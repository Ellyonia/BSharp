<?
  include 'phpAPI.php';   
  $phpInit = new phpAPI();

  try{
    include_once "./facebook-php-sdk/src/facebook.php";
  }
  catch(Exception $o){
      
  }
  if (isset($_POST['fb'])) {
    // Get information from fb
    // Check database with fb information
    // If exists, set session.
    // else, add to database
    // then set session
    //APP_ID = "501087379989764"
    //APP_SECRET = "90553cdeebdd0ca0027de916b6adcb86"
    // initialize facebook
 $facebook = new Facebook(array(
        'appId' => "501087379989764",
        'secret' => "90553cdeebdd0ca0027de916b6adcb86"));

 $session = $facebook->getSession();
 if ($session) {
 try {
    $fbme = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
  }
}
else
{
  echo "You are NOT Logged in";
}

//getting the login page if not signned in
if (!$fbme) {
  $loginUrl = $facebook->getLoginUrl(array('canvas' => 1,
                                      'fbconnect' => 0,
                                      'req_perms' =>                   'email,user_birthday,publish_stream',
                                      'next' => CANVAS_PAGE,
                                      'cancel_url' => CANVAS_PAGE ));
 echo '<fb:redirect url="' . $loginUrl . '" />';
 } else {

      // $fbme is valid i.e. user can access our app
     echo "You can use this App";
 }

 // getting the profile data
 $user_id = $fbme[id];
 $name=$fbme['name'];
 $first_name=$fbme['first_name'];
 $last_name=$fbme['last_name'];
 $facebook_url=$fbme['link'];
 $location=$fbme['location']['name'];
 $bio_info=$fbme['bio'];
 $work_array=$fbme['work'];
 $education_array=$fbme["education"];
 $email=$fbme['email'];
 $date_of_birth=$fbme['birthday'];
 $_SESSION['uid'] = 2;
  }
  $phpInit->checkLoggedIn();



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Welcome to B#</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src='js/Users.js'></script>
  </head>
  <body>
  	<h1>Welcome User!</h1>
    <a href="logout.php">Log Out</a>
  	<div class="bands">
  		<h2>My Bands</h2>
  		<ul>
        <li>
            <?php

                $phpInit->getBands();
            ?>
        </li>
  			<li>
          <FORM METHOD="LINK" ACTION="BandCreation.php" id="createBand">
            <INPUT TYPE="submit" VALUE="Create Band">
          </FORM>
          <!--
          <input type="button" id="createBand" name="createBand" value="Create Band"/>-->
  			</li>

  		</ul>
      <ul>
        <?
          $phpInit->getBandsAllowed();
        ?>
      </ul>
  </body>