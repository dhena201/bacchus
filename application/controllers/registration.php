<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Registration extends MY_Controller {
        
		private $content;
		
		public function __construct() {
			parent::__construct();
			$this->load->library('form_validation');
		    $this->form_validation->set_error_delimiters('<p><span class="label label-danger">', '</span></p>');
			$this->content = 'public/public_template';
		}
		
        public function index() {
   			$this->load->library('form_validation');
			
	        if ( $this->ion_auth->logged_in()) {
				redirect('', 'location');
			}
			
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email||max_length[50]|is_unique[users.email]');
		    $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[3]|max_length[16]|is_unique[users.username]');
		    $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
		    $this->form_validation->set_rules('cpassword', 'password confirmation', 'required|matches[password]');

		    if ($this->form_validation->run() !== FALSE) {		
		        $username = $this->input->post('username');
		        $email = $this->input->post('email');
		        $password = $this->input->post('password');
		
		        $registered = $this->ion_auth->register($username, $password, $email);
		
		        if ($registered) {
		            $this->session->set_flashdata('alert-success', 'Account created. Check your email inbox for activation instructions.');
		            redirect('auth/login', 'location');
		        } else {
		            $this->session->set_flashdata('alert-error', 'Failed to create your account. Please contact site support if this problem persists.');
		            redirect('auth/login', 'location');
		        }
		
		    }

			$data['title'] = 'Sign up';
			$data['content'] = $this->content;
			$data['public_content'] = 'user/signup';
			$data['navigation'] = $this->navigation;
			
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			
			$data['email'] = array(
				'name'  => 'email',
				'id'    => 'emailInput',
				'class' => 'form-control',
				'type'  => 'text',
				'placeholder' => 'Email Address',
				'autofocus' => 'autofocus',
				'maxlength'   => '50',
				'value' => $this->form_validation->set_value('email')
			);
			$data['username'] = array(
				'name'  => 'username',
				'id'    => 'usernameInput',
				'class' => 'form-control',
				'type'  => 'text',
				'maxlength'   => '16',
				'minlength'   => '3',
				'placeholder' => 'Username',
				'value' => $this->form_validation->set_value('username')
			);
			$data['password'] = array(
				'name'  => 'password',
				'id'    => 'passwordInput',
				'class' => 'form-control',
				'type'  => 'password',
				'maxlength'   => $this->config->item('max_password_length', 'ion_auth'),
				'minlength'   => $this->config->item('min_password_length', 'ion_auth'),
				'placeholder' => 'Password',
				'value' => $this->form_validation->set_value('password')
			);
			$data['cpassword'] = array(
				'name'  => 'cpassword',
				'id'    => 'cpasswordInput',
				'class' => 'form-control',
				'type'  => 'password',
				'maxlength'   => $this->config->item('max_password_length', 'ion_auth'),
				'minlength'   => $this->config->item('min_password_length', 'ion_auth'),
				'placeholder' => 'Confirm Password',
				'value' => $this->form_validation->set_value('cpassword')
			);
			
			$this->load->view($this->layout, $data);
		} 
    }

/* 
 * End of file Registration.php 
 * Location: application/controllers/Registration.php 
 * */