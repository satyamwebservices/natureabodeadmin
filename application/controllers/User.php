<?php
class User extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function login() {
        // Load the login view
        $this->load->view('login');
    }

    public function do_login() {
        $email = $this->input->post('email'); 
        $password = $this->input->post('password');
        $user = $this->User_model->check_credentials($email, $password);
    
        if ($user) {
           
            $user_data = array(
                'user_id' => $user->id,
                'email' => $user->email,
                'username' => $username, // Add the username to the session
                'logged_in' => true
            );
    
            $this->session->set_userdata($user_data);
            redirect('dashboard');
        } else {
            // Failed login, show an error message
            $this->session->set_flashdata('login_error', 'Invalid email or password');
            redirect('login');
        }
    }

    public function register() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('header');
            $this->load->view('user-add');
            $this->load->view('footer');
        } else {
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $status = $this->input->post('status');
            $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            
            $data = array(
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'status' => $status,

            );

            $this->User_model->create_user($data);

            $this->session->set_flashdata('signup_success', 'Registration successful. You can now log in.');
            redirect('login'); // Redirect to your login page
        }
    }

    public function logout() {
        // Destroy the user session and redirect to the login page
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('logged_in');

        $this->session->sess_destroy();

        redirect('login');
    }
}