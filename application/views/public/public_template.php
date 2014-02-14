<script src="<?php echo asset_url().'js/user/public_validation.js';?>"></script>

<div class="container">
	
	<?php $this->load->view('user/message');?>

	<?php $this->load->view($public_content); ?>
	
</div>
