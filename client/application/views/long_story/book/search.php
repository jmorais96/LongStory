<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 29-11-2018
 * Time: 14:26
 */
//var_dump($movies);
?>

<h1>List of search</h1>
<table class="table table-bordered table-hover">
	<thead>


	<tr>
		<td scope="col" >Name</td>
		<td scope="col" >Id Author</td>
		<td scope="col" >Description</td>
		<td scope="col" >ISBN</td>
		<td scope="col" >View Info</td>
	</tr>
	</thead>
	<tbody>
	<?php

	//var_dump($books);
	foreach ($books as $book){ ?>
		<tr>
			<td><?php echo  $book['name'] = str_replace('%20', ' ', $book['name']);?></td>
			<td><?php echo  $book['author'] = str_replace('%20', ' ', $book['author']);?></td>
			<td><?php echo  $book['description'] = str_replace('%20', ' ', $book['description']);?></td>
			<td><?php echo  $book['ISBN'] ?></td>
			<td><a class="download-btn" href="<?php echo site_url("book/getBookInfo/".$book['idBook']); ?>">INFO</a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
