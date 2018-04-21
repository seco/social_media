<?php 



	require_once "header.php";



 ?>

		
		<section id="register">
			
	
				<div class="container">
					


						<h1 class="title">Create Account</h1>


						<?php 

								//check if user has submitted data

								if(input::exist()) {


									$validation = new Validation;

									$fields = array(


											'first_name' => array(

												'required' => true
											),


											'last_name' => array(

												'required' => true

											),

											'email' => array(

												'required' => true,
												'unique' => 'users'

											)

									);

									$check = $validation->check($_POST, $fields);

									if($check->passed()) {


										$fields = array(

											'first_name' => input::get('first_name'),
											'last_name' => input::get('last_name'),
											'email' => input::get('email'),
											'username' => input::get('username'),
											'password' => input::get('password'),
											'salt' => "salt",
											'joined' => date("Y-m-d H:i:s")
										);

										$account = $user->create_account($fields);

										if($account) {

											redirect::to('login.php');
										} else {

											?>

							<p class="error">There was a problem creating account</p>

											<?php 
										}

									} else {


										foreach($check->errors() as $error) {

											?>
												<p class="error"><?php echo $error; ?></p>
											<?php
										}
									}
								}
						 ?>

						<form action="" method='post' class='awesome-form'>
								
								<input type="text" name="first_name" placeholder='First Name' value="<?php echo input::get('first_name'); ?>">
								<input type="text" name='last_name' placeholder="Last Name" value='<?php echo input::get('last_name'); ?>'>

								<input type="text" name='email' placeholder='Email Address' value="<?php echo input::get('email'); ?>">

								<input type="text" name='username' placeholder="Username" value="<?php echo input::get("username"); ?>">
								<input type="text" name='password' placeholder="Password" value="<?php echo input::get("password"); ?>">
	

						<button type='submit' name='submit'>Create Account</button>


						</form>


				</div>


		</section>



 <?php 

 	require_once "footer.php";

  ?>