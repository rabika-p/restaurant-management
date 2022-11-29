<?php
session_start();
// check if a staff is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
     <form action="updateHome" method="POST" enctype ="multipart/form-data">
          <!-- display form to take details such as title, description to add updates to the home 
        page -->

        <input type="hidden" name="id" />

        <label>Date :</label>
        <input type="date" name = "date" value="
        <?php 
            echo date('Y/m/d'); 
        ?>
        ">

        <label>Title:</label>
        <input type="text" name="title" />
                
        <label>Description: </label>
        <textarea name="description"></textarea>
                
        <label>Attach picture : </label>
        <input type="file" name="image" id="image">
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