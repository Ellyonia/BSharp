$(document).ready(function(){
	$('#signUp').click(checkPass);


});



function checkPass()
{
	if ($('#newPassword').val() == $('#reTypePass').val())
	{
		var pass = $('#newPassword').val();
	 	$('#setPassword').val(pass);



	 	var reg = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).+$");

	 	if($(reg.test('#newPassword').val()) === false){
	 		alert("Please make sure your password contains at least: 1 Capital Letter, 1 Lowercase Letter, and 1 Number");
	 	}
	 	else{
			$('.register').submit();
		}


	}
	else
	{
		console.log("not matching");
	  	alert("Passwords do not match!");
	}
}
