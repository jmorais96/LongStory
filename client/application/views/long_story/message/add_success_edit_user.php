<?php //print_r($message);exit;?>
<div class="row">
	<div class="col-lg-12" style="justify-content: center;height: 100px; display: flex; align-items: center" >
		<div class="alert alert-success" style="height: 50px">
			<strong>Success! </strong> User edited
		</div>
	</div>
	<script>
		window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
				$(this).remove();
			});
		}, 4000);
	</script>

</div>
<?php echo form_close()?>

