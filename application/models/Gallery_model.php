<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function set_news($data) {
        return $this->db->insert('gallery', $data);
    }

    public function get_gallery() {
        $this->db->where('status', 1);
        $query = $this->db->get('gallery');
        return $query->result_array();
    }

    public function get_gallerys($id) {
        $query = $this->db->get_where('gallery', array('id' => $id));
        return $query->row_array();
    }

    public function update_gallery($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('gallery', $data);
    }

    public function delete_record($id) {
        $this->db->where('id', $id);
        return $this->db->delete('gallery');
    }
}
?>