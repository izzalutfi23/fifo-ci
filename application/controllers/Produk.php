<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    function __construct(){
		parent::__construct();
		$this->load->model('Mhome');
        $this->load->model('Mproduk');
        $this->load->model('Mpembelian');
		if($this->session->userdata('user')){
            
        }
        else{
            redirect('login');
        }
	}

    public function index(){
		$produk = $this->Mproduk->getProduk()->result();
        $data = [
            'title' => 'Produk | Fifo',
			'produk' => $produk
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/produk');
        $this->load->view('fifo/_footer');
    }

    public function store(){        
        $input = [
            'kode_barang' => $this->input->post('kode_barang'),
            'barcode' => $this->input->post('barcode'),
            'nama' => $this->input->post('nama'),
            'c2' => $this->input->post('c2'),
            'stok' => $this->input->post('stok'),
            'umur' => $this->input->post('umur'),
            'retur' => $this->input->post('retur'),
            'harga' => $this->input->post('harga'),
            'trx_id' => 0,
            'qty' => $this->input->post('stok')
        ];
        $this->Mproduk->store($input);
        $last_id = $this->db->insert_id();
        $arr = [
            'jumlah' => $this->input->post('stok'),
            'harga' => $this->input->post('harga')
        ];
        $input = [
            'barang_id' => $last_id,
            'faktur' => 'Awal-001',
            'tgl' => date('Y-m-d'),
            'status' => '0',
            'saldo' => json_encode($arr),
            'type' => 'awal'
        ];
        $this->Mpembelian->store($input);
        $id = $this->db->insert_id();
        // Update produk
        $data = [
			'trx_id' => $id 
		];
		$this->Mproduk->update($data, $last_id);
		redirect('produk');
    }

    public function update(){
        $id = $this->input->post('id');
		$data = [
			'kode_barang' => $this->input->post('kode_barang'),
			'barcode' => $this->input->post('barcode'),
			'nama' => $this->input->post('nama'),
			'c2' => $this->input->post('c2'),
			'stok' => $this->input->post('stok'),
			'umur' => $this->input->post('umur'),
            'retur' => $this->input->post('retur'),
            'harga' => $this->input->post('harga'),
		];
		$this->Mproduk->update($data, $id);
		redirect('produk');
    }

    public function delete($id){
		$this->Mproduk->delete($id);
		redirect('produk');
	}

    public function pdf(){
        $barang = $this->Mproduk->getProduk()->result();
        $datas = [
            'produk' => $barang
        ];
        $this->load->library('pdf');
        $file_pdf = 'laporan-barang.pdf';
        $paper = 'A4';
        $orientation = "portrait";
        
		$html = $this->load->view('fifo/page/pdf/produk',$datas, true);
        $this->pdf->generate($html, $file_pdf,$paper,$orientation);
    }
}