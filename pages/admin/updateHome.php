<?php
$picExists = false; //boolean to check if an image is attached or not
$homePage = new DatabaseTable('homepage');
//if submit button is pressed,
if (isset($_POST['submit'])){
    $file = $_FILES['image'];
    $fileName = $_FILES['image'] ['name']; //get full name of the file
    $tempFileName = $_FILES['image'] ['tmp_name']; //temporary location of the file
    $fileSize = $_FILES['image'] ['size'];
    $errors = $_FILES['image'] ['error']; //check for errors
    $fileType = $_FILES['image'] ['type'];

    $fileExt = explode('.', $fileName); //separate  extension from file name
    $fileLowerExt = strtolower(end($fileExt)); //convert extension to lowercase

    $formats = array('png', 'jpeg', 'jpg'); //the extensions that are allowed to be uploaded

    if(in_array($fileLowerExt, $formats)){ //check if the file extension falls under allowed 
        if ($errors == 0) {
            if ($fileSize < 1000000){
                $changeFileName = uniqid(rand()). "." .$fileLowerExt; //generating a random file name
                $destFileName = 'css/images/uploads/' .$changeFileName;
                move_uploaded_file($tempFileName, $destFileName); //move file from temporary location to desired new location
                // $criteria = [
				// 	'id' => $_POST['id'],
				// 	'title' => $_POST['title'],
				// 	'description' => $_POST['description'],
				// 	'date' => $_POST['date'],
				// 	'image' => $changeFileName
				// ];
				// $homePage-> save($criteria, 'id');
				// header('Location:?page=admin/updateHome&msg= Saved Successfully');

                $picExists = true;
                  
             } 
             else{
				header('Location:?page=admin/updateHome&msg=File too big'); 
                }
        }
        else{
			header('Location:?page=admin/updateHome&msg=Error uploading the file'); 
        }
	}
    else{
		header('Location:?page=admin/updateHome&msg=Invalid type of image');    
  	}
      //check if picture has been uploaded or not to decide whether to send image file name
      //to database 
    if ($picExists == true){
        $criteria = [
            	'id' => $_POST['id'],
            	'title' => $_POST['title'],
            	'description' => $_POST['description'],
            	'date' => $_POST['date'],
            	'image' => $changeFileName
            ];
            $homePage-> save($criteria, 'id');
            header('Location:?page=admin/updateHome&msg= Saved Successfully');
    }
    else{
        $criteria = [
            	'id' => $_POST['id'],
            	'title' => $_POST['title'],
            	'description' => $_POST['description'],
            	'date' => $_POST['date']
            ];
            $homePage-> save($criteria, 'id');
            header('Location:?page=admin/updateHome&msg= Saved Successfully');
    }
	
}
//set title of the page and load template for content
$title = 'Admin - Update Home Page';
$content = loadTemplate('../templates/admin/update-home-template.php', []);
?>