<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert_gallery($data) {
        $this->db->insert('gallery', $data);
        return $this->db->insert_id();
    }

    public function get_gallery() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('gallery');
        return $query->result_array();
    }

    public function get_gallery_data_by_id($galleryId) {
        // Fetch gallery data from the database based on the provided gallery ID
        $query = $this->db->get_where('gallery', array('id' => $galleryId));
        return $query->row_array();
    }

    public function update_gallery($galleryId, $data) {
        // Update gallery data in the database based on the provided gallery ID
        $this->db->where('id', $galleryId);
        $this->db->update('gallery', $data);
        return true; // Return true for successful update
    }
}
?>