<body>

<!-- Start menu section -->
<section id="menu-area">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav" style="width: 100%; justify-content: space-between;">
				<!-- LOGO -->
				<div class="row">
				<a class="footer-logo" href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/images/logo.jpg');?>" alt="Logo"></a>
				<a class="nav-item nav-link active" href="<?php echo site_url("user/"); ?>">Home <span class="sr-only">(current)</span></a>
				<a class="nav-item nav-link" href="<?php echo site_url("user/getuserbooks"); ?>">Books</a>
				<a class="nav-item nav-link" href="<?php echo site_url("user/getuser"); ?>">Users</a>
				</div>
				<!-- SEARCH -->
				<div class="col-lg-6">
				<?php echo form_open_multipart("Book/searchBook", 'role="form" class="form-horizontal"')?>
					<div class="row">
						<div class="col-lg-2" style="padding: 2px;">
									<?php echo form_input('name', set_value('name'), 'class="form-control" placeholder="Name"')?>
						</div>
						<div class="col-lg-2" style="padding: 2px;">
									<?php echo form_input('author', set_value('author'), 'class="form-control"  placeholder="Author"')?>
						</div>
						<div class="col-lg-2"style="padding: 2px;">
									<?php echo form_input('ISBN', set_value('ISBN'), 'class="form-control"  placeholder="ISBN"')?>
						</div>
						<div class="col-lg-2"style="padding: 2px;">
							<p class="text-center">
								<button type="submit" class="btn btn-green" style="width: 100%">SEARCH</button>
							</p>
						</div>
					</div>
				<?php echo form_close()?>
				</div>
				<!-- END SEARCH -->
			</div>
		</div>
	</nav>


</section>
<!-- End menu section -->

<body>
<div class="container" style="min-height: 550px;">
	<!--<nav> <ul> <a href="<?php //echo site_url("user/getusers"); ?>" style="text-decoration: none;" >
				<li>See all users</li></a>
			<a href="<?php //echo site_url("user/getgender"); ?>" >
				<li>Todos os generos</li></a>
			<a href="<?php //echo site_url("clientrest/addmovieform"); ?>" >
				<li>Adicionar um filme</li></a> </ul> </nav>-->
