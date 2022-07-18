<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpembelian extends CI_Model {
	
    public function getPembelian(){
        $this->db->select('t.id, b.nama as barang, s.nama as suplier, t.tgl, t.pembelian, t.status, t.type');
        $this->db->where('type', 'pembelian');
        $this->db->join('barang as b', 'b.id=t.barang_id', 'left');
        $this->db->join('suplier as s', 's.id=t.suplier_id', 'left');
        return $this->db->get('transaksi as t');
    }

    public function store($data){
        $this->db->insert('transaksi', $data);
    }

    public function update($data, $id){
        $this->db->update('barang', $data, ['id'=>$id]);
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('barang');
    }

}