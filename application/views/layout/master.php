<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo isset($title) ? "Bacchus - $title" : NULL; ?></title>
	<script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php echo asset_url().'js/bootstrap.min.js';?>"></script>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo asset_url().'css/bootstrap.css';?>" rel="stylesheet" type="text/css" />
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
<div class="navbar navbar-fixed-top navbar-inverse">
  <div class="container">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo base_url().'user'; ?>">Bacchus</a>
    <p class="navbar-text"><?php echo isset($username) ? "Hello, $username!" : "Welcome to Bacchus";?></p>
	<div class="nav-collapse collapse navbar-responsive-collapse">
		<form class="navbar-form pull-left">
		  <input type="text" class="form-control" style="width: 200px;">
		  <button type="submit" class="btn btn-default">Search!</button>
		</form>
 		<ul class="nav navbar-nav pull-right">
		  <li><a href="<?php echo base_url().'user/cellar'; ?>">My Wines</a></li>
		  <li><a href="<?php echo base_url().'user/orders'; ?>">Orders <span class="badge">2</span></a></li>
		  <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url().'user/profile'; ?>">View profile</a></li>
            <li><a href="<?php echo base_url().'user/edit_account'; ?>">Edit account settings</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url().'user/help'; ?>">Help</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url().'user/logout'; ?>" >Sign Out</a></li>
          </ul>
        </li>
		</ul>
	</div>
  </div>
</div>
<?php
	$this->load->view($content);
	$this->load->view('layout/footer');
?>