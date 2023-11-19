<?php
class Project extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

        public function index()
        {
            $this->load->view('header');
            $this->load->view('project');
            $this->load->view('footer');
        }

        public function add()
        {
            $this->load->view('header');
            $this->load->view('project-add');
            $this->load->view('footer');           
        }

        public function edit()
        {
            $this->load->view('header');
            $this->load->view('project-edit');
            $this->load->view('footer');            
        }

        public function delete()
        {
            
        }
}