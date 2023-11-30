<?php
class Gallery extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Gallery_model');
        $this->load->library('form_validation');
        
    }

        public function index()
        {
            $data['gallery'] = $this->Gallery_model->get_gallery();
            $this->load->view('header');
            $this->load->view('gallery', $data);
            $this->load->view('footer');
        }
        public function add() {
            date_default_timezone_set('Asia/Kolkata');
            $current_date = date('Y-m-d H:i:s');
        
            $this->form_validation->set_rules('title', 'Title', 'required');
        
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('header');
                $this->load->view('gallery-add');
                $this->load->view('footer');
            } else {
                // File upload configuration for gallery images
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // 2MB max file size
                $config['file_name'] = uniqid(); // Generate a unique file name
        
                $this->load->library('upload', $config);
        
                $hero_image = '';
                    if ($_FILES['heroimg']['name'] && $this->upload->do_upload('heroimg')) {
                        $upload_data = $this->upload->data();
                        $hero_image = $upload_data['file_name'];
                    }
        
                // Prepare data to insert into the database
                $data = array(
                    'title' => $this->input->post('title'),
                    'status' => $this->input->post('status'),
                    'created_at' => $current_date,
                    'updated_at' => $current_date, 
                    
                );
    
                if ($hero_image) {
                    $data['heroimg'] = $hero_image;
                }
                // Insert the data into the 'article' table
                $this->Gallery_model->set_news($data);
                $this->session->set_flashdata('success', 'Data inserted successfully.');
                redirect('gallery');
            }
        }
    
        public function edit($id) {
            date_default_timezone_set('Asia/Kolkata');
            $current_date = date('Y-m-d H:i:s');
        
            $this->form_validation->set_rules('title', 'Title', 'required');
        
            if ($this->form_validation->run() === FALSE) {
                // Load the existing category data and display the edit form
                $data['gallery'] = $this->Gallery_model->get_gallerys($id); // Replace with your actual method
                $this->load->view('header');
                $this->load->view('gallery-edit', $data); // Create an edit view
                $this->load->view('footer');
            } else {
                // File upload configuration for hero image
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // 2MB max file size
                $config['file_name'] = uniqid(); // Generate a unique file name
        
                $this->load->library('upload', $config);
        
                $hero_image = '';
                if ($_FILES['heroimg']['name'] && $this->upload->do_upload('heroimg')) {
                    $upload_data = $this->upload->data();
                    $hero_image = $upload_data['file_name'];
                }
        
                // Prepare data to update in the database
                $data = array(
                    'title' => $this->input->post('title'),
                    'status' => $this->input->post('status'),
                    'updated_at' => $current_date,
                );
        
                if ($hero_image) {
                    $data['heroimg'] = $hero_image;
                }
        
                // Update the existing category with the new data
                $this->Gallery_model->update_Gallery($id, $data); // Replace with your actual method
                $this->session->set_flashdata('success', 'Data updated successfully.');
                redirect('gallery');
            }
        }

        public function delete() {
            $id = $this->input->post('id');
    
            if ($this->Gallery_model->delete_record($id)) {
                echo json_encode(array('status' => 'Gallery deleted'));
            } else {
                echo json_encode(array('status' => 'error'));
            }
        }

}