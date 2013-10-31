<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signup!</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo asset_url().'css/bootstrap.min.css';?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
    	body {
		  padding-top: 40px;
		  padding-bottom: 40px;
		  background-color: #eee;
		}
		
		.form-signup {
		  max-width: 330px;
		  padding: 15px;
		  margin: 0 auto;
		}
		.form-signup .form-signup-heading,
		.form-signup .checkbox {
		  margin-bottom: 10px;
		}
		.form-signup .checkbox {
		  font-weight: normal;
		}
		.form-signup input[type="text"],
		.form-signup input[type="password"] {
		  position: relative;
		  font-size: 16px;
		  height: auto;
		  padding: 10px;
		  -webkit-box-sizing: border-box;
		     -moz-box-sizing: border-box;
		          box-sizing: border-box;
		}
		.form-signup input[type="text"]:focus,
		.form-signup input[type="password"]:focus {
		  z-index: 2;
		}
		.form-signup input[type="text"] {
		  margin-bottom: -1px;
		  border-bottom-left-radius: 0;
		  border-bottom-right-radius: 0;
		}
		.form-signup input[type="password"] {
		  margin-bottom: 10px;
		  border-top-left-radius: 0;
		  border-top-right-radius: 0;
		}
    </style>
  </head>

  <body>

    <div class="container">
	    <?php
	    $form_attr = array('class' => 'form-signup');
	    echo form_open(base_url().'registration', $form_attr);
		echo validation_errors();
		echo '<h2 class="form-signup-heading">Sign Up</h2>';
		$email_data = array(
          'name'        => 'email',
          'autofocus' => 'autofocus',
          'maxlength'   => '100',
          'class'        => 'form-control',
          'placeholder'       => 'Email address',
          'value'       => $this->input->post('email')
        );
		echo form_input($email_data);
		
		$username_data = array(
          'name'        => 'username',
          'maxlength'   => '100',
          'class'        => 'form-control',
          'placeholder'       => 'Username',
          'value'       => $this->input->post('username')
        );
		echo form_input($username_data);
		
		$pswd_data = array(
          'name'        => 'password',
          'maxlength'   => '100',
          'class'        => 'form-control',
          'placeholder'       => 'Password',
        );
		echo form_password($pswd_data);
		
		$cpswd_data = array(
          'name'        => 'cpassword',
          'maxlength'   => '100',
          'class'        => 'form-control',
          'placeholder'       => 'Confirm Password',
        );
		echo form_password($cpswd_data);
		
		
		$submit_data = array(
          'name'        => 'signup_submit',
          'class'        => 'btn btn-large btn-primary btn-block',
          'value'       => 'Sign up',
        );
		echo form_submit($submit_data);
      	echo form_close();
		?>
		<div class="container" style="text-align: center;"><a href='<?php echo base_url()."app/login" ?>'>Already have an account? Click here to sign in!</a></div>
    </div> <!-- /container -->

  </body>
</html>