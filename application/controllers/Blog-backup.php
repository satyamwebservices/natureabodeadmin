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
                // Load the existing blog post data and display the edit form
                $data['blog'] = $this->Blog_model->get_blog($id); // Replace with your actual method
                $this->load->view('header');
                $this->load->view('blog-edit', $data); // Create an edit view
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
                    'slug' => strtolower(str_replace(' ', '-', trim($this->input->post('title')))),
                    'intro' => $this->input->post('intro'),
                    'content' => $this->input->post('content'),
                    'metatitle' => $this->input->post('metatitle'),
                    'metadesc' => $this->input->post('metadesc'),
                    'metakeyword' => $this->input->post('metakeyword'),
                    'status' => $this->input->post('status'),
                    'updated_at' => $current_date,
                );
        
                if ($hero_image) {
                    $data['heroimg'] = $hero_image;
                }
        
                // Update the existing post with the new data
                $this->Blog_model->update_blog($id, $data); // Replace with your actual method
                $this->session->set_flashdata('success', 'Data updated successfully.');
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