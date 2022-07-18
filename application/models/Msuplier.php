<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msuplier extends CI_Model {
	
    public function getSuplier(){
        return $this->db->get('suplier');
    }

    public function store($data){
        $this->db->insert('suplier', $data);
    }

    public function update($data, $id){
        $this->db->update('suplier', $data, ['id'=>$id]);
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('suplier');
    }

}