<?php 

	
	require_once "header.php";



	if(input::exist()) {

			$fields = array(

				'first_name' => input::get("first_name"),
				'last_name' => input::get("last_name"),
				'email' => input::get('email')

			);

			$account_update =  $user->update_account($fields);

			if($account_update) {

				redirect::to('user_profile.php');
			}


	}

 ?>



	<section id="edit">
		
		<div class="container">
			
			<h1 class="title">Edit Profile</h1>
			<form action="" class="awesome-form" method='post'>
				<input type="text" name='first_name' value = '<?php echo $user->data()->first_name; ?>'>
				<input type="text" name='last_name' value = '<?php echo $user->data()->last_name ?>'>
				<input type="text" name='email' value = '<?php echo $user->data()->email; ?>'>
				<button type='submit' name='submit'>Save Changes</button>
			</form>
		</div>
	</section>

 <?php 


 		require_once "footer.php";

  ?>