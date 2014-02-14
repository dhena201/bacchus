<!-- Custom styles for this template -->
    <style>
    	body {
		  padding-top: 100px;
		  padding-bottom: 40px;
		  background-color: #eee;
		}
		
		.form-signin {
		  max-width: 330px;
		  padding: 15px;
		  margin: 0 auto;
		}
		.form-signin .form-signin-heading, .form-signin .checkbox {
		  margin-bottom: 10px;
		}
		.form-signin .checkbox {
		  font-weight: normal;
		}
		.form-signin input[type="text"], .form-signin input[type="password"] {
		  position: relative;
		  font-size: 16px;
		  height: auto;
		  padding: 10px;
		  -webkit-box-sizing: border-box;
		     -moz-box-sizing: border-box;
		          box-sizing: border-box;
		}
		.form-signin input[type="text"]:focus, .form-signin input[type="password"]:focus {
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
	
	<div class="container">
		
		<?=form_open("auth/login", 'class="form-signin" id="loginUserForm"');?>
			
			<h2 class="form-signin-heading"><?=lang('login_heading');?></h2>
			<p class="form-signin-heading"><?=lang('login_subheading');?></p>
		  	
		  	<div class="form-group">
		  		<?=form_error('identity');?>
		  		<?=lang('login_identity_label', 'identity');?>
				<?=form_input($identity);?>
		 	</div>
			
			<div class="form-group">
		  		<?=form_error('password');?>
		  		<?=lang('login_password_label', 'password');?>
				<?=form_input($password);?>
		 	</div>
			
			<div class="form-group">
		  		<?=lang('login_remember_label', 'remember');?>
				<?=form_checkbox('remember', '1', FALSE, 'id="remember"');?>
		 	</div>

		<?=form_submit('login_submit', lang('login_submit_btn'), 'class="btn btn-large btn-primary btn-block"');?>
		
		<?=form_close();?>
		
		<div class="container" style="text-align: center;">
			<p><a href="forgot_password"><?=lang('login_forgot_password');?></a></p>
			<p><a href='<?=base_url()."registration" ?>'>Don't have an account? Click here to sign up!</a></p>
		</div>
		
	</div>
