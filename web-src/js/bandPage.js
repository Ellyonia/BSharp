$(document).ready(function(){
	$('#navbar li').click(function(e){
		console.log(e.target);
		//e.prevenDefault();
		var makeVis = $(e.target).first().attr('href');
		//var makeVis = $(e.target + ' a').attr('href');
		console.log(makeVis);
		$('.visible').addClass('hidden');
		$('.visible').removeClass('visible');
		//$('.selected').css({"background-color": "#181818"});
		$.when($('.selected').removeClass('selected')).then(function(){
		$(makeVis).addClass('visible');
		$(e.target).addClass('selected');
	});

});
});