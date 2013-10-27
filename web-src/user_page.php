
<!--
<?php
  /*
    session_start();

    $phpInit = new phpAPI();
    $phpInit->getBands();
*/


?>

-->

            <?php
              session_start();
              $query = mysql_query("SELECT Band.band_name, Band.band_id from BandsIn INNER JOIN Band ON BandsIn.band_id=Band.band_id where BandsIn.user_id = 1");
              echo "test";
              while ($temp = mysql_fetch_assoc($query)) {
                  echo "<a href=band_page.php>" . $temp['band_name'] . $temp['band_id'] . "</a>";

              }

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
  	<h1>User Home</h1>

  	<div class="band_pages">
  		<h2>My Bands</h2>
  		<ul>
  			<li>
          <FORM METHOD="LINK" ACTION="BandCreation.php">

            <INPUT TYPE="submit" VALUE="Create Band">
          </FORM>
          <!--
          <input type="button" id="createBand" name="createBand" value="Create Band"/>-->
  			</li>
  		</ul>
  </body>