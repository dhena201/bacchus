<div id="infoMessage">
	<?php 
	$message = $this->session->flashdata('message');
	$alert = $this->session->flashdata('alert-message');
	
	if($alert == 'success'): ?>
	
	<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<?=$message;?>
	</div>
	
	<?php elseif ( $alert == 'failure'): ?>
		
	<div class='alert alert-danger alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<?=$message;?>
	</div>
	
	<?php elseif ( $alert == NULL): ?>
		
	<div class='text-center'>
		<?=$message;?>
	</div>
	
	<?php endif; ?>
</div>
<script>
	$('.alert').fadeOut(10000);
</script>