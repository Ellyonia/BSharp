$(document).ready(function(){
	$('#navbar li').click(function(e){
		console.log(e.target);
		//e.prevenDefault();
		var makeVis = $(e.target).first().attr('href');
		if(typeof makeVis === 'undefined'){
			makeVis = $(e.target + ' a').first().attr('href');
		}
		$('.visible').addClass('hidden');
		$('.visible').removeClass('visible');
		//$('.selected').css({"background-color": "#181818"});
		$.when($('.selected').removeClass('selected')).done(function(){
		$(makeVis).addClass('visible');
		$(e.target).addClass('selected');
	});

});
});