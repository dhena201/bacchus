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
		  		
  	</style>
  </head>

  <body>

	<?php $this->load->view('includes/user_header'); ?>

    <div class="container">
      <div class="body-content">
        <div class="row">
          <div class="col-lg-8" >
            <h2 style="border-bottom: 1px solid black; padding-bottom: 10px;">Welcome to Bacchus! Your Wine Unity Engine</h2>
            <div class="container">
            	<div class="row">
            		<div class="col-lg-6" style="border: 1px solid black; background: gray; padding: 10px 5px 10px 5px;">
            			<p style="text-align: center; margin-top: 10px;"><a class="btn btn-primary btn-lg btn-block" href="#">Add wine to cellar</a></p>
            		</div>
            		<div class="col-lg-6" style="border: 1px solid black; background: gray; padding: 10px 5px 10px 5px;">
           				<p style="text-align: center; margin-top: 10px;"><a class="btn btn-primary btn-lg btn-block" href="#">Manage orders</a></p>
            		</div>
            	</div>
            </div>
            <div class="container" >
            	<div class="row" >
            		<div class="col-lg-12" style="border: 1px solid black; background: gray; padding: 10px 5px 10px 5px;">
          				<p style="text-align: center; margin-top: 10px;"><a class="btn btn-primary btn-lg btn-block" href="#">View Cellar &raquo;</a></p>
            		</div>
            	</div>
            </div>
          </div>
          <div class="col-lg-4" >
            <h2 style="border-bottom: 1px solid black; padding-bottom: 10px;">Wine Feed</h2>
            <div class="container" >
            	<div class="row">
            		<div class="col-lg-10" style="min-height: 600px; border: 1px solid black; background: gray; margin-left: 10px;">
           				<table class="table .table-striped .table-hover" style="background: white;">
							<tbody>
								<tr><td>2011 Chateauneuf-du-pape is ready to drink!</td></tr>
								<tr><td>2004 Perrier Jouel is running low <a class="btn">reorder</a></td></tr>
								<tr><td>2007 Gavi de Gavi (9) was added to "<a href="#">cellar</a>"</td></tr>
							</tbody>
						</table>
            		</div>
            	</div>
            </div>
         </div>
        <hr>
      </div>
     </div>
    </div> <!-- /container -->
	<?php $this->load->view('includes/footer'); ?>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php echo asset_url().'js/bootstrap.min.js';?>"></script>
  </body>
</html>