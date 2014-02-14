<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class MY_Model extends CI_Model {
    	
		public $table;
		public $user_id; //make these protected?
		public $table_id;

		//check that record exists in each return true if successful, else return false
		// also check that the user id matches the __id ie. the user must have the order_id
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}
		
		public function get_all() {
			return $this->db->where('user_id', $this->user_id)->get($this->table)->result();
		}
		
		public function get_some($limit, $offset) {
			return $this->db->where('user_id', $this->user_id)->get($this->table, $limit, $offset)->result();
		}
		
		public function get_some_by($field, $order, $limit = 10, $offset ) {
			return $this->db->select('*')->where('user_id', $this->user_id)->order_by($field, $order)->from($this->table)->limit($limit, $offset)->get()->result();
		}
				
		public function get($id) {
			return $this->db->where('id', $id)->limit(1)->get($this->table)->row();
		}
		
		public function get_by($field, $order = 'desc') {
			return $this->db->select('*')->where('user_id', $this->user_id)->order_by($field, $order)->from($this->table)->get()->result();
		}
		
		public function create($data) {
			return $this->db->insert($this->table, $data);
		}
		
		public function delete() {
			//skip first two uri segments
			$success = array();
			foreach($this->uri->segment_array() as $segment => $order_id){
				if($segment > 2){
					$this->db->where('id', $this->uri->segment($segment));
					$q = $this->db->delete($this->table);
					array_push($success, $q);
				}
			}
			return $this->check_success($success);
		}
		
		public function update($data){
			/* make update batch if more than one */
			$success = array();
			foreach($this->uri->segment_array() as $segment => $order_id){
				if($segment > 2){
					$this->db->where('id', $this->uri->segment($segment));
				    $q = $this->db->update($this->table, $data[$segment - 3]); // subtract 3 to adjust from uri segment to get index
					array_push($success, $q);
				}
			}
			return $this->check_success($success);
		}
				
		public function check_success($queries) {
			foreach ($queries as $query) {
				if(!$query){
					return FALSE;
				}
			}
			return TRUE;
		}
		
		public function check_permission($data) {
			// if $this->user_id has what it wants to alter then return TRUE else return FALSE
			// there should never be a discrepancy in the user_id stored in the session and the one in the database
			// check that all data or id is safe
		}
		
    }
