<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlaporan extends CI_Model {
	
    public function getLaporan($id){
        $this->db->select('t.id, b.nama as barang, t.tgl, t.pembelian, t.status, t.type, t.faktur, t.hpp, t.saldo');
        $this->db->join('barang as b', 'b.id=t.barang_id', 'left');
        $this->db->order_by('id', 'asc');
        $this->db->where('barang_id', $id);
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