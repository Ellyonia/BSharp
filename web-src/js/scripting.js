$(document).ready(function(){
	$('#signUp').click(checkMe);



});



function checkMe()
{
	if ($('#newPassword').val() == $('#reTypePass').val())
	{
		var pass = $('#newPassword').text();
	 	$('#setPassword').val(pass);
		console.log(pass);
		$('register').submit();
	}
	else
	{
		console.log("not matching");
	  	alert("Passwords do not match!");
	}
}

