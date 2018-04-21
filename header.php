<?php 

require_once "core/init.php";


$user = new User;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Social Media</title>
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src='js/jquery.js'></script>
	<script src='js/main.js'></script>
</head>
<body>


	<header class="main-header">

		<div class="container">

			<h1 class="logo"><a href="index.php">Logo</a></h1>

			<nav>

			
				<?php 

				if($user->logged_in()) {

					?>

					<a href="user_profile">Profile</a>
					<a href="notifications">Notifications</a>
					<a href="following.php">Following</a>
					<a href="followers.php">Followers</a>
					<a href="logout">Logout</a>
					<?php 
				} else {


					?>

					<a href="login.php">Login</a>
					<a href="create_account.php">SignUp</a>

					<?php 
				}


				?>
				

			</nav>

		</div>

	</header>
