<?php
session_start();
//to check if main admin is trying to access the page 
$admin = false;
$user = new DatabaseTable('user');
$stmt = $user->findWhere('mainAdmin', '1', 'username' , $_SESSION['username']);
$row = $stmt->fetch();
// check if a staff is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	if($stmt->rowcount() ==1){	?>
		<!-- display form to add a new staff with fields such as username, password and main admin
		(main admins have access to manage staff accounts) -->
		<form action="manageStaffAccount" method="POST">
			<input type="hidden" name="id" />
			<label>Username:</label>
			<input type="text" name="username" />
			
			<label>Password:</label>
			<input type="text" name="password" />';
			
			<label>Main Admin? </label>

			<select name="mainAdmin">
			
			<option value="0">No </option>
			<option value="1">Yes </option>
			</select>
			
			<input type="submit" value="Save" name="submit" />
		</form>
	<?php
	}
}
//if the user is not logged in, display the login form
else {
	$logIn = new logIn(); //instance of logIn class
	echo $logIn->displayForm(); //call displayForm
}
?>