<div class="container">
	<h1><?=lang('edit_user_heading');?></h1>
	<p><?=lang('edit_user_subheading');?></p>

	<div class="panel panel-default">
		<div class="panel-heading">
	   		<h3 class="panel-title">Edit User Information</h3>
	  	</div>
	  	
		<div class="panel-body">
	    	<?=form_open(uri_string(), 'id="editUserForm"');?>

		    	<div class="form-group">
		       		<?=lang('edit_user_fname_label', 'first_name');?>
		            <?=form_error('first_name');?>
		            <?php echo form_input($first_name);?>
		      	</div>

		      	<div class="form-group">
		            <?=lang('edit_user_lname_label', 'last_name');?>
		            <?=form_error('last_name');?>
		            <?=form_input($last_name);?>
		      	</div>
      
		      	<div class="form-group">
		            <?=lang('edit_user_company_label', 'company');?>
		            <?=form_error('company');?>
		            <?=form_input($company);?>
		     	 </div>

		      	<div class="form-group">
		            <?=lang('edit_user_phone_label', 'phone');?>
		            <?=form_error('phone');?>
		            <?=form_input($phone);?>
		      	</div>

			 	<?=form_hidden('id', $user->id);?>
		      	<?=form_hidden($csrf); ?>
				<?=form_submit('edit_user_submit', lang('edit_user_submit_btn'), 'class="btn btn-success"');?>
			<?=form_close();?>
		</div>
	  
		<div class="panel-heading">
	  		<h3 class="panel-title"><?php echo lang('change_password_heading');?></h3>
	  	</div>
	  
		<div class="panel-body">
		
			<?=form_open("auth/change_password", 'id="editUserPasswordForm"');?>
		
			    <div class="form-group">
			    	<?=lang('change_password_old_password_label', 'old_password');?>
			        <?=form_error('old_password');?>
			        <?=form_input($old_password);?>
			    </div>
		
		      	<div class="form-group">
		            <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label>
		            <?=form_error('new_password');?>
		            <?=form_input($new_password);?>
		      	</div>
		
		      	<div class="form-group">
		            <?=lang('change_password_new_password_confirm_label', 'new_password_confirm');?>
		            <?=form_error('new_password_confirm');?>
		            <?=form_input($new_password_confirm);?>
		      	</div>
		
		      	<?=form_input($user_id);?>
		      	<?=form_submit('change_password_submit', lang('change_password_submit_btn'), 'class="btn btn-success"');?>
			<?=form_close();?>
			<br />
			<a href="<?=base_url()."auth/forgot_password" ?>"><?=lang('login_forgot_password');?></a>
		</div>
	</div>
	
	<div class="panel panel-danger">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h3 class="panel-title"><?=lang('deactivate_heading');?></h3>
		  	</div>
		  	
			<div class="panel-body">
		    	<?=form_open("auth/deactivate/".$user->id);?>
					<!-- Button trigger modal -->
					<a data-toggle="modal" href="#deactivate" class="btn btn-danger btn-lg">DELETE ACCOUNT</a>
				  	<!-- Modal -->
					<div class="modal fade" id="deactivate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				    	<div class="modal-dialog">
				      		<div class="modal-content">
				        		<div class="modal-header">
				          			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				          			<h4 class="modal-title"><?=lang('deactivate_heading');?></h4>
				        		</div>
				        		
				        		<div class="modal-body">
				          			<p><?=sprintf(lang('deactivate_subheading'), $user->username);?></p>
				          			<p>
										<?=lang('deactivate_confirm_y_label', 'confirm');?>
										<input type="radio" name="confirm" value="yes" checked="checked" />
							    		<?=lang('deactivate_confirm_n_label', 'confirm');?>
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
					<?=form_hidden($csrf); ?>
					<?=form_hidden(array('id'=>$user->id)); ?>
					<div class="alert alert-warning"><span class="help-block">Once you delete your account, there is no going back. Please be certain.</span></div>
				<?=form_close();?>
			</div>
		</div>
	</div>
</div>
