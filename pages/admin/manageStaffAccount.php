<?php
$user = new DatabaseTable('user');
if (isset($_GET['uId'])) {
	
	$stmt = $user->find('id', $_GET['uId']);
	$row = $stmt->fetch();
}
else{ $row = []; }
if(isset($_POST['submit'])){
	$criteria = [
		'id' => $_POST['id'],
		'username' => $_POST['username'],
		'password' => sha1($_POST['username'] . $_POST['password']),
		'mainAdmin' => $_POST['mainAdmin']
    	//concatenate username and password to generate a hash for the password 
	];
	$user-> save($criteria, 'id');
	header('Location:?page=admin/manageStaffAccount&msg= User Saved');
}

if(isset($_POST['delete'])){
$stmt = $user->delete('id', $_POST['id']);
header('location:?page=admin/displayStaffAccount&msg= User Deleted');
}
//set title of the page and load template for content and pass row 
$title = 'Admin - Manage Staff Accounts';
$content = loadTemplate('../templates/admin/manage-staff-account-template.php',
 ['row'=>$row]);
?>
	