$(document).ready(function(){
	$('#signUp').click(checkPass);


});



function checkPass()
{
	if ($('#newPassword').val() == $('#reTypePass').val())
	{
		var pass = $('#newPassword').val();
	 	$('#setPassword').val(pass);



	 	var reg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;

	 	if($('#newPassword').val().search(reg) == -1){
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
