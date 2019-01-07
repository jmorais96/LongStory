<?php //print_r($message);exit;?>
<div class="row">
	<div class="col-lg-12">
		<h2> New user's registration</h2>
	</div>
</div>
<div class="row">
	<div class="col-lg-12" style="justify-content: center;height: 450px; display: flex; align-items: center" >
		<div class="alert alert-success" style="height: 50px">
			<strong>Success!</strong> <?php echo $message["message"]; ?>
		</div>
		<br>
		&nbsp&nbsp
		<p><a>Return to the read books list </a><a href="<?php echo site_url("book/getread/".$message["id"]); ?>" class="greenLink">here</a></p>
	</div>
</div>
