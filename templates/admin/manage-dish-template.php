<?php
session_start();
// check if a staff is logged in
 if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {?>
    <form action="manageDish" method="POST" enctype ="multipart/form-data">
     <!-- check for id to know if values are being edited, if so, display respective values 
    to fields, else display empty form -->

    <input type="hidden" name="id" value="<?php if (isset($row['id'])) echo $row['id']; ?>" />
    
    <label>Name</label>
    <input type="text" name="name" value="<?php if (isset($row['id'])) echo $row['name']; ?>" />

    <label>Description</label>
    <textarea name="description"><?php if (isset($row['id'])) echo $row['description']; ?></textarea>

    <label>Price</label>
    <input type="text" name="price" value="<?php if (isset($row['id'])) echo $row['price']; ?>" />

    <label>Category</label>

    <select name="categoryId">
    <?php

	$category = new DatabaseTable('category');
	$stmt = $category->findAll();

    foreach ($stmt as $category) {
        if ($row['categoryId'] == $category['id']) {
            echo '<option selected="selected" value="' . $row['id'] . '">' . $category['name'] . '</option>';
        }
        else {
            echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
        }

    }


    ?>

    </select>
    
    <?php if (isset($row['id'])){ } else{?>
    <label> Attach picture : </label>
    
    <input type="file" name="image[]" multiple /> 
    <?php }?>
    <input type="submit" name="submit" value="Save" />

    </form>
    <?php
 }

//if the user is not logged in, display the login form
else {
    $logIn = new logIn(); //instance of logIn class
    echo $logIn->displayForm(); //call displayForm
}
?>         