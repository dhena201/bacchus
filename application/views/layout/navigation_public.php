<nav class="navbar navbar-inverse" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo base_url();?>">Bacchus</a>
    <p class="navbar-text">Welcome to Bacchus</p>
  </div>

	<div class="collapse navbar-collapse" id="navbar-collapse-1">
	
		<form class="navbar-form navbar-left" role="search">
			<div class="form-group">
		    	<input type="text" class="form-control" placeholder="Search">
		  	</div>
		  	<button type="submit" class="btn btn-default">Submit</button>
		</form>

		<ul class="nav navbar-nav navbar-right">
			<li><a href="<?=base_url().'auth/login'; ?>">Sign In</a></li>
			<li><a href="<?=base_url().'registration'; ?>">Create Account</a></li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>