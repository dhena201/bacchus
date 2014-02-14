<?php 
if (!empty($locations)):

	$location_ids = '';
	
	foreach($locations as $location){
		$location_ids .= '/'.$location->id;
	}
?>
	<?=validation_errors();?>
	<?=form_open(base_url()."locations/edit$location_ids");?>
	<?=form_hidden('user_id', $user->id);?>
	
	<table class="table table-striped table-hover">
		<theader>
			<tr>
				<td>Name</td>
				<td>Address Line 1</td>
				<td>Address Line 2</td>
				<td>City</td>
				<td>State/Province/Region</td>
				<td>Postal Code</td>
				<td>Country</td>
				<td>Comments</td>
				<td></td>
				<td></td>
				<td><input type="checkbox" id="select_all"> Select all</td>
			</tr>
		</theader>
		<tbody>
			<?php
			foreach ($locations as $location): ?>
				<tr>
					<td><input name='name[]' class='form-control' id='nameInput' value='<?=$location->name['value']?>'></td>
					<td><input name='address_line_1[]' class='form-control' id='addressLine1Input' value='<?=$location->address_line_1['value']?>'></td>
					<td><input name='address_line_2[]' class='form-control' id='addressLine2Input' value='<?=$location->address_line_2['value']?>'></td>
					<td><input name='city[]' class='form-control' id='cityInput' value='<?=$location->city['value']?>'></td>
					<td><input name='state_province_region[]' class='form-control' id='stateProvinceRegionInput' value='<?=$location->state_province_region['value']?>'></td>
					<td><input name='postal_code[]' class='form-control' id='postalCodeInput' value='<?=$location->postal_code['value']?>'></td>
					<td><?=form_dropdown('country[]', $country_list, $location->country['value'], 'class="form-control" id="countryInput"');?></td>
					<td><textarea id='commentsInput' name='location_comments[]' class='form-control' rows='3'><?=$location->location_comments['value']?></textarea></td>
					<td class='view'><a href='<?=$base_url?>/view/<?=$location->id?>'><button type='button' class='view_button btn btn-info btn-sm'>View</button></a></td>
					<td><a data-toggle='modal' href='#deleteLocation'><button type='button' class='delete_button btn btn-default btn-sm btn-warning'> X </button></a></td>
					<td class='select'><div class='checkbox'><label><input type='checkbox' name='location_id[]' value='<?=$location->id?>'></label></div></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	
	<div class="text-center">
		<button type="submit" class="btn btn-success">Update!</button>
	</div>
	
	<?=form_close();?>
	
	<?php $delete_attributes = array('id' => 'delete_action_form'); ?>
	<?=form_open("locations/delete", $delete_attributes);?>
	<?=form_hidden('user_id', $user->id);?>
		<div class='modal fade' id='deleteLocation' tabindex='-1' role='dialog' aria-labelledby='deleteLocationLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
						<h4 class='modal-title'>Delete location</h4>
					</div>
					<div class='modal-body'>
						<p>Are you sure you want to delete the location?</p>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
						<button type='submit' class='btn btn-danger' name='submit'>Delete</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	<?=form_close();?>
<?php 
else: 
?>
	<?='nothing to edit';?>
<?php 
endif;
?>