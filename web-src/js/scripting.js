$(document).ready(function(){
	$('#signUp').click(checkPass);

	$('#createBand').click(function(){

		window.confirm("Make a new Band?");
	})



});



function checkPass()
{
	if ($('#newPassword').val() == $('#reTypePass').val())
	{
		var pass = $('#newPassword').val();
	 	$('#setPassword').val(pass);
		$('.register').submit();
	}
	else
	{
		console.log("not matching");
	  	alert("Passwords do not match!");
	}
}

