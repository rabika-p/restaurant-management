<ul class="listing">
<?php 
$dId = $_GET['dId'];  // get dish id from the url
//display the dish name which the reviews belong to at the top
$menu = new DatabaseTable('menu');
$smt = $menu ->find('id', $dId);
foreach ($smt as $record){
    echo '<h2> Review of: ' . $record['name'] . '</h2>';
    $cId =  $record['categoryId']; //get the category id of the dish
}
echo '<li>';
    echo '<div class="details">';
        $review = new DatabaseTable('review');
        //view all reviews which are approved, sort by highest rating and
        //display top 3 under the dish
        $smt = $review ->findAndOrderBy('approval', 1, 'rating', 'DESC');
        $reviewsExist = false; //boolean to check if reviews exist for the dish
        foreach ($smt as $record){
            if ($record['menuId'] == $dId){
                //view details of  the review such as rating, description 
                echo '<h4> Reviewer Name: ' .$record['reviewerName'] . '</h4>';
                echo '<h4> Rating: ' . $record['rating'] . '</h4>';
                echo '<p> Description: ' . nl2br($record['description']) . '</p>';
            }
                
        }
    echo '</div>';
echo '</li>';
//link to go back to menu list
echo '<a href="categories&cId='.$cId .'">Go back</a> <br> <br>';


?>
</ul>

