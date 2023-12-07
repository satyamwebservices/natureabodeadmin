<?php
class Blog extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Blog_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
        public function index() {
            $data['blog'] = $this->Blog_model->get_blogs();
            $this->load->view('header');
            $this->load->view('blog', $data);
            $this->load->view('footer');
        }

        public function add() {
            date_default_timezone_set('Asia/Kolkata');
            $current_date = date('Y-m-d H:i:s');
        
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('intro', 'Intro', 'trim');
        
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('header');
                $this->load->view('blog-add');
                $this->load->view('footer');
            } else {
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048;
                $config['file_name'] = uniqid();
        
                $this->load->library('upload', $config);
                $hero_image = '';
        
                if ($_FILES['heroimg']['name'] && $this->upload->do_upload('heroimg')) {
                    $upload_data = $this->upload->data();
                    $hero_image = $upload_data['file_name'];
                }
        
                $data = array(
                    'title' => $this->input->post('title'),
                    'slug' => 'blog/' . strtolower(str_replace(' ', '-', trim($this->input->post('title')))),
                    'intro' => $this->input->post('intro'),
                    'content' => $this->input->post('content'),
                    'metatitle' => $this->input->post('metatitle'),
                    'metadesc' => $this->input->post('metadesc'),
                    'metakeyword' => $this->input->post('metakeyword'),
                    'status' => $this->input->post('status'),
                    'created_at' => $current_date,
                    'updated_at' => $current_date,
                );
        
                if ($hero_image) {
                    $data['heroimg'] = $hero_image;
                }
        
                $this->Blog_model->set_news($data);
                $this->session->set_flashdata('success', 'Data inserted successfully.');
                redirect('blog');
            }
        }

        public function detail($slug)
        {
        $data['blog'] = $this->Blog_model->get_blog_by_slug($slug);

        if (!$data['blog']) {
        show_404(); // If the blog entry is not found, show a 404 error
        }

        $this->load->view('header');
        $this->load->view('blog_detail', $data);
        $this->load->view('footer');
        }

        public function edit($id) {
            date_default_timezone_set('Asia/Kolkata');
            $current_date = date('Y-m-d H:i:s');
        
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('intro', 'Intro', 'trim');
        
            if ($this->form_validation->run() === FALSE) {
                $data['blog'] = $this->Blog_model->get_blog($id);
                $this->load->view('header');
                $this->load->view('blog-edit', $data);
                $this->load->view('footer');
            } else {
                $hero_image = '';
        
                if ($_FILES['heroimg']['name']) {
                    // File upload configuration for hero image
                    $config['upload_path'] = './path/to/upload/directory/'; // Replace with your upload directory path
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['max_size'] = 2048; // 2MB maximum file size (adjust as needed)
                    $config['file_name'] = uniqid(); // Generate a unique file name
                    $this->load->library('upload', $config);
        
                    if (!$this->upload->do_upload('heroimg')) {
                        $error = $this->upload->display_errors();
                        echo $error; // Handle file upload error for hero image
                        exit; // Stop execution if upload fails (you can handle this differently)
                    } else {
                        $upload_data = $this->upload->data();
                        $hero_image = $upload_data['file_name'];
                    }
                }
        
                // Prepare data to update the record in the database
                $data = array(
                    'title' => $this->input->post('title'),
                    'intro' => $this->input->post('intro'),
                    'content' => $this->input->post('content'),
                    'metatitle' => $this->input->post('metatitle'),
                    'metadesc' => $this->input->post('metadesc'),
                    'metakeyword' => $this->input->post('metakeyword'),
                    'status' => $this->input->post('status'),
                    'updated_at' => $current_date, // Fix typo here from 'update_at' to 'updated_at'
                );
        
                if ($hero_image) {
                    $data['heroimg'] = $hero_image;
                }
        
                // Update the data in the 'blog' table
                $this->Blog_model->update_blog($id, $data);
                $this->session->set_flashdata('success', 'Data Updated successfully.');
                redirect('blog');
            }
        }

        public function delete() {
            $id = $this->input->post('id');
    
            if ($this->Blog_model->delete_record($id)) {
                echo json_encode(array('status' => 'Blog deleted'));
            } else {
                echo json_encode(array('status' => 'error'));
            }
        }
}