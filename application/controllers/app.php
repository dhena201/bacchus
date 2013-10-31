<?php
    class App extends CI_Controller {
        
        public function index(){
			 if (!$this->ion_auth->logged_in()){
			 	$this->load->view('includes/nli_header');
				$this->load->view('nli_home');
			} elseif (!$this->ion_auth->is_admin()){
				redirect('admin', 'refresh');
			} else {
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
	
				$data['first_name'] = $this->ion_auth->user()->row()->first_name;
				redirect('user', 'refresh');
			}
        }
		
		public function login(){
			$this->load->view('includes/nli_header');
			$this->load->view('login');
		}
		
		public function signup(){
			$this->load->view('includes/nli_header');
			$this->load->view('signup');
		}	
    }
    
?>