<?php
require(APPPATH.'/libraries/REST_Controller.php');  
  /**
   * NOT SAFE right now
   * Need to make Validation Token
   * and require URI Param - APIKEY
   * **/
class Api extends REST_Controller  {
	  
    function user_get()  {
    	$this->load->model('user_model');  
        if(!$this->get('id'))  {  
            $this->response(NULL, 400);  
        }  
        $user = $this->user_model->get( $this->get('id') );  
        if($user)  {  
            $this->response($user, 200); // 200 being the HTTP response code  
        } else {  
            $this->response(NULL, 404);  
        }  
    }  
      
    function user_post() {
    	$this->load->model('user_model');  
        $result = $this->user_model->update( $this->post('id'), array(  
            'name' => $this->post('name'),  
            'email' => $this->post('email')  
        ));  
        if($result === FALSE)  {  
            $this->response(array('status' => 'failed'));  
        } else {  
            $this->response(array('status' => 'success'));  
        }     
    }  
      
    function users_get()  {
    	$this->load->model('user_model');  
        $users = $this->user_model->get_all();  
        if($users) {  
            $this->response($users, 200);  
        } else {  
            $this->response(NULL, 404);  
        }  
    }  
} 

/* 
 * End of file Api.php 
 * Location: application/controllers/Api.php 
 * */