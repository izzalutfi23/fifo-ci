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
        // $mpdf = new \Mpdf\Mpdf();
        // $mpdf->showImageErrors = true;
		// $data = $this->load->view('fifo/page/pdf/fifo', $datas, TRUE);
		// $mpdf->WriteHTML($data);
		// $mpdf->Output();
        // $data = array(
        //     "dataku" => array(
        //         "nama" => "Petani Kode",
        //         "url" => "http://petanikode.com"
        //     )
        // );
    
        // $this->load->library('pdf');
    
        // $this->pdf->setPaper('A4', 'potrait');
        // $this->pdf->filename = "laporan-stok.pdf";
        // $this->pdf->load_view('fifo/page/pdf/fifo', $datas);

        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdf');
        
        // title dari pdf
        // $this->data['title_pdf'] = 'Laporan Penjualan Toko Kita';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'laporan-stok.pdf';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        
		$html = $this->load->view('fifo/page/pdf/fifo',$datas, true);	    
        
        // run dompdf
        $this->pdf->generate($html, $file_pdf,$paper,$orientation);
    }

}