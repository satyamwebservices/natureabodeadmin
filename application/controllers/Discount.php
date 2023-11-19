<?php
class Discount extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

        public function index()
        {
            $this->load->view('header');
            $this->load->view('discount');
            $this->load->view('footer');
        }

        public function add()
        {
            $this->load->view('header');
            $this->load->view('discount-add');
            $this->load->view('footer');           
        }

        public function edit()
        {
            $this->load->view('header');
            $this->load->view('discount-edit');
            $this->load->view('footer');            
        }

        public function delete()
        {
            
        }
}