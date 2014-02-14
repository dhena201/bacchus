<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/*
	 * outline: http://stevethomas.com.au/cat/php
	 * to use this: go to root of this app and type "php index.php Faker/Seed_DB seed"
	 * */
	class Seed_DB extends MY_Controller {
        
		private $faker;
		
        public function __construct() {
            parent::__construct();
			
			// can only be called from the command line
	        if (!$this->input->is_cli_request()) {
	            exit('Direct access is not allowed');
	        }
	 
	        // can only be run in the development environment
	        if (ENVIRONMENT !== 'development') {
	            exit('You really don\'t want to do that!');
	        }
	 
	        // initiate faker
	        $this->faker = Faker\Factory::create();
	 
	        // load any required models
			//$this->load->model('User_model'); // change this to Faker_model
			$this->load->model('Faker_model');
			
        }
		
		/**
	     * seed local database
	     */
		public function seed() {
	        // purge existing data
	    	$this->_truncate_db();
	 
	        // seed users
			$this->Faker_model->set_table('users');
	      	$this->_seed_users(25);
	 
	        // call more seeds here...
	    }
		
		/**
	     * seed users
	     *
	     * @param int $limit
	     */
	    private function _seed_users($limit) {
	        echo "Seeding $limit users";
	        // create a bunch of user accounts
	        
	        $admin_data = array (
	            	'ip_address' => '7f000001',
	                'username' => 'administrator',
	                'password' => '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', // 'password'
	                'salt' => '9462e8eee0',
	                'email' => 'admin@admin.com',
					'created_on' => '1268889823',
	                'active' => '1',
	               	'first_name' => 'Admin',
	                'last_name' => 'istrator',
	                'company' => 'ADMIN',
	                'phone' => '0'
	        );
			$this->Faker_model->create($admin_data);

			$admin_id = $this->Faker_model->get_last_id();
			$this->Faker_model->set_table('users_groups');
			$this->Faker_model->create(array('user_id' => $admin_id, 'group_id' => '1'));
			//need to recreate user_groups, and all other default stuff
			
	        for($i = 0; $i < $limit; $i++) {
	            echo ".";
	 			
	            $data = array (
	            	'ip_address' => mt_rand(0, 1) ? inet_pton($this->faker->ipv4) : inet_pton($this->faker->ipv6),
	                'username' => $this->faker->unique()->userName, // get a unique nickname
	                'password' => sha1('password'),
	                'email' => $this->faker->email,
					'created_on' => strtotime($this->faker->dateTimeThisYear->format('Y-m-d H:i:s')),
	               	'last_login' => strtotime($this->faker->dateTimeThisMonth->format('Y-m-d H:i:s')),
	                'active' => mt_rand(0, 1) ? '0' : '1',
	               	'first_name' => $this->faker->firstName,
	                'last_name' => $this->faker->lastName,
	                'company' => $this->faker->company,
	                'phone' => $this->faker->phoneNumber
	            );
				$this->Faker_model->set_table('users');
	            $this->Faker_model->create($data);
	            
	            $user_id = $this->Faker_model->get_last_id();
				$this->Faker_model->set_table('users_groups');
				$this->Faker_model->create(array('user_id' => $user_id, 'group_id' => '2'));
				
				//populate everything else
				/* on hold until I pick a wine API*/
				$this->_seed_locations($user_id);
				$this->_seed_wines($user_id);
				$this->_seed_bottles($user_id);
				$this->_seed_orders($user_id);
	        }
	 
	        echo PHP_EOL;
	    }
		
		/**
	     * seed wines
	     *
	     * @param int $user_id
	     */
		private function _seed_wines($user_id) {
					
		}
		
		/**
	     * seed locations
	     *
	     * @param int $user_id
	     */
		private function _seed_locations($user_id) {
					
		}
		
		/**
	     * seed bottles
	     *
	     * @param int $user_id
	     */
		private function _seed_bottles($user_id) {
									
		}
		
		/**
	     * seed orders
	     *
	     * @param int $user_id
	     */
		private function _seed_orders($user_id) {
			
		}
								
		private function _truncate_db() {
	    	$this->Faker_model->truncate_db();
	    }
    }
    