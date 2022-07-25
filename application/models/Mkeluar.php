<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkeluar extends CI_Model {
	
    public function getCart(){
        $this->db->join('barang', 'barang.id=keranjang.barang_id');
        return $this->db->get('keranjang');
    }

    public function getCartById($id){
        $this->db->where('barang_id', $id);
        return $this->db->get('keranjang');
    }

    public function getByProduk($id){
        $this->db->where('barang_id', $id);
        return $this->db->get('keranjang');
    }

    public function updateCart($data, $id){
        $this->db->update('keranjang', $data, ['barang_id'=>$id]);
    }

    public function getTrx($id){
        $this->db->where('barang_id', $id);
        $this->db->where_in('type', ['awal', 'pembelian']);
        $this->db->where('terpakai', '0');
        return $this->db->get('transaksi');
    }

    public function updateTrx($data, $id){
        $this->db->update('transaksi', $data, ['id'=>$id]);
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

    public function deleteCart(){
        $this->db->truncate('keranjang');
    }

}