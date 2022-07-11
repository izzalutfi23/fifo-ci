<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mhome extends CI_Model {
	
    public function get_train($id=null){
        if($id!=null){
            $this->db->where('label', $id);
        }
        return $this->db->get('train');
    }

    public function train_update($data, $id){
        $this->db->update('train', $data, ['id'=>$id]);
    }

    public function deltrain($id){
        $this->db->where('id', $id);
        $this->db->delete('train');
    }

    public function getResult($k){
        $this->db->limit($k, 0);
        $this->db->order_by('amount', 'asc');
        return $this->db->get('result');
    }

    public function delresult(){
        $this->db->truncate('result');
    }

    public function train_insert($data){
        $this->db->insert('train', $data);
    }

    public function insertresult($data){
        $this->db->insert('result', $data);
    }

}