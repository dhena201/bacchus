<script>
	$(document).ready( function() {
	
		$("#feed").prepend("<tr><td><em>Loading...</em></td></tr>");
		var url = '<?=base_url().'notifications/get_num_order_notifications';?>';
		
		$.get(url, function(data) {
			console.log(data);
		});
		// every X seconds check if there are any new things to add to feed
		// if not nothing changes
		// if a notification is new and not seen before make it a diff. color
		// sort of like the STEAM audio mapping js file
});
</script>

<div class="body-content">
	<div class="row">
    	<div class="col-lg-8" >
        	<h2 style="border-bottom: 1px solid black; padding-bottom: 10px;">Welcome to Bacchus! <small>Your Wine Unity Engine</small></h2>
    	
	    	<div class="row">
	    		<div class="col-lg-6" style="border: 1px solid black; background: gray; padding: 10px 5px 10px 5px;">
	    			<p style="text-align: center; margin-top: 10px;"><a class="btn btn-primary btn-lg btn-block" href="#">Add wine to cellar</a></p>
	    		</div>
	    		<div class="col-lg-6" style="border: 1px solid black; background: gray; padding: 10px 5px 10px 5px;">
	   				<p style="text-align: center; margin-top: 10px;"><a class="btn btn-primary btn-lg btn-block" href="<?php echo base_url().'orders'; ?>">Manage orders</a></p>
	    		</div>
	        </div>
        
	    	<div class="row" >
	    		<div class="col-lg-12" style="border: 1px solid black; background: gray; padding: 100px 5px 100px 5px;">
	  				<p style="text-align: center; margin-top: 10px;"><a class="btn btn-primary btn-lg btn-block" href="#">View Cellar &raquo;</a></p>
	    		</div>
	    	</div>

  		</div>
      
		<div class="col-lg-4" >
			<!--<div class="col-lg-10" style="min-height: 600px; border: 1px solid black; background: gray; margin-left: 10px;">-->
				<table class="table .table-striped .table-hover"  style="min-height: 600px; border: 1px solid black; background: gray; margin: 10px 0 0 10px;">
					<tbody id="feed">

					</tbody>
				</table>
			<!--</div>-->
		</div>
	</div>
</div>