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
    <title>Welcome!</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src='js/bandPage.js'></script> 
  </head>

  <body>
  	<h1>Welcome to the band front page</h1>
    <img src="img/logo.png" id = "logo" alt = "Custom Cupcake Logo">
    <a href="logout.php">Log Out</a>
  	<span id="navbar">
  		<ul>
  			<li>
  				<a href="#about">About Band</a>
  			</li>
  			<li>
  				<a href="#Pieces">Pieces</a>
  			</li>
  			<li>
  				<a href="#management">Band Management</a>
  			</li>
  			<li>
  				<a href="#events">Upcoming Events</a>
  			</li>
  			<li>
  				<a href="#members">Band Members</a>
  			</li>
  			<li>
  				<a href="#contact">Contact Information</a>
  			</li>
  		</ul>
  	</span>
  	<div class="band_pages">
  		<h2>My Bands</h2>
  		<ul>
  			<li>
  			</li>
  		</ul>
  	</div>
  	<div id="about" class="visible">
      <h2>About Band</h2>
      <p>This is the greatest and best band in the world. All other bands are shit.</p>
  	</div>
  	<div id="pieces" class="hidden">
      <h2>View Band Pieces</h2>
  	</div>
  	<div id="management" class="hidden">
      <h2>Manage Band</h2>
      <form id="band_info" action = "editInfo.php" method = "post">
        <div class="editInfo">
          <textArea rows="4" cols="50" placeholder="Edit Information about your Band" id="aboutBand" name = "aboutBand"/> 
            <?
            include 'phpAPI.php';
            $phpInit = new phpAPI();
            $phpInit->getBandInfo();


            ?>
          </textarea>

        </div>
      </form>
      <!--<p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.""Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.""Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
  	 -->
    </div>
  	<div id="events" class="hidden">
      <h2>View Upcoming Events</h2>
  	</div>
  	<div id="members" class="hidden">
      <h2>View/Edit Band Members</h2>
  	</div>
  	<div id="contact" class="hidden">
      <h2>Contact Information</h2>
  	</div>
  </body>