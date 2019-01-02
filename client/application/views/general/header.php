<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 04-12-2018
 * Time: 15:52
 */
?>

<html>


<header>
	<link rel="stylesheet" href= <?php echo base_url('assets/css/bootstrap.min.css');?> >
	<script src=<?php echo base_url('assets/js/bootstrap.min.js');?> ></script>

	<script src=<?php echo base_url('assets/js/jquery-3.3.1.slim.min.js');?>  ></script>
	<script src=<?php echo base_url('assets/js/popper.min.js');?> ></script>
</header>
<body>
<div class="container" >
	<nav> <ul> <a href="<?php echo site_url("clientrest/getmovies"); ?>" style="text-decoration: none;" ><li>Ver todos os filmes</li></a>  <a href="<?php echo site_url("clientrest/getgender"); ?>" ><li>Todos os generos</li></a> <a href="<?php echo site_url("clientrest/addmovieform"); ?>" ><li>Adicionar um filme</li></a> </ul> </nav>
