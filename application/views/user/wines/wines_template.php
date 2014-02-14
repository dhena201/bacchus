<script src="<?php echo asset_url().'js/user/wines.js';?>"></script>
<script src="<?php echo asset_url().'js/user/wines_validation.js';?>"></script>

<div class="container">
	
	<?php $this->load->view('user/message');?>
		
	<div class="btn-group btn-group-justified">
		<a href="<?=base_url()?>wines/index" class="btn btn-primary<?php if($index_active){echo ' active';}?>" role="button">View Wines</a>
		<a href="<?=base_url()?>wines/create" class="btn btn-primary<?php if($create_active){echo ' active';}?>" role="button">Create Wine</a>
		<a href="<?=base_url()?>wines/preferences" class="btn btn-primary<?php if($preferences_active){echo ' active';}?>" role="button">Wine Preferences</a>
	</div>
	<br />
	<?php $this->load->view($wine_content); ?>
</div>
