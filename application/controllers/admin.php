<?php

/*
 * Still need to make Admin role and necessary Views
 * */
 
    class Admin extends CI_Controller {
        
        public function index(){
			if ($this->ion_auth->is_admin()) {
				$this->load->view('includes/admin_header'); 
				$this->load->view('admin');
				echo "<pre>";
				print_r ($this->ion_auth->users()->result());
				echo "</pre>";
			} else {
				redirect('app/login');
			}
				
		}

		public function logout(){		
			$this->ion_auth->logout();
			redirect('/', 'refresh');
		}	
    }
    
?>