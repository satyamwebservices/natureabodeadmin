<?php 

class Slider_model extends CI_Model {
   
    public function set_news($data) {
        return $this->db->insert('slider', $data);
    }

    public function get_slider() {
        $query = $this->db->get('slider');
        return $query->result_array();
    }

    public function update_slider($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('slider', $data);
    }

    public function get_sliders($id) {
        $query = $this->db->get_where('slider', array('id' => $id));
        return $query->row_array();
    }

    public function delete_record($id) {
        $this->db->where('id', $id);
        return $this->db->delete('slider');
    }

    
}