<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {

    public function login_chk ($email ,$password) {
        
    	 $this->db->where('email', $email);
    	 $this->db->where('password', $password); 
         $this->db->from('user_master');
         $query = $this->db->get();
    
           if($query->num_rows() == 1) {
    
              return $query->row();
    
          } else {
          	return false;
          }
      }

}