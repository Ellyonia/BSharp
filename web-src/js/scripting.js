$(document).ready(function(){
	$('#signUp').click(checkMe);



});



function checkMe()
{
	if ($('#newPassword').val() == $('#reTypePass').val())
	{
	  $('#setPassword').val($('#newPassword').val());
	  console.log('#setPassword');
	  $('register').submit();
	}
	else
	{
		console.log("not matching");
	  	alert("Passwords do not match!");
	}
}

