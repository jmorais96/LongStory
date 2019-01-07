<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 29-11-2018
 * Time: 14:26
 */
//var_dump($movies);
?>

<h1>Wishlist books</h1>
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
	foreach ($wishlist as $oneWishlist){ ?>
		<tr>
			<td><?php echo  $oneWishlist['name']  = str_replace('%20', ' ', $oneWishlist['name']);?></td>
			<td><?php echo  $oneWishlist['author']  = str_replace('%20', ' ', $oneWishlist['author']);?></td>
			<td><?php echo  $oneWishlist['description']  = str_replace('%20', ' ', $oneWishlist['description']);?></td>
			<!--<td class="col-lg-6" style="width: 100px; height: 100px;">
				<?php //file_put_contents(FCPATH . 'upload/notFound.jpg', base64_decode($book['image'])); ?>
				<img src="<?php //echo base_url('upload/notFound.jpg');?>" class="img-fluid">
			</td>-->
		</tr>
	<?php } ?>
	</tbody>
</table>

<!-- SET WISHLIST FORM -->
<?php echo form_open_multipart("Book/setWishlistValidation", 'role="form" class="form-horizontal"')?>
<div class="row">
	<div class="col-lg-2">
		<?php echo validation_errors(); ?>
	</div>
</div>
<h3 class="col-lg-12" style=color:grey;> Add one book to the wishlist</h3>
<div class="row">
	<div class="col-lg-3">
		<div class="form-group row">
			<?php echo form_label('MyIdUser', 'myIdUser', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('myIdUser', set_value('myIdUser'), 'class="form-control"')?>
			</div>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="form-group row">
			<?php echo form_label('IdBook', 'idBook', array('class' => 'col-lg-3 control-label'))?>
			<div class="col-lg-12">
				<?php echo form_input('idBook', set_value('idBook'), 'class="form-control"')?>
			</div>
		</div>
	</div>

	<div class="col-lg-6">
		<p class="text-center">
			<br>
			<button type="submit" class="btn btn-green" style="width: 100%"> Send to wishlist</button>
		</p>
	</div>
</div>
<?php echo form_close()?>
</div>
<!-- END SET WISHLIST FORM -->
