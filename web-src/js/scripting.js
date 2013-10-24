$(document).ready(function(){
	$('#signUp').click(checkMe);



});



function checkMe()
{
  if (document.register.newPassword.value == document.register.reTypePass.value)
  {
    document.register.setPassword.value=document.register.newPassword.value;
    document.register.submit();
  }
  else
    alert("Passwords do not match!");
}

