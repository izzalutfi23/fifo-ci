<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyimpanan extends CI_Controller {

    function __construct(){
		parent::__construct();
		$this->load->model('Mhome');
        $this->load->model('Mproduk');
        $this->load->model('Msimpan');
		if($this->session->userdata('user')){
            
        }
        else{
            redirect('login');
        }
	}

    public function index(){
		$this->db->select('RIGHT(faktur,5) as kode', FALSE);
        $this->db->where('type', 'pembelian');
        $this->db->order_by('kode','DESC');    
        $this->db->limit(1);
        $query = $this->db->get('transaksi');
            if($query->num_rows() <> 0){      
                $data = $query->row();
                $kode = intval($data->kode) + 1; 
            }
            else{      
                $kode = 1;  
            }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
        $faktur = "IN-".$batas;

        $produk = $this->Mproduk->getProduk()->result();
        $simpan = $this->Msimpan->getSimpan()->result();
        $data = [
            'title' => 'Pembelian | Fifo',
            'produk' => $produk,
            'faktur' => $faktur,
            'simpan' => $simpan
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/penyimpanan');
        $this->load->view('fifo/_footer');
    }

    public function store(){
        $input = $this->input->post(null, true);
		$this->Msimpan->store($input);
		redirect('penyimpanan');
    }

    public function delete($id){
		$this->Msimpan->delete($id);
		redirect('penyimpanan');
	}
}