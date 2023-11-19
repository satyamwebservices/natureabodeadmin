<?php
class Event extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

        public function index()
        {
            $this->load->view('header');
            $this->load->view('event');
            $this->load->view('footer');
        }

        public function add()
        {
            $this->load->view('header');
            $this->load->view('event-add');
            $this->load->view('footer');           
        }

        public function edit()
        {
            $this->load->view('header');
            $this->load->view('event-edit');
            $this->load->view('footer');            
        }

        public function delete()
        {
            
        }
}