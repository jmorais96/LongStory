<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 29-11-2018
 * Time: 14:26
 */
//print_r($users);exit;
?>
<span id="list_friends">
	<div style="display:flex;width: 100%; justify-content: space-between; align-items:center">
		<div><h1>List of friends of 'fulano'</h1></div>
		<div><a class="download-btn" href="<?php echo site_url("user/addFriendForm"); ?>">ADD FRIEND</a></div>
	</div>
<table class="table table-bordered table-hover">
	<thead>

	<div class="row">
		<div class="col-lg-12">
			<?php echo validation_errors(); ?>
		</div>
	</div>

	<tr>
		<td scope="col" >IdUser</td>
		<td scope="col" >IdFriend</td>
		<!--<td scope="col" >Edit</td>-->
	</tr>
	</thead>
	<tbody>
	<?php

	//var_dump($users);
	foreach ($friends as $friend){ ?>
		<tr>
			<td><?php echo  $friend['name'] ?></td>
			<td><?php echo  $friend['email'] ?></td>
			<!--<td><a class="download-btn" href="<?php //echo site_url("user/editUserForm/".$user['idUser']); ?>">EDIT</a></td>-->
		</tr>
	<?php } ?>
	</tbody>
</table>

</span>
