<nav class="navbar navbar-inverse" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?=base_url().'user'; ?>">Bacchus</a>
    <p class="navbar-text"><?=isset($username) ? "Hello, $username!" : "Welcome to Bacchus";?></p>
  </div>
	
	<div class="collapse navbar-collapse" id="navbar-collapse-1">
	
		<form class="navbar-form navbar-left" role="search">
			<div class="form-group">
		    	<input type="text" class="form-control" placeholder="Search">
		  	</div>
		  	<button type="submit" class="btn btn-default">Submit</button>
		</form>

		<ul class="nav navbar-nav navbar-right">
			 
			<?php if(base_url() == current_url()): // or the default controller or the indices of them ?>
				<li><a href="<?=base_url().'user'?>">Dashboard</a></li>
			<?php endif; ?>
			
			<li><a href="<?php echo base_url().'wines'; ?>">My Wines</a></li>
			
			<li><a href="<?php echo base_url().'orders'; ?>">Orders <span class="badge">2</span></a></li>
			
			<li><a href="<?php echo base_url().'locations'; ?>">Locations</a></li>
			
			<li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
		        <ul class="dropdown-menu">
			        <li><a href="<?php echo base_url().'user/profile'; ?>">View profile</a></li>
			        
			        <li><a href="<?php echo base_url().'user/edit_account'; ?>">Edit account</a></li>
			        
			        <li class="divider"></li>
			        
			        <li><a href="<?php echo base_url().'user/help'; ?>">Help</a></li>
			        
			        <li class="divider"></li>
			        
			        <li><a href="<?php echo base_url().'user/logout'; ?>" >Sign Out</a></li>
		        </ul>
	        </li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>