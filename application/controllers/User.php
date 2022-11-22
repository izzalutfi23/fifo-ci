<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct(){
		parent::__construct();
        $this->load->model('Muser');
		if($this->session->userdata('user')){
            
        }
        else{
            redirect('login');
        }
	}

    public function index(){
		$user = $this->Muser->getUser()->result();
        $data = [
            'title' => 'User | Fifo',
			'user' => $user
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/user');
        $this->load->view('fifo/_footer');
    }

    public function store(){
        $data = [
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'role' => $this->input->post('role'),
        ];
		$this->Muser->store($data);
		redirect('user');
    }

    public function update(){
        $id = $this->input->post('id');
        $pass = $this->input->post('password');
        if($pass != null){
            $data = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'role' => $this->input->post('role'),
            ];
        }
        else{
            $data = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username')
            ];
        }
		$this->Muser->update($data, $id);
		redirect('user');
    }

    public function delete($id){
		$this->Muser->delete($id);
		redirect('user');
	}
}