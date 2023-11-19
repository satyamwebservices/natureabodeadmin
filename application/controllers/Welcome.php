<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

	public function index() {
		if ($this->session->userdata('logged_in')) {
			$data['email'] = $this->session->userdata('email');
			$data['username'] = $this->User_model->get_username($data['email']);
			// Load your views
			$this->load->view('header', $data);
			$this->load->view('dashboard', $data);
			$this->load->view('footer', $data);
		} else {
			redirect('login');
		}
	}
}
