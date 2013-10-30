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


<?
  include 'phpAPI.php';
  $phpInit = new phpAPI();
  $phpInit->setBID();


?>

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
  			<li class="selected">
  				<a href="#about" class="selected notselected">About Band</a>
  			</li>
  			<li>
  				<a href="#pieces" class="notselected">Pieces</a>
  			</li>
  			<li>
  				<a href="#management" class="notselected">Band Management</a>
  			</li>
  			<li>
  				<a href="#events" class="notselected">Upcoming Events</a>
  			</li>
  			<li>
  				<a href="#members" class="notselected">Band Members</a>
  			</li>
  			<li>
  				<a href="#contact" class="notselected">Contact Information</a>
  			</li>
  		</ul>
  	</span>

  	<div class="band_pages">
  		<h2>My Bands</h2>
  		<ul>
          <?php
            $phpInit->getBands();
          ?>
  			<li>
          <FORM METHOD="LINK" ACTION="BandCreation.php">
            <INPUT TYPE="submit" VALUE="Create Band">
          </FORM>
  			</li>
  		</ul>
  	</div>

  	<div id="about" class="visible">
      <h2>About Band</h2>
      <?
        echo "<p>";
        $phpInit->getBandInfo();
        echo "</p>";
      ?>
  	</div>

  	<div id="pieces" class="hidden">
      <h2>View Band Pieces</h2>
  	</div>

  	<div id="management" class="hidden">
      <h2>Manage Band</h2>
      <form id="changeInfo" action = "changeAbout.php" method = "post">
          <textArea rows="4" cols="50" id="newInfo" name = "newInfo"/>
            <?
              $phpInit->getBandInfo();
            ?>
          </textarea>

          <input type="submit" name="changeAbout" id="changeAbout" value="Submit Changes"/>

      </form>

      <form id = "addMembers" action = "addMembers.php" method = "post">

        <ul class = "NewMembers">
          <li>
            <input type='text' name = 'newOne' id='newOne' placeholder="Enter Email address here" required/>
          </li>
          <li>
            <input type='text' name = 'newTwo' id='newTwo' placeholder="Enter Email address here" />
          </li>
          <li>
            <input type='text' name = 'newThree' id='newThree' placeholder="Enter Email address here" />
          </li>
          <li>
            <input type='text' name = 'newFour' id='newFour' placeholder="Enter Email address here" />
          </li>
          <li>
            <input type='text' name = 'newFive' id='newFive' placeholder="Enter Email address here" />
          </li>
          <li>
            <input type='text' name = 'newSix' id='newSix' placeholder="Enter Email address here" />
          </li>
          <li>
            <input type='text' name = 'newSeven' id='newSeven' placeholder="Enter Email address here" />
          </li>
          <li>
            <input type='text' name = 'newEight' id='newEight' placeholder="Enter Email address here" />
          </li>
          <li>
            <input type='text' name = 'newNine' id='newNine' placeholder="Enter Email address here" />
          </li>
          <li>
            <input type='text' name = 'newTen' id='newTen' placeholder="Enter Email address here" />
          </li>
      </ul>

        <input type="submit" name="addButton" id="addButton" value="Add Members"/>
      </form>
    </div>

  	<div id="events" class="hidden">
      <h2>View Upcoming Events</h2>
  	</div>

  	<div id="members" class="hidden">
      <h2>View/Edit Band Members</h2>

      <ul>
        <?
          $phpInit->getBandMembers();
        ?>
      </ul>
  	</div>

  	<div id="contact" class="hidden">
      <h2>Contact Information</h2>
  	</div>

  </body>