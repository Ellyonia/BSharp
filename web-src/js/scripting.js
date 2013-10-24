$(document).ready(function(){
	$('#signUp').click(checkMe);



});



function checkMe()
{
	if ($('#newPassword').val() == $('#reTypePassword').val())
	{
	  $('#setPassword').val($('#newPassword').val());
	  $('register').submit();
	}
	else
	{
		console.log("not matching");
	  	alert("Passwords do not match!");
	}
}

