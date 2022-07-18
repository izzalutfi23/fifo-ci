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
            'pembelian' => $pembelian
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/pembelian');
        $this->load->view('fifo/_footer');
    }

    public function store(){
        $arr = [
            'jumlah' => $this->input->post('jumlah'),
            'satuan' => $this->input->post('satuan'),
            'harga' => $this->input->post('harga')
        ];
        $input = [
            'barang_id' => $this->input->post('barang_id'),
            'suplier_id' => $this->input->post('suplier_id'),
            'tgl' => $this->input->post('tgl'),
            'status' => '0',
            'pembelian' => json_encode($arr),
            'type' => 'pembelian'
        ];
		$this->Mpembelian->store($input);
		redirect('pembelian');
    }

    public function update(){
        $id = $this->input->post('id');
		$data = [
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
			'hp' => $this->input->post('hp')
		];
		$this->Msuplier->update($data, $id);
		redirect('suplier');
    }

    public function delete($id){
		$this->Msuplier->delete($id);
		redirect('suplier');
	}
}