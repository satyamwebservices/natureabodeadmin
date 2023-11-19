<?php
class Slider extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('slider_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index() {
        // Load and display articles from the database
        $data['slider'] = $this->slider_model->get_slider();
        $this->load->view('header');
        $this->load->view('slider', $data);
        $this->load->view('footer');
    }

    public function add() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date('Y-m-d H:i:s');
    
        $this->form_validation->set_rules('title', 'Title', 'trim'); // Trim removes any whitespace
        $this->form_validation->set_rules('intro', 'Intro', 'trim'); // Trim removes any whitespace
    
    
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('header');
            $this->load->view('slider-add');
            $this->load->view('footer');
        } else {
            // File upload configuration for gallery images
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048; // 2MB max file size
            $config['file_name'] = uniqid(); // Generate a unique file name
    
            $this->load->library('upload', $config);
    
            // Handle hero image
            $hero_image = '';
    
            if ($_FILES['heroimg']['name']) {
                // File upload configuration for hero image
                $config['file_name'] = uniqid(); // Generate a unique file name
                $this->upload->initialize($config);
    
                if (!$this->upload->do_upload('heroimg')) {
                    $error = $this->upload->display_errors();
                    echo $error; // Handle file upload error for hero image
                } else {
                    $upload_data = $this->upload->data();
                    $hero_image = $upload_data['file_name'];
                }
            }
    
            // Prepare data to insert into the database
            $data = array(
                'title' => $this->input->post('title'),
                'intro' => $this->input->post('intro'),
                'button' => $this->input->post('button'),
                'btnlink' => $this->input->post('btnlink'),
                'status' => $this->input->post('status'),
                'heroimg' => $hero_image,
                'created_at' => $current_date,
                'updated_at' => $current_date, // Change the semicolon to a comma here
            );
    
            // Insert the data into the 'article' table
            $this->slider_model->set_news($data);
            $this->session->set_flashdata('success', 'Data inserted successfully.');
            redirect('slider');
        }
    }

    public function edit($id) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date('Y-m-d H:i:s');
    
        $this->form_validation->set_rules('title', 'Title', 'trim'); // Trim removes any whitespace
        $this->form_validation->set_rules('intro', 'Intro', 'trim'); // Trim removes any whitespace
    
        if ($this->form_validation->run() === FALSE) {
            // Load the existing record data
            $existing_data = $this->slider_model->get_sliders($id);
    
            $data = array(
                'slider' => $existing_data, // Pass existing data to the view
            );
            $this->load->view('header');
            $this->load->view('slider_edit', $data); // Load the edit view
            $this->load->view('footer');
        } else {
            // Handle file upload for hero image if a new image is selected
            $hero_image = '';
            if ($_FILES['heroimg']['name']) {
                // File upload configuration for hero image
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // 2MB max file size
                $config['file_name'] = uniqid(); // Generate a unique file name
    
                $this->load->library('upload', $config);
    
                if (!$this->upload->do_upload('heroimg')) {
                    $error = $this->upload->display_errors();
                    echo $error; // Handle file upload error for hero image
                } else {
                    $upload_data = $this->upload->data();
                    $hero_image = $upload_data['file_name'];
                }
            }
    
            // Prepare data to update the record in the database
            $data = array(
                'title' => $this->input->post('title'),
                'intro' => $this->input->post('intro'),
                'status' => $this->input->post('status'),
                'created_at' => $current_date,
                'updated_at' => $current_date,
            );
    
            // Check if a new hero image was uploaded
            if ($hero_image) {
                $data['heroimg'] = $hero_image;
            }
    
            // Update the data in the 'article' table
            $this->slider_model->update_slider($id, $data);
    
            // Load a success view or redirect to another page
            $this->session->set_flashdata('success', 'Data updated successfully.');
           redirect('slider_model');
        }
    }

    public function delete($id) {
    
        if ($this->slider_model->delete_record($id)) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
    
    public function update_database_value($id) {
      
        // Update the database value using your model
        $result = $this->slider_model->update_value($id);
    
        if ($result) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
}