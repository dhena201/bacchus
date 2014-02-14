   <!-- Custom styles for this template -->
    <style>
    	body {
		  padding-top: 100px;
		  padding-bottom: 40px;
		  background-color: #eee;
		}
		.form-signup {
		  max-width: 330px;
		  padding: 15px;
		  margin: 0 auto;
		}
		.form-signup .form-signup-heading, .form-signup .checkbox {
		  margin-bottom: 10px;
		}
		.form-signup .checkbox {
		  font-weight: normal;
		}
		.form-signup input[type="text"], .form-signup input[type="password"] {
		  position: relative;
		  font-size: 16px;
		  height: auto;
		  padding: 10px;
		  -webkit-box-sizing: border-box;
		  -moz-box-sizing: border-box;
		  box-sizing: border-box;
		}
		.form-signup input[type="text"]:focus, .form-signup input[type="password"]:focus {
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

    <div class="container">

	    <?=form_open(base_url().'registration', "class='form-signup' id='newUserForm'");?>
			
			<h2 class="form-signup-heading">Sign Up</h2>
			
			<div class="form-group">
	            <?=form_error('email');?>
	            <?=form_input($email);?>
	     	</div>
	     	
			<div class="form-group">
				<?=form_error('username');?>
				<?=form_input($username);?>
			</div>
		
			<div class="form-group">
	            <?=form_error('password');?>
	            <?=form_input($password);?>
			</div>
			
			<div class="form-group">
	            <?=form_error('cpassword');?>
	            <?=form_input($cpassword);?>
	     	</div>
	     	
			<?=form_submit('signup_submit', 'Sign up!', 'class="btn btn-large btn-primary btn-block"');?>
			
      	<?=form_close();?>
      	
		<div class="container" style="text-align: center;">
			<a href='<?php echo base_url()."auth/login" ?>'>Already have an account? Click here to sign in!</a>
		</div>
