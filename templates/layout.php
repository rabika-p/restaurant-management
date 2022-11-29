
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
	<?php
	if(isset($_GET['page']) && ($_GET['page'] == 'admin/login')){
			echo '<link rel="stylesheet" type="text/css" href="../../css/styles.css">';
	}	
	else{
		echo '<link rel="stylesheet" type="text/css" href="../css/styles.css"> ';
	}
	?>
   
</head>
<body>
<header>
		<section>
			<aside>
				<h3>Opening times:</h3>
				<p>Sun-Thu: 12:00-22:00</p>
				<p>Fri-Sat: 12:00-23:30</p>
			</aside>
			<h1>Kate's Kitchen</h1>

		</section>
	</header>
	<?php
	$category = new DatabaseTable('category');
	$stmt = $category->findAll();
	
	?>				
			<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {}
			//check if the user is logged in or not, if not display login and customer
			// index options
			else{
				echo '<nav>
				<ul>';
				echo '<li><a href="index.php">Home</a></li>';
				echo '<li><a href="admin/login">Login </a></li>';
			?>
			<li>Menu
				<ul>
				<?php
				foreach ($stmt as $row) {
					echo '<li> <a href="categories&cId='.$row['id'] .'">' .$row['name'] .'</a> </li>';	
				}
				?>	 
				</ul>
			</li>
			<li><a href="about">About Us</a></li>
			<li><a href="faqs">FAQs</a></li>
			<li><a href="book">Book A Table</a></li>
			
		</ul>
	</nav>
	<?php
	if(isset($_GET['page']) && ($_GET['page'] == 'admin/login')){
			echo '<img src="../../css/images/randombanner.php"/> ';
	}
	else{
		echo '<img src="../css/images/randombanner.php"/> ';
		}
	} ?>


 <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	?>
	<link rel="stylesheet" type="text/css" href="../../css/styles.css"> 
	<img src="../../css/images/randombanner.php"/>
	<?php 
	//to check if the staff that is logged in is the main admin
	$admin = false;
	$user = new DatabaseTable('user');
	$stmt = $user->findWhere('mainAdmin', '1', 'username' , $_SESSION['username']);
	$row = $stmt->fetch();

	if($stmt->rowcount() ==1) //if the record is unique
    {
		$admin = true;
	}
	?>

	<main class="sidebar">
		<section class="left">
			<ul>
				<li><a href="displayDish">Menu</a></li>
				<li><a href="displayCategory">Categories</a></li>
				<li><a href="manageReview">Manage reviews</a></li>
				<li><a href="manageBooking">Manage bookings</a></li>
				<?php 
				//managing staff accounts can only be done by the main admins
				if ($admin == true){?>
				<li><a href="displayStaffAccount">Manage Staff Accounts</a></li>
				<?php } ?>
				<li><a href="updateHome">Manage Home Page</a></li>
				<li><a href="logout">Logout</a></li>

			</ul>
		</section>

		<section class="right">
		<?php echo $content; ?>
		</section>
	</main>
	<?php }
		
	else{
		echo '<main>'
		 		.$content
			.'</main>';
	}?>

	<!-- displays current year with the copyright notice in the footer -->
	<footer>
		<p> &copy; Kate's Kitchen <?php echo date('Y'); ?> </p> 
	</footer>
    
</body>
</html>