$(document).ready(function(){
	$('#navbar li').click(function(e){
		console.log(e.target);
		//e.prevenDefault();
		var makeVis = $(e.target).first().attr('href');
		//var makeVis = $(e.target + ' a').attr('href');
		console.log(makeVis);
		$('.visible').addClass('hidden');
		console.log(2);
		$('.visible').removeClass('visible');
		console.log(3);
		$(makeVis).addClass('visible');
		console.log(4);
	});


});