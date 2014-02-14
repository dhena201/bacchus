<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class User extends MY_Controller {
        
		private $content;
		
		public function __construct(){
			parent::__construct();
			if (!$this->ion_auth->logged_in()) {
				redirect('auth/login', 'refresh');
			} elseif ($this->ion_auth->is_admin()) {
				redirect('admin', 'refresh');
			} else {
				$this->load->model('User_model');
				$this->content = 'user/user_template';
			}
		}
		
        public function index(){
			$data['title'] = 'Dashboard'; 
			$data['content'] = $this->content;
			$data['user_content'] = 'user/dashboard';
			$data['navigation'] = $this->navigation;
			$data['username'] = $this->ion_auth->user()->row()->username;
			$data['user'] = $this->ion_auth->user()->row();
			$this->load->view($this->layout, $data);
        }
		
		/** * Logout current user*
		 * @access public 
		 * @param null 
		 * @return void
		 * */
		public function logout(){		
			$this->ion_auth->logout();
			redirect('/', 'refresh');
		}
		
		/** * Redirect to auth/edit_user *
		 * @access public 
		 * @param null 
		 * @return void
		 * */
		public function edit_account(){		
			redirect('auth/edit_user/'.$this->ion_auth->user()->row()->id); // for now
		}
		
		/** * Load user profile page *
		 * @access public 
		 * @param null 
		 * @return void
		 * */
		public function profile(){		
			$data['title'] = 'View Profile'; 
			$data['content'] = $this->content;
			$data['user_content'] = 'user/profile';
			$data['navigation'] = $this->navigation;
			$this->load->view($this->layout, $data);
		}
		
		/** * Load help page *
		 * @access public 
		 * @param null 
		 * @return void
		 * */
		public function help(){
			$data['title'] = 'Help'; 
			$data['content'] = $this->content;
			$data['user_content'] = 'help';
			$data['navigation'] = $this->navigation;
			$this->load->view($this->layout, $data);
		}
		
    }
    
/* 
 * End of file User.php 
 * Location: application/controllers/User.php 
 * */