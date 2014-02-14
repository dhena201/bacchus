<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Orders extends MY_Controller {
	
	private $content;
	
	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		} elseif ($this->ion_auth->is_admin()) {
			redirect('admin', 'refresh');
		} else {
			$this->load->model('User_model');
			$this->User_model->set_table('orders');
			$this->load->library('pagination');
			$this->load->library('form_validation');
		    $this->form_validation->set_error_delimiters('<p><span class="label label-danger">', '</span></p>');
			$this->content = 'user/orders/template_orders';
		}
	}
	
	public function index() {
		$config['base_url'] = base_url() . '/orders/index';
		$config['total_rows'] = count($this->User_model->get_all());
		$config['per_page'] = 10;
		$config['num_links'] = 5;
		$config['full_tag_open'] = "<div id='pagination' class='text-center'>";
		$config['full_tag_close'] = "</div>";
		
		$this->pagination->initialize($config);

		$sort = array('estimated_arrival', 'asc');
		
		$data['records'] = $this->User_model->get_some_by($sort[0], $sort[1], $config['per_page'], $this->uri->segment(3)); 
		
		$data['title'] = 'Orders';
		$data['content'] = $this->content;
		$data['order_content'] = 'user/orders/index_orders';
		$data['navigation'] = $this->navigation;
		
		$data['user'] = $this->ion_auth->user()->row();
		$data['username'] = $this->ion_auth->user()->row()->username;
		
		$data['base_url'] = base_url().'orders';
		
		$data['orders'] = $this->User_model->get_by($sort[0], $sort[1]);
		
		$data['index_active'] = TRUE;
		$data['create_active'] = FALSE;
		$data['preferences_active'] = FALSE;
		
		$this->load->view($this->layout, $data);
		
	}

	
	public function create() {
		if (!$this->ion_auth->logged_in()) {
			redirect('app/login', 'refresh');
		}
		
		$this->form_validation->set_rules('wine_id', 'Wine', 'xss_clean|required|trim|is_natural_no_zero'); // must match a wine in wine.com API OR offer a warning saying that we can't find it and we will add it
		$this->form_validation->set_rules('location_id', 'Location', 'xss_clean|required|trim|is_natural_no_zero|callback_location_id_check'); // must belong to user
		$this->form_validation->set_rules('quantity', 'Quantity', 'xss_clean|required|trim|is_natural_no_zero');
		$this->form_validation->set_rules('estimated_arrival', 'Estimated Arrival', 'xss_clean|trim|callback_estimated_arrival_check');
		$this->form_validation->set_rules('order_comments', 'Comments', 'xss_clean|trim');
		
				
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Create Order';
			$data['content'] = $this->content;
			$data['order_content'] = 'user/orders/create_order';
			$data['navigation'] = $this->navigation;
			
			$data['user'] = $this->ion_auth->user()->row();
			$data['username'] = $this->ion_auth->user()->row()->username;
			
			$data['index_active'] = FALSE;
			$data['create_active'] = TRUE;
			$data['preferences_active'] = FALSE;
			
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			
			$data['wine_id'] = array(
				'name'  => 'wine_id',
				'id'    => 'wineInput',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('wine_id')
			);
			$data['location_id'] = array(
				'name'  => 'location_id',
				'id'    => 'locationInput',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('location_id')
			);
			$data['quantity'] = array(
				'name'  => 'quantity',
				'id'    => 'quantityInput',
				'class' => 'form-control',
				'type'  => 'number',
				'value' => $this->form_validation->set_value('quantity')
			);
			$data['estimated_arrival'] = array(
				'name'  => 'estimated_arrival',
				'class' => 'form-control datepicker hasDatepicker',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('estimated_arrival')
			);
			$data['order_comments'] = array(
				'name'  => 'order_comments',
				'id'    => 'commentsInput',
				'class' => 'form-control',
				'rows'  => '3',
				'value' => $this->form_validation->set_value('order_comments')
			);
			$this->_render_page($this->layout, $data);
			
		} else {
			$data = array(
				'wine_id' => $this -> input -> post('wine_id'), // verifiy that exists
				'location_id' => $this -> input -> post('location_id'), // verifiy that exists
				'estimated_arrival' => $this->input->post('estimated_arrival'),
				'quantity' => $this->input->post('quantity'),
				'order_comments' => $this->input->post('order_comments'),
				'user_id' => $this->user_id
			);
			
			$added = $this->User_model->create($data);
			if ($added) {
				$this->session->set_flashdata('message', 'Order was created.');
				$this->session->set_flashdata('alert-message', 'success');
			} else {
				$this->session->set_flashdata('message', 'There was an error creating your order.');
				$this->session->set_flashdata('alert-message', 'failure');
			}
			redirect('orders','refresh');
		}
		
	}
	
	public function edit() {
		// verifiy that wine exist
		/* make a maximum of 10 edits */
		if (!$this->ion_auth->logged_in()) {
			redirect('app/login', 'refresh');
		}
		
		$this->form_validation->set_rules('user_id', 'User Id', 'required|is_natural_no_zero|callback_user_id_check');
		$this->form_validation->set_rules('wine_id[]', 'Wine', 'xss_clean|required|trim|is_natural_no_zero'); // must match a wine in wine.com API OR offer a warning saying that we can't find it and we will add it
		$this->form_validation->set_rules('location_id[]', 'Location', 'xss_clean|required|trim|is_natural_no_zero|callback_location_id_check');
		$this->form_validation->set_rules('quantity[]', 'Quantity', 'xss_clean|required|trim|is_natural_no_zero|trim');
		$this->form_validation->set_rules('estimated_arrival[]', 'Estimated Arrival', 'xss_clean|trim|callback_estimated_arrival_check');
		$this->form_validation->set_rules('order_comments[]', 'Comments', 'xss_clean|trim');
		
		if (isset($_POST) && !empty($_POST)) {
			if ($this->form_validation->run() == TRUE) {
				$data = array();
				// Count distinct entries in the form
				$count = count($this->input->post('wine_id'));
				
				for($i=0; $i < $count; $i++) {
					$wine_id = $this->input->post('wine_id');
					$location_id = $this->input->post('location_id');
					$estimated_arrival = $this->input->post('estimated_arrival');
					$quantity = $this->input->post('quantity');
					$order_comments = $this->input->post('order_comments');
				    $data[] = array(
				        'wine_id' => $wine_id[$i],
				        'location_id' => $location_id[$i],
				        'estimated_arrival' => $estimated_arrival[$i],
				        'quantity' => $quantity[$i],
				        'order_comments' => $order_comments[$i],
				       );
				} 

				$updated = $this->User_model->update($data);
				
				if ($updated) {
					$this->session->set_flashdata('message', 'Update Successful.');
					$this->session->set_flashdata('alert-message', 'success');
					redirect('orders','refresh');
				} else {
					$this->session->set_flashdata('message', 'There was an error updating your order.');
					$this->session->set_flashdata('alert-message', 'failure');
					$order_ids = '';
					foreach($this->uri->segment_array() as $segment => $order_id){
						if($segment > 2){
							$order_ids .= '/' . $this->uri->segment($segment);
						}
					}
				    redirect("orders/edit$order_ids",'refresh');
				}
			}
		}

		$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$data['title'] = 'Edit Order'; 
		$data['content'] = $this->content;
		$data['order_content'] = 'user/orders/edit_order';
		$data['navigation'] = $this->navigation;
		$data['base_url'] = base_url().'orders';
		
		$data['username'] = $this->ion_auth->user()->row()->username;
		$data['user'] = $this->ion_auth->user()->row();
		
		$data['index_active'] = FALSE;
		$data['create_active'] = FALSE;
		$data['preferences_active'] = FALSE;
		
		$data['orders'] = array();
		//get the orders
		foreach($this->uri->segment_array() as $segment => $order_id){
			if($segment > 2 && $segment <= 12){
				$num = $segment - 3; 
				$data['orders'][$num] = $this->User_model->get($order_id);
			}
		}

		//set values
		foreach($data['orders'] as $num => $order){
			$data['orders'][$num]->wine_id = array(
				'name'  => 'wine_id[]',
				'id'    => 'wineInput',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('wine_id[]', $order->wine_id)
			);
			$data['orders'][$num]->location_id = array(
				'name'  => 'location_id[]',
				'id'    => 'locationInput',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('location_id[]', $order->location_id)
			);
			$data['orders'][$num]->quantity = array(
				'name'  => 'quantity[]',
				'id'    => 'quantityInput',
				'type'  => 'number',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('quantity[]', $order->quantity)
			);
			$data['orders'][$num]->estimated_arrival = array(
				'name'  => 'estimated_arrival[]',
				'type'  => 'text',
				'class' => 'form-control datepicker hasDatepicker',
				'value' => $this->form_validation->set_value('estimated_arrival[]', $order->estimated_arrival)
			);
			$data['orders'][$num]->order_comments = array(
				'name'  => 'order_comments[]',
				'id'    => 'commentsInput',
				'rows'  => '3',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('order_comments[]', $order->order_comments)
			);
		}
		
		$this->_render_page($this->layout, $data);

	}


	public function preferences() {
		$data['title'] = 'Order Preferences';
		$data['content'] = $this->content;
		$data['order_content'] = 'user/orders/preferences_order';
		$data['navigation'] = $this->navigation;
		$data['user'] = $this->ion_auth->user()->row();
		$data['username'] = $this->ion_auth->user()->row()->username;
		
		$data['index_active'] = FALSE;
		$data['create_active'] = FALSE;
		$data['preferences_active'] = TRUE;
		
		$this->load->view($this->layout, $data);
	}

	public function add() {
		
		if (!$this->ion_auth->logged_in()) {
			// user not allowed to add this order -- will the delete still go through anyway?
			redirect('app/login', 'refresh'); // or if user did not submit form
		}
		
		$this->form_validation->set_rules('user_id', 'User Id', 'required|is_natural_no_zero|callback_user_id_check');
		// require at least 1 checkbox

		if ($this->form_validation->run() == FALSE) {
			$errors = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			$this->session->set_flashdata('message', "Order Addition Failure: $errors");
			$this->session->set_flashdata('alert-message', 'failure');
			redirect('orders','refresh');
		} else {
			/* verify that checkboxes have been checked too */
			$added = $this->User_model->add_order();
			
			if ($added) {
				$this->session->set_flashdata('message', 'Order Addition Successful.');
				$this->session->set_flashdata('alert-message', 'success');
			} else {
				$this->session->set_flashdata('message', 'Order Addition Failure.');
				$this->session->set_flashdata('alert-message', 'failure');
			}
			redirect('orders','refresh');
		}
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
			$this->session->set_flashdata('message', "Order Deletion Failure: $errors");
			$this->session->set_flashdata('alert-message', 'failure');
			redirect('orders','refresh');
		} else {
			/* verify that checkboxes have been checked too */
			$deleted = $this->User_model->delete();
			
			if ($deleted) {
				$this->session->set_flashdata('alert-message', 'success');
				$this->session->set_flashdata('message', 'Order Deletion Successful.');
			} else {
				$this->session->set_flashdata('alert-message', 'failure');
				$this->session->set_flashdata('message', 'Order Deletion Failure.');
			}
			redirect('orders','refresh');
		}
	}
	
	public function view() {
		if (!$this->ion_auth->logged_in()) {
			redirect('app/login', 'refresh'); // or if user did not submit form
		}
		// set maximum of 10 or 1?
		$data['title'] = 'View Order';
		$data['content'] = $this->content;
		$data['order_content'] = 'user/orders/view_orders';
		$data['navigation'] = $this->navigation;
		
		$data['user'] = $this->ion_auth->user()->row();
		$data['username'] = $this->ion_auth->user()->row()->username;
		
		$data['base_url'] = base_url().'orders';
		
		$data['orders'] = array();
		//get the orders
		foreach($this->uri->segment_array() as $segment => $order_id){
			if($segment > 2 && $segment <= 12){
				$num = $segment - 3; 
				$data['orders'][$num] = $this->User_model->get($order_id);
			}
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
	
	public function estimated_arrival_check($estimated_arrival) {
		// -- problem --  when editing an estimated arrival that has past, form validation won't pass unless you update with at least current date
		if(!is_null($estimated_arrival) && trim($estimated_arrival) !== ''){
			if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $estimated_arrival)) {
				$today = date("Y-m-d");
				//verify that date is at least today or later
				if((strtotime($estimated_arrival) - strtotime($today)) >= 0){
					return TRUE;
				} else {
					$this->form_validation->set_message('estimated_arrival_check', "The %s field has a minimum date of $today");
					return FALSE;
				}
			} else {
				$this->form_validation->set_message('estimated_arrival_check', 'The %s field must be in the form YYYY-MM-DD');
				return FALSE;
			}
		} else {
			return TRUE; // estimated_arrival can be NULL
		}
	}
	
	public function location_id_check($location_id) {
		// $this->user_id must have the location they want to alter
		if ($this->User_model->user_has($this->user_id, $location_id, 'locations')) {
			return TRUE;
		} else {
			$this->form_validation->set_message('location_id_check', 'Oops! That\'s a bad location.'); // vulnerablility --- a person could just try every location id
			return FALSE;
		}
	}
}

/* 
 * End of file Orders.php 
 * Location: application/controllers/Orders.php 
 * */