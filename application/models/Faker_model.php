<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   /*
    * FOR fzaninotto/Faker (database seeding)
    * */
   
	class Faker_Model extends MY_Model {
		
		public function __construct() {
			parent::__construct();
			if(empty($table)){
				$this->table = 'users'; 
			}
			
			$this->user_id = $this->ion_auth->get_user_id(); // is this secure?
		}
		
		public function set_table($table) {
			$this->table = $table;
		}
		
		public function truncate_db() {
			foreach ($this->db->list_tables() as $table) {
				if(!($table === 'groups' || $table === 'emails' || $table === 'login_attempts')){
					$this->db->truncate($table);
				}
			}
		}
		
		public function get_last_id() {
			return $this->db->insert_id();
		}
	}
		