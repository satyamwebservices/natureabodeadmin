<?php 
class Category_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function set_news($data) {
        return $this->db->insert('category', $data);
    }

    public function get_categorys($id) {
        $query = $this->db->get_where('category', array('id' => $id));
        return $query->row_array();
    }

    public function get_category_title($category_id) {
        $this->db->where('id', $category_id);
        $query = $this->db->get('category');
        $result = $query->row_array();
        return $result['place'];
    }
     function get_category() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('category');
        return $query->result_array();
    }

    public function update_category($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('category', $data);
    }

    public function delete_record($id) {
        $this->db->where('id', $id);
        return $this->db->delete('category');
    }
}