	<div class="col-sm-3">
		<div class="col-sm" style="float: left;">
			<?php file_put_contents(FCPATH . "upload/notFound.jpg" , base64_decode($image)); ?>
			<img src="<?php echo base_url('upload/notFound.jpg'); ?>" class="img-fluid" style="height: 300px">
		</div>

	</div>
	<div class="col-sm-9" style="float: right">
		<table class="table">
			<tr>
				<th>Name</th>
				<td><?php echo $name;?></td>
			</tr>

			<tr>
				<th>Author</th>
				<td><?php echo $author;?></td>
			</tr>

			<tr>
				<th>Description</th>
				<td><?php echo $description;?></td>
			</tr>

			<tr>
				<th>ISBN</th>
				<td><?php echo $ISBN;?></td>
			</tr>

			<tr>
				<th>Rating</th>
				<td><?php echo $rating;?></td>
			</tr>

		</table>
	</div>