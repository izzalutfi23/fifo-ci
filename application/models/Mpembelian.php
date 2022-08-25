<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpembelian extends CI_Model {
	
    public function getPembelian(){
        $this->db->select('p.*, s.nama');
        $this->db->join('suplier as s', 's.id=p.suplier_id');
        return $this->db->get('pembelian as p');
    }

    public function store($data){
        $this->db->insert('transaksi', $data);
    }

    public function update($data, $id){
        $this->db->update('barang', $data, ['id'=>$id]);
    }

    public function getCart(){
        $this->db->select('c.*, b.nama, b.c2, b.barcode, b.retur');
        $this->db->join('barang as b', 'b.id=c.barang_id');
        return $this->db->get('cart as c');
    }

    public function getByProduk($id){
        $this->db->where('barang_id', $id);
        return $this->db->get('cart');
    }

    public function storeCart($data){
        $this->db->insert('cart', $data);
    }

    public function getCartById($id){
        $this->db->where('barang_id', $id);
        return $this->db->get('cart');
    }

    public function updateCart($data, $id){
        $this->db->update('cart', $data, ['barang_id'=>$id]);
    }

    public function delCart($id){
        $this->db->where('barang_id', $id);
        $this->db->delete('cart');
    }

    public function storePembelian($data){
        $this->db->insert('pembelian', $data);
    }

    public function storeDetail($data){
        $this->db->insert('detail', $data);
    }

    public function deleteCart(){
        $this->db->truncate('cart');
    }

    public function getByPembelian($id){
        $this->db->select('d.*, b.kode_barang, b.barcode, b.nama, b.c2, b.stok, b.umur, b.retur');
        $this->db->join('barang as b', 'b.id=d.barang_id');
        $this->db->where('d.pembelian_id', $id);
        return $this->db->get('detail as d');
    }

    public function getByPembelian1($id){
        $this->db->select('d.*, b.kode_barang, b.barcode, b.suplier_id, b.nama, b.c2, b.stok, b.umur, b.retur');
        $this->db->join('barang as b', 'b.id=d.barang_id');
        $this->db->where('d.id', $id);
        return $this->db->get('detail as d');
    }

    public function updateDetail($data, $id){
        $this->db->update('detail', $data, ['id'=>$id]);
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('barang');
    }

}