<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muser extends CI_Model {
	
    public function getUser(){
        return $this->db->get('user');
    }

    public function store($data){
        $this->db->insert('user', $data);
    }

    public function update($data, $id){
        $this->db->update('user', $data, ['id'=>$id]);
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('user');
    }

}