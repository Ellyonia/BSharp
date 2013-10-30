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


  if(isset($_POST['addButton'])){
    $members = array($_POST['newOne'], $_POST['newTwo'], $_POST['newThree'], $_POST['newFour'], $_POST['newFive'], $_POST['newSix'], $_POST['newSeven'], $_POST['newEight'], $_POST['newNine'], $_POST['newTen']);
    $dirFlags = array($_POST['dir1'], $_POST['dir2'], $_POST['dir3'], $_POST['dir4'], $_POST['dir5'], $_POST['dir6'], $_POST['dir7'], $_POST['dir8'], $_POST['dir9'], $_POST['dir10']);

    $_SESSION['newMembers'] = $members;
    $_SESSION['dirFlags'] = $dirFlags;

  }


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
            <select>
              <optgroup label = "Woodwinds">
                <option>Piccolo</option>
                <option>Flute</option>
                <option>Oboe</option>
                <option>Bassoon</option>
                <option>Clarinet</option>
                <option>Bass Clarinet</option>
                <option>Alto Saxophone</option>
                <option>Tenor Saxaphone</option>
                <option>Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option>Trumpet</option>
                <option>Horns</option>
                <option>Tenor Trombones</option>
                <option>Bass Trombone</option>
                <option>Baritone Horn/Euphonium</option>
                <option>Tuba</option>
              </optgroup>

              <optgroup labe;l="Percussion">
                <option>Snare Drum</option>
                <option>Bass Drum</option>
                <option>Cymbals</option>
                <option>Tam-Tam</option>
                <option>Triangle</option>
                <option>Tambourine</option>
                <option>Wood Blocks/Temple Blocks</option>
                <option>Tom-Tom</option>
                <option>Bongos</option>
                <option>Congas</option>
                <option>Claves</option>
                <option>Drum Kit</option>
                <option>Timpani</option>
                <option>Glockenspiel</option>
                <option>Xylophone</option>
                <option>Marimba</option>
                <option>Crotales</option>
                <option>Vibraphone</option>
                <option>Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option>Piano</option>
                <option>Celesta</option>
                <option>Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option>Harp</option>
                <option>Violoncello</option>
                <option>Double Bass</option>
              </optgroup>
              
            </select>
            <label><input type="checkbox" name="dir1" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'newTwo' id='newTwo' placeholder="Enter Email address here" />
                        <select>
              <optgroup label = "Woodwinds">
                <option>Piccolo</option>
                <option>Flute</option>
                <option>Oboe</option>
                <option>Bassoon</option>
                <option>Clarinet</option>
                <option>Bass Clarinet</option>
                <option>Alto Saxophone</option>
                <option>Tenor Saxaphone</option>
                <option>Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option>Trumpet</option>
                <option>Horns</option>
                <option>Tenor Trombones</option>
                <option>Bass Trombone</option>
                <option>Baritone Horn/Euphonium</option>
                <option>Tuba</option>
              </optgroup>

              <optgroup labe;l="Percussion">
                <option>Snare Drum</option>
                <option>Bass Drum</option>
                <option>Cymbals</option>
                <option>Tam-Tam</option>
                <option>Triangle</option>
                <option>Tambourine</option>
                <option>Wood Blocks/Temple Blocks</option>
                <option>Tom-Tom</option>
                <option>Bongos</option>
                <option>Congas</option>
                <option>Claves</option>
                <option>Drum Kit</option>
                <option>Timpani</option>
                <option>Glockenspiel</option>
                <option>Xylophone</option>
                <option>Marimba</option>
                <option>Crotales</option>
                <option>Vibraphone</option>
                <option>Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option>Piano</option>
                <option>Celesta</option>
                <option>Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option>Harp</option>
                <option>Violoncello</option>
                <option>Double Bass</option>
              </optgroup>
              
            </select>
            <label><input type="checkbox" name="dir2" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'newThree' id='newThree' placeholder="Enter Email address here" />
                        <select>
              <optgroup label = "Woodwinds">
                <option>Piccolo</option>
                <option>Flute</option>
                <option>Oboe</option>
                <option>Bassoon</option>
                <option>Clarinet</option>
                <option>Bass Clarinet</option>
                <option>Alto Saxophone</option>
                <option>Tenor Saxaphone</option>
                <option>Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option>Trumpet</option>
                <option>Horns</option>
                <option>Tenor Trombones</option>
                <option>Bass Trombone</option>
                <option>Baritone Horn/Euphonium</option>
                <option>Tuba</option>
              </optgroup>

              <optgroup labe;l="Percussion">
                <option>Snare Drum</option>
                <option>Bass Drum</option>
                <option>Cymbals</option>
                <option>Tam-Tam</option>
                <option>Triangle</option>
                <option>Tambourine</option>
                <option>Wood Blocks/Temple Blocks</option>
                <option>Tom-Tom</option>
                <option>Bongos</option>
                <option>Congas</option>
                <option>Claves</option>
                <option>Drum Kit</option>
                <option>Timpani</option>
                <option>Glockenspiel</option>
                <option>Xylophone</option>
                <option>Marimba</option>
                <option>Crotales</option>
                <option>Vibraphone</option>
                <option>Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option>Piano</option>
                <option>Celesta</option>
                <option>Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option>Harp</option>
                <option>Violoncello</option>
                <option>Double Bass</option>
              </optgroup>
              
            </select>
            <label><input type="checkbox" name="dir3" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'newFour' id='newFour' placeholder="Enter Email address here" />
                        <select>
              <optgroup label = "Woodwinds">
                <option>Piccolo</option>
                <option>Flute</option>
                <option>Oboe</option>
                <option>Bassoon</option>
                <option>Clarinet</option>
                <option>Bass Clarinet</option>
                <option>Alto Saxophone</option>
                <option>Tenor Saxaphone</option>
                <option>Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option>Trumpet</option>
                <option>Horns</option>
                <option>Tenor Trombones</option>
                <option>Bass Trombone</option>
                <option>Baritone Horn/Euphonium</option>
                <option>Tuba</option>
              </optgroup>

              <optgroup labe;l="Percussion">
                <option>Snare Drum</option>
                <option>Bass Drum</option>
                <option>Cymbals</option>
                <option>Tam-Tam</option>
                <option>Triangle</option>
                <option>Tambourine</option>
                <option>Wood Blocks/Temple Blocks</option>
                <option>Tom-Tom</option>
                <option>Bongos</option>
                <option>Congas</option>
                <option>Claves</option>
                <option>Drum Kit</option>
                <option>Timpani</option>
                <option>Glockenspiel</option>
                <option>Xylophone</option>
                <option>Marimba</option>
                <option>Crotales</option>
                <option>Vibraphone</option>
                <option>Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option>Piano</option>
                <option>Celesta</option>
                <option>Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option>Harp</option>
                <option>Violoncello</option>
                <option>Double Bass</option>
              </optgroup>
              
            </select>
            <label><input type="checkbox" name="dir4" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'newFive' id='newFive' placeholder="Enter Email address here" />
                        <select>
              <optgroup label = "Woodwinds">
                <option>Piccolo</option>
                <option>Flute</option>
                <option>Oboe</option>
                <option>Bassoon</option>
                <option>Clarinet</option>
                <option>Bass Clarinet</option>
                <option>Alto Saxophone</option>
                <option>Tenor Saxaphone</option>
                <option>Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option>Trumpet</option>
                <option>Horns</option>
                <option>Tenor Trombones</option>
                <option>Bass Trombone</option>
                <option>Baritone Horn/Euphonium</option>
                <option>Tuba</option>
              </optgroup>

              <optgroup labe;l="Percussion">
                <option>Snare Drum</option>
                <option>Bass Drum</option>
                <option>Cymbals</option>
                <option>Tam-Tam</option>
                <option>Triangle</option>
                <option>Tambourine</option>
                <option>Wood Blocks/Temple Blocks</option>
                <option>Tom-Tom</option>
                <option>Bongos</option>
                <option>Congas</option>
                <option>Claves</option>
                <option>Drum Kit</option>
                <option>Timpani</option>
                <option>Glockenspiel</option>
                <option>Xylophone</option>
                <option>Marimba</option>
                <option>Crotales</option>
                <option>Vibraphone</option>
                <option>Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option>Piano</option>
                <option>Celesta</option>
                <option>Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option>Harp</option>
                <option>Violoncello</option>
                <option>Double Bass</option>
              </optgroup>
              
            </select>
            <label><input type="checkbox" name="dir5" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'newSix' id='newSix' placeholder="Enter Email address here" />
                        <select>
              <optgroup label = "Woodwinds">
                <option>Piccolo</option>
                <option>Flute</option>
                <option>Oboe</option>
                <option>Bassoon</option>
                <option>Clarinet</option>
                <option>Bass Clarinet</option>
                <option>Alto Saxophone</option>
                <option>Tenor Saxaphone</option>
                <option>Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option>Trumpet</option>
                <option>Horns</option>
                <option>Tenor Trombones</option>
                <option>Bass Trombone</option>
                <option>Baritone Horn/Euphonium</option>
                <option>Tuba</option>
              </optgroup>

              <optgroup labe;l="Percussion">
                <option>Snare Drum</option>
                <option>Bass Drum</option>
                <option>Cymbals</option>
                <option>Tam-Tam</option>
                <option>Triangle</option>
                <option>Tambourine</option>
                <option>Wood Blocks/Temple Blocks</option>
                <option>Tom-Tom</option>
                <option>Bongos</option>
                <option>Congas</option>
                <option>Claves</option>
                <option>Drum Kit</option>
                <option>Timpani</option>
                <option>Glockenspiel</option>
                <option>Xylophone</option>
                <option>Marimba</option>
                <option>Crotales</option>
                <option>Vibraphone</option>
                <option>Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option>Piano</option>
                <option>Celesta</option>
                <option>Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option>Harp</option>
                <option>Violoncello</option>
                <option>Double Bass</option>
              </optgroup>
              
            </select>
            <label><input type="checkbox" name="dir6" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'newSeven' id='newSeven' placeholder="Enter Email address here" />
                        <select>
              <optgroup label = "Woodwinds">
                <option>Piccolo</option>
                <option>Flute</option>
                <option>Oboe</option>
                <option>Bassoon</option>
                <option>Clarinet</option>
                <option>Bass Clarinet</option>
                <option>Alto Saxophone</option>
                <option>Tenor Saxaphone</option>
                <option>Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option>Trumpet</option>
                <option>Horns</option>
                <option>Tenor Trombones</option>
                <option>Bass Trombone</option>
                <option>Baritone Horn/Euphonium</option>
                <option>Tuba</option>
              </optgroup>

              <optgroup labe;l="Percussion">
                <option>Snare Drum</option>
                <option>Bass Drum</option>
                <option>Cymbals</option>
                <option>Tam-Tam</option>
                <option>Triangle</option>
                <option>Tambourine</option>
                <option>Wood Blocks/Temple Blocks</option>
                <option>Tom-Tom</option>
                <option>Bongos</option>
                <option>Congas</option>
                <option>Claves</option>
                <option>Drum Kit</option>
                <option>Timpani</option>
                <option>Glockenspiel</option>
                <option>Xylophone</option>
                <option>Marimba</option>
                <option>Crotales</option>
                <option>Vibraphone</option>
                <option>Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option>Piano</option>
                <option>Celesta</option>
                <option>Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option>Harp</option>
                <option>Violoncello</option>
                <option>Double Bass</option>
              </optgroup>
              
            </select>
            <label><input type="checkbox" name="dir7" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'newEight' id='newEight' placeholder="Enter Email address here" />
                        <select>
              <optgroup label = "Woodwinds">
                <option>Piccolo</option>
                <option>Flute</option>
                <option>Oboe</option>
                <option>Bassoon</option>
                <option>Clarinet</option>
                <option>Bass Clarinet</option>
                <option>Alto Saxophone</option>
                <option>Tenor Saxaphone</option>
                <option>Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option>Trumpet</option>
                <option>Horns</option>
                <option>Tenor Trombones</option>
                <option>Bass Trombone</option>
                <option>Baritone Horn/Euphonium</option>
                <option>Tuba</option>
              </optgroup>

              <optgroup labe;l="Percussion">
                <option>Snare Drum</option>
                <option>Bass Drum</option>
                <option>Cymbals</option>
                <option>Tam-Tam</option>
                <option>Triangle</option>
                <option>Tambourine</option>
                <option>Wood Blocks/Temple Blocks</option>
                <option>Tom-Tom</option>
                <option>Bongos</option>
                <option>Congas</option>
                <option>Claves</option>
                <option>Drum Kit</option>
                <option>Timpani</option>
                <option>Glockenspiel</option>
                <option>Xylophone</option>
                <option>Marimba</option>
                <option>Crotales</option>
                <option>Vibraphone</option>
                <option>Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option>Piano</option>
                <option>Celesta</option>
                <option>Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option>Harp</option>
                <option>Violoncello</option>
                <option>Double Bass</option>
              </optgroup>
              
            </select>
            <label><input type="checkbox" name="dir8" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'newNine' id='newNine' placeholder="Enter Email address here" />
                        <select>
              <optgroup label = "Woodwinds">
                <option>Piccolo</option>
                <option>Flute</option>
                <option>Oboe</option>
                <option>Bassoon</option>
                <option>Clarinet</option>
                <option>Bass Clarinet</option>
                <option>Alto Saxophone</option>
                <option>Tenor Saxaphone</option>
                <option>Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option>Trumpet</option>
                <option>Horns</option>
                <option>Tenor Trombones</option>
                <option>Bass Trombone</option>
                <option>Baritone Horn/Euphonium</option>
                <option>Tuba</option>
              </optgroup>

              <optgroup labe;l="Percussion">
                <option>Snare Drum</option>
                <option>Bass Drum</option>
                <option>Cymbals</option>
                <option>Tam-Tam</option>
                <option>Triangle</option>
                <option>Tambourine</option>
                <option>Wood Blocks/Temple Blocks</option>
                <option>Tom-Tom</option>
                <option>Bongos</option>
                <option>Congas</option>
                <option>Claves</option>
                <option>Drum Kit</option>
                <option>Timpani</option>
                <option>Glockenspiel</option>
                <option>Xylophone</option>
                <option>Marimba</option>
                <option>Crotales</option>
                <option>Vibraphone</option>
                <option>Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option>Piano</option>
                <option>Celesta</option>
                <option>Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option>Harp</option>
                <option>Violoncello</option>
                <option>Double Bass</option>
              </optgroup>
              
            </select>
            <label><input type="checkbox" name="dir9" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'newTen' id='newTen' placeholder="Enter Email address here" />
                        <select>
              <optgroup label = "Woodwinds">
                <option>Piccolo</option>
                <option>Flute</option>
                <option>Oboe</option>
                <option>Bassoon</option>
                <option>Clarinet</option>
                <option>Bass Clarinet</option>
                <option>Alto Saxophone</option>
                <option>Tenor Saxaphone</option>
                <option>Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option>Trumpet</option>
                <option>Horns</option>
                <option>Tenor Trombones</option>
                <option>Bass Trombone</option>
                <option>Baritone Horn/Euphonium</option>
                <option>Tuba</option>
              </optgroup>


              <optgroup label = "Keyboards">
                <option>Piano</option>
                <option>Celesta</option>
                <option>Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option>Harp</option>
                <option>Violoncello</option>
                <option>Double Bass</option>
              </optgroup>
              
            </select>
            <label><input type="checkbox" name="dir10" value="1" /> Is this member a Director?</label>
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