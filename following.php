<?php 


require_once "header.php";


?>


<section id="following">

	<div class="container">
		
		<h1 class="title">Following</h1>

		<?php 


		$following = $user->get_following($user->data()->id);

		if($following) {

			foreach($following as $follow) {

				?>

				<div class="thumb-wrapper">


					<div class="face" style='background-image: url(uploads/default.jpg)'></div>


					<div class="content">

						<p class="name"><?php echo $follow->first_name ?></p>
						<a href="view_user.php?user_id=<?php echo $follow->id; ?>">View</a>
					</div>

				</div>		


				<?php 
			}
		}


		?>

	</div>


</section>

<?php 


require_once "footer.php";



?>