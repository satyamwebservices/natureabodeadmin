<?php
class Resorts extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Resort_model');
        $this->load->model('Category_model');
    }

    public function index() {
        $data['resort'] = $this->Resort_model->get_resort();
        $this->load->view('header');
        $this->load->view('resort', $data);
        $this->load->view('footer');
    }

    public function create() {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date('Y-m-d H:i:s');
      
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('intro', 'Intro', 'trim');
        $this->form_validation->set_rules('category', 'Category', 'required|integer');
      
        if ($this->form_validation->run() === FALSE) {
            $data['categories'] = $this->Category_model->get_category();
            $this->load->view('header');
            $this->load->view('resort-add', $data);
            $this->load->view('footer');
        } else {
            // File upload configuration for gallery images
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048; // 2MB max file size
            $config['file_name'] = uniqid(); // Generate a unique file name
            // print_r($config);
            $this->load->library('upload', $config);
    
            $gallery_images = array(); // Initialize an array for gallery images
    
            // Handle gallery images
            foreach ($_FILES['gallery']['name'] as $key => $value) {
                $_FILES['userfile']['name'] = $_FILES['gallery']['name'][$key];
                $_FILES['userfile']['type'] = $_FILES['gallery']['type'][$key];
                $_FILES['userfile']['tmp_name'] = $_FILES['gallery']['tmp_name'][$key];
                $_FILES['userfile']['error'] = $_FILES['gallery']['error'][$key];
                $_FILES['userfile']['size'] = $_FILES['gallery']['size'][$key];
    
                if (!$this->upload->do_upload('userfile')) {
                    $error = $this->upload->display_errors();
                    echo $error; // Handle file upload error for gallery images
                } else {
                    $upload_data = $this->upload->data();
                    $gallery_images[] = $upload_data['file_name']; // Store only the random name
                }
            }
    
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
    
            // Get category title based on category ID
            $category_id = $this->input->post('category');
            $category_title = $this->Category_model->get_category_title($category_id);
    
            // Prepare data to insert into the database
            $data = array(
                'title' => $this->input->post('title'),
                'slug' => strtolower(trim(str_replace(' ', '-', trim($this->input->post('title'))))),
                'intro' => $this->input->post('intro'),
                'content' => $this->input->post('content'),
                'cat_id' => $category_id,
                'category' => $category_title,
                'metatitle' => $this->input->post('metatitle'),
                'metadesc' => $this->input->post('metadesc'),
                'metakeyword' => $this->input->post('metakeyword'),
                'status' => $this->input->post('status'),
                'created_at' => $current_date,
                'update_at' => $current_date,
                'gallery' => implode(',', $gallery_images), // Store gallery image names as comma-separated values
                'heroimg' => $hero_image,
            );
    
            $this->Resort_model->set_news($data); // Assuming your model function is named 'insert_resort'
            $this->session->set_flashdata('success', 'Data inserted successfully.');
            redirect('resort');
        }
    }

    public function edit($id) {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date('Y-m-d H:i:s');
    
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('intro', 'Intro', 'trim');
        if ($this->form_validation->run() === FALSE) {
            $selectedCategory = $this->Resort_model->getSelectedCategory($id);
            $categories = $this->Resort_model->getAllCategories();
            $existing_data = $this->Resort_model->get_resorts($id);
    
            $data = array(
                'resort' => $existing_data,
                'selectedCategory' => $selectedCategory,
                'categories' => $categories,
            );
           //print_r($data);
            $this->load->view('header');
            $this->load->view('resort-edit', $data);
            $this->load->view('footer');
        } else {
            $gallery_images = array();
    
            // Get the existing images from the database
            $existing_data = $this->Resort_model->get_resorts($id);
            $existing_images = $existing_data['gallery'];
    
            // Handle the new image uploads
            if (!empty($_FILES['gallery']['name'][0])) {
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // 2MB max file size
    
                $this->load->library('upload', $config);
    
                foreach ($_FILES['gallery']['name'] as $key => $value) {
                    $_FILES['userfile']['name'] = $_FILES['gallery']['name'][$key];
                    $_FILES['userfile']['type'] = $_FILES['gallery']['type'][$key];
                    $_FILES['userfile']['tmp_name'] = $_FILES['gallery']['tmp_name'][$key];
                    $_FILES['userfile']['error'] = $_FILES['gallery']['error'][$key];
                    $_FILES['userfile']['size'] = $_FILES['gallery']['size'][$key];
    
                    if (!$this->upload->do_upload('userfile')) {
                        $error = $this->upload->display_errors();
                        echo $error;
                    } else {
                        $upload_data = $this->upload->data();
                        $gallery_images[] = $upload_data['file_name'];
                    }
                }
            }
    
            // Combine existing and new images
            $combined_images = implode(',', array_filter([$existing_images, implode(',', $gallery_images)]));
    
            // Get category information
            $category_id = $this->input->post('category');
            $category_title = $this->Category_model->get_category_title($category_id);
           
            // Prepare data to update the record in the database
            $data = array(
                'title' => $this->input->post('title'),
                'intro' => $this->input->post('intro'),
                'content' => $this->input->post('content'),
                'cat_id' => $category_id,
                'category' => $category_title,
                'metatitle' => $this->input->post('metatitle'),
                'metadesc' => $this->input->post('metadesc'),
                'metakeyword' => $this->input->post('metakeyword'),
                'status' => $this->input->post('status'),
                'gallery' => $combined_images,
                'update_at' => $current_date,
            );
    
            // Update the data in the 'category' table
            $this->Resort_model->update_resort($id, $data);
            $this->session->set_flashdata('success', 'Data Updated successfully.');
            redirect('resort');
        }
    }

    public function remove_image($category_id, $image_filename) {
        
        // Remove the image from the database (if applicable)
        $resort = $this->Resort_model->get_resorts($resort_id);
        $existing_images = explode(',', $resort['gallery']);
        
        if (($key = array_search($image_filename, $existing_images)) !== false) {
            unset($existing_images[$key]);
        }
        
        // Save the updated gallery information in the database
        $new_gallery = implode(',', $existing_images);
        $data = array('gallery' => $new_gallery);
        $this->Resort_model->update_category($resort_id, $data);
    
        // Delete the image file from the server
        $image_path = './assets/uploads/' . $image_filename;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    
        // Redirect back to the edit page
        redirect('categories/edit/' . $category_id);
    }

    public function delete() {
        $id = $this->input->post('id');

        if ($this->Resort_model->delete_record($id)) {
            echo json_encode(array('status' => 'Resort deleted'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
}