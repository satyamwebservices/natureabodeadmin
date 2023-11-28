<?php
class Gallery extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Gallery_model');
        $this->load->library('form_validation');
        
    }

    public function view()
    {
        $data['gallery'] = $this->Gallery_model->get_gallery();
        $this->load->view('header');
        $this->load->view('gallery', $data);
        $this->load->view('footer');
    }

        public function index()
        {
            $this->load->view('header');
            $this->load->view('gallery-add');
            $this->load->view('footer');
        }
        public function add() {
            // File upload configuration for gallery images
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048; // 2MB max file size
            $config['file_name'] = uniqid(); // Generate a unique file name
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
        
            $data = array(
                'gallery' => implode(',', $gallery_images), // Store gallery image names as comma-separated values
            );
        
            $this->Gallery_model->insert_gallery($data); // Assuming your model function is named 'insert_gallery'
        
            // Redirect or set a flash message
            redirect('gallery');
        }
  

        public function edit($galleryId) {
            // Fetch existing gallery data from the database based on $galleryId
            $existingGalleryData = $this->Gallery_model->get_gallery_data_by_id($galleryId);

            // Validate the form data
            $this->form_validation->set_rules('gallery[]', 'Gallery', 'required');
        
            if ($this->form_validation->run() == FALSE) {
                // Form validation failed, handle the error and load the edit view with existing data
                $data['gallery'] = $existingGalleryData;
                $this->load->view('header');
                $this->load->view('gallery-edit', $data);
                $this->load->view('footer');
            } else {
                die('@@@@@@@');
                // Handle the uploaded images
                $galleryImages = $this->input->post('gallery');
        
                // Merge the new images with the existing ones
                $existingImages = explode(',', $existingGalleryData['gallery']);
                $mergedImages = array_merge($existingImages, $galleryImages);
        
                // Remove duplicate images, if necessary
                $uniqueImages = array_unique($mergedImages);
        
                // Prepare data to update into the database
                $data = array(
                    'gallery' => implode(',', $uniqueImages) // Store merged and unique gallery image names
                );
        
                // Update gallery data in the database
                $this->Gallery_model->update_gallery($galleryId, $data);
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