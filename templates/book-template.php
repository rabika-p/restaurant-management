<h3> Book a Table </h3>

<form action="book" method="POST">
	<label>Customer's name: </label>
	<input type="text" name="customerName" />

	<label> Contact Number: </label>
	<input type="text" name="contact" />

	<label>Number of guests: </label>
	<input type="text" name="numGuests"/>

    <label>Date & Time: </label>                                 
    <input type="datetime-local" name = "dateTime" value="
    <?php 
        echo date('Y/m/d H:i'); 
    ?>
    ">
	<input type="submit" name="submit" value="Submit" />
</form>

<?php
if(isset($_POST['submit'])){
	$booking = new DatabaseTable('booking');

	$criteria = [
		'customerName' => $_POST['customerName'],
		'contact' => $_POST['contact'],
        'numGuests' => $_POST['numGuests'],
		'dateTime' => $_POST['dateTime']
	];
	
	$stmt = $booking->insert($criteria);
	header('Location:book&msg= Booking Successful');
}
?>


			