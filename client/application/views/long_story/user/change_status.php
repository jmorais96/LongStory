<?php echo form_open_multipart("User/changeUserStatusValidation", 'role="form" class="form-horizontal"')?>

<div class="row">
	<div class="col-lg-12">
		<?php echo validation_errors(); ?>
	</div>
</div>

<h2 style=color:grey;> Change Status</h2>
<div class="row">
	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('MyidUser', 'myIdUser', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('myIdUser', set_value('myIdUser'), 'class="form-control"')?>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="form-group row">
			<?php echo form_label('IdUser', 'idUser', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('idUser', set_value('idUser'), 'class="form-control"')?>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<p class="text-center">
			<br>
			<button type="submit" class="btn btn-green" style="width: 100%"> Change Status</button>
		</p>
	</div>
</div>
<?php echo form_close()?>

