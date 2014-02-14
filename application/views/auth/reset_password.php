   <!-- Custom styles for this template -->
    <style>
    	body {
		  padding-top: 100px;
		  padding-bottom: 40px;
		  background-color: #eee;
		}
		.form-reset-password {
		  max-width: 330px;
		  padding: 15px;
		  margin: 0 auto;
		}
		.form-reset-password .form-reset-password-heading, .form-reset-password {
		  margin-bottom: 10px;
		}
		.form-reset-password {
		  font-weight: normal;
		}
		.form-reset-password input[type="text"], .form-reset-password input[type="password"] {
		  position: relative;
		  font-size: 16px;
		  height: auto;
		  padding: 10px;
		  -webkit-box-sizing: border-box;
		  -moz-box-sizing: border-box;
		  box-sizing: border-box;
		}
		.form-reset-password input[type="text"]:focus, .form-reset-password input[type="password"]:focus {
		  z-index: 2;
		}
		.form-reset-password input[type="text"] {
		  margin-bottom: -1px;
		  border-bottom-left-radius: 0;
		  border-bottom-right-radius: 0;
		}
		.form-reset-password input[type="password"] {
		  margin-bottom: 10px;
		  border-top-left-radius: 0;
		  border-top-right-radius: 0;
		}
    </style>

	<div class="container">
			
		<?=form_open("auth/reset_password/$code", 'class="form-reset-password" id="resetPasswordForm"');?>
			
			<h2 class="form-reset-password-heading"><?=lang('reset_password_heading');?></h2>
		  	
		  	<div class="form-group">
		  		<?=form_error('new_password');?>
		  		<label for="new_password"><?=sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label>
				<?=form_input($new_password);?>
		 	</div>
		
			<div class="form-group">
		  		<?=form_error('new_password_confirm');?>
		  		<label for="new_password"><?=lang('reset_password_new_password_confirm_label', 'new_password_confirm');?></label>
				<?=form_input($new_password_confirm);?>
		 	</div>
		
			<?=form_input($user_id);?>
			<?=form_hidden($csrf); ?>
		
		<?=form_submit('submit', lang('reset_password_submit_btn'), 'class="btn btn-large btn-primary btn-block"');?>
		
		<?=form_close();?>
		
		<div class="container text-center">
			<p><a href='<?php echo base_url()."auth/login" ?>'>Already have an account? Click here to sign in!</a></p>
			<p><a href='<?php echo base_url()."registration" ?>'>Don't have an account? Click here to sign up!</a></p>
		</div>
			
	</div>