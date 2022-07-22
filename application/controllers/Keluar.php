<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluar extends CI_Controller {

    function __construct(){
		parent::__construct();
        $this->load->model('Mproduk');
        $this->load->model('Msuplier');
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
            'title' => 'Barang Keluar | Fifo',
			'penjualan' => $penjualan
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/keluar');
        $this->load->view('fifo/_footer');
    }

    public function create(){
        $this->db->select('RIGHT(faktur,5) as kode', FALSE);
        $this->db->order_by('kode','DESC');    
        $this->db->limit(1);
        $query = $this->db->get('penjualan');
            if($query->num_rows() <> 0){      
                 $data = $query->row();
                 $kode = intval($data->kode) + 1; 
            }
            else{      
                 $kode = 1;  
            }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
        $faktur = "IN-".$batas;
		$cart = $this->Mkeluar->getCart()->result();
        $produk = $this->Mproduk->getProduk()->result();
        $data = [
            'title' => 'Tambah Barang Keluar | Fifo',
			'cart' => $cart,
            'faktur' => $faktur,
            'produk' => $produk
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/create');
        $this->load->view('fifo/_footer');
    }

    public function storeCart(){
        $data = [
            'barang_id' => $this->input->post('barang_id'),
            'jumlah' => $this->input->post('jumlah')
        ];
        $this->Mkeluar->storeCart($data);
		redirect('keluar/create');
    }

    public function store(){
        $keluar = [
            'faktur' => $this->input->post('faktur'),
            'pelanggan' => $this->input->post('pelanggan'),
            'tgl' => $this->input->post('tanggal'),
            'total' => $this->input->post('total')
        ];
		$this->Mkeluar->storePenjualan($keluar);
		redirect('keluar');
    }

    public function delete($id){
		$this->Msuplier->delete($id);
		redirect('suplier');
	}
}