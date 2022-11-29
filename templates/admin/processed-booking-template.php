<?php
session_start(); 
// check if a staff is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    //view all bookings to be processed
    $booking = new DatabaseTable('booking');
    $stmt = $booking ->find('processed', 1);
     //link to go back to displaying bookings to process
    echo '<a href="?page=admin/manageBooking">Go back</a> <br> <br>';
    //view all details of  the booking such as customer name, date and time 
    foreach ($stmt as $row) {
    echo '<ul class="listing">
        <li>';
            echo '<div class="details">';
                echo '<h2> Customer Name: ' .$row['customerName'] . '</h2>';
                echo '<h4> Contact: ' . $row['contact'] . '</h4>';
                echo '<h4> Number of Guests: ' . $row['numGuests'] . '</h4>';
                echo '<h4> Date & Time: ' . $row['dateTime'] . '</h4> <br>';
        echo '</div>';
    echo '</li>';    
    echo '</ul>'; 
    }
} 
//if the user is not logged in, display the login form
else {
	$logIn = new logIn(); //instance of logIn class
	echo $logIn->displayForm(); //call displayForm
}