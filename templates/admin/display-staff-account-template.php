<?php
session_start();
//to check if main admin is trying to access the page 
$admin = false;
$user = new DatabaseTable('user');
$stmt = $user->findWhere('mainAdmin', '1', 'username' , $_SESSION['username']);
$row = $stmt->fetch();
// check if a staff is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	if($stmt->rowcount() ==1){	
	?>
			<!-- display list of all staff accounts -->
			<h2>Staff Accounts</h2>

			<!-- display link to add a new staff -->

			<a class="new" href="manageStaffAccount">Add new staff account</a>

			<?php
			echo '<table>';
			echo '<thead>';
			echo '<tr>';
			echo '<th>Username</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '</tr>';

			$user = new DatabaseTable('user');
			$stmt = $user->findAll();

			//display details of the staff such as their username, also display 
			// a button to delete them (use staff id from hidden input field)

			foreach ($stmt as $user) {
				echo '<tr>';
				echo '<td>' . $user['username'] . '</td>';
				//echo '<td><a style="float: right" href="manageStaffAccount?uId=' . $user['id'] . '">Edit</a></td>';
				echo '<td><form method="post" action="manageStaffAccount">
				<input type="hidden" name="id" value="' . $user['id'] . '" />';
				echo '<input type="submit" name="delete" value="Delete" />
				</form></td>';
				echo '</tr>';
			}

			echo '</thead>';
			echo '</table>';
		}
	}	
	//if the user is not logged in, display the login form
	else {
		$logIn = new logIn(); //instance of logIn class
		echo $logIn->displayForm(); //call displayForm
	}
?>