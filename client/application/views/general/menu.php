<body>

<!-- Start menu section -->
<section id="menu-area">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<!-- LOGO -->
				<a class="footer-logo" href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/images/logo.jpg');?>" alt="Logo"></a>
				<a class="nav-item nav-link active" href="<?php echo site_url("user/"); ?>">Home <span class="sr-only">(current)</span></a>
				<a class="nav-item nav-link" href="<?php echo site_url("user/getuser"); ?>">Users</a>
				<a class="nav-item nav-link" href="<?php echo site_url("user/getuserbooks"); ?>">Books</a>
			<!--	<div class="dropdown">
					<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Users
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="#">Another action</a>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</div>-->
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
