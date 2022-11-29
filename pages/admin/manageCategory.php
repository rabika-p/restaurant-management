<?php
$category = new DatabaseTable('category');
if (isset($_GET['cId'])) {
	
	$stmt = $category->find('id', $_GET['cId']);
	$row = $stmt->fetch();
}
else{ $row = []; }
if(isset($_POST['submit'])){
	$criteria = [
		'id' => $_POST['id'],
		'name' => $_POST['name']
	];
	$category-> save($criteria, 'id');
	header('Location:?page=admin/manageCategory&msg= Category Saved');
}

if(isset($_POST['delete'])){
$stmt = $category->delete('id', $_POST['id']);
header('location: ?page=admin/displayCategory&msg= Category Deleted');
}
//set title of the page and load template for content and pass row 
$title = 'Admin - Manage Categories';
$content = loadTemplate('../templates/admin/manage-category-template.php', ['row'=>$row]);
?>
	