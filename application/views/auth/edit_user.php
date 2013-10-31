<?php 		$data['username'] = $this->ion_auth->user()->row()->username;
			$data['user'] = $this->ion_auth->user()->row();
			$this->lang->load('auth', 'english');
			$this->load->view('includes/user_header', $data); ?>
<h1><?php echo lang('edit_user_heading');?></h1>
<p><?php echo lang('edit_user_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>
	<div class="panel panel-default">
		<div class="panel-heading">
	    <h3 class="panel-title"><?php echo lang('edit_user_heading');?></h3>
	  	</div>
	  <div class="panel-body">
	    <?php echo form_open(uri_string());?>

      <p>
            <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
      </p>

      <p>
            <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </p>

      <p>
            <?php echo lang('edit_user_company_label', 'company');?> <br />
            <?php echo form_input($company);?>
      </p>

      <p>
            <?php echo lang('edit_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone);?>
      </p>

	  <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>

      <p><?php echo form_submit('submit', lang('edit_user_submit_btn'));?></p>

<?php echo form_close();?>
	  </div>
	  <div class="panel-footer"></div>
	  <div class="panel-heading">
	    <h3 class="panel-title"><?php echo lang('change_password_heading');?></h3>
	  	</div>
	  <div class="panel-body">

<h1></h1>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/change_password");?>

      <p>
            <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
            <?php echo form_input($old_password);?>
      </p>

      <p>
            <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
            <?php echo form_input($new_password);?>
      </p>

      <p>
            <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
            <?php echo form_input($new_password_confirm);?>
      </p>

      <?php echo form_input($user_id);?>
      <p><?php echo form_submit('submit', lang('change_password_submit_btn'));?></p>

<?php echo form_close();?>


		<form role="form">
		  <div class="form-group">
		   	 <label for="oldPassword">Old Password</label>
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
	</div>
	<div class="panel-footer"></div>
	</div>

	<div class="panel panel-danger">
			<div class="panel panel-default">
			<div class="panel-heading">
		    <h3 class="panel-title"><?php echo lang('deactivate_heading');?></h3>
		  	</div>
		  <div class="panel-body">
		    <?php echo form_open("auth/deactivate/".$user->id);?>
		
		  <!-- Button trigger modal -->
	  <a data-toggle="modal" href="#deactivate" class="btn btn-danger btn-lg">DELETE ACCOUNT</a>
	
	  <!-- Modal -->
	  <div class="modal fade" id="deactivate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	          <h4 class="modal-title"><?php echo lang('deactivate_heading');?></h4>
	        </div>
	        <div class="modal-body">
	          <p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>
	          	<p>
					<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
					<input type="radio" name="confirm" value="yes" checked="checked" />
				    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
				    <input type="radio" name="confirm" value="no" />
				</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	          <button type="submit" class="btn btn-danger btn-default" name="submit">Submit</button>
	        </div>
	      </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
	  </div><!-- /.modal -->
		
	  <?php echo form_hidden($csrf); ?>
	  <?php echo form_hidden(array('id'=>$user->id)); ?>
			<div class="alert alert-warning">Once you delete your account, there is no going back. Please be certain.</span></div><span class="help-block">
	<?php echo form_close();?>
		  </div>
		  <div class="panel-footer"></div>
		</div>
	</div>
