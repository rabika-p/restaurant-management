<?php
$rId = $_GET['rId'];
$menu = new DatabaseTable('menu');
$stmt = $menu -> find('id', $rId);
foreach ($stmt as $row){
	echo '<h3> Review ' .$row['name'] .'</h3>';
}
?>

<form action=" "  method="POST">
	<label>Reviewer's name: </label>
	<input type="text" name="reviewerName" />

	<label>Rating (1-5 stars): </label>

    <select name="rating">

    <option value="1">1 star</option>
    <option value="2">2 stars</option>
    <option value="3">3 stars</option>
    <option value="4">4 stars</option>
	<option value="5">5 stars</option>
  	</select>

	<label>Description: </label>
	<textarea name="description"></textarea>

	<input type="submit" name="submit" value="Submit" />
</form>

<?php
if(isset($_POST['submit'])){
	$review = new DatabaseTable('review');

	$criteria = [
		'reviewerName' => $_POST['reviewerName'],
		'rating' => $_POST['rating'],
        'description' => $_POST['description'],
		'menuId' => $rId
	];
	//check for empty inputs in the form
	if ((empty($_POST['reviewerName'])) || (empty($_POST['description']))){
		header('Location:reviewDish&rId='.$rId.'&msg= Enter valid data in all fields');
	}
	else{
		$stmt = $review->insert($criteria);
		header('Location:reviewDish&rId='.$rId.'&msg=Review Successful');
	}
}

			