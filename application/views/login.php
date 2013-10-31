<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo asset_url().'css/bootstrap.min.css';?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
    	body {
		  padding-top: 40px;
		  padding-bottom: 40px;
		  background-color: #eee;
		}
		
		.form-signin {
		  max-width: 330px;
		  padding: 15px;
		  margin: 0 auto;
		}
		.form-signin .form-signin-heading,
		.form-signin .checkbox {
		  margin-bottom: 10px;
		}
		.form-signin .checkbox {
		  font-weight: normal;
		}
		.form-signin input[type="text"],
		.form-signin input[type="password"] {
		  position: relative;
		  font-size: 16px;
		  height: auto;
		  padding: 10px;
		  -webkit-box-sizing: border-box;
		     -moz-box-sizing: border-box;
		          box-sizing: border-box;
		}
		.form-signin input[type="text"]:focus,
		.form-signin input[type="password"]:focus {
		  z-index: 2;
		}
		.form-signin input[type="text"] {
		  margin-bottom: -1px;
		  border-bottom-left-radius: 0;
		  border-bottom-right-radius: 0;
		}
		.form-signin input[type="password"] {
		  margin-bottom: 10px;
		  border-top-left-radius: 0;
		  border-top-right-radius: 0;
		}
    </style>
  </head>

  <body>

    <div class="container">
	    <?php
	    $form_attr = array('class' => 'form-signin');
	    echo form_open('auth/login', $form_attr);
		
		$success = $this->session->flashdata('alert-success');
		$failure = $this->session->flashdata('alert-error');
	    if($success){
	        echo '<div>' . $success . '</div>';
	    } elseif($failure) {
	    	 echo '<div>' . $failure . '</div>';
	    }
		
		echo validation_errors();
		echo '<h2 class="form-signin-heading">Please sign in</h2>';
		$email_data = array(
          'name'        => 'identity',
          'autofocus' => 'autofocus',
          'maxlength'   => '100',
          'class'        => 'form-control',
          'placeholder'       => 'Email address',
        );
		echo form_input($email_data);
		
		$pswd_data = array(
          'name'        => 'password',
          'maxlength'   => '100',
          'class'        => 'form-control',
          'placeholder'       => 'Password',
          'value'       => $this->input->post('email')
        );
		echo form_password($pswd_data);
		
		echo "<label class='checkbox'>";
		echo form_checkbox('remember', '1', FALSE, 'id="remember"');
		echo "Remember me";
		echo "</label>";
		
		
		$submit_data = array(
          'name'        => 'login_submit',
          'class'        => 'btn btn-large btn-primary btn-block',
          'value'       => 'Sign in',
        );
		echo form_submit($submit_data);
      	echo form_close();
		?>
		<div class="container" style="text-align: center;"><p><a href="<?php echo base_url()."auth/forgot_password" ?>"><?php echo 'Forgot Password?'.lang('login_forgot_password');?></a></p></div>
		<div class="container" style="text-align: center;"><a href='<?php echo base_url()."app/signup" ?>'>Don't have an account? Click here to sign up!</a></div>
    </div> <!-- /container -->

  </body>
</html>