$(document).ready(function(){
	$('#navbar li').click(function(e){
		var makeVis = $(e.target + ' a').attr('href');
		$('visible').addClass('hidden');
		$('visible').removeClass('visible');
		$('#'+makeVis).addClass('visible');
	});


});