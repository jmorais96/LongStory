<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 29-11-2018
 * Time: 14:26
 */
//var_dump($movies);
?>

<h1>List of owned books</h1>
<table class="table table-bordered table-hover">
	<thead>

	<!--	<div class="row">
		 <div class="col-lg-12">
			<?php //file_get_contents(FCPATH . "upload/prometoFalhar.jpg" , base64_decode($books[0]['image'])); ?>
			 <img src="<?php //echo base_url('upload/prometoFalhar.jpg'); ?>" class="img-fluid">
		</div>
		<div class="col-lg-12">
			<?php //echo validation_errors(); ?>
		</div>
	</div>-->

	<tr>
		<td scope="col" >Name</td>
		<td scope="col" >Author</td>
		<td scope="col" >Description</td>
		<!--<td scope="col" >image</td>-->
		<!--<td scope="col" >View Info</td>-->
	</tr>
	</thead>
	<tbody>
	<?php

	//var_dump($users);
	foreach ($allOwned as $oneOwned){ ?>
		<tr>
			<td><?php echo  $oneOwned['name'] ?></td>
			<td><?php echo  $oneOwned['author'] ?></td>
			<td><?php echo  $oneOwned['description'] ?></td>
			<td class="col-lg-6" style="width: 100px; height: 100px;">
				<?php //file_put_contents(FCPATH . 'upload/notFound.jpg', base64_decode($book['image'])); ?>
				<img src="<?php //echo base_url('upload/notFound.jpg');?>" class="img-fluid">
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
