<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkeluar extends CI_Model {
	
    public function getCart(){
        $this->db->join('barang', 'barang.id=keranjang.barang_id');
        return $this->db->get('keranjang');
    }

    public function getPenjualan(){
        return $this->db->get('penjualan');
    }

    public function storeCart($data){
        $this->db->insert('keranjang', $data);
    }

    public function storePenjualan($data){
        $this->db->insert('penjualan', $data);
    }

}