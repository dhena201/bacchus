<?=form_open(base_url().'locations/create', 'id="newLocationForm"');?>

<?=form_hidden('user_id', $user->id);?>
	
	<div class="form-group">
		<label for="nameInput">Name</label>
		<?=form_error('name');?>
		<input name="name" type="text" class="form-control" id="nameInput" value="<?=set_value('name')?>" required >
	</div>
  
	<div class="form-group">
		<label for="addressLine1Input">Address Line 1</label>
		<?=form_error('address_line_1');?>
		<input name="address_line_1" type="text" class="form-control" id="addressLine1Input" value="<?=set_value('address_line_1')?>" required placeholder="Street address, P.O. box, company name, c/o">
	</div>
  
  	<div class="form-group">
		<label for="addressLine2Input">Address Line 2</label>
		<?=form_error('address_line_2');?>
		<input name="address_line_2" type="text" class="form-control" id="addressLine2Input" value="<?=set_value('address_line_2')?>" placeholder="Apartment, suite, unit, building, floor, etc.">
	</div>
  	
  	<div class="form-group">
		<label for="cityInput">City</label>
		<?=form_error('city');?>
		<input name="city" type="text" class="form-control" id="cityInput" value="<?=set_value('city')?>">
	</div>
  	
  	<div class="form-group">
		<label for="stateProvinceRegionInput">State/Province/Region</label>
		<?=form_error('state_province_region');?>
		<input name="state_province_region" type="text" class="form-control" id="stateProvinceRegionInput" value="<?=set_value('state_province_region')?>">
	</div>
  	
  	<div class="form-group">
		<label for="postalCodeInput">Postal Code</label>
		<?=form_error('postal_code');?>
		<input name="postal_code" type="text" class="form-control" id="postalCodeInput" value="<?=set_value('postal_code')?>">
	</div>
  	
  	<div class="form-group">
		<label for="countryInput">Country</label>
		<?=form_error('country');?>
		<?=form_dropdown('country', $country_list, 'US', 'class="form-control" id="countryInput"');?>
	</div>
  	
	<div class="form-group">
		<label for="commentsInput">Comments</label>
		<?=form_error('location_comments');?>
		<textarea id="commentsInput" name="location_comments" class="form-control" rows="3"><?=set_value('location_comments')?></textarea>
	</div>
	
	<div class="text-center">
		<button type="submit" class="btn btn-success">Create Location!</button>
	</div>

<?=form_close();?>