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
	<div style="display:flex;width: 100%; justify-content: space-between; align-items:center">
		<div><h1>List of users</h1></div>
		<div><a class="download-btn" href="<?php echo site_url("user/addUserForm"); ?>">CREATE USER</a></div>
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
		<td scope="col" >Pass</td>
		<td scope="col" >Birth Date</td>
		<td scope="col" >Edith</td>
	</tr>
	</thead>
	<tbody>
	<?php

	//var_dump($users);
	foreach ($users as $user){ ?>
		<tr>
			<td><?php echo  $user['name'] ?></td>
			<td><?php echo  $user['email'] ?></td>
			<td><?php echo  $user['pass'] ?></td>
			<td><?php echo  $user['birthDate'] ?></td>
			<td><button class="btn btn-green">edit</button></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

</span>
