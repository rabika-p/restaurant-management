<main class="sidebar">
<?php $cId = $_GET['cId'];  // get category id from the url
$count = null; //variable to count the number of records
?>
	<section class="left">
        <?php $category = new DatabaseTable('category');
        $stmt = $category->findAll();
        ?>
		<ul>
            <!-- display all categories in the left section of sidebar -->
            <!-- check for current category id from the url and highlight name in the 
            sidebar -->
            <?php
            foreach ($stmt as $row) {
                if ($cId == $row['id']){
                    echo '<li> <a class="current" href="categories&cId='.$row['id'] .'">' .$row['name'] .'</a> </li>';
                }
                 else{
                    echo '<li> <a href="categories&cId='.$row['id'] .'">' .$row['name'] .'</a> </li>';	
                }
            }
            ?>    
	</section>
    <!-- display category name that is selected  -->
	<section class="right">
    <?php 
    $category = new DatabaseTable('category');
    $stmt = $category ->find('id', $cId);
    foreach ($stmt as $row) {
        echo  '<h1> ' .$row['name'] .'</h1> ';
    } 
    ?>  
	<ul class="listing">

	<?php
    //select all menu items based on the category that they fall under
	$menu = new DatabaseTable('menu');
    $stmt = $menu ->find('categoryId', $cId);
    foreach ($stmt as $row) {
        //only display menu items that are not hidden
        if ($row ['hidden'] == 0){
            echo '<li>';
            //display details of the menu items such as price and name
            echo '<div class="details">';
                echo '<h3>£' . $row['price'] . '</h3>';
                echo '<h2>' . $row['name'] . '</h2>';
                echo '<p>' . nl2br($row['description']) . '</p>';
                $fNameWithCommas = $row['image'];
                if (!empty($row['image'])){
                    $fName = explode(',' , $fNameWithCommas); //separate two file names using comma

                    $num = count($fName); //count number of elements in array
                    for ($i = 0; $i< $num; $i++){
                        echo  '<img src="../css/images/uploads/' .$fName[$i] .'"/>';
                    }
                }


                echo '<a href="reviewDish&rId='.$row['id'] .'"> Write a Review </a> <br> <br>';	
        
                $review = new DatabaseTable('review');
                //view all reviews which are approved, sort by highest rating and
                //display top 3 under the dish
                $smt = $review ->findLimitAndOrderBy('approval', 1, 'menuId', $row['id'],
                'rating', 'DESC', '3');
                $reviewsExist = false; //boolean to check if reviews exist for the dish
                foreach ($smt as $record){
                    if ($record['menuId'] == $row ['id']){
                        $count = $count + 1;
                        $reviewsExist = true;
                        //view details of  the review such as rating, description 
                        echo '<h4> Reviewer Name: ' .$record['reviewerName'] . '</h4>';
                        echo '<h4> Rating: ' . $record['rating'] . '</h4>';
                        echo '<p> Description: ' . nl2br($record['description']) . '</p>';
                    }
                    	
                }
                //if reviews exist, display link with dish id to allow user to view all reviews
                if ($reviewsExist == true){
                   //if there are more than 3 records, show option to view all
                    if ($count >4){
                    echo '<a href="viewReview&dId='.$row['id'] .'"> View All Reviews </a>';
                }
            }
            echo '</div>';
        echo '</li>';
	    }
    }
	?>
    </ul>
    </section>
</main>