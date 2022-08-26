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

    public function getByPenjualan($id){
        $this->db->where('t.penjualan_id', $id);
        $this->db->select('t.id, b.nama as barang, b.harga, b.c2, t.status, t.jumlah, t.barang_id');
        $this->db->join('barang as b', 'b.id=t.barang_id', 'left');
        return $this->db->get('detail_keluar as t');
    }

    public function getByProduk($id){
        $this->db->where('barang_id', $id);
        return $this->db->get('keranjang');
    }

    public function updateCart($data, $id){
        $this->db->update('keranjang', $data, ['barang_id'=>$id]);
    }

    public function delCart($id){
        $this->db->where('barang_id', $id);
        $this->db->delete('keranjang');
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
        $this->db->select('p.*, t.nama');
        $this->db->join('toko as t', 't.id=p.toko_id');
        return $this->db->get('penjualan as p');
    }

    public function storeCart($data){
        $this->db->insert('keranjang', $data);
    }

    public function storeDetail($data){
        $this->db->insert('detail_keluar', $data);
    }

    public function updateDetail($data, $id){
        $this->db->update('detail_keluar', $data, ['id'=>$id]);
    }

    public function storePenjualan($data){
        $this->db->insert('penjualan', $data);
    }

    public function deleteCart(){
        $this->db->truncate('keranjang');
    }

}