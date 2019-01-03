<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 29-11-2018
 * Time: 14:26
 */
//var_dump($movies);
?>

<span id="list_users">
<h1>List of books</h1>
<table class="table table-bordered table-hover">
	<thead>

	<div class="row">
		<div class="col-lg-12">
			<?php echo validation_errors(); ?>
		</div>
	</div>

	<tr>
		<td scope="col" >Name</td>
		<td scope="col" >Id Author</td>
		<td scope="col" >Description</td>
		<td scope="col" >ISBN</td>
	</tr>
	</thead>
	<tbody>
	<?php

	//var_dump($users);
	foreach ($users as $user){ ?>
		<tr>
			<td><?php echo  $user['name'] ?></td>
			<td><?php echo  $user['idAuthor'] ?></td>
			<td><?php echo  $user['description'] ?></td>
			<td><?php echo  $user['isbn'] ?></td>
			<td><button class="btn btn-green">edit</button></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
</span>
