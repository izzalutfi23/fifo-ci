<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtoko extends CI_Model {
	
    public function getToko(){
        return $this->db->get('toko');
    }

    public function store($data){
        $this->db->insert('toko', $data);
    }

    public function update($data, $id){
        $this->db->update('toko', $data, ['id'=>$id]);
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('toko');
    }

}