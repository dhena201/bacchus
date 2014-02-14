<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Wines extends MY_Controller {
		
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
				$this->User_model->set_table('wines');
				$this->load->library('pagination');
				$this->load->library('form_validation');
				
				$params['api_key'] = $this->config->item('adegga_api_key');
				$this->load->library('AdeggaCore', $params);
				$this->load->library('Adegga', $params);
				
				$this->form_validation->set_error_delimiters('<p><span class="label label-danger">', '</span></p>');
				$this->content = 'user/wines/wines_template';
				$this->config->load('countries');
				$this->country_list = $this->config->item('country_list');
			}
		}
		
        public function index() {
		 	$config['base_url'] = base_url() . '/wines/index';
			$config['total_rows'] = count($this->User_model->get_all());
			$config['per_page'] = 10;
			$config['num_links'] = 5;
			$config['full_tag_open'] = "<div id='pagination' class='text-center'>";
			$config['full_tag_close'] = "</div>";
			
			$this->pagination->initialize($config);
			
			$sort = array('wine_created_at', 'desc');
			
			$data['records'] = $this->User_model->get_some_by($sort[0], $sort[1], $config['per_page'], $this->uri->segment(3)); 

			$data['title'] = 'Wines';
			$data['content'] = $this->content;
			$data['wine_content'] = 'user/wines/index_wines';
			$data['navigation'] = $this->navigation;
			
			$data['user'] = $this->ion_auth->user()->row();
			$data['username'] = $this->ion_auth->user()->row()->username;
				
			$data['base_url'] = base_url().'wines';
			
			$data['index_active'] = TRUE;
			$data['create_active'] = FALSE;
			$data['preferences_active'] = FALSE;
			
			$data['wines'] = $this->User_model->get_by($sort[0], $sort[1]);

			//prettify($this->adegga->GetWinesByName('cortes ', 5, 4, 2, 'null', 'desc', 'name'));
			//prettify( $this->adegga->getLog());
			
			$this->load->view($this->layout, $data);
			
        }
	}