<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    function __construct(){
		parent::__construct();;
        $this->load->model('Mkeluar');
		if($this->session->userdata('user')){
            
        }
        else{
            redirect('login');
        }
	}

    public function index(){
		$penjualan = $this->Mkeluar->getPenjualan()->result();
        $data = [
            'title' => 'Laporan Stok Barang | Fifo',
			'penjualan' => $penjualan
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/fifo');
        $this->load->view('fifo/_footer');
    }

}