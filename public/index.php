<?php
require '../db/connection.php'; //for connection to the database
require '../functions/loadTemplate.php'; //for load template
require '../includes/autoloader.php'; //autoload all classes 
// get and display the message from the url at the top (if any)
if(isset($_GET['msg'])){ 
    echo $_GET['msg'];
}
//get page name from the url and require it from pages folder
if(isset($_GET['page'])){ 
    require '../pages/' . $_GET['page'] . '.php';
}

else{ //redirect to home
    require '../pages/home.php';
}
//set title and content for the page
$tempVars = [
		'title' => $title,
		'content' => $content
	];
echo loadTemplate('../templates/layout.php', $tempVars);
?>