$(function(){

	profile_click();

	search();
});



function profile_click() {

	$('.user-face').on('click', function (){


		$('.upload').toggleClass('active');
	});

	$('.close').on('click', function(){

		$('.upload').removeClass('active');
	})


}

function search() {



	$('#user_search').on('keyup', function (){

		var user_search = $('#user_search').val();


		$.post('search_results.php', {

			search: user_search

		}, function (data){

			$("#result").html(data);
		});
	});

}