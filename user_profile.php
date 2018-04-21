<?php 


require_once "header.php";

?>





<?php 


if(!$user->logged_in()) {

	redirect::to('login.php');

}




	//check if user has submitted data


	if(input::exist()) {

		$file = input::get('file');
		$profile_update = $user->update_profile($file);

		if($profile_update) {

			?>
			
				<p class="success">Profile Successfully updated</p>

			<?php
		}
	}

?>





<section id="user_profile">


<div class="container">
	

	<div class="profile">

		<?php 

				$profile = 'uploads/default.jpg';

				$profile_status = $user->data()->profile_status;

				if($profile_status) {

					$profile = "uploads/".$user->get_profile_picture();

					//echo $profile;

				
				}


		 ?>

		<div class="user-face" style="background-image: url(<?php echo $profile; ?>)"></div>

		<div class="content">
			<div class="desc-wrapper">
				<p class="name"><?php echo $user->data()->first_name." ".$user->data()->last_name; ?></p>
				<a href="edit" class='edit'>Edit Profile</a>
			</div>

			<div class="post-wrapper">

				<p class="post"><span>10</span>post</p>
				<p class="post"><span>48</span>Followers</p>
				<p class="post"><span>11</span>Following</p>


			</div>

		</div>

	</div> <!--====  end Profile=======-->


	<div class="upload">

		<div class="wrapper">
			<div class="close"><i class="fa fa-close"></i></div>


			<form action="" method='post' class='form-upload' enctype="multipart/form-data">
				<input type="file" name='file'>
				<button type='submit' name='submit'>save</button>
			</form>

		</div>

	</div>


	<div class="post-wrapper">

		<?php 

			$posts = new Post($user->data()->id);

			if($posts->exist()) {

				foreach($posts->data() as $data) {

				

					?>
						
						<a class="post" style='background-image: url(uploads/<?php echo $data->post_file ?>)' href='view_post?post_id=<?php echo $data->id; ?>'></a>

					<?php 
				}
			} else {

				echo "You have not submitted any post";
			}


		 ?>
		
		
	</div>


	</div>
	
</section>

<?php 


require_once "footer.php";


?>