<script src="<?php echo asset_url().'js/user/orders.js';?>"></script>
<script src="<?php echo asset_url().'js/user/orders_validation.js';?>"></script>

<div class="container">
	
	<?php $this->load->view('user/message');?>
		
	<div class="btn-group btn-group-justified">
		<a href="<?=base_url()?>orders/index" class="btn btn-primary<?php if($index_active){echo ' active';}?>" role="button">View Orders</a>
		<a href="<?=base_url()?>orders/create" class="btn btn-primary<?php if($create_active){echo ' active';}?>" role="button">Create Order</a>
		<a href="<?=base_url()?>orders/preferences" class="btn btn-primary<?php if($preferences_active){echo ' active';}?>" role="button">Order Preferences</a>
	</div>
	<br />
	<?php $this->load->view($order_content); ?>
</div>
