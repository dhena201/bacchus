<script src="<?php echo asset_url().'js/user/locations.js';?>"></script>
<script src="<?php echo asset_url().'js/user/locations_validation.js';?>"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD_nQoWgmCAIBwc-f90wfs4E_68njjgibY&sensor=false"></script> <!-- load this for google maps api -->

<div class="container">
	
	<?php $this->load->view('user/message');?>
		
	<div class="btn-group btn-group-justified">
		<a href="<?=base_url()?>locations/index" class="btn btn-primary<?php if($index_active) { echo ' active';}?>" role="button">View Locations</a>
		<a href="<?=base_url()?>locations/create" class="btn btn-primary<?php if($create_active) { echo ' active';}?>" role="button">Create Location</a>
		<a href="<?=base_url()?>locations/preferences" class="btn btn-primary<?php if($preferences_active) { echo ' active';}?>" role="button">Location Preferences</a>
	</div>
	<br />
	<?php $this->load->view($location_content); ?>
</div>
