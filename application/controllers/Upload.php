<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    public function upload_image() {
        $config['upload_path'] = './assets/uploads/'; // Set your upload path
        $config['allowed_types'] = 'gif|jpg|png'; // Set allowed image types
        $config['max_size'] = 1024; // Set maximum file size
        // Add more configurations as needed
    
        $this->load->library('upload', $config);
    
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            // Handle upload error
        } else {
            $data = array('upload_data' => $this->upload->data());
            // Handle successful upload, return image URL or path
            echo base_url('assets/uploads/' . $data['upload_data']['file_name']);
        }
    }
}