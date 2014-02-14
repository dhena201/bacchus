<?=form_open(base_url().'orders/create', 'id="newOrderForm"');?>

<?=form_hidden('user_id', $user->id);?>
	
	<div class="form-group">
		<label for="wineInput">Wine</label>
		<?=form_error('wine_id');?>
		<input name="wine_id" type="text" class="form-control" id="wineInput" value="<?=set_value('wine_id')?>">
	</div>
  
	<div class="form-group">
		<label for="locationInput">Location</label>
		<?=form_error('location_id');?>
		<input name="location_id" type="text" class="form-control" id="locationInput" value="<?=set_value('location_id')?>">
	</div>
  
	<div class="form-group">
		<label for="quantityInput">Quantity</label>
		<?=form_error('quantity');?>
		<input name="quantity" type="number" class="form-control" id="quantityInput" value="<?=set_value('quantity')?>">
	</div>
  
	<div class="form-group">
		<label for="datepicker">Expected Date of Delivery</label>
		<?=form_error('estimated_arrival');?>
		<input name="estimated_arrival" type="text" class="form-control datepicker" value="<?=set_value('estimated_arrival')?>">
		<p class="help-block"></p>
	</div>
  
	<div class="form-group">
		<label for="commentsInput">Comments</label>
		<?=form_error('order_comments');?>
		<textarea id="commentsInput" name="order_comments" class="form-control" rows="3"><?=set_value('order_comments')?></textarea>
	</div>
	
	<div class="text-center">
		<button type="submit" class="btn btn-success">Create Order!</button>
	</div>
	
<?=form_close();?>