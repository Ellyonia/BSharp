<?
  include 'phpAPI.php';   
  $phpInit = new phpAPI();

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
    <div id="top_bar">
  	  <h1>Welcome <? $phpInit-getfname() ?>!</h1>
      <a href="logout.php" id="logout">Log Out</a>
    </div>
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
