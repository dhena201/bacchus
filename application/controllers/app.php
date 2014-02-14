<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/* public controller */
    class App extends MY_Controller {
        
		private $content;
		
		public function __construct(){
			parent::__construct();
			$this->content = 'public/public_template';
		}
		
        public function index(){
		 	$data['title'] = 'Welcome'; 
			$data['content'] = $this->content;
			$data['public_content'] = 'public/home_public';
			$data['navigation'] = $this->navigation;
			$this->load->view($this->layout, $data);

        }
		
    }
    
/* 
 * End of file App.php 
 * Location: application/controllers/App.php 
 * */