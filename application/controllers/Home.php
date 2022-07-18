<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Mhome');
	}

	public function index()
	{
		$train = $this->Mhome->get_train()->result();
		// print_r($train);
		$data = [
			'title' => 'Home | Fifo',
			'train' => count($train)
		];
		$this->load->view('fifo/_header', $data);
		$this->load->view('fifo/page/home');
		$this->load->view('fifo/_footer');
	}
}