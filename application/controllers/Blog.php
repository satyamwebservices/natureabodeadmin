<?php
class Blog extends CI_Controller {
    public function __construct(){
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
        $this->handleBlogAction();
    }

    public function edit($id) {
        $this->handleBlogAction($id);
    }

    // public function add() {
    //     date_default_timezone_set('Asia/Kolkata');
    //     $current_date = date('Y-m-d H:i:s');
    //     $this->load->library('upload'); // Load upload library
    //     $this->form_validation->set_rules('title', 'Title', 'required');
    //     $this->form_validation->set_rules('intro', 'Intro', 'trim');
    
    //     if ($this->form_validation->run() === FALSE) {
    //         $this->load->view('header');
    //         $this->load->view('blog-add');
    //         $this->load->view('footer');
    //     } else {
    //         // Handling content and image uploads
    //         $content = $this->input->post('content');
    
    //         // Handling imageFile (blob:http://localhost/) if provided
    //         if (!empty($_FILES['imageFile']['name'])) {
    //             $upload_path = './assets/uploads/';
    //             $file_name = $_FILES['imageFile']['name'];
    //             $temp_name = $_FILES['imageFile']['tmp_name'];
    
    //             // Move uploaded image file to the destination folder
    //             if (move_uploaded_file($temp_name, $upload_path . $file_name)) {
    //                 $image_path = base_url('assets/uploads/' . $file_name);
    //                 $content = str_replace('blob:http://localhost/', $image_path, $content);
    //             } else {
    //                 echo 'File upload failed.';
    //                 return; // Abort further execution on upload failure
    //             }
    //         }
    
    //         // Handling heroimg file upload
    //         $config['upload_path'] = './assets/uploads/';
    //         $config['allowed_types'] = 'jpg|jpeg|png|gif';
    //         $config['max_size'] = 2048;
    //         $config['file_name'] = uniqid();
    //         $this->upload->initialize($config); // Initialize upload settings
    
    //         $hero_image = '';
    //         if ($_FILES['heroimg']['name'] && $this->upload->do_upload('heroimg')) {
    //             $upload_data = $this->upload->data();
    //             $hero_image = $upload_data['file_name'];
    //         }
    
    //         // Create data array to insert into the database
    //         $data = array(
    //             'title' => $this->input->post('title'),
    //             'slug' => 'blog/' . strtolower(str_replace(' ', '-', trim($this->input->post('title')))),
    //             'intro' => $this->input->post('intro'),
    //             'content' => $content,
    //             'metatitle' => $this->input->post('metatitle'),
    //             'metadesc' => $this->input->post('metadesc'),
    //             'metakeyword' => $this->input->post('metakeyword'),
    //             'status' => $this->input->post('status'),
    //             'created_at' => $current_date,
    //             'updated_at' => $current_date,
    //         );
    
    //         if ($hero_image) {
    //             $data['heroimg'] = $hero_image;
    //         }
    
    //         // Insert data into the database using Blog_model
    //         $this->Blog_model->set_news($data);
    //         $this->session->set_flashdata('success', 'Data inserted successfully.');
    //         redirect('blog');
    //     }
    // }
    
    
    
    private function handleBlogAction($id = null) {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date('Y-m-d H:i:s');
        $this->load->library('upload');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('intro', 'Intro', 'trim');
        
        if ($this->form_validation->run() === FALSE) {
            $data['blog'] = $this->Blog_model->get_blog($id); 
            $this->load->view('header');
            if ($id) {
                $this->load->view('blog-edit', $data); // View for editing an existing blog post
            } else {
                $this->load->view('blog-add'); // View for adding a new blog post
            }
            $this->load->view('footer');
        } else {
           
            $content = $this->input->post('content');
    
            // Handling imageFile (blob:http://localhost/) if provided
            if (!empty($_FILES['imageFile']['name'])) {
                $upload_path = './assets/uploads/';
                $file_name = $_FILES['imageFile']['name'];
                $temp_name = $_FILES['imageFile']['tmp_name'];
    
                // Move uploaded image file to the destination folder
                if (move_uploaded_file($temp_name, $upload_path . $file_name)) {
                    $image_path = base_url('assets/uploads/' . $file_name);
                    $content = str_replace('blob:http://localhost/', $image_path, $content);
                } else {
                    echo 'File upload failed.';
                    return; // Abort further execution on upload failure
                }
            }
          
            // Handling heroimg file upload
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            $config['file_name'] = uniqid();
            $this->upload->initialize($config);  // Initialize upload settings
    
            $hero_image = '';
            if ($_FILES['heroimg']['name'] && $this->upload->do_upload('heroimg')) {
                $upload_data = $this->upload->data();
                $hero_image = $upload_data['file_name'];
            }
           
            // Create data array to insert into the database
            $data = array(
                'title' => $this->input->post('title'),
                'slug' => 'blog/' . strtolower(str_replace(' ', '-', trim($this->input->post('title')))),
                'intro' => $this->input->post('intro'),
                'content' => $content,
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
           
            if ($id) {
                // Update existing blog post
                $this->Blog_model->update_blog($id, $data); // Assuming this method updates an existing blog post
                $this->session->set_flashdata('success', 'Data updated successfully.');
            } else {
                // Add a new blog post
                $this->Blog_model->set_news($data);
                $this->session->set_flashdata('success', 'Data inserted successfully.');
            }
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

    public function detail($slug){
        $data['blog'] = $this->Blog_model->get_blog_by_slug($slug);

        if (!$data['blog']) {
        show_404(); // If the blog entry is not found, show a 404 error
        }

        $this->load->view('header');
        $this->load->view('blog_detail', $data);
        $this->load->view('footer');
    }
        
      
    }     