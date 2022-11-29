<?php
session_start();
// check if a staff is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	?>
		<!-- display list of all categories -->
		<h2>Categories</h2>

		<!-- display link to add a new category -->
		<a class="new" href="?page=admin/manageCategory">Add new category</a>

		<?php
		echo '<table>';
		echo '<thead>';
		echo '<tr>';
		echo '<th>Name</th>';
		echo '<th style="width: 5%">&nbsp;</th>';
		echo '<th style="width: 5%">&nbsp;</th>';
		echo '</tr>';

		$category = new DatabaseTable('category');
		$stmt = $category->findAll();

		//display details of the category such as the name, also display 
		//a link edit and a button to delete them (use category id from hidden input field)

		foreach ($stmt as $category) {
			echo '<tr>';
			echo '<td>' . $category['name'] . '</td>';
			echo '<td><a style="float: right" href="manageCategory?cId=' . $category['id'] . '">Edit</a></td>';
			echo '<td><form method="post" action="manageCategory">
			<input type="hidden" name="id" value="' . $category['id'] . '" />
			<input type="submit" name="delete" value="Delete" />
			</form></td>';
			echo '</tr>';
		}

		echo '</thead>';
		echo '</table>';

	}
	
		//if the user is not logged in, display the login form
		else {
			$logIn = new logIn(); //instance of logIn class
			echo $logIn->displayForm(); //call displayForm
		}
?>