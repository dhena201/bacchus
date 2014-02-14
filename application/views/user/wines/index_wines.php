<?php
if (!empty($wines)): ?>
  	<div class="input-group-lg">
		<input type="text" class="form-control" placeholder="Search wines" />
	</div>
	<br />
	<?=$this->pagination->create_links()?>
	<table class="table table-striped table-hover">
		<theader>
			<tr>
				<td>Name</td>
				<td>Vintage</td>
				<td>Type</td>
				<td>Country</td>
				<td>Region</td>
				<td>Producer</td>
				<td>Comments</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="checkbox" id="select_all"> Select all</td>
			</tr>
		</theader>
		<tbody> 
			<?php
			foreach ($records as $wine):
				$wine_comments = strlen($wine->wine_comments) <= 25 ? $wine->wine_comments : substr($wine->wine_comments, 0, 25). '...'; ?>
				<tr>
					<td>name</td>
					<td>vintage</td>
					<td>type</td>
					<td>country</td>
					<td>region</td>
					<td>producer</td>
					<td><?=$wine_comments?></td>
					<td class='edit'><a href='<?=$base_url?>/edit/<?=$wine->id?>'><button type='button' class='edit_button btn btn-default btn-sm'>Edit</button></a></td>
					<td class='view'><a href='<?=$base_url?>/view/<?=$wine->id?>'><button type='button' class='view_button btn btn-info btn-sm'>View</button></a></td>
					<td><a data-toggle='modal' href='#deleteWine'><button type='button' class='delete_button btn btn-default btn-sm btn-warning'> X </button></a></td>
					<td class='select'><div class='checkbox'><label><input type='checkbox' name='wine_id[]' value='<?=$wine->id?>'></label></div></td>
				</tr>
			<?php 
			endforeach; ?>
		</tbody>
	</table> 
	<?php $delete_attributes = array('id' => 'delete_action_form'); ?>
	<?=form_open("wines/delete", $delete_attributes);?>
	<?=form_hidden('user_id', $user->id);?>
		<div class='modal fade' id='deleteWine' tabindex='-1' role='dialog' aria-labelledby='deleteWineLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
						<h4 class='modal-title'>Delete wine</h4>
					</div>
					<div class='modal-body'>
						<p>Are you sure you want to delete the wine?</p>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
						<button type='submit' class='btn btn-danger' name='submit'>Delete</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	<?=form_close();?>

	<?=$this->pagination->create_links();?>
	
<?php
else: ?>
	<?="No records. create some wines";?>
<?php
endif; ?>
