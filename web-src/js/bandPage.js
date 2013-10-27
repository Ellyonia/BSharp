$(document).ready(function(){
	$('#navbar li').click(function(e){
		log(0);
		e.prevenDefault();
		var makeVis = $(e.target + ' a').attr('href');
		log(1);
		$('visible').addClass('hidden');
		log(2);
		$('visible').removeClass('visible');
		log(3);
		$('#'+makeVis).addClass('visible');
		log(4);
	});


});