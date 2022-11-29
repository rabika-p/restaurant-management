<ul class="listing">
	<?php
    //select all homepage updates
	$homepage = new DatabaseTable('homepage');
    $stmt = $homepage ->findAll();
    foreach ($stmt as $row) {
        echo '<li>';
            //display details of the update such as title and description
            echo '<div class="details">';
                echo '<h2> ' . $row['title'] . '</h2>';
                echo '<h3>' . $row['date'] . '</h3>';
                echo '<p>' . nl2br($row['description']) . '</p>';
                //check for image in database before displaying
                if (!empty($row['image'])){
                echo  '<img src="../css/images/uploads/' .$row['image'] .'"/>';
                }
            }
            echo '</div>';
        echo '</li>';
            
	?>
</ul>