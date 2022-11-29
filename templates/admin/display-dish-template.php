<?php
session_start();
// check if a staff is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
<!-- display list of all dishes in the menu -->
    <h2>Menu</h2>
<!-- display link to add a new dish -->
    <a class="new" href="?page=admin/manageDish">Add new dish</a>

    <?php
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Title</th>';
    echo '<th style="width: 15%">Price</th>';
    echo '<th style="width: 5%">&nbsp;</th>';
    echo '<th style="width: 15%">&nbsp;</th>';
    echo '<th style="width: 5%">&nbsp;</th>';
    echo '<th style="width: 5%">&nbsp;</th>';
    echo '</tr>';

   
	$menu = new DatabaseTable('menu');
	$stmt = $menu->findAll();
        //display details of the dish such as its name, price also display 
		//a link edit and a button to delete them (use dish(menu) id from hidden input field)

    foreach ($stmt as $menu) {
        echo '<tr>';
        echo '<td>' . $menu['name'] . '</td>';
        echo '<td>' . $menu['price'] . '</td>';
        echo '<td><a style="float: right" href="manageDish?dId=' . $menu['id'] . '">Edit</a></td>';

        echo '<td><form method="post" action="manageDish">
        <input type="hidden" name="id" value="' . $menu['id'] . '" />
        <input type="submit" name="delete" value="Delete" />';

        //display hide dish or show dish button based on whether they are hidden 
        //or shown in the site in the first place.
        if ($menu ['hidden'] == 0){
            echo '<input type="submit" name="hide" value="Hide" />';
        }
        else{
            echo '<input type="submit" name="show" value="Show" />';       
        }
       echo  '</form></td>';
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