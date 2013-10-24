$(document).ready(function(){
	$('#signUp').click(checkMe);



});



function checkMe()
{
  if ($('register #newPassword').val() == $('register #reTypePassword').val())
  {
    $('register #setPassword').val()=$('register #newPassword').val();
    $('register').submit();
  }
  else
    alert("Passwords do not match!");
}

