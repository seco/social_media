<?php 


require_once "header.php";



//check for flash messages

	if(session::exist('account')) {

		?>

			<p class="success"><?php echo session::flash('account'); ?></p>

		<?php 
	}
//check if user has ssubmitted data


	if(input::exist()) {

		

		$login = $user->login(input::get('email'), input::get('password'));

		if($login) {

			redirect::to("timeline.php");
			
		} else {


			?>

			
				<p class="error">Invalid Username/Password combination</p>



			<?php
		}
	}

?>

<div class="container">

	<form action="" method='post' class='awesome-form'>
		<input type="text" name="email" placeholder="Enter Email Address" value= "<?php echo input::get('email') ?>">
		<input type="password" name="password" placeholder="Enter Password" value ="<?php echo input::get('password') ?>">
		<button type='submit' name='submit'>Login</button> <a href="create_account.php">Dont Have an Account?</a>
	</form>

</div>

<?php 



require_once "footer.php";


?>