<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function check_credentials($email, $password) {
        $query = $this->db->get_where('users', array('email' => $email));
        
        if ($query->num_rows() == 1) {
            $user = $query->row();
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        
        return false;
    }

    public function get_username($email) {
        $query = $this->db->get_where('users', array('email' => $email));
        if ($query->num_rows() == 1) {
            $user = $query->row();
            return $user->username;
        }
        return false;
    }

    public function create_user($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }
}