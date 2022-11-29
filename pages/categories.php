<?php
	$cId = $_GET['cId']; //get the category id from the url
	$cName = null;
	$category = new DatabaseTable('category');
	$stmt = $category ->find('id', $cId);
	//search for category name
	foreach ($stmt as $row){
		$cName = $row['name'];
	}
	//set title of the page and load template for content
	$title = 'Kate\'s Kitchen - ' .$cName;
	$content = loadTemplate('../templates/categories-template.php', []);
?>