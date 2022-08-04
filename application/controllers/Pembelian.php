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
        foreach($pembelian as $beli){
            $beli->pembelian = json_decode($beli->pembelian);
        }
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
            'suplier_id' => $this->input->post('suplier_id'),
            'faktur' => $this->input->post('faktur'),
            'tgl' => $this->input->post('tgl'),
            'status' => '0',
            'pembelian' => json_encode($arr),
            'saldo' => json_encode($saldo),
            'type' => 'pembelian'
        ];
		$this->Mpembelian->store($input);
		redirect('pembelian');
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