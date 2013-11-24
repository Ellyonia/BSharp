<?php
	include 'phpAPI.php';
	echo "Hello0";
	include 'facebook.php';
	echo "Hello1";
	$phpInit = new phpAPI();
	echo "Hello2";
	$facebook = new Facebook(array(
        	'appId' => 501087379989764,
        	'secret' => '90553cdeebdd0ca0027de916b6adcb86'));
        echo "Hello3";	
        $user = $facebook->getUser();
        echo "Hello4";
        if ($user) {
		try {
        		$user_profile = $facebook->api('/me');
		} catch (FacebookApiException $e) {
        		$user = null;
		}
    	}
    	echo "Hello5";
    	if ($user) { // User is logged in successfully
    		echo "Hello6a";
		$params = array (
  		'access_token' => ''. getAccessToken() .'',
  		);
  		$logoutUrl = $facebook->getLogoutUrl($params);
  		$phpInit->checkFacebook($user_profile['email'],$user_profile['first_name'],$user_profile['last_name']);
	} else {  // User is not logged in
		echo "Hello6b";
		$params = array(
  			'scope' => 'email',
  			'redirect_uri' => "http://ec2-54-200-98-78.us-west-2.compute.amazonaws.com/DB-GUI/web-src/checkFacebook.php"
  			//'redirect_uri' => "http://www.bsharp.tk/DB-GUI/web_src/checkFacebook.php"
  			);
  		header('Location:'.$facebook->getLoginUrl($params));
	}
?>
