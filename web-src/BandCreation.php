


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Band Creation</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src='js/scripting.js'></script>
  </head>

  <body>
  	<form id="makeBand" action = "makeBand.php" method = "post">
  		<ol>
        <li>
          Band Name
          <input type='text' name = 'bName' id='bName' placeholder="Band Name" required/>
        </li>
  			<li>
  				About Band
  				<textArea rows="4" cols="50" placeholder="Enter Information about your Band" id="aboutBand" name = "aboutBand"  required/></textarea>
  			</li>
  			<li>
  				Band Contact Info
  				<input type='text' name = 'phone' id='phone' placeholder="Phone Number" required/>
  			</li>
  		</ol>


  	</form>



  </body>
</html>