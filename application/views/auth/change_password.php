	<!-- Custom styles for this template -->
    <style>
    	body {
		  padding-top: 100px;
		  padding-bottom: 40px;
		  background-color: #eee;
		}
		.form-change-password {
		  max-width: 330px;
		  padding: 15px;
		  margin: 0 auto;
		}
		.form-change-password .form-change-password-heading, .form-change-password {
		  margin-bottom: 10px;
		}
		.form-change-password {
		  font-weight: normal;
		}
		.form-change-password input[type="text"], .form-change-password input[type="password"] {
		  position: relative;
		  font-size: 16px;
		  height: auto;
		  padding: 10px;
		  -webkit-box-sizing: border-box;
		  -moz-box-sizing: border-box;
		  box-sizing: border-box;
		}
		.form-change-password input[type="text"]:focus, .form-change-password input[type="password"]:focus {
		  z-index: 2;
		}
		.form-change-password input[type="text"] {
		  margin-bottom: -1px;
		  border-bottom-left-radius: 0;
		  border-bottom-right-radius: 0;
		}
		.form-change-password input[type="password"] {
		  margin-bottom: 10px;
		  border-top-left-radius: 0;
		  border-top-right-radius: 0;
		}
    </style>

	<div class="container">
			
		<?=form_open("auth/change_password", 'class="form-change-password" id="changePasswordForm"');?>
			
			<h2 class="form-change-password-heading"><?=lang('change_password_heading');?></h2>
		  	
		  	<div class="form-group">
		  		<?=form_error('old_password');?>
		  		<?=lang('change_password_old_password_label', 'old_password');;?>
				<?=form_input($old_password);?>
		 	</div>
		  	
		  	<div class="form-group">
		  		<?=form_error('new_password');?>
		  		<label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label>
				<?=form_input($new_password);?>
		 	</div>
		
			<div class="form-group">
		  		<?=form_error('new_password_confirm');?>
		  		<?=lang('change_password_new_password_confirm_label', 'new_password_confirm');;?>
				<?=form_input($new_password_confirm);?>
		 	</div>
		
			<?=form_input($user_id);?>
			<?=form_submit('submit', lang('change_password_submit_btn'), 'class="btn btn-large btn-primary btn-block"');?>
		
		<?=form_close();?>
		
	</div>