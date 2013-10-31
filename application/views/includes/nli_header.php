<?php echo doctype('html5'); ?>
<div class="navbar navbar-fixed-top navbar-inverse">
  <div class="container">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo base_url(); ?>">Bacchus</a>
    <p class="navbar-text">Welcome to Bacchus!</p>
	<div class="nav-collapse collapse navbar-responsive-collapse">
		<form class="navbar-form pull-left">
		  <input type="text" class="form-control" style="width: 200px;">
		  <button type="submit" class="btn btn-default">Search!</button>
		</form>
 		<ul class="nav navbar-nav pull-right">
		  <li><a href='<?php echo base_url()."app/login" ?>'>Sign In</a></li>
		  <li><a href='<?php echo base_url()."app/signup" ?>'>Create Account</a></li>
		  <li><a href='#'>Wine</a></li>
		 <!--  <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Wine<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Browse Wines</a></li>
            <li><a href="#">Popular Wines</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li class="dropdown-header">Nav header</li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
    </li> -->
		</ul>
	</div><!-- /.nav-collapse -->
  </div>
</div>