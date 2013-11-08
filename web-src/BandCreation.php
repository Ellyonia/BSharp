<!--
<?
/*
  session_start();
  if (!$_SESSION['uid'])
  {
    header("Location: index.php");
  }
  */
?>-->




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
          <input type='text' name = 'bandName' id='bandName' placeholder="Band Name" required/>
        </li>
  			<li>
  				<p>About Band</p>
  				<textArea rows="4" cols="50" placeholder="Enter Information about your Band" id="aboutBand" name = "aboutBand"  required/></textarea>
  			</li>
  			<li>
  				<p>Band Contact Info</p>
  				<input type='text' name = 'phone' id='phone' pattern="[0-9]{10,}" placeholder="Phone Number" required/>
  			</li>
  		</ol>

      <input type="submit" name="createBand" id="bandCreation" value="Create Band"/>

  	</form>



  </body>
</html>