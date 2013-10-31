<?php echo doctype('html5'); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bacchus</title>

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

		/* Responsive: Portrait tablets and up */
		@media screen and (min-width: 768px) {
		  /* Let the jumbotron breathe */
		  .jumbotron {
		    margin-top: 20px;
		  }
		  /* Remove padding from wrapping element since we kick in the grid classes here */
		  .body-content {
		    padding: 0;
		  }
		}		
  	</style>
  </head>

  <body>

    <div class="container">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Welcome!</h1>
        <p>Bacchus has the largest collection of wine reviews, tasting notes and personal stories from people who love wine.</p>
        <p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
      </div>
      <div class="body-content">
        <div class="row">
          <div class="col-lg-4">
            <h2>People</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
          </div>
          <div class="col-lg-4">
            <h2>Discussion</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
         </div>
          <div class="col-lg-4">
            <h2>Articles</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
          </div>
        </div>
      </div>
    </div> <!-- /container -->
	<?php $this->load->view('includes/footer'); ?>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php echo asset_url().'js/bootstrap.min.js';?>"></script>
  </body>
</html>