<?php
require(APPPATH.'/libraries/REST_Controller.php');  
  
class Api extends REST_Controller  {
	  
    function user_get()  {  
        if(!$this->get('id'))  {  
            $this->response(NULL, 400);  
        }  
        $user = $this->model_users->get( $this->get('id') );  
        if($user)  {  
            $this->response($user, 200); // 200 being the HTTP response code  
        } else {  
            $this->response(NULL, 404);  
        }  
    }  
      
    function user_post() {  
        $result = $this->model_users->update( $this->post('id'), array(  
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
        $users = $this->model_users->get_all();  
        if($users) {  
            $this->response($users, 200);  
        } else {  
            $this->response(NULL, 404);  
        }  
    }  
} 
?>