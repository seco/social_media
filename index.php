<?php 


require_once "header.php";


?>

<div class="container">
	

	<?php 


	//check if user has submitted any post

	if(input::exist()) {

		$validation = new Validation();

		$post = new Post();

		$fields = array(

			'user_id' => $user->data()->id,
			'post_file' => file::upload(input::get('file')),
			'caption' => input::get('caption'),
			"post_date" => date("Y-m-d H:i:s")
		);



		$post = $post->create_post($fields);

		if($post) {

			redirect::to('user_profile.php');
		}


	}


	if($user->logged_in()) {


		?>

		<div class="post-form">

			<form action="" method='post' class='post-form' enctype="multipart/form-data">
				<input type="file" name='file'>
				<input type="text" name='caption' placeholder="caption">
				<button type='submit' name='submit'>submit</button>

			</form>
		</div>


		<?php 


	} else {

		?>

		<h1>Escogram</h1>



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