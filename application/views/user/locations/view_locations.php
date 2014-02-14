<script>
	var myCenter = new google.maps.LatLng(parseFloat(<?=$location->lat; ?>), parseFloat(<?=$location->lon; ?>));
	function initialize() {
		var mapOptions = {
			center: myCenter,
			zoom: 6, 
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		
		var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
		var marker = new google.maps.Marker({
			position: myCenter,
			map: map, 
			title: '<?=$location->name;?>',
			optimized: false
		});
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php
if (!empty($location)): ?>
	<br />
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
				<td><input type="checkbox" id="select_all"> Select all</td>
			</tr>
		</theader>
		<tbody> 
			<tr>
				<td><?=$location->name?></td>
				<td><?=$location->address_line_1?> <?=$location->address_line_2?></td>
				<td><?=$location->city?></td>
				<td><?=$location->state_province_region?></td>
				<td><?=$location->postal_code?></td>
				<td><?=$location->country_name?></td>
				<td><?=$location->location_comments?></td>
				<td class='edit'><a href='<?=$base_url?>/edit/<?=$location->id?>'><button type='button' class='edit_button btn btn-default btn-sm'>Edit</button></a></td>
				<td><a data-toggle='modal' href='#deleteLocation'><button type='button' class='delete_button btn btn-default btn-sm btn-warning'> X </button></a></td>
				<td class='select'><div class='checkbox'><label><input type='checkbox' name='location_id[]' value='<?=$location->id?>'></label></div></td>
			</tr>
		</tbody>
	</table> 
	<div id="googleMap" style="width: 500px; height: 400px; margin: 0 auto;"></div>
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
else: ?>
	<?="No records. Please create a location where you will keep your wines";?>
<?php
endif; ?>