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
        $input = $this->input->post(null, true);
		$this->Msuplier->store($input);
		redirect('suplier');
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