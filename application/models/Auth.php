<?php
    class Auth extends CI_Model{
        public function cek($user, $pass){
            return $this->db->get_where('user', array('username'=>$user, 'password'=>$pass));
        }
    }
?>