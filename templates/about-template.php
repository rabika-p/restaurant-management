<br> <h3 >Welcome to Kate's Kitchen, we're a family run resturaunt in northampton.
	 Take a look around our site to see our menu!</h3> </br>
<h2> Take a look at our menu: </h2>
<?php 
	$category = new DatabaseTable('category');
	$stmt = $category->findAll();
?>
	<ul>
		<?php
		foreach ($stmt as $row) {
			echo '<li> <a href="index.php?page=categories&cId='.$row['id'] .'">' .$row['name'] .'</a> </li>';	
		}
		?>	
	</ul>