<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 04-12-2018
 * Time: 15:52
 */
?>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Long Story : Home</title>
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/icon" href="../../assets/images/favicon.ico"/>
	<!-- Font Awesome -->
	<link href="../../assets/css/font-awesome.css" rel="stylesheet">
	<!-- Bootstrap -->
	<link href="../../assets/css/bootstrap.css" rel="stylesheet">
	<!-- Slick slider -->
	<link rel="stylesheet" type="text/css" href="../../assets/css/slick.css"/>
	<!-- Fancybox slider -->
	<link rel="stylesheet" href="../../assets/css/jquery.fancybox.css" type="text/css" media="screen" />
	<!-- Animate css -->
	<link rel="stylesheet" type="text/css" href="../../assets/css/animate.css"/>
	<!-- Theme color -->
	<link id="switcher" href="../../assets/css/theme-color/default.css" rel="stylesheet">

	<link href="../../assets/css/preloader.css" rel="stylesheet">
	<!-- Main Style -->
	<link href="../../assets/css/style.css" rel="stylesheet">


	<!-- Fonts -->
	<!-- Open Sans for body font -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<!-- Raleway for Title -->
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<!-- Pacifico for 404 page   -->
	<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!--<link rel="stylesheet" href= <?php echo base_url('assets/css/bootstrap.min.css');?> >-->
	<script src=<?php echo base_url('assets/js/bootstrap.min.js');?> ></script>

	<script src=<?php echo base_url('assets/js/jquery-3.3.1.slim.min.js');?>  ></script>
	<script src=<?php echo base_url('assets/js/popper.min.js');?> ></script>
</head>
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
				<img src="../../assets/images/logo.jpg" alt="logo">
				<a class="nav-item nav-link active" href="<?php echo site_url("user/"); ?>">Home <span class="sr-only">(current)</span></a>
				<a class="nav-item nav-link" href="<?php echo site_url("user/getuser"); ?>">Users</a>
				<a class="nav-item nav-link" href="<?php echo site_url("user/addUserValidation"); ?>">Add User</a>
				<a class="nav-item nav-link" href="<?php echo site_url("book/getbook"); ?>">Books</a>
				<a class="nav-item nav-link" href="">Add Book</a>
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
<div class="container" >
	<!--<nav> <ul> <a href="<?php //echo site_url("user/getusers"); ?>" style="text-decoration: none;" >
				<li>See all users</li></a>
			<a href="<?php //echo site_url("user/getgender"); ?>" >
				<li>Todos os generos</li></a>
			<a href="<?php //echo site_url("clientrest/addmovieform"); ?>" >
				<li>Adicionar um filme</li></a> </ul> </nav>-->
