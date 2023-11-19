<?php
class Category extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Category_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['categories'] = $this->Category_model->get_category();
        $this->load->view('header');
       $this->load->view('project', $data);
       $this->load->view('footer');
       
    }

    public function create() {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date('Y-m-d H:i:s');
    
        $this->form_validation->set_rules('title', 'Title', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('header');
            $this->load->view('project-add');
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
                'intro' => $this->input->post('intro'),
                'slug' => strtolower(trim(str_replace(' ', '-', trim($this->input->post('title'))))),
                'status' => $this->input->post('status'),
                'place' => $this->input->post('place'),
                'created_at' => $current_date,
                'updated_at' => $current_date, 
                'metatitle' => $this->input->post('metatitle'),
                'metakeyword' => $this->input->post('metakeyword'),
                'metadesc' => $this->input->post('metadesc'),
            );

            if ($hero_image) {
                $data['heroimg'] = $hero_image;
            }
                //print_r($data);
            // Insert the data into the 'article' table
            $this->Category_model->set_news($data);
            $this->session->set_flashdata('success', 'Data inserted successfully.');
            redirect('project');
        }
    }

    public function edit($id) {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date('Y-m-d H:i:s');
    
        $this->form_validation->set_rules('title', 'Title', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            // Load the existing category data and display the edit form
            $data['category'] = $this->Category_model->get_categorys($id); // Replace with your actual method
            $this->load->view('header');
            $this->load->view('project-edit', $data); // Create an edit view
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
                'intro' => $this->input->post('intro'),
                'slug' => strtolower(trim(str_replace(' ', '-', trim($this->input->post('title'))))),
                'status' => $this->input->post('status'),
                'place' => $this->input->post('place'),
                'updated_at' => $current_date,
                'metatitle' => $this->input->post('metatitle'),
                'metakeyword' => $this->input->post('metakeyword'),
                'metadesc' => $this->input->post('metadesc'),
            );
    
            if ($hero_image) {
                $data['heroimg'] = $hero_image;
            }
    
            // Update the existing category with the new data
            $this->Category_model->update_category($id, $data); // Replace with your actual method
            $this->session->set_flashdata('success', 'Data updated successfully.');
            redirect('project');
        }
    }
    
    public function delete()
    {
        if ($this->Blog_model->delete_record($id)) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        } 
    }
}

?>