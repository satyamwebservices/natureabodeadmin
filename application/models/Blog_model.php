<?php 

class Blog_model extends CI_Model {
   
    public function set_news($data) {
        return $this->db->insert('blog', $data);
    }

    public function get_blogs() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('blog');
        return $query->result_array();
    }

    public function update_blog($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('blog', $data);
    }

    public function update_status($newStatus) {
        $data = array('status' => $newStatus);

        $this->db->where('id', $id); 
        $this->db->update('blog', $data);
    }

    public function getSelectedCategory($articleId) {
        $query = $this->db->select('category')->where('id', $articleId)->get('article');
        
        if ($query->num_rows() > 0) {
            return $query->row()->category;
        }
        
        return '';
    }

    public function getAllCategories() {
        $query = $this->db->select('title')->get('categories');
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        
        return array();
    }

    public function get_blog($id) {
        $query = $this->db->get_where('blog', array('id' => $id));
        return $query->row_array();
    }

    public function delete_record($id) {
        $this->db->where('id', $id);
        return $this->db->delete('blog');
    }

    public function get_blog_by_slug($slug)
{
    // Modify this method based on your database structure
    $this->db->select('*')->from('blog')->where('slug', $slug)->get()->row_array();
    return array(); 
}

}