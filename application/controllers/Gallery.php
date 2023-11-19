<?php
class Gallery extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

        public function index()
        {
            $this->load->view('header');
            $this->load->view('gallery');
            $this->load->view('footer');
        }

        public function add()
        {
            $this->load->view('header');
            $this->load->view('gallery-add');
            $this->load->view('footer');           
        }

        public function edit()
        {
            $this->load->view('header');
            $this->load->view('gallery-edit');
            $this->load->view('footer');            
        }

        public function delete()
        {
            
        }
}