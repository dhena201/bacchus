<?php
    class MY_Model extends CI_Model {
    	
		public $table;
		
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}
		
		public function find(){
			return $this->db->get($this->table)->result();
		}
		
		public function find_by_id($id){
			return $this->db->where('id', $id)->limit(1)->get($this->table)->row();
		}
		
    }
?>