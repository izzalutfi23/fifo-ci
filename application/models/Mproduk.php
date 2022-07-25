<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mproduk extends CI_Model {
	
    public function getProduk(){
        return $this->db->get('barang');
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