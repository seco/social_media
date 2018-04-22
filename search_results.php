<?php 

		require_once "core/init.php";


		$search = input::get('search');

		$user = new User;
		$results = $user->search($search);

		
 ?>


<div class="search-results">
	
	<div class="container">

		<div class="thumb-wrapper">
			
			<?php 


					if($results) {

						//var_dump($results);

						foreach($results as $result) {


							$profile_path = "uploads/default.jpg";

							if($result->profile_status) {

								$profile_picture = $user->get_profile_picture($result->id);

								$profile_path = "uploads/".$profile_picture;


							}


							?>
				
								<a  href='search_profile.php?user_id=<?php echo $result->id ?>'class="thumb-unit">
									
									<div class="face" style='background-image: url(<?php echo $profile_path ?>)'>
										
									</div>


									<div class="content">
										
										<p class="name"><?php echo $result->first_name." ".$result->last_name; ?></p>
									</div>
								</a>
	
							<?php 
						}
					}

			 ?>


			 </div>

	</div>
</div>