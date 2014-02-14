<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Still need to make Admin role and necessary Views
 * */
 
    class Admin extends CI_Controller {
        
		public function __construct(){
			parent::__construct();
			if (!$this->ion_auth->is_admin()) {
				redirect('/', 'refresh');
			} else {
				$this->load->model('user_model');
				$this->lang->load('auth', 'english');
			}
		}
		
        public function index(){
			$this->load->view('includes/admin_header'); 
			$this->load->view('admin');
		}

		public function logout(){		
			$this->ion_auth->logout();
			redirect('/', 'refresh');
		}	
    }
    
/* 
 * End of file Admin.php 
 * Location: application/controllers/admin/Admin.php 
 * */