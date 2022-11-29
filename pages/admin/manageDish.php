<?php
$menu = new DatabaseTable('menu');

if (isset($_GET['dId'])) {
	$stmt = $menu->find('id', $_GET['dId']);
	$row = $stmt->fetch();
}
else{ $row = []; }
if(isset($_POST['submit'])){
	$fileName = $_FILES['image'] ['name']; //get full name of the file
	
	if (!empty($fileName)){
		
		$fNameWithCommas = implode("," , $fileName); //to be written into the database
		$tempFileName = $_FILES['image'] ['tmp_name']; //temporary location of the file
		
		foreach ($fileName as $key => $value){
			$destFileName = 'css/images/uploads/' .$value;
			move_uploaded_file($tempFileName[$key], $destFileName);
		}
		$criteria = [
			'id' => $_POST['id'],
			'name' => $_POST['name'],
			'description' => $_POST['description'],
			'price' => $_POST['price'],
			'categoryId' => $_POST['categoryId'],
			'image' => $fNameWithCommas
		];
		$menu-> save($criteria, 'id');
		header('Location:?page=admin/manageDish&msg= Dish Saved');

	}
	else if (empty($fileName)){
			$criteria = [
				'id' => $_POST['id'],
				'name' => $_POST['name'],
				'description' => $_POST['description'],
				'price' => $_POST['price'],
				'categoryId' => $_POST['categoryId']
			];
			$menu-> save($criteria, 'id');
			header('Location:?page=admin/manageDish&msg= Dish Saved');
		}
	else{
		header('location: ?page=admin/manageDish&msg= Uploading Failed');
	}
}

if (isset($_POST['delete'])){
	$stmt = $menu->delete('id', $_POST['id']);
	header('location: ?page=admin/displayDish&msg= Dish Deleted');
}

//if hide or show dish buttons are pressed on, update hidden attribute for the dish
//to true or false respectively
if (isset($_POST['hide'])){
	$criteria = [
		'id' => $_POST['id'],
		'hidden' => 1
	];
	$stmt = $menu->update($criteria, 'id');
	header('location: ?page=admin/displayDish&msg= Dish Hidden');
}

if (isset($_POST['show'])){
	$criteria = [
		'id' => $_POST['id'],
		'hidden' => 0
	];
	$stmt = $menu->update($criteria, 'id');
	header('location: ?page=admin/displayDish&msg= Dish Shown');
}
//set title of the page and load template for content and pass row 
$title = 'Admin - Manage Dishes';
$content = loadTemplate('../templates/admin/manage-dish-template.php', ['row'=>$row]);
?>
	