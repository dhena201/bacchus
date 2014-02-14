<?php
if (!empty($locations)): ?>
  	<div class="input-group-lg">
		<input type="text" class="form-control" placeholder="Search locations" />
	</div>
	<br />
	<?=$this->pagination->create_links()?>
	<table class="table table-striped table-hover">
		<theader>
			<tr>
				<td>Name</td>
				<td>Address</td>
				<td>City</td>
				<td>State/Province/Region</td>
				<td>Postal Code</td>
				<td>Country</td>
				<td>Comments</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="checkbox" id="select_all"> Select all</td>
			</tr>
		</theader>
		<tbody> 
			<?php
			foreach ($records as $location):
				$location_comments = strlen($location->location_comments) <= 25 ? $location->location_comments : substr($location->location_comments, 0, 25). '...'; ?>
				<tr>
					<td><?=$location->name?></td>
					<td><?=$location->address_line_1?> <?=$location->address_line_2?></td>
					<td><?=$location->city?></td>
					<td><?=$location->state_province_region?></td>
					<td><?=$location->postal_code?></td>
					<td><?=$location->country_name?></td>
					<td><?=$location_comments?></td>
					<td class='edit'><a href='<?=$base_url?>/edit/<?=$location->id?>'><button type='button' class='edit_button btn btn-default btn-sm'>Edit</button></a></td>
					<td class='view'><a href='<?=$base_url?>/view/<?=$location->id?>'><button type='button' class='view_button btn btn-info btn-sm'>View</button></a></td>
					<td><a data-toggle='modal' href='#deleteLocation'><button type='button' class='delete_button btn btn-default btn-sm btn-warning'> X </button></a></td>
					<td class='select'><div class='checkbox'><label><input type='checkbox' name='location_id[]' value='<?=$location->id?>'></label></div></td>
				</tr>
			<?php 
			endforeach; ?>
		</tbody>
	</table> 
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

	<?=$this->pagination->create_links();?>
	
<?php
else: ?>
	<?="No records. Please create a location where you will keep your wines";?>
<?php
endif; ?>
