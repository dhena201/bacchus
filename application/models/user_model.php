<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   /*
    * FOR The API and users
    * */
   
	class User_Model extends MY_Model {
	
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
		
		public function get_table() {
			return $this->table;
		}
		
		public function add_order() {
			//skip first two uri segments
			foreach($this->uri->segment_array() as $segment => $order_id){
				if($segment > 2){
					//$this->db->where('id', $this->uri->segment($segment));
					//$this->db->delete($this->table);
				}
			}
			return $this->check_success();
		}
		
		public function delete_items($id_list) {
			$success = array();
			foreach ($id_list as $id) {
				if($this->user_has($this->user_id, $id, $this->table)){
					$this->db->where('id', $id);
					$q = $this->db->delete($this->table);
					array_push($success, $q);
				}
			}
			return $this->check_success($success);
		}
		
		public function user_has($user_id, $item_id, $table) {
			$this->db->select('*')->from($table)->where('id', $item_id)->where('user_id', $user_id);
			return $this->db->count_all_results() == 0 ? FALSE : TRUE;
		}
		
		public function search_orders($search) {
			// great link: 			http://stackoverflow.com/questions/8821844/how-to-create-mvc-for-search-in-codeigniter
		}
		
		public function get_recent_orders() {
			//$this->db->get_all;
		}
	}

/* 
 * End of file User_model.php 
 * Location: application/models/User_model.php 
 * */