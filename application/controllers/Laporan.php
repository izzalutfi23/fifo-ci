<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    function __construct(){
		parent::__construct();;
        $this->load->model('Mkeluar');
        $this->load->model('Mlaporan');
        $this->load->model('Mproduk');
		if($this->session->userdata('user')){
            
        }
        else{
            redirect('login');
        }
	}

    public function index(){
		$barang = $this->Mproduk->getProduk()->result();
        $data = [
            'title' => 'Pilih Barang | Fifo',
			'barang' => $barang
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/cari');
        $this->load->view('fifo/_footer');
    }

    public function hasil(){
		$laporan = $this->Mlaporan->getLaporan($this->input->post('barang_id'))->result();
        $barang = $this->Mproduk->getById($this->input->post('barang_id'))->row();
        foreach($laporan as $data){
            $data->pembelian = json_decode($data->pembelian);
            $data->hpp = json_decode($data->hpp);
            $data->saldo = json_decode($data->saldo);
        }
        $data = [
            'title' => 'Laporan Stok Barang | Fifo',
            'barang' => $barang,
			'laporan' => $laporan
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/fifo');
        $this->load->view('fifo/_footer');
    }

}