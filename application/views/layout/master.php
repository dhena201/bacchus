<?=doctype('html5');?>
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="description" content="">
    	<meta name="author" content="">

    	<title><?php echo isset($title) ? "Bacchus - $title" : NULL; ?></title>
    
		 <!-- jQuery -->
		<script src="http://code.jquery.com/jquery.js"></script>
		
		<!-- Bootstrap core JS -->
	    <script src="<?php echo asset_url().'js/bootstrap.min.js';?>"></script>
	
	    <!-- Bootstrap core CSS -->
	    <link href="<?php echo asset_url().'css/bootstrap.css';?>" rel="stylesheet" type="text/css" />
	    
	    <!-- jQuery UI -->
	    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	    
	    <!-- bootstrapValidation -->
		<script type="text/javascript" src="<?php echo asset_url().'js/bootstrapValidation.js';?>"></script>
		<style>
			.bootstrap-validator-form .help-block {
			    margin-bottom: 0;
			}			
		</style>
		
	    <!-- Custom styles for this template -->
	  	<style>
	  		/* Move down content because we have a fixed navbar that is 50px tall */
			body {
			  padding-top: 70px;
			  padding-bottom: 20px;
			}
			
			/* Wrapping element */
			/* Set some basic padding to keep content from hitting the edges */
			.body-content {
			  padding-left: 15px;
			  padding-right: 15px;
			}
			  		
	  	</style>
	</head>
  
	<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
		<div class="container" style="border: 0;">
			<?php $this->load->view($navigation); ?>
		</div>
	</div>
	
	<body>
	
	<?php
		$this->load->view($content);
		$this->load->view('layout/footer');
	?>