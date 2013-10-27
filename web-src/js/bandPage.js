$(document).ready(function(){
	$('#navbar li').click(function(e){
		console.log(0);
		e.prevenDefault();
		var makeVis = $(e.target).children('a').eq(0).attr('href');
		//var makeVis = $(e.target + ' a').attr('href');
		console.log(1);
		$('visible').addClass('hidden');
		console.log(2);
		$('visible').removeClass('visible');
		console.log(3);
		$('#'+makeVis).addClass('visible');
		console.log(4);
	});


});