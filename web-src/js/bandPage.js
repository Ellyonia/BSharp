$(document).ready(function(){
	$('#navbar li').click(function(e){
		//console.log(e.target);
		//e.prevenDefault();
		var makeVis = $(e.target).first().attr('href');
		if(typeof makeVis === 'undefined'){
			makeVis = $(e.target).children().first().attr('href');
		}
		$('.visible').addClass('hidden');
		$('.visible').removeClass('visible');
		//$('.selected').css({"background-color": "#181818"});
		$.when($('.selected').removeClass('selected')).done(function(){
		$(makeVis).addClass('visible');
		$(e.target).addClass('selected');
		if ($(e.target).children().length > 0 ) {
			$(e.target).children().addClass('selected');
		}
		else {
			$(e.target).parent().addClass('selected');
		}
	});




});


});

	function otherOpt(val){
	 var element=document.getElementById('oInstrument');
	 if(val=='Other')
	   element.style.display='block';
	 else  
	   element.style.display='none';
	}

	function partOther(val){
		var element = $('*[id*=oInstrumentFile]');


		$("*[id*=oInstrumentFile][value='Other']").show();
		/*

	 //var element=document.getElementById('oInstrumentFile');
	 if(val=='Other'){
	 	$('*[id*=oInstrumentFile]').css("display", "block");
	 	//element.style.display='block';
	 }
	   
	 else{
	 	$('*[id*=oInstrumentFile]').css("display", "none");
	 	//element.style.display='none';
	 }
	   */
	}