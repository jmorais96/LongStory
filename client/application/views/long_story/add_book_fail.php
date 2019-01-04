<?php //print_r($message);exit;?>
	<div class="row">
		<div class="col-lg-12">
			<h2> New books's registration</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12" style="justify-content: center;height: 450px; display: flex; align-items: center" >
			<div class="alert alert-danger" style="height: 50px">
				<strong>Erro!</strong> <?php echo $message["message"]; ?><!--Utilizador não é administrador-->
			</div>
		</div>

	</div>
<?php echo form_close()?>
