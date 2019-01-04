<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 29-11-2018
 * Time: 14:26
 */
//var_dump($movies);
?>

<h1>List of books</h1>
<table class="table table-bordered table-hover">
	<thead>

	<div class="row">
		 <div class="col-lg-12">
			<?php file_get_contents(FCPATH . "upload/prometoFalhar.jpg" , base64_decode($photo)); ?>
			 <img src="<?php echo base_url('upload/prometoFalhar.jpg'); ?>" class="img-fluid">
		</div>
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
	foreach ($books as $book){ ?>
		<tr>
			<td><?php echo  $book['name'] ?></td>
			<td><?php echo  $book['idAuthor'] ?></td>
			<td><?php echo  $book['description'] ?></td>
			<td><?php echo  $book['isbn'] ?></td>
			<td><?php echo  $book['image'] ?></td>
			<td><button class="btn btn-green">edit</button></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
