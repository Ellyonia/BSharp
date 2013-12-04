<?
  include 'phpAPI.php';   
  $phpInit = new phpAPI();

  $phpInit->checkLoggedIn();


?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Band Creation</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src='js/BandCreation.js'></script>
  </head>

  <body>
  	<form id="makeBand" action = "makeBand.php" method = "post">
  		<ol>
        <li>
          <p>Band Name</p>
          <input type='text' name = 'bandName' maxlength="45" pattern="[A-Za-z0-9!2#$%^&*()][A-Za-z0-9!@#$%^&*()\s]*[A-Za-z0-9!@#$%^&*()]|[A-Za-z0-9!@#$%^&*()]" id='bandName' placeholder="Band Name" oninvalid="setCustomValidity('Sorry spaces are not allowed as the first or last character')" onchange="try{setCustomValidity('')}catch(e){}" required/>
        </li>
  			<li>
  				<p>About Band</p>
  				<textArea rows="4" cols="50" maxlength="2000" placeholder="Enter Information about your Band" id="aboutBand" name = "aboutBand"  required/></textarea>
  			</li>
  			<li>
  				<p>Band Contact Info</p>
  				<input type='text' name = 'phone' id='phone' pattern="[0-9-]{10,13}" placeholder="Phone Number" oninvalid="setCustomValidity('Please enter only numbers or dashes with only 10 numbers')" onchange="try{setCustomValidity('')}catch(e){}" required/>
  			</li>
  		</ol>

      <input type="submit" name="createBand" id="bandCreation" value="Create Band"/>

  	</form>



  </body>
</html>