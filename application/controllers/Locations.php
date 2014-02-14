<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Locations extends MY_Controller {
		
		private $content;
		private $country_list;
		
		public function __construct() {
			parent::__construct();
			if (!$this->ion_auth->logged_in()) {
				redirect('auth/login', 'refresh');
			} elseif ($this->ion_auth->is_admin()) {
				redirect('admin', 'refresh');
			} else {
				$this->load->model('User_model');
				$this->User_model->set_table('locations');
				$this->load->library('pagination');
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<p><span class="label label-danger">', '</span></p>');
				$this->content = 'user/locations/locations_template';
				$this->config->load('countries');
				$this->country_list = $this->config->item('country_list');
			}
		}
		
        public function index() {
		 	$config['base_url'] = base_url() . '/locations/index';
			$config['total_rows'] = count($this->User_model->get_all());
			$config['per_page'] = 10;
			$config['num_links'] = 5;
			$config['full_tag_open'] = "<div id='pagination' class='text-center'>";
			$config['full_tag_close'] = "</div>";
			
			$this->pagination->initialize($config);
			
			$sort = array('location_created_at', 'desc');
			
			$data['records'] = $this->User_model->get_some_by($sort[0], $sort[1], $config['per_page'], $this->uri->segment(3)); 
			
			// add country name from 2-character iso code
			foreach($data['records'] as $location){
				if(array_key_exists($location->country, $this->country_list)){
					$location->country_name = $this->country_list[$location->country];
				}
			}

			$data['title'] = 'Locations';
			$data['content'] = $this->content;
			$data['location_content'] = 'user/locations/index_locations';
			$data['navigation'] = $this->navigation;
			
			$data['user'] = $this->ion_auth->user()->row();
			$data['username'] = $this->ion_auth->user()->row()->username;
				
			$data['base_url'] = base_url().'locations';
			
			$data['index_active'] = TRUE;
			$data['create_active'] = FALSE;
			$data['preferences_active'] = FALSE;
			
			$data['locations'] = $this->User_model->get_by($sort[0], $sort[1]);
			
			$this->load->view($this->layout, $data);
        }
		
		public function create() {
			if (!$this->ion_auth->logged_in()) {
				redirect('app/login', 'refresh');
			}
			
			$this->form_validation->set_rules('name', 'Name', 'xss_clean|required|trim'); 
			$this->form_validation->set_rules('address_line_1', 'Address Line 1', 'xss_clean|required|trim');
			$this->form_validation->set_rules('address_line_2', 'Address Line 2', 'xss_clean|trim');
			$this->form_validation->set_rules('city', 'City', 'xss_clean|required|trim');
			$this->form_validation->set_rules('state_province_region', 'State/Province/Region', 'xss_clean|trim');
			$this->form_validation->set_rules('postal_code', 'Postal Code', 'xss_clean|trim');
			$this->form_validation->set_rules('country', 'State/Province/Region', 'xss_clean|trim|required');
			$this->form_validation->set_rules('location_comments', 'Comments', 'xss_clean|trim');
					
			if ($this->form_validation->run() == FALSE) {
				$data['title'] = 'Create Location';
				$data['content'] = $this->content;
				$data['location_content'] = 'user/locations/create_locations';
				$data['navigation'] = $this->navigation;
				
				$data['user'] = $this->ion_auth->user()->row();
				$data['username'] = $this->ion_auth->user()->row()->username;
				
				$data['index_active'] = FALSE;
				$data['create_active'] = TRUE;
				$data['preferences_active'] = FALSE;
				
				$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
				
				$data['country_list'] = $this->country_list;

				$data['name'] = array(
					'name'  => 'name',
					'id'    => 'nameInput',
					'class' => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('name')
				);
				$data['address_line_1'] = array(
					'name'  => 'address_line_1',
					'id'    => 'addressLine1Input',
					'class' => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('address_line_1')
				);
				$data['address_line_2'] = array(
					'name'  => 'address_line_2',
					'id'    => 'addressLine2Input',
					'class' => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('address_line_2')
				);
				$data['city'] = array(
					'name'  => 'city',
					'id'    => 'cityInput',
					'class' => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('city')
				);
				$data['state_province_region'] = array(
					'name'  => 'state_province_region',
					'id'    => 'stateProvinceRegionInput',
					'class' => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('state_province_region')
				);
				$data['postal_code'] = array(
					'name'  => 'postal_code',
					'id'    => 'postalCodeInput',
					'class' => 'form-control',
					'type'  => 'text',
					'value' => $this->form_validation->set_value('postal_code')
				);
				$data['country'] = array(
					'name'  => 'country',
					'id'    => 'countryInput',
					'class' => 'form-control',
					'value' => $this->form_validation->set_select('country')
				);
				$data['location_comments'] = array(
					'name'  => 'location_comments',
					'id'    => 'commentsInput',
					'class' => 'form-control',
					'rows'  => '3',
					'value' => $this->form_validation->set_value('location_comments')
				);
				$this->_render_page($this->layout, $data);
				
			} else {
				$address_line_1 = $this->input->post('address_line_1');
				$address_line_2 = $this->input->post('address_line_2');
				$city = $this->input->post('city');
				$state_province_region = $this->input->post('state_province_region');
				$postal_code = $this->input->post('postal_code');
				$country = $this->country_list[$this->input->post('country')];
				
				$address = $address_line_1 . ' ' . $address_line_2 . ', ' . $city . ', ' . $state_province_region . ' ' . $postal_code .  ' ' . $country;
				$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false";
				$get = file_get_contents($url);
				$lat = json_decode($get)->results[0]->geometry->location->lat;
				$lon = json_decode($get)->results[0]->geometry->location->lng;
				// if lat and lng successfully gotten
				$data = array(
					'name' => $this->input->post('name'), 
					'address_line_1' => $address_line_1, 
					'address_line_2' => $address_line_2, 
					'city' => $city, 
					'state_province_region' => $state_province_region,
					'postal_code' => $postal_code,
					'country' => $this->input->post('country'),
					'lat' => $lat,
					'lon' => $lon,
					'location_comments' => $this->input->post('location_comments'),
					'user_id' => $this->user_id
				);
				
				$added = $this->User_model->create($data);
				if ($added) {
					$this->session->set_flashdata('message', 'Location was created.');
					$this->session->set_flashdata('alert-message', 'success');
				} else {
					$this->session->set_flashdata('message', 'There was an error creating your location.');
					$this->session->set_flashdata('alert-message', 'failure');
				}
				redirect('locations','refresh');
			}
			
		}
		
	public function edit() {
		// verifiy that wine exist
		/* make a maximum of 10 edits */
		if (!$this->ion_auth->logged_in()) {
			redirect('app/login', 'refresh');
		}
		
		$this->form_validation->set_rules('user_id', 'User Id', 'required|is_natural_no_zero|callback_user_id_check');
		$this->form_validation->set_rules('name[]', 'Name', 'xss_clean|required|trim'); 
		$this->form_validation->set_rules('address_line_1[]', 'Address Line 1', 'xss_clean|required|trim');
		$this->form_validation->set_rules('address_line_2[]', 'Address Line 2', 'xss_clean|trim');
		$this->form_validation->set_rules('city[]', 'City', 'xss_clean|required|trim');
		$this->form_validation->set_rules('state_province_region[]', 'State/Province/Region', 'xss_clean|trim');
		$this->form_validation->set_rules('postal_code[]', 'Postal Code', 'xss_clean|trim');
		$this->form_validation->set_rules('country[]', 'State/Province/Region', 'xss_clean|trim|required');
		$this->form_validation->set_rules('location_comments[]', 'Comments', 'xss_clean|trim');

		if (isset($_POST) && !empty($_POST)) {
			if ($this->form_validation->run() == TRUE) {
				$data = array();
				// Count distinct entries in the form
				$count = count($this->input->post('name'));
				
				for($i=0; $i < $count; $i++) {
					$name = $this->input->post('name');
					$address_line_1 = $this->input->post('address_line_1');
					$address_line_2 = $this->input->post('address_line_2');
					$city = $this->input->post('city');
					$state_province_region = $this->input->post('state_province_region');
					$postal_code = $this->input->post('postal_code');
					$country_iso = $this->input->post('country');
					$country = $this->country_list[$country_iso[$i]];
					$location_comments = $this->input->post('location_comments'); 
					$address = $address_line_1[$i] . ' ' . $address_line_2[$i] . ', ' . $city[$i] . ', ' . $state_province_region[$i] . ' ' . $postal_code[$i] .  ' ' . $country[$i];
					$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false";
					$get = file_get_contents($url);
					$lat[] = json_decode($get)->results[0]->geometry->location->lat;
					$lon[] = json_decode($get)->results[0]->geometry->location->lng;
					// if lat and lng successfully gotten
					
					$data[] = array(
						'name' => $name[$i], 
						'address_line_1' => $address_line_1[$i], 
						'address_line_2' => $address_line_2[$i], 
						'city' => $city[$i], 
						'state_province_region' => $state_province_region[$i],
						'postal_code' => $postal_code[$i],
						'country' => $country_iso[$i],
						'lat' => $lat[$i],
						'lon' => $lon[$i],
						'location_comments' => $location_comments[$i],
						'user_id' => $this->user_id
					);
				} 

				$updated = $this->User_model->update($data);
				
				if ($updated) {
					$this->session->set_flashdata('message', 'Update Successful.');
					$this->session->set_flashdata('alert-message', 'success');
					redirect('locations','refresh');
				} else {
					$this->session->set_flashdata('message', 'There was an error updating your location.');
					$this->session->set_flashdata('alert-message', 'failure');
					$location_ids = '';
					foreach($this->uri->segment_array() as $segment => $location_id){
						if($segment > 2){
							$location_ids .= '/' . $this->uri->segment($segment);
						}
					}
					redirect("locations/edit$location_ids",'refresh');
				}
			}
		}

		$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$data['title'] = 'Edit Location'; 
		$data['content'] = $this->content;
		$data['location_content'] = 'user/locations/edit_locations';
		$data['navigation'] = $this->navigation;
		$data['base_url'] = base_url().'locations';
		
		$data['username'] = $this->ion_auth->user()->row()->username;
		$data['user'] = $this->ion_auth->user()->row();
		
		$data['index_active'] = FALSE;
		$data['create_active'] = FALSE;
		$data['preferences_active'] = FALSE;
		
		$data['country_list'] = $this->country_list;
		
		$data['locations'] = array();
		//get the orders
		foreach($this->uri->segment_array() as $segment => $order_id){
			if($segment > 2 && $segment <= 12){
				$num = $segment - 3; 
				$data['locations'][$num] = $this->User_model->get($order_id);
			}
		}

		//set values
		foreach($data['locations'] as $num => $location){
			$data['locations'][$num]->name = array(
				'name'  => 'name[]',
				'id'    => 'nameInput',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('name[]', $location->name)
			);
			$data['locations'][$num]->address_line_1 = array(
				'name'  => 'address_line_1[]',
				'id'    => 'addressLine1Input',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('address_line_1[]', $location->address_line_1)
			);
			$data['locations'][$num]->address_line_2 = array(
				'name'  => 'address_line_2[]',
				'id'    => 'addressLine2Input',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('address_line_2[]', $location->address_line_2)
			);
			$data['locations'][$num]->city = array(
				'name'  => 'city[]',
				'id'    => 'cityInput',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('city[]', $location->city)
			);
			$data['locations'][$num]->state_province_region = array(
				'name'  => 'state_province_region[]',
				'id'    => 'stateProvinceRegionInput',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('state_province_region[]', $location->state_province_region)
			);
			$data['locations'][$num]->postal_code = array(
				'name'  => 'postal_code[]',
				'id'    => 'postalCodeInput',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('postal_code[]', $location->postal_code)
			);
			$data['locations'][$num]->country = array(
				'name'  => 'country[]',
				'id'    => 'countryInput',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('country[]', $location->country)
			);
			$data['locations'][$num]->location_comments = array(
				'name'  => 'location_comments[]',
				'id'    => 'commentsInput',
				'class' => 'form-control',
				'rows'  => '3',
				'value' => $this->form_validation->set_value('location_comments[]', $location->location_comments)
			);
		}
		
		$this->_render_page($this->layout, $data);

	}
		
		public function delete() {
			// what if user's session expires and they submit a request... --> should return Unauthorized Server Error
			
			if (!$this->ion_auth->logged_in()) {
				// user not allowed to delete this order -- will the delete still go through anyway?
				redirect('app/login', 'refresh'); // or if user did not submit form
			}
			
			$this->form_validation->set_rules('user_id', 'User Id', 'required|is_natural_no_zero|callback_user_id_check');
			// require at least 1 checkboxz
	
			if ($this->form_validation->run() == FALSE) {
				$errors = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
				$this->session->set_flashdata('message', "Location Deletion Failure: $errors");
				$this->session->set_flashdata('alert-message', 'failure');
				redirect('locations','refresh');
			} else {
				/* verify that checkboxes have been checked too */
				// clean this mess up...
				
				$location_ids = array();
				$order_ids = array();
				$wine_ids = array();
				
				foreach($this->uri->segment_array() as $segment => $order_id){
					if($segment > 2){
						array_push($location_ids, $this->uri->segment($segment));
					}
				}
				
				foreach ($location_ids as $loc) {
					foreach($this->db->where('user_id', $this->user_id)->where('location_id', $loc)->get('orders')->result() as $r){
						array_push($order_ids, $r->id);
					}
				}
				
				$locations_deleted = $this->User_model->delete();
				
				// delete orders and wines there too
				
				$this->User_model->set_table('orders');
				$orders_deleted = $this->User_model->delete_items($order_ids);
				
				$this->User_model->set_table('wines');
				//$wines_deleted = TRUE; // $this->User_model->delete_items($wine_ids);
				
				if ($locations_deleted && $orders_deleted) {
					$this->session->set_flashdata('alert-message', 'success');
					$this->session->set_flashdata('message', 'Location Deletion Successful.');
				} else {
					$this->session->set_flashdata('alert-message', 'failure');
					$this->session->set_flashdata('message', 'Location Deletion Failure.');
				}
				$this->User_model->set_table('locations'); // reset to the locations table
			    redirect('locations','refresh');
			}
		}
		
		public function preferences() {
			$data['title'] = 'Location Preferences';
			$data['content'] = $this->content;
			$data['location_content'] = 'user/locations/preferences_locations';
			$data['navigation'] = $this->navigation;
			$data['user'] = $this->ion_auth->user()->row();
			$data['username'] = $this->ion_auth->user()->row()->username;
			
			$data['index_active'] = FALSE;
			$data['create_active'] = FALSE;
			$data['preferences_active'] = TRUE;
			
			$this->load->view($this->layout, $data);
		}
		
		public function view() {
			if (!$this->ion_auth->logged_in()) {
				redirect('app/login', 'refresh'); // or if user did not submit form
			}
			// set maximum of 1?
			$data['title'] = 'View Location';
			$data['content'] = $this->content;
			$data['location_content'] = 'user/locations/view_locations';
			$data['navigation'] = $this->navigation;
			
			$data['user'] = $this->ion_auth->user()->row();
			$data['username'] = $this->ion_auth->user()->row()->username;
			
			$data['base_url'] = base_url().'locations';
			
			$data['location'] = $this->User_model->get($this->uri->segment(3));
		
			// add country name from 2-character iso code
			if(array_key_exists($data['location']->country, $this->country_list)){
				$data['location']->country_name = $this->country_list[$data['location']->country];
			}
			
			$data['index_active'] = FALSE;
			$data['create_active'] = FALSE;
			$data['preferences_active'] = FALSE;
	
			$this->load->view($this->layout, $data);
			
		}
		
		/*  *  Helper Methods  *  */
		
		/** * Get user error or success message *
		 * @access private 
		 * @param string, array, boolean
		 * @return string
		 * */
		 
		private function _render_page($view, $data=null, $render=false) {
			$this->viewdata = (empty($data)) ? $this->data: $data;
			$view_html = $this->load->view($view, $this->viewdata, $render);
			if (!$render) return $view_html;
		}
		
		/*
		 * Callbacks 
		 * */
		 
		public function user_id_check($user_id) {
		if ($user_id !== $this->user_id) {
			$this->form_validation->set_message('user_id_check', 'The %s field is incorrect'); // vulnerablility --- a person could just try every user id
			return FALSE;
		} else {
			return TRUE;
		}
	}
		
    }
    
/* 
 * End of file Locations.php 
 * Location: application/controllers/Locations.php 
 * */