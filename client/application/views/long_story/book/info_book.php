	<div class="col-sm-4">
		<div class="col-sm" style="float: left;">
			<?php file_put_contents(FCPATH . "upload/notFound.jpg" , base64_decode($image)); ?>
			<img src="<?php echo base_url('upload/notFound.jpg'); ?>" class="img-fluid" style=" object-fit: cover; width: 330px; height: 530px;">
		</div>

	</div>
	<div class="col-sm-8" style="float: right">
		<table class="table">
			<tr>
				<th>Name</th>
				<td><?php echo $name =str_replace('%20', ' ', $name);?></td>
			</tr>

			<tr>
				<th>Author</th>
				<td><?php echo $author = str_replace('%20', ' ', $author);;?></td>
			</tr>

			<tr>
				<th>Description</th>
				<td><?php echo $description = str_replace('%20', ' ', $description);?></td>
			</tr>

			<tr>
				<th>ISBN</th>
				<td><?php echo $ISBN;?></td>
			</tr>

			<tr>
				<th>Gender</th>
				<td><?php echo $gender; ?></td>
			</tr>

			<tr>
				<th>State</th>
				<td><?php
					if($idStatusBook == 1){
						echo "Approved";
					} else if ($idStatusBook == 2) {
						echo "Reproved";
					} else {
						echo "Pending";
					}
					?></td>
			</tr>

			<tr>
				<th>Rating</th>
				<td><?php echo $rating;?></td>
			</tr>

		</table>

		<!-- ADD RATING FORM -->
		<?php echo form_open_multipart("Book/rateBookValidation", 'role="form" class="form-horizontal"')?>
		<div class="row">
			<div class="col-lg-2">
				<?php echo validation_errors(); ?>
			</div>
		</div>
		<h3 class="col-lg-12" style=color:grey;> Add rating to this book</h3>
		<div class="row">
			<div class="col-lg-2">
				<div class="form-group row">
					<?php echo form_label('MyIdUser', 'myIdUser', array('class' => 'col-lg-3 control-label'))?>
					<div class="col-lg-12">
						<?php echo form_input('myIdUser', set_value('myIdUser'), 'class="form-control"')?>
					</div>
				</div>
			</div>

			<div class="col-lg-2">
				<div class="form-group row">
					<?php echo form_label('IdBook', 'idBook', array('class' => 'col-lg-3 control-label'))?>
					<div class="col-lg-12">
						<?php echo form_input('idBook', set_value('idBook'), 'class="form-control"')?>
					</div>
				</div>
			</div>

			<div class="col-lg-2">
				<div class="form-group row">
					<?php echo form_label('Rating', 'rating', array('class' => 'col-lg-3 control-label'))?>
					<div class="col-lg-12">
						<?php echo form_input('rating', set_value('rating'), 'class="form-control"')?>
					</div>
				</div>
			</div>

			<div class="col-lg-6">
				<p class="text-center">
					<br>
					<button type="submit" class="btn btn-green" style="width: 100%"> Add rating</button>
				</p>
			</div>
		</div>
		<?php echo form_close()?>
		<div class="col-lg-12">
			<p class="text-center">
				<a class="col-lg-12 btn btn-green" href="<?php echo site_url("book/editbookform/".$idBook); ?>">Edit book</a>
			</p>
			<br>
		</div>
		<!-- END ADD RATING FORM -->
	</div>
