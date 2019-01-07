<div class="row">
	<div class="col-lg-12">
		<h2> New user's registration</h2>
	</div>
</div>
<?php //print_r($user);?>

<?php echo form_open_multipart("User/editUserValidation", 'role="form" class="form-horizontal"')?>

<div class="row">
	<div class="col-lg-12">
		<?php echo validation_errors(); ?>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('MyIdUser', 'myIdUser', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('myIdUser', set_value(''),"class='form-control'")?>
			</div>
		</div>
	</div>

	<?php $idUser = $user[0]['idUser']?>
	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('IdUser', 'idUser', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('idUser', $idUser, "class='form-control'")?>
			</div>
		</div>
	</div>

	<?php $idProfile = $user[0]['idProfile']?>
	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('IdProfile', 'idProfile', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('idProfile', $idProfile, "class='form-control' placeholder= $idProfile")?>
			</div>
		</div>
	</div>

	<?php $name = $user[0]['name']?>
	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('Name', 'name', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('name', $name, "class='form-control' placeholder= $name")?>
			</div>
		</div>
	</div>

	<?php $pass = $user[0]['pass']?>
	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('Pass', 'pass', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('pass', $pass, "class='form-control' placeholder= $pass")?>
			</div>
		</div>
	</div>

	<?php $birthDate = $user[0]['birthDate']?>
	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('BirthDate', 'birthDate', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('birthDate', $birthDate, "class='form-control' placeholder= $birthDate")?>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<p class="text-center">
			<br>
			<button type="submit" class="btn btn-green" style="width: 100%"> Edit User</button>
		</p>
	</div>
</div>
<?php echo form_close()?>
