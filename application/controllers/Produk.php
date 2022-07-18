<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    function __construct(){
		parent::__construct();
		$this->load->model('Mhome');
        $this->load->model('Mproduk');
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
        $input = $this->input->post(null, true);
		$this->Mproduk->store($input);
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
}