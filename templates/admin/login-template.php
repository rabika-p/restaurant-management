<?php
session_start(); 
$user = new DatabaseTable('user');
//if submit button is pressed,
if (isset($_POST['submit'])) {
	//get login details from the staff
	$username = $_POST['username'];
    $password = $_POST['password'];
    $password = sha1($_POST['username'] . $_POST['password']); 
	//get username and hashed password and match with the users table
	$stmt = $user->findWhere('username', $username, 'password' , $password);
	$row = $stmt->fetch();

	if($stmt->rowcount() ==1) 
    {
        $_SESSION['loggedin'] = true; //set session loggedin variable to true
		$_SESSION['username'] = $username; //so that only Kate herself can manage user accounts
    }
}
// check if a staff is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	?>
	<h2>You are now logged in</h2>
	<?php
	}
	//if the user is not logged in, display the login form
	else {
		$logIn = new logIn(); //instance of logIn class
		echo $logIn->displayForm(); //call displayForm
	}
	?>

	</main>
