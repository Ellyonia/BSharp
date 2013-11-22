$(document).ready(function(){
	

      window.fbAsyncInit = function() {
  FB.init({
    appId      : '501087379989764',  // Development
//  appId      : '551756141566063',  // Production
    status     : true,
    cookie     : true, 
    xfbml      : true  
  });
 
  FB.Event.subscribe('auth.authResponseChange', function(response) {
    if (response.status === 'connected') {
      FB.api('/me', function(response) {
        $.ajax({
        type: "POST",
        url: "checkFacebook.php",
        data: { "email":response.email, "fname":response.first_name, "lname":response.last_name },
        });
      });
    } else if (response.status === 'not_authorized') {
      FB.login();
    } else {
      FB.login();
    }
  });
  };

  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));
  $('#signUp2').click(checkPass);
  
  });



function checkPass()
{
	if ($('#newPassword').val() == $('#reTypePass').val())
	{
		var pass = $('#newPassword').val();
	 	$('#setPassword').val(pass);



	 	var reg = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).+$");

	 	if(reg.test(pass) === false){
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
