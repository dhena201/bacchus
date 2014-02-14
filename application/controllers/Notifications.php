<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * should I make this a library??!?!?!?!?
 * */

    class Notifications extends MY_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->model('User_model');
			
		}
		
        public function index() {
			
	        if (!$this->ion_auth->logged_in()) {
				redirect('/');
			}

		}
		
		/*
		 * return a number to display in user navigation for orders
		 * */
		public function get_num_order_notifications() {
			// get any order that
			// if order was clicked, clear it
			// what happens if they click it, clear it, then logout and log back in
			// it should be like facebook notifications
			// maybe everytime you log in for the first time in a day, check to see if any orders are expected on that day
			// if I click on the orders notifications, how do I remember it for the next time?
			// for now, if user logs on count it as having looked at the feed

		}
		
		public function init_feed() {
			// get all orders
			// get activity on mobile application
			// get any updates on wines (deletions, additions)
			// get any updates on locations?? additions, deltions etc.
			// get any Bacchus system updates: articles, new wines, popular discussion, follower updates, etc.
			$user = $this->ion_auth->user()->row();
			prettify($user);
			$last_login = $user->last_login;
			$this->User_model->set_table('orders');
			prettify($this->User_model->get_all());
			// get all relevent orders
		}
    }

/* 
 * End of file Notifications.php 
 * Location: application/controllers/Notifications.php 
 * */