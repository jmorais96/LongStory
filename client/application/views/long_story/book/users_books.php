<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 29-11-2018
 * Time: 14:26
 */
//print_r($users);exit;
?>
<span id="list_users">
	<div style="display:flex;width: 100%; justify-content: space-between; align-items:center">
		<div><h1>Select your user</h1></div>
		<div><a class="download-btn" href="<?php echo site_url("book/addBookForm"); ?>">ADD BOOK</a></div>
	</div>
<table class="table table-bordered table-hover">
	<thead>

	<div class="row">
		<div class="col-lg-12">
			<?php echo validation_errors(); ?>
		</div>
	</div>

	<tr>
		<td scope="col" >Name</td>
		<td scope="col" >Email</td>
		<!--<td scope="col" >Pass</td>
		<td scope="col" >Birth Date</td>-->
		<td scope="col" >All</td>
		<td scope="col" >Owned</td>
		<td scope="col" >Read</td>
		<td scope="col" >Wishlist</td>
	</tr>
	</thead>
	<tbody>
	<?php

	//var_dump($users);
	foreach ($users as $user){ ?>
		<tr>
			<td><?php echo  $user['name'] ?></td>
			<td><?php echo  $user['email'] ?></td>
			<!--<td><?php //echo  $user['pass'] ?></td>
			<td><?php //echo  $user['birthDate'] ?></td>-->
			<td><a class="download-btn" href="<?php echo site_url("book/getBooks/".$user['idUser']); ?>">ALL</a></td>
			<td><a class="download-btn" href="<?php echo site_url("book/getOwned/".$user['idUser']); ?>">OWNED</a></td>
			<td><a class="download-btn" href="<?php echo site_url("book/getRead/".$user['idUser']); ?>">READ</a></td>
			<td><a class="download-btn" href="<?php echo site_url("book/getWishlist/".$user['idUser']); ?>">WISHLIST</a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

</span>
