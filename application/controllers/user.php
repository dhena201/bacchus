<?php
    class User extends MY_Controller {
        
        public function index(){
	        if (!$this->ion_auth->logged_in()) {
				redirect('app/login', 'refresh');
			} elseif ($this->ion_auth->is_admin()) {
				redirect('admin', 'refresh');
			} else {
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				
				$data['username'] = $this->ion_auth->user()->row()->username;
				$this->load->view('includes/user_header', $data); 
				$this->load->view('user', $data);
			}
			$this->load->model('user_model');
			//$this->load->view('projectcamp/index.html');
        	//echo "<pre>";
        	//print_r($this->user_model->find());
			//echo "</pre>";
        }
		
		public function plogin(){		
			$this->load->view('projectcamp/login.html');
		}
		
		public function pregister(){		
			$this->load->view('projectcamp/register.html');
		}
		
		public function logout(){		
			$this->ion_auth->logout();
			redirect('/', 'refresh');
		}
		
		public function edit_account(){		
			/*$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data['username'] = $this->ion_auth->user()->row()->username;
			$data['user'] = $this->ion_auth->user()->row();
			$this->lang->load('auth', 'english');
			$this->load->view('includes/user_header', $data);
			$this->load->view('edit_account', $data);*/
			//$this->load->view('auth/edit_user');
			redirect('auth/edit_user/'.$this->ion_auth->user()->row()->id); // for now
		}
		
		public function reset_password(){		
			redirect('/user', 'refresh');
		}
		public function delete_user(){
			$id = $this->ion_auth->user()->row()->id;
			if($this->ion_auth->delete_user($id)){
				//success
			} else {
				//failure
			}
		}
		public function profile(){		
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			/* tmp data */
			$data['title'] = 'View Profile'; 
			$data['content'] = 'profile'; 
			$data['username'] = $this->ion_auth->user()->row()->username;
			$data['user'] = $this->ion_auth->user()->row();
			$this->lang->load('auth', 'english');
			$this->load->view($this->layout, $data);
		}
		
		public function help(){
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			/* tmp data */
			$data['title'] = 'Help'; 
			$data['content'] = 'help'; 
			$data['username'] = $this->ion_auth->user()->row()->username;
			$data['user'] = $this->ion_auth->user()->row();
			$this->lang->load('auth', 'english');
			$this->load->view($this->layout, $data);
		}

		//view cellar
		public function cellar(){
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			/* tmp data */
			$data['title'] = 'View Cellar'; 
			$data['content'] = 'cellar'; 
			$data['username'] = $this->ion_auth->user()->row()->username;
			$data['user'] = $this->ion_auth->user()->row();
			$this->lang->load('auth', 'english');
			$this->load->view($this->layout, $data);
		}
		
		//view orders
		public function orders(){
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			/* tmp data */
			$data['title'] = 'View Orders'; 
			$data['content'] = 'orders'; 
			$data['username'] = $this->ion_auth->user()->row()->username;
			$data['user'] = $this->ion_auth->user()->row();
			$this->lang->load('auth', 'english');
			$this->load->view($this->layout, $data);
		}
		
    }
    
?>