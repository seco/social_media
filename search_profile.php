<?php 


require_once "header.php";


	//check if user is logged in

if(!$user->logged_in()) {

	redirect::to('login.php');
}


	//check if there is a user_id

if(!$user_id = input::get('user_id')) {

	redirect::to('timeline.php');
}



$search_data = $user->get_user_profile(input::get('user_id'));

if($search_data) {


	$search_path = "uploads/default.jpg";

	if($search_data->profile_status) {

		$profile_pic = $user->get_profile_picture($search_data->id);

		$search_path = "uploads/".$profile_pic;
	}


	?>


	<?php 

	if(input::exist()) {



		$fields = array(

			'user_id' => input::get('person_id'),
			'follower_id' => input::get('follower_id')

		);

		$follow = $user->follow($fields);

		if($follow) {

			redirect::to('user_profile.php');
		} else {

			?>

			<p class="error">There was a problem following user please check later</p>

			<?php 
		}
	}


	?>


	<div class="search-profile">

		<div class="face" style="background-image: url(<?php echo $search_path; ?>);"></div>

		<div class="content">

			<p class="name"><?php echo $search_data->first_name." ".$search_data->last_name; ?></p>


			<?php 

			$check_fields = array(

				'user_id' => $user->data()->id,
				'follower_id' => $search_data->id
			);

			if($user->check_follow($check_fields)) {

				?>

					<a href="unfollow.php">Unfollow</a>

				<?php 
			} else {

				?>

				<form action="" method="post">
					<input type="hidden" name="person_id" value= "<?php echo $user->data()->id; ?>">
					<input type="hidden" name='follower_id' value = "<?php echo $search_data->id; ?>"> 
					<button type='submit' name='submit'>Follow</button>
				</form>

				<?php 
			}

			?>

		</div>

	</div>
	<?php 
} else {

	echo "user not found";
}


?>


<?php 


require_once "footer.php";

?>