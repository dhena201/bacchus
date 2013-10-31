<html>
	<body>
		<?php echo form_open(base_url().'auth/edit_user/'.$user->id);?>
		
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-md-push-3">
			    	<?php echo lang('edit_user_fname_label', 'first_name');?> <br />
			    	<?php echo form_input($user->first_name);?>
			  	</div>
			  	<div class="col-md-3 col-md-pull-9">
			  		<?php echo lang('edit_user_lname_label', 'last_name');?> <br />
			        <?php echo form_input($user->last_name);?>
				</div>
			</div>
			<?php echo form_hidden('id', $user->id);?>
			<?php echo form_hidden($csrf); ?>
			<?php echo form_submit('submit', lang('edit_user_submit_btn'));?>
			<?php echo form_close();?>
		<form role="form">
		  <div class="form-group">
		   	 <label for="newPassword">Old Password</label>
		     <input type="password" class="form-control" id="oldPassword">
		  </div>
		  <div class="form-group">
		    <label for="newPassword">New Password</label>
		    <input type="password" class="form-control" id="newPassword">
		  </div>
		  <div class="form-group">
		    <label for="cpassword">Confirm Password</label>
		    <input type="password" class="form-control" id="cpassword" >
		  </div>
		
		  <button type="submit" class="btn btn-warning btn-default">Update Password</button>
		  <div class="container" style="text-align: center;">
			
		  		<a href="<?php echo base_url()."auth/forgot_password" ?>">
		  			<?php echo lang('login_forgot_password');?>
		   		</a>

		   </div>
		</form>



		<button type="button" class="btn btn-danger btn-default">anchor(' ,"DELETE ACCOUNT")</button>
		<span class="help-block">Once you delete your account, there is no going back. Please be certain.</span>
		<?php $this->load->view('includes/footer'); ?>
		</div>
	</body>
</html>
    