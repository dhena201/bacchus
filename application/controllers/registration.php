<?php
    class Registration extends CI_Controller {
        
        public function index() {
   			$this->load->library('form_validation');
			
	        if ( $this->ion_auth->logged_in()) {
				redirect('', 'location');
			}
		
		    $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[3]|max_length[16]|is_unique[users.username]');
		    $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email||max_length[50]|is_unique[users.email]');
		    $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
		    $this->form_validation->set_rules('cpassword', 'password confirmation', 'required|matches[password]');

		    if ($this->form_validation->run() !== FALSE) {		
		        $username = $this->input->post('username');
		        $email = $this->input->post('email');
		        $password = $this->input->post('password');
		
		        $registered = $this->ion_auth->register($username, $password, $email);
		
		        if ($registered) {
		            $this->session->set_flashdata('alert-success', 'Account created. Check your email inbox for activation instructions.');
		            redirect('app/login', 'location');
		        } else {
		            $this->session->set_flashdata('alert-error', 'Failed to create your account. Please contact site support if this problem persists.');
		            redirect('app/login', 'location');
		        }
		
		    }
		    $this->load->view('signup');
		} 
    }
    
?>