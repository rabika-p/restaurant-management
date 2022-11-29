<?php
session_start(); 
// check if a staff is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    //view all reviews to be approved (value = 0)
    $review = new DatabaseTable('review');
    $stmt = $review ->find('approval', 0);
    // echo '<a href="processedBooking">View processed bookings</a> <br> <br>';

    foreach ($stmt as $row) {
    echo '<ul class="listing">
        <li>';
            echo '<div class="details">';
                //display the dish name for which the review was submitted at the top
                $menu = new DatabaseTable('menu');
                $smt = $menu ->find('id', $row['menuId']);
                foreach ($smt as $record){
                    echo '<h2> Review of: ' . $record['name'] . '</h2>';
                }
                //view other details of  the review such as rating, description 
                echo '<h4> Reviewer Name: ' .$row['reviewerName'] . '</h4>';
                echo '<h4> Rating: ' . $row['rating'] . '</h4>';
                echo '<p> Description: ' . nl2br($row['description']) . '</p>';
                // to approve reviews so that they show up on the site
                echo '<form method="post" action="manageReview">
                <input type="hidden" name="id" value="' . $row['id'] . '" />';
                //display the review id in a hidden field
                echo '<input type="submit" name="approve" value="Approve" />';
                echo ' </form>';	
        echo '</div>';
    echo '</li>';    
    echo '</ul>'; 
    } 

    //change the value approval to 1 after the approve button is pressed for a review 
    if (isset($_POST['approve'])){
        $criteria = [
            'id' => $_POST['id'],
            'approval' => 1
        ];
        $stmt = $review->update($criteria, 'id'); //update approval in matching id 
        header('location: manageReview&msg=Review Approved'); //redirect to page and display message
    }
 }
//if the user is not logged in, display the login form
else {
	$logIn = new logIn(); //instance of logIn class
	echo $logIn->displayForm(); //call displayForm
}
