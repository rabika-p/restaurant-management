<?php
session_start();
// check if a staff is logged in
 if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
	<form action="manageCategory" method="POST">
	<!-- check for id to know if values are being edited, if so, display respective values 
    to fields, else display empty form -->
	    <input type="hidden" name="id" value="<?php if(isset($row['id'])) echo $row['id']; ?>" />
		<label>Category Name:</label>
		<input type="text" name="name" value="<?php if(isset($row['name'])) echo $row['name']; ?>" />
		<input type="submit" value="Save" name="submit" />
	</form>
<?php
}
//if the user is not logged in, display the login form
else {
	$logIn = new logIn(); //instance of logIn class
	echo $logIn->displayForm(); //call displayForm
}
?>