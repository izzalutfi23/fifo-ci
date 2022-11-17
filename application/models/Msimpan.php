<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msimpan extends CI_Model {
	
    public function getSimpan(){
        $this->db->select('b.nama, b.kode_barang, b.c2, b.retur, p.*');
        $this->db->join('barang as b', 'b.id=p.barang_id');
        return $this->db->get('penyimpanan as p');
    }

    public function store($data){
        $this->db->insert('penyimpanan', $data);
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('penyimpanan');
    }

}