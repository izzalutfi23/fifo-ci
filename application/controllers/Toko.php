<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller {

    function __construct(){
		parent::__construct();
        $this->load->model('Mproduk');
        $this->load->model('Msuplier');
        $this->load->model('Mtoko');
		if($this->session->userdata('user')){
            
        }
        else{
            redirect('login');
        }
	}

    public function index(){
		$toko = $this->Mtoko->getToko()->result();
        $data = [
            'title' => 'Toko | Fifo',
			'toko' => $toko
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/toko');
        $this->load->view('fifo/_footer');
    }

    public function store(){
        $input = $this->input->post(null, true);
		$this->Mtoko->store($input);
		redirect('toko');
    }

    public function update(){
        $id = $this->input->post('id');
		$data = [
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
			'telepon' => $this->input->post('telepon')
		];
		$this->Mtoko->update($data, $id);
		redirect('toko');
    }

    public function delete($id){
		$this->Mtoko->delete($id);
		redirect('toko');
	}
}