<?php
session_start(); 

// check if a staff is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    //view all bookings to be processed (value = 0)
    $booking = new DatabaseTable('booking');
    $stmt = $booking ->find('processed', 0);

    //display link to view all processed bookings -->

    echo '<a href="processedBooking">View processed bookings</a> <br> <br>';

    foreach ($stmt as $row) {
        echo '<ul class="listing">
            <li>';
                echo '<div class="details">';
                //view all details of the booking such as customer name, contact  
                // a button to process them (use booking id from hidden input field)
                echo '<h2> Customer Name: ' .$row['customerName'] . '</h2>';
                echo '<h4> Contact: ' . $row['contact'] . '</h4>';
                echo '<h4> Number of Guests: ' . $row['numGuests'] . '</h4>';
                echo '<h4> Date & Time: ' . $row['dateTime'] . '</h4> <br>';
                // to process bookings 
                echo '<form method="post" action="manageBooking">
                <input type="hidden" name="id" value="' . $row['id'] . '" />';
                //display the booking id in a hidden field
                echo '<input type="submit" name="process" value="Process" />';
                echo ' </form>';	
        echo '</div>';
    echo '</li>';    
    echo '</ul>'; 
    } 
    //change the value processed to 1 after the process button is pressed for a booking 
    if (isset($_POST['process'])){
        $criteria = [
            'id' => $_POST['id'],
            'processed' => 1
        ];
        $stmt = $booking->update($criteria, 'id'); //update processed in matching id 
        header('location: manageBooking&msg=Booking Processed'); //redirect to page and display message
    }
}

//if the user is not logged in, display the login form
else {
    $logIn = new logIn(); //instance of logIn class
    echo $logIn->displayForm(); //call displayForm
}
?>
