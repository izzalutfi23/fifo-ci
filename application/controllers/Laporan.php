<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Options;
use Dompdf\Dompdf;
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
        $transaksi = $this->db->get_where('transaksi', ['barang_id' => $barang->id, 'type' => 'pembelian', 'terpakai' => '0'])->result();
        foreach($laporan as $data){
            $data->pembelian = json_decode($data->pembelian);
            $data->hpp = json_decode($data->hpp);
            $data->saldo = json_decode($data->saldo);
        }
        foreach($transaksi as $trx){
            $trx->pembelian = json_decode($trx->pembelian);
        }
        $data = [
            'title' => 'Laporan Stok Barang | Fifo',
            'barang' => $barang,
			'laporan' => $laporan,
            'transaksi' => $transaksi
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/fifo');
        $this->load->view('fifo/_footer');
    }

    public function pdf($id){
        $laporan = $this->Mlaporan->getLaporan($id)->result();
        $barang = $this->Mproduk->getById($id)->row();
        foreach($laporan as $data){
            $data->pembelian = json_decode($data->pembelian);
            $data->hpp = json_decode($data->hpp);
            $data->saldo = json_decode($data->saldo);
        }
        $datas = [
            'barang' => $barang,
			'laporan' => $laporan
        ];
        $this->load->library('pdf');
        $file_pdf = 'laporan-stok.pdf';
        $paper = 'A4';
        $orientation = "portrait";
        
		$html = $this->load->view('fifo/page/pdf/fifo',$datas, true);
        $this->pdf->generate($html, $file_pdf,$paper,$orientation);
    }

}