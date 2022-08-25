<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {

    function __construct(){
		parent::__construct();
        $this->load->model('Mproduk');
        $this->load->model('Msuplier');
        $this->load->model('Mpembelian');
		if($this->session->userdata('user')){
            
        }
        else{
            redirect('login');
        }
	}

    public function index(){
        $this->db->select('RIGHT(faktur,5) as kode', FALSE);
        $this->db->where('type', 'pembelian');
        $this->db->order_by('kode','DESC');    
        $this->db->limit(1);
        $query = $this->db->get('transaksi');
            if($query->num_rows() <> 0){      
                $data = $query->row();
                $kode = intval($data->kode) + 1; 
            }
            else{      
                $kode = 1;  
            }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
        $faktur = "IN-".$batas;


		$suplier = $this->Msuplier->getSuplier()->result();
        $produk = $this->Mproduk->getProduk()->result();
        $pembelian = $this->Mpembelian->getPembelian()->result();
        $data = [
            'title' => 'Pembelian | Fifo',
			'suplier' => $suplier,
            'produk' => $produk,
            'pembelian' => $pembelian,
            'faktur' => $faktur
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/pembelian');
        $this->load->view('fifo/_footer');
    }

    public function before(){
        $id = $this->input->post('suplier_id');
        redirect('pembelian/create/'.$id);
    }

    public function create($id){
        $this->db->select('RIGHT(faktur,5) as kode', FALSE);
        $this->db->order_by('kode','DESC');    
        $this->db->limit(1);
        $query = $this->db->get('pembelian');
            if($query->num_rows() <> 0){      
                $data = $query->row();
                $kode = intval($data->kode) + 1; 
            }
            else{      
                $kode = 1;  
            }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
        $faktur = "IN-".$batas;
        $suplier = $this->db->get_where('suplier', ['id' => $id])->row();
        $produk = $this->db->get_where('barang', ['suplier_id' => $id])->result();
        $cart = $this->Mpembelian->getCart()->result();
        $data = [
            'title' => 'Buat Pembelian | Fifo',
            'produk' => $produk,
            'cart' => $cart,
            'faktur' => $faktur,
            'suplier' => $suplier
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/create_beli');
        $this->load->view('fifo/_footer');
    }

    public function storeCart(){
        $sid = $this->input->post('sid');
        $data = [
            'barang_id' => $this->input->post('barang_id'),
            'jumlah' => $this->input->post('jumlah'),
            'harga' => $this->input->post('harga')
        ];
        $cek = count($this->Mpembelian->getByProduk($this->input->post('barang_id'))->result());
        if($cek < 1){
            $this->Mpembelian->storeCart($data);
        }
        else{
            $id_barang = $this->input->post('barang_id');
            $barang = $this->Mpembelian->getCartById($id_barang)->row();
            $payload = [
                'jumlah' => $barang->jumlah + $this->input->post('jumlah')
            ];
            $this->Mpembelian->updateCart($payload, $id_barang);
        }
		redirect('pembelian/create/'.$sid);
    }

    public function delcart($id, $sid){
        $this->Mpembelian->delCart($id);
        redirect('pembelian/create/'.$sid);
    }

    public function storeBeli(){
        $keluar = [
            'faktur' => $this->input->post('faktur'),
            'suplier_id' => $this->input->post('sid'),
            'tgl' => $this->input->post('tanggal')
        ];
		$this->Mpembelian->storePembelian($keluar);
        $last_id = $this->db->insert_id();
        $carts = $this->Mpembelian->getCart()->result();
        foreach($carts as $cart){
            $data = [
                'barang_id' => $cart->barang_id,
                'pembelian_id' => $last_id,
                'faktur' => $this->input->post('faktur'),
                'jumlah' => $cart->jumlah,
                'harga' => $cart->harga,
                'status' => '0'
            ];
            $this->Mpembelian->storeDetail($data);
        }

        $this->Mpembelian->deleteCart();
        redirect('pembelian');
    }

    public function detail($id){
        $detail = $this->Mpembelian->getByPembelian($id)->result();
        $pembelian = $this->db->get_where('pembelian', ['id' => $id])->row();
        $suplier = $this->db->get_where('suplier', ['id' => $pembelian->suplier_id])->row();
        $data = [
            'title' => 'Detail Barang Keluar | Fifo',
            'detail' => $detail,
            'pembelian' => $pembelian,
            'suplier' => $suplier
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/detail_masuk');
        $this->load->view('fifo/_footer');
    }

    public function store(){
        $data = [
            'jumlah' => $this->input->post('jumlah'),
            'harga' => $this->input->post('harga'),
            'status' => '1'
        ];
        $this->Mpembelian->updateDetail($data, $this->input->post('id'));
		redirect('pembelian/detail/'.$this->input->post('pembelian_id'));
    }

    public function konfirmasi($id){
        $details = $this->db->get_where('detail', ['pembelian_id' => $id, 'status' => '0'])->result();
        $pembelian = $this->db->get_where('pembelian', ['id' => $id])->row();
        foreach($details as $detail){
            $produk = $this->Mproduk->getById($detail->barang_id)->row();
            $newStok = $produk->stok + $detail->jumlah;
            $dataProduk = [
                'stok' => $newStok
            ];
    
            $arr = [
                'jumlah' => $detail->jumlah,
                'harga' => $detail->harga
            ];
            $saldo = [
                'jumlah' => $detail->jumlah,
                'harga' => $detail->harga
            ];
            $input = [
                'barang_id' => $detail->barang_id,
                'faktur' => $pembelian->faktur,
                'tgl' => $pembelian->tgl,
                'status' => '0',
                'pembelian' => json_encode($arr),
                'saldo' => json_encode($saldo),
                'type' => 'pembelian'
            ];
            $data = [
                'status' => '1'
            ];
            if($detail->status == '0'){
                $this->Mproduk->update($dataProduk, $detail->barang_id);
                $this->Mpembelian->store($input);
            }
            $this->Mpembelian->updateDetail($data, $detail->id);
        }
        redirect('pembelian/detail/'.$id);
    }

    public function delete($id){
		$this->Msuplier->delete($id);
		redirect('suplier');
	}

    public function pdf($id){
        $pembelian = $this->db->get_where('pembelian', ['id' => $id])->row();
        $suplier = $this->db->get_where('suplier', ['id' => $pembelian->suplier_id])->row();
        $beli = $this->Mpembelian->getByPembelian($pembelian->id)->result();
        $datas = [
            'pembelian' => $pembelian,
            'suplier' => $suplier,
            'beli' => $beli
        ];
        $this->load->library('pdf');
        $file_pdf = 'formulir-pembelian.pdf';
        $paper = 'A4';
        $orientation = "portrait";
        
		$html = $this->load->view('fifo/page/pdf/detail_beli',$datas, true);
        $this->pdf->generate($html, $file_pdf,$paper,$orientation);
    }
}