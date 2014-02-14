<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class MY_Controller extends CI_Controller {
        
		protected $layout;
		protected $user_id;
		protected $navigation;
		
        public function __construct() {
            parent::__construct();
			$this->layout = 'layout/master';
			$this->navigation = ($this->ion_auth->logged_in() ? 'layout/navigation_user' : 'layout/navigation_public');
			$this->user_id = $this->ion_auth->logged_in() ? $this->ion_auth->get_user_id() : NULL;
			$this->lang->load('auth', 'english'); // should automatically remember it and be based on location etc.
		}
    }
    
?>