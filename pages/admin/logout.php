 <?php
session_start();
session_unset(); //frees all the session variables used 
session_destroy(); //destroy the session

header('Location:../index.php'); //redirect to index page after logging out
?>
