<?php
	include 'phpAPI.php';
	include 'facebook.php';
	
	$phpInit = new phpAPI();
	
	$facebook = new Facebook(array(
        	'appId' => 501087379989764,
        	'secret' => '90553cdeebdd0ca0027de916b6adcb86'));
        	
        $user = $facebook->getUser();
        
        if ($user) {
		try {
        		$user_profile = $facebook->api('/me');
		} catch (FacebookApiException $e) {
        		$user = null;
		}
    	}
    	
    	if ($user) { // User is logged in successfully
		$params = array (
  		access_token => ''. getAccessToken() .'',
  		);
  		$logoutUrl = $facebook->getLogoutUrl($params);
  		phpAPI->checkFacebook($user_profile['email'],$user_profile['first_name'],$user_profile['last_name']);
	} else {  // User is not logged in
		$params = array(
  		scope => 'email',
  		//redirect_uri => $url
  		);
  		$loginUrl = $facebook->getLoginUrl($params);
	}
?>
