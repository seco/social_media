$(function(){

	profile_click();
});



function profile_click() {

	$('.user-face').on('click', function (){


		$('.upload').toggleClass('active');
	});

	$('.close').on('click', function(){

		$('.upload').removeClass('active');
	})


}