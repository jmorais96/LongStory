<?php echo form_open_multipart("Book/addBookValidation", 'role="form" class="form-horizontal"')?>

<div class="row">
	<div class="col-lg-12">
		<?php echo validation_errors(); ?>
	</div>
</div>

<h2 style=color:grey;> New book</h2>
<div class="row">
	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('Name', 'name', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('name', set_value('name'), 'class="form-control"')?>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('Author', 'author', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('author', set_value('author'), 'class="form-control"')?>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('Description', 'description', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('description', set_value('description'), 'class="form-control"')?>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('ISBN', 'ISBN', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('ISBN', set_value('description'), 'class="form-control"')?>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="form-group row">
			<?php $name="image"; ?>
			<?php echo form_label('Image', $name, array('class' => 'col-lg-12 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_upload($name, set_value($name), 'class="form-control" id = "'. $name .'" placeholder="Image')?>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('IdGender', 'idGender', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('idGender', set_value('idGender'), 'class="form-control"')?>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('IdRegister', 'idRegister', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('idRegister', set_value('idRegister'), 'class="form-control"')?>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<p class="text-center">
			<br>
			<button type="submit" class="btn btn-green" style="width: 100%"> Add Book</button>
		</p>
	</div>
</div>
</div>
</div>
<?php echo form_close()?>

