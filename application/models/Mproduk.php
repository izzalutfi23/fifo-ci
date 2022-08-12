<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mproduk extends CI_Model {
	
    public function getProduk(){
        $this->db->select('p.*, s.nama as suplier');
        $this->db->join('suplier as s', 's.id=p.suplier_id');
        return $this->db->get('barang as p');
    }

    public function getById($id){
        $this->db->where('id', $id);
        return $this->db->get('barang');
    }

    public function store($data){
        $this->db->insert('barang', $data);
    }

    public function update($data, $id){
        $this->db->update('barang', $data, ['id'=>$id]);
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('barang');
    }

}