   <!-- Custom styles for this template -->
    <style>
    	body {
		  padding-top: 100px;
		  padding-bottom: 40px;
		  background-color: #eee;
		}
		.form-forgot-password {
		  max-width: 330px;
		  padding: 15px;
		  margin: 0 auto;
		}
		.form-forgot-password .form-forgot-password-heading, .form-forgot-password {
		  margin-bottom: 10px;
		}
		.form-forgot-password {
		  font-weight: normal;
		}
		.form-forgot-password input[type="text"] {
		  position: relative;
		  font-size: 16px;
		  height: auto;
		  padding: 10px;
		  -webkit-box-sizing: border-box;
		  -moz-box-sizing: border-box;
		  box-sizing: border-box;
		}
		.form-forgot-password input[type="text"]:focus {
		  z-index: 2;
		}
		.form-forgot-password input[type="text"] {
		  margin-bottom: -1px;
		  border-bottom-left-radius: 0;
		  border-bottom-right-radius: 0;
		}
    </style>

	<div class="container">
			
		<?=form_open("auth/forgot_password", 'class="form-forgot-password" id="forgotPasswordForm"');?>
			
			<h2 class="form-forgot-password-heading"><?=lang('forgot_password_heading');?></h2>
			<p class="form-forgot-password-heading"><?=sprintf(lang('forgot_password_subheading'), $identity_label);?></p>
		  	
		  	<div class="form-group">
		  		<?=form_error('email');?>
		  		<label for="email"><?=sprintf(lang('forgot_password_email_label'), $identity_label);?></label>
				<?=form_input($email);?>
		 	</div>
		
		<?=form_submit('submit', lang('forgot_password_submit_btn'), 'class="btn btn-large btn-primary btn-block"');?>
		
		<?=form_close();?>
		
		<div class="container text-center">
			<p><a href='<?php echo base_url()."auth/login" ?>'>Already have an account? Click here to sign in!</a></p>
			<p><a href='<?php echo base_url()."registration" ?>'>Don't have an account? Click here to sign up!</a></p>
		</div>
			
	</div>