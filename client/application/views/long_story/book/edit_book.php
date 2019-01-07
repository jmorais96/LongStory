<div class="row">
	<div class="col-lg-12">
		<h2> Edit book's registration</h2>
	</div>
</div>
<?php print_r($book);?>

<?php echo form_open_multipart("Book/editBookValidation", 'role="form" class="form-horizontal"')?>

<div class="row">
	<div class="col-lg-12">
		<?php echo validation_errors(); ?>
	</div>
</div>

<div class="row">
	<?php $idBook = $book[0]['idBook']?>
	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('IdBook', 'idBook', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('idBook', $idBook, "class='form-control'")?>
			</div>
		</div>
	</div>

	<?php $name = $book[0]['name']; $name =str_replace('%20', ' ', $name);?>
	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('Name', 'name', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('name', $name, "class='form-control' placeholder= $name")?>
			</div>
		</div>
	</div>

	<?php $author = $book[0]['name']; $author =str_replace('%20', ' ', $author);?>
	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('Author', 'author', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('author', $author, "class='form-control' placeholder= $author")?>
			</div>
		</div>
	</div>

	<?php $description = $book[0]['description']; $description = str_replace('%20', ' ', $description);?>
	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('Description', 'description', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('description', $description, "class='form-control' placeholder= $description")?>
			</div>
		</div>
	</div>

	<?php $idStatusBook = $book[0]['idStatusBook']; $description =str_replace('%20', ' ', $description);?>
	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('IdStatusBook', 'idStatusBook', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('idStatusBook', $idStatusBook, "class='form-control' placeholder= $idStatusBook")?>
			</div>
		</div>
	</div>

	<?php $idAprover= $book[0]['idAprover']?>
	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('IdAprover', 'idAprover', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('idAprover', $idAprover, "class='form-control'")?>
			</div>
		</div>
	</div>

	<?php $gender= $book[0]['gender'];?>
	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('Gender', 'gender', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('gender', $gender, "class='form-control' placeholder= $gender")?>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="form-group row">
			<?php $image="image"; ?>
			<?php echo form_label('Image', $image, array('class' => 'col-lg-12 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_upload($image, set_value($image), 'class="form-control" id = "'. $image .'" placeholder="Image')?>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<p class="text-center">
			<br>
			<button type="submit" class="btn btn-green" style="width: 100%"> Edit Book</button>
		</p>
	</div>
</div>

<?php echo form_close()?>
</div>
</div>
