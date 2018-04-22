<?php 


require_once "header.php";


?>

<div class="container">
	

	<?php 


	//check if user has submitted any post

	if(input::exist()) {



		$login = $user->login(input::get('email'), input::get('password'));

		if($login) {

			redirect::to('timeline.php');
		} else {


			?>

					<p class="error">Invalid username/password Combination</p>

			<?php 
		}
	}


	if($user->logged_in()) {


		redirect::to('timeline.php');

	} else {

		?>

		<h1 class='title'>Escogram</h1>



		<form action="" method='post' class='awesome-form'>

			<input type="text" name='email' placeholder='Email' >
			<input type="password" name='password' placeholder='password'>
			<button name='login' type='submit'>Login</button>

		</form>

		<?php 
	}

	?>

	



</div>


<?php 


require_once "footer.php";

?>