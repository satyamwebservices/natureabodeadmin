<?php 

class Resort_model extends CI_Model {
   
    public function set_news($data) {
        return $this->db->insert('resort', $data);
        //$this->db->resort('resort', $data);
    }

    public function get_resort() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('resort');
        return $query->result_array();
    }

    public function update_resort($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('resort', $data);
    }

    public function update_status($newStatus) {
        $data = array('status' => $newStatus);

        $this->db->where('id', $id); 
        $this->db->update('resort', $data);
    }

    public function getSelectedCategory($resortId) {
        $query = $this->db->select('category')->where('id', $resortId)->get('resort');
        
        if ($query->num_rows() > 0) {
            return $query->row()->category;
        }
        
        return '';
    }


    public function getAllCategories() {
        $query = $this->db->select('title')->get('category');
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        
        return array();
    }

    public function get_resorts($id) {
        $query = $this->db->get_where('resort', array('id' => $id));
        return $query->row_array();
    }


    public function delete_record($id) {
        $this->db->where('id', $id);
        return $this->db->delete('resort');
    }

}