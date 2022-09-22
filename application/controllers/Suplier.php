<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suplier extends CI_Controller {

    function __construct(){
		parent::__construct();
        $this->load->model('Mproduk');
        $this->load->model('Msuplier');
		if($this->session->userdata('user')){
            
        }
        else{
            redirect('login');
        }
	}

    public function index(){
		$suplier = $this->Msuplier->getSuplier()->result();
        $data = [
            'title' => 'Suplier | Fifo',
			'suplier' => $suplier
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/suplier');
        $this->load->view('fifo/_footer');
    }

    public function store(){
        $sup = $this->db->get_where('suplier', ['kode' => $this->input->post('kode')])->row();
        if(count($sup) > 0){
            redirect('suplier');
        }
        else{
            $input = $this->input->post(null, true);
            $this->Msuplier->store($input);
            redirect('suplier');
        }
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

    public function pdf(){
        $suplier = $this->Msuplier->getSuplier()->result();
        $datas = [
            'suplier' => $suplier
        ];
        $this->load->library('pdf');
        $file_pdf = 'laporan-suplier.pdf';
        $paper = 'A4';
        $orientation = "portrait";
        
		$html = $this->load->view('fifo/page/pdf/suplier',$datas, true);
        $this->pdf->generate($html, $file_pdf,$paper,$orientation);
    }
}