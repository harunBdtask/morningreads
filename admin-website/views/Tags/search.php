
	<?php require_once '../../src/model.php'; 
	$find = $_POST['find'];
	$Tags->find = $find;
	$records = $Tags->search();
	if(!empty($records)) { ?>
		<table class="table table-bordered">
			<tr class="">
				<th>#</th>				
				<th>Tags Name</th>					
				<th class="text-center">Action</th>
			</tr>
			<?php foreach ($records as $record) { ?>
				<tr class="">
					<td><?php echo $record->id; ?></td>
					<td><?php echo $record->title; ?></td>
					<td class="text-center">
						<a href="index.php?page=Tags_update&id=<?php echo $record->id; ?>"><span class="glyphicon glyphicon-edit"></span></a>
						<a href="index.php?page=Tags_delete&id=<?php echo $record->id; ?>"><span class="glyphicon glyphicon-remove-circle"></span></a>
					</td>
				</tr>
			<?php } ?>
		</table>
	<?php } else { ?>
		<div class="alert alert-info">No Record Found.</div>
	<?php }
     ?>
