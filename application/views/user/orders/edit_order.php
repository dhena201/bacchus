<?php 
if (!empty($orders)):

	$order_ids = '';
	
	foreach($orders as $order){
		$order_ids .= '/'.$order->id;
	}
?>
	<?=validation_errors();?>
	<?=form_open(base_url()."orders/edit$order_ids");?>
	<?=form_hidden('user_id', $user->id);?>
	
	<table class="table table-striped table-hover">
		<theader>
			<tr>
				<td>Wine</td>
				<td>Location</td>
				<td>Quantity</td>
				<td>Delivery Date</td>
				<td>Comments</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="checkbox" id="select_all"> Select all</td>
			</tr>
		</theader>
		<tbody>
			<?php
			foreach ($orders as $order): // should I be doing this?
				$estimated_arrival = ($order->estimated_arrival['value'] == '0000-00-00' ?  NULL : $order->estimated_arrival['value']); ?>
				<tr>
					<td><input name='wine_id[]' class='form-control' id='wineInput' value='<?=$order->wine_id['value']?>'></td>
					<td><input name='location_id[]' class='form-control' id='locationInput' value='<?=$order->location_id['value']?>'></td>
					<td><input name='quantity[]' type='number' class='form-control' id='quantityInput' value='<?=$order->quantity['value']?>'></td>
					<td><input name='estimated_arrival[]' type='text' class='form-control datepicker' value='<?=$estimated_arrival?>'></td>
					<td><textarea id='commentsInput' name='order_comments[]' class='form-control' rows='3'><?=$order->order_comments['value']?></textarea></td>
					<td><a data-toggle='modal' href='#addOrder'><button type='button' class='add_button btn btn-default btn-sm btn-success'>Add</button></a></td>
					<td class='view'><a href='<?=$base_url?>/view/<?=$order->id?>'><button type='button' class='view_button btn btn-info btn-sm'>View</button></a></td>
					<td><a data-toggle='modal' href='#deleteOrder'><button type='button' class='delete_button btn btn-default btn-sm btn-warning'> X </button></a></td>
					<td class='select'><div class='checkbox'><label><input type='checkbox' name='order_id[]' value='<?=$order->id?>'></label></div></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	
	<div class="text-center">
		<button type="submit" class="btn btn-success">Update!</button>
	</div>
	
	<?=form_close();?>
	
	<?php $delete_attributes = array('id' => 'delete_action_form'); ?>
	<?=form_open("orders/delete", $delete_attributes);?>
	<?=form_hidden('user_id', $user->id);?>
		<div class='modal fade' id='deleteOrder' tabindex='-1' role='dialog' aria-labelledby='deleteOrderLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
						<h4 class='modal-title'>Delete Order</h4>
					</div>
					<div class='modal-body'>
						<p>Are you sure you want to delete the order?</p>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
						<button type='submit' class='btn btn-danger' name='submit'>Delete</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	<?=form_close();?>
		
	<?php $add_attributes = array('id' => 'add_action_form'); ?>
	<?=form_open("orders/add", $add_attributes);?>
	<?=form_hidden('user_id', $user->id);?>
		<div class='modal fade' id='addOrder' tabindex='-1' role='dialog' aria-labelledby='addOrderLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
						<h4 class='modal-title'>Add Order</h4>
					</div>
					<div class='modal-body'>
						<p>Are you sure you want to add the order?</p>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
						<button type='submit' class='btn btn-success' name='submit'>Add</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	<?=form_close();?>
<?php 
else: 
?>
	<?='nothing to edit';?>
<?php 
endif;
?>