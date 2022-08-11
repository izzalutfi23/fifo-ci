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

    public function create(){
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

        $produk = $this->Mproduk->getProduk()->result();
        $cart = $this->Mpembelian->getCart()->result();
        $data = [
            'title' => 'Buat Pembelian | Fifo',
            'produk' => $produk,
            'cart' => $cart,
            'faktur' => $faktur
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/create_beli');
        $this->load->view('fifo/_footer');
    }

    public function storeCart(){
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
		redirect('pembelian/create');
    }

    public function delcart($id){
        $this->Mpembelian->delCart($id);
        redirect('pembelian/create');
    }

    public function storeBeli(){
        $keluar = [
            'faktur' => $this->input->post('faktur'),
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
        $data = [
            'title' => 'Detail Barang Keluar | Fifo',
            'detail' => $detail,
            'pembelian' => $pembelian
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/detail_masuk');
        $this->load->view('fifo/_footer');
    }

    public function store(){
        $produk = $this->Mproduk->getById($this->input->post('barang_id'))->row();
        $newStok = $produk->stok + $this->input->post('jumlah');
        $dataProduk = [
            'stok' => $newStok
        ];
        
        $this->Mproduk->update($dataProduk, $this->input->post('barang_id'));
        $arr = [
            'jumlah' => $this->input->post('jumlah'),
            'harga' => $this->input->post('harga')
        ];
        $saldo = [
            'jumlah' => $this->input->post('jumlah'),
            'harga' => $this->input->post('harga')
        ];
        $input = [
            'barang_id' => $this->input->post('barang_id'),
            'faktur' => $this->input->post('faktur'),
            'tgl' => $this->input->post('tgl'),
            'status' => '0',
            'pembelian' => json_encode($arr),
            'saldo' => json_encode($saldo),
            'type' => 'pembelian'
        ];
        $data = [
            'jumlah' => $this->input->post('jumlah'),
            'harga' => $this->input->post('harga'),
            'status' => '1'
        ];
        $this->Mpembelian->updateDetail($data, $this->input->post('id'));
		$this->Mpembelian->store($input);
		redirect('pembelian/detail/'.$this->input->post('pembelian_id'));
    }

    public function delete($id){
		$this->Msuplier->delete($id);
		redirect('suplier');
	}

    public function pdf(){
        $pembelian = $this->Mpembelian->getPembelian()->result();
        foreach($pembelian as $beli){
            $beli->pembelian = json_decode($beli->pembelian);
        }
        $datas = [
            'pembelian' => $pembelian
        ];
        $this->load->library('pdf');
        $file_pdf = 'laporan-barang-masuk.pdf';
        $paper = 'A4';
        $orientation = "portrait";
        
		$html = $this->load->view('fifo/page/pdf/pembelian',$datas, true);
        $this->pdf->generate($html, $file_pdf,$paper,$orientation);
    }
}