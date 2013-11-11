<?
  include 'phpAPI.php';   
  $phpInit = new phpAPI();

  $phpInit->checkLoggedIn();


?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Set Parts</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src='js/BandCreation.js'></script>
  </head>

  <body>
  	<form id="setNames" action = "parts.php" method = "post">
  		<ol>

  		</ol>

      <input type="submit" name="setParts" id="setParts" value="Set Parts and Instruments"/>

  	</form>



  </body>
</html>