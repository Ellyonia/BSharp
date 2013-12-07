<?
  include 'phpAPI.php';
  $phpInit = new phpAPI();
  $phpInit->setBID();
  $phpInit->checkLoggedIn();
  $phpInit->checkAllowed();


/*
  if(isset($_POST['addButton'])){
    $members = array($_POST['new1'], $_POST['new2'], $_POST['new3'], $_POST['new4'], $_POST['new5'], $_POST['new6'], $_POST['new7'], $_POST['new8'], $_POST['new9'], $_POST['new10']);
    $dirFlags = array($_POST['dir1'], $_POST['dir2'], $_POST['dir3'], $_POST['dir4'], $_POST['dir5'], $_POST['dir6'], $_POST['dir7'], $_POST['dir8'], $_POST['dir9'], $_POST['dir10']);
    $instruments = array($_POST['Instrument1'], $_POST['Instrument2'], $_POST['Instrument3'], $_POST['Instrument4'], $_POST['Instrument5'], $_POST['Instrument6'], $_POST['Instrument7'], $_POST['Instrument8'], $_POST['Instrument9'], $_POST['Instrument10']);
    $parts = array($_POST['part1'], $_POST['part2'], $_POST['part3'], $_POST['part4'], $_POST['part5'], $_POST['part6'], $_POST['part7'], $_POST['part8'], $_POST['part9'], $_POST['part10']);

    $_SESSION['newMembers'] = $members;
    $_SESSION['dirFlags'] = $dirFlags;
    $_SESSION['instruments'] = $instruments;
    $_SESSION['parts'] = $parts;

  }*/


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
  	<h1 id="band_header"><?
        
        $phpInit->getBandName();
    
      ?></h1>
    <img src="img/logo.png" id = "logo" alt = "B Sharp Logo" title="test">
    <a href="logout.php" class="logout">Log Out</a>
  	<span id="navbar">
  		<ul>
  			<li class="selected">
  				<a href="#about" class="selected notselected">About Band</a>
  			</li>
  			<li>
  				<a href="#pieces" class="notselected">Pieces</a>
  			</li>
  			
          <?
          $phpInit->ifDirGetManagement();
          ?>
          <!--
        <li>
  				<a href="#management" class="notselected">Band Management</a>
  			</li> -->
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
          <FORM METHOD="LINK" ACTION="BandCreation.php" id="createBand">
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
      <ul id = "pieces">
        <?
          $phpInit->getMusicList();
        ?>
      </ul>
  	</div>

  	<div id="management" class="hidden">
      <span id="navbar2">
      <ul>
        <li class="selected">
          <a href="#changeInfo" class="selected notselected">Edit the About Band Information</a>
        </li>
        <li>
          <a href="#changeEvents" class="notselected">Edit Upcoming Events</a>
        </li>
        <li>
          <a href="#addMembers" class="notselected">Add Band Members</a>
        </li>
         <li>
          <a href="#upload" class="notselected">Add Pieces</a>
        </li>
        <li>
          <a href="#editPhone" class="notselected">Edit Band Phone Number</a>
        </li>
      </ul>
    </span>
      <h2>Manage Band</h2>
      <form id="changeInfo" action = "changeAbout.php" method = "post" class ="visible2">
        <h3>Edit the About Band Information</h3>
          <textArea rows="4" cols="50" id="newInfo" name = "newInfo"/><?$phpInit->getBandInfo();?></textarea>

          <input type="submit" name="changeAbout" id="changeAbout" value="Submit Changes"/>

      </form>

      <form id="changeEvents" action = "changeEvents.php" method = "post" class ="hidden2">
        <h3>Edit the Upcoming Events</h3>
          <textArea rows="4" cols="50" id="changeEvents" name = "changeEvents"/><?$phpInit->getEventsForEdit(); ?></textarea>

          <input type="submit" name="changeAbout" id="changeAbout" value="Submit Changes"/>

      </form>



      <form method="post" action = "upload_file.php" name="upload" id="upload" enctype="multipart/form-data" class="hidden2">
          <input type="text" name = "pieceName" id="pieceName" placeholder = "Enter the Name of The Piece/Song" required/>
          <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="">
          <input class="button" type="submit" value="Upload" />
      </form>


      <form id = "addMembers" action = "addMembers.php" method = "post" class ="hidden2">
        <h3>Add Band Members by Entering their Email Addresses</h3>

        <ul class = "NewMembers">
          <li>
            <input type='text' name = 'new1' id='new1' placeholder="Enter Email address here" required/>
            <select id="Instrument1" name="Instrument1" onchange='otherOpt(this.value);'>
              <option value="">Select an Instrument</option>
              <optgroup label = "Woodwinds">
                <option value="Piccolo">Piccolo</option>
                <option value="Flute">Flute</option>
                <option value="Oboe">Oboe</option>
                <option value="Bassoon">Bassoon</option>
                <option value="Clarinet">Clarinet</option>
                <option value = "Bass">Bass Clarinet</option>
                <option value="Alto Saxophpone">Alto Saxophone</option>
                <option value="Tenor Saxophone">Tenor Saxaphone</option>
                <option value="Baritone Saxophone">Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option value="Trumpet">Trumpet</option>
                <option value="Horns">Horns</option>
                <option value="Tenor Trombone">Tenor Trombones</option>
                <option value="Bass Trombone">Bass Trombone</option>
                <option value="Baritone Horn/Euphonium">Baritone Horn/Euphonium</option>
                <option value="Tuba">Tuba</option>
              </optgroup>

              <optgroup label="Percussion">
                <option value="Snare Drum">Snare Drum</option>
                <option value="Bass Drum">Bass Drum</option>
                <option value="Cymbals">Cymbals</option>
                <option value="Tam-Tam">Tam-Tam</option>
                <option value="Triangle">Triangle</option>
                <option value="Tambourine">Tambourine</option>
                <option value="Wood Blocks/Temple Blocks">Wood Blocks/Temple Blocks</option>
                <option value="Tom-Tom">Tom-Tom</option>
                <option value="Bongos">Bongos</option>
                <option value="Congas">Congas</option>
                <option value="Claves">Claves</option>
                <option value="Drum Kit">Drum Kit</option>
                <option value="Timpani">Timpani</option>
                <option value="Glockenspiel">Glockenspiel</option>
                <option value="Xylohpone">Xylophone</option>
                <option value="Marimba">Marimba</option>
                <option value="Crotales">Crotales</option>
                <option value="Vibraphone">Vibraphone</option>
                <option value="Chimes">Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option value="Piano">Piano</option>
                <option value="Celesta">Celesta</option>
                <option value="Organ">Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option value="Harp">Harp</option>
                <option value="Violencello">Violoncello</option>
                <option value="Double Bass">Double Bass</option>
              </optgroup>
                <option value="Other">other</option>
              
            </select>

            <input type = "text" name="oInstrument1" id="oInstrument" style="display:none;" />

            <select id="part1" name="part1">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>

            <label><input type="checkbox" name="dir1" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'new2' id='new2' placeholder="Enter Email address here" />
            <select id="Instrument2" name="Instrument2" onchange='otherOpt(this.value);'>
              <option value="">Select an Instrument</option>
              <optgroup label = "Woodwinds">
                <option value="Piccolo">Piccolo</option>
                <option value="Flute">Flute</option>
                <option value="Oboe">Oboe</option>
                <option value="Bassoon">Bassoon</option>
                <option value="Clarinet">Clarinet</option>
                <option value = "Bass">Bass Clarinet</option>
                <option value="Alto Saxophpone">Alto Saxophone</option>
                <option value="Tenor Saxophone">Tenor Saxaphone</option>
                <option value="Baritone Saxophone">Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option value="Trumpet">Trumpet</option>
                <option value="Horns">Horns</option>
                <option value="Tenor Trombone">Tenor Trombones</option>
                <option value="Bass Trombone">Bass Trombone</option>
                <option value="Baritone Horn/Euphonium">Baritone Horn/Euphonium</option>
                <option value="Tuba">Tuba</option>
              </optgroup>

              <optgroup label="Percussion">
                <option value="Snare Drum">Snare Drum</option>
                <option value="Bass Drum">Bass Drum</option>
                <option value="Cymbals">Cymbals</option>
                <option value="Tam-Tam">Tam-Tam</option>
                <option value="Triangle">Triangle</option>
                <option value="Tambourine">Tambourine</option>
                <option value="Wood Blocks/Temple Blocks">Wood Blocks/Temple Blocks</option>
                <option value="Tom-Tom">Tom-Tom</option>
                <option value="Bongos">Bongos</option>
                <option value="Congas">Congas</option>
                <option value="Claves">Claves</option>
                <option value="Drum Kit">Drum Kit</option>
                <option value="Timpani">Timpani</option>
                <option value="Glockenspiel">Glockenspiel</option>
                <option value="Xylohpone">Xylophone</option>
                <option value="Marimba">Marimba</option>
                <option value="Crotales">Crotales</option>
                <option value="Vibraphone">Vibraphone</option>
                <option value="Chimes">Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option value="Piano">Piano</option>
                <option value="Celesta">Celesta</option>
                <option value="Organ">Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option value="Harp">Harp</option>
                <option value="Violencello">Violoncello</option>
                <option value="Double Bass">Double Bass</option>
              </optgroup>
              
              <option value="Other">other</option>
              
            </select>

            <input type = "text" name="oInstrument2" id="oInstrument" style="display:none;" />

            <select id="part2" name="part2">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>

            <label><input type="checkbox" name="dir2" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'new3' id='new3' placeholder="Enter Email address here" />
            <select id="Instrument3" name="Instrument3" onchange='otherOpt(this.value);'>
              <option value="">Select an Instrument</option>
              <optgroup label = "Woodwinds">
                <option value="Piccolo">Piccolo</option>
                <option value="Flute">Flute</option>
                <option value="Oboe">Oboe</option>
                <option value="Bassoon">Bassoon</option>
                <option value="Clarinet">Clarinet</option>
                <option value = "Bass">Bass Clarinet</option>
                <option value="Alto Saxophpone">Alto Saxophone</option>
                <option value="Tenor Saxophone">Tenor Saxaphone</option>
                <option value="Baritone Saxophone">Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option value="Trumpet">Trumpet</option>
                <option value="Horns">Horns</option>
                <option value="Tenor Trombone">Tenor Trombones</option>
                <option value="Bass Trombone">Bass Trombone</option>
                <option value="Baritone Horn/Euphonium">Baritone Horn/Euphonium</option>
                <option value="Tuba">Tuba</option>
              </optgroup>

              <optgroup label="Percussion">
                <option value="Snare Drum">Snare Drum</option>
                <option value="Bass Drum">Bass Drum</option>
                <option value="Cymbals">Cymbals</option>
                <option value="Tam-Tam">Tam-Tam</option>
                <option value="Triangle">Triangle</option>
                <option value="Tambourine">Tambourine</option>
                <option value="Wood Blocks/Temple Blocks">Wood Blocks/Temple Blocks</option>
                <option value="Tom-Tom">Tom-Tom</option>
                <option value="Bongos">Bongos</option>
                <option value="Congas">Congas</option>
                <option value="Claves">Claves</option>
                <option value="Drum Kit">Drum Kit</option>
                <option value="Timpani">Timpani</option>
                <option value="Glockenspiel">Glockenspiel</option>
                <option value="Xylohpone">Xylophone</option>
                <option value="Marimba">Marimba</option>
                <option value="Crotales">Crotales</option>
                <option value="Vibraphone">Vibraphone</option>
                <option value="Chimes">Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option value="Piano">Piano</option>
                <option value="Celesta">Celesta</option>
                <option value="Organ">Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option value="Harp">Harp</option>
                <option value="Violencello">Violoncello</option>
                <option value="Double Bass">Double Bass</option>
              </optgroup>
              
                <option value="Other">other</option>
              
            </select>

            <input type = "text" name="oInstrument3" id="oInstrument" style="display:none;" />

            <select id="part3" name="part3">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <label><input type="checkbox" name="dir3" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'new4' id='new4' placeholder="Enter Email address here" />
            <select id="Instrument4" name="Instrument4" onchange='otherOpt(this.value);'>
              <option value="">Select an Instrument</option>
              <optgroup label = "Woodwinds">
                <option value="Piccolo">Piccolo</option>
                <option value="Flute">Flute</option>
                <option value="Oboe">Oboe</option>
                <option value="Bassoon">Bassoon</option>
                <option value="Clarinet">Clarinet</option>
                <option value = "Bass">Bass Clarinet</option>
                <option value="Alto Saxophpone">Alto Saxophone</option>
                <option value="Tenor Saxophone">Tenor Saxaphone</option>
                <option value="Baritone Saxophone">Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option value="Trumpet">Trumpet</option>
                <option value="Horns">Horns</option>
                <option value="Tenor Trombone">Tenor Trombones</option>
                <option value="Bass Trombone">Bass Trombone</option>
                <option value="Baritone Horn/Euphonium">Baritone Horn/Euphonium</option>
                <option value="Tuba">Tuba</option>
              </optgroup>

              <optgroup label="Percussion">
                <option value="Snare Drum">Snare Drum</option>
                <option value="Bass Drum">Bass Drum</option>
                <option value="Cymbals">Cymbals</option>
                <option value="Tam-Tam">Tam-Tam</option>
                <option value="Triangle">Triangle</option>
                <option value="Tambourine">Tambourine</option>
                <option value="Wood Blocks/Temple Blocks">Wood Blocks/Temple Blocks</option>
                <option value="Tom-Tom">Tom-Tom</option>
                <option value="Bongos">Bongos</option>
                <option value="Congas">Congas</option>
                <option value="Claves">Claves</option>
                <option value="Drum Kit">Drum Kit</option>
                <option value="Timpani">Timpani</option>
                <option value="Glockenspiel">Glockenspiel</option>
                <option value="Xylohpone">Xylophone</option>
                <option value="Marimba">Marimba</option>
                <option value="Crotales">Crotales</option>
                <option value="Vibraphone">Vibraphone</option>
                <option value="Chimes">Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option value="Piano">Piano</option>
                <option value="Celesta">Celesta</option>
                <option value="Organ">Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option value="Harp">Harp</option>
                <option value="Violencello">Violoncello</option>
                <option value="Double Bass">Double Bass</option>
              </optgroup>
              
                <option value="Other">other</option>
              
            </select>

            <input type = "text" name="oInstrument4" id="oInstrument" style="display:none;" />

            <select id="part4" name="part4">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <label><input type="checkbox" name="dir4" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'new5' id='new5' placeholder="Enter Email address here" />
            <select id="Instrument5" name="Instrument5" onchange='otherOpt(this.value);'>
              <option value="">Select an Instrument</option>
              <optgroup label = "Woodwinds">
                <option value="Piccolo">Piccolo</option>
                <option value="Flute">Flute</option>
                <option value="Oboe">Oboe</option>
                <option value="Bassoon">Bassoon</option>
                <option value="Clarinet">Clarinet</option>
                <option value = "Bass">Bass Clarinet</option>
                <option value="Alto Saxophpone">Alto Saxophone</option>
                <option value="Tenor Saxophone">Tenor Saxaphone</option>
                <option value="Baritone Saxophone">Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option value="Trumpet">Trumpet</option>
                <option value="Horns">Horns</option>
                <option value="Tenor Trombone">Tenor Trombones</option>
                <option value="Bass Trombone">Bass Trombone</option>
                <option value="Baritone Horn/Euphonium">Baritone Horn/Euphonium</option>
                <option value="Tuba">Tuba</option>
              </optgroup>

              <optgroup label="Percussion">
                <option value="Snare Drum">Snare Drum</option>
                <option value="Bass Drum">Bass Drum</option>
                <option value="Cymbals">Cymbals</option>
                <option value="Tam-Tam">Tam-Tam</option>
                <option value="Triangle">Triangle</option>
                <option value="Tambourine">Tambourine</option>
                <option value="Wood Blocks/Temple Blocks">Wood Blocks/Temple Blocks</option>
                <option value="Tom-Tom">Tom-Tom</option>
                <option value="Bongos">Bongos</option>
                <option value="Congas">Congas</option>
                <option value="Claves">Claves</option>
                <option value="Drum Kit">Drum Kit</option>
                <option value="Timpani">Timpani</option>
                <option value="Glockenspiel">Glockenspiel</option>
                <option value="Xylohpone">Xylophone</option>
                <option value="Marimba">Marimba</option>
                <option value="Crotales">Crotales</option>
                <option value="Vibraphone">Vibraphone</option>
                <option value="Chimes">Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option value="Piano">Piano</option>
                <option value="Celesta">Celesta</option>
                <option value="Organ">Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option value="Harp">Harp</option>
                <option value="Violencello">Violoncello</option>
                <option value="Double Bass">Double Bass</option>
              </optgroup>
              
                <option value="Other">other</option>
              
            </select>

            <input type = "text" name="oInstrument5" id="oInstrument" style="display:none;" />

            <select id="part5" name="part5">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <label><input type="checkbox" name="dir5" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'new6' id='new6' placeholder="Enter Email address here" />
            <select id="Instrument6" name="Instrument6" onchange='otherOpt(this.value);'>
              <option value="">Select an Instrument</option>
              <optgroup label = "Woodwinds">
                <option value="Piccolo">Piccolo</option>
                <option value="Flute">Flute</option>
                <option value="Oboe">Oboe</option>
                <option value="Bassoon">Bassoon</option>
                <option value="Clarinet">Clarinet</option>
                <option value = "Bass">Bass Clarinet</option>
                <option value="Alto Saxophpone">Alto Saxophone</option>
                <option value="Tenor Saxophone">Tenor Saxaphone</option>
                <option value="Baritone Saxophone">Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option value="Trumpet">Trumpet</option>
                <option value="Horns">Horns</option>
                <option value="Tenor Trombone">Tenor Trombones</option>
                <option value="Bass Trombone">Bass Trombone</option>
                <option value="Baritone Horn/Euphonium">Baritone Horn/Euphonium</option>
                <option value="Tuba">Tuba</option>
              </optgroup>

              <optgroup label="Percussion">
                <option value="Snare Drum">Snare Drum</option>
                <option value="Bass Drum">Bass Drum</option>
                <option value="Cymbals">Cymbals</option>
                <option value="Tam-Tam">Tam-Tam</option>
                <option value="Triangle">Triangle</option>
                <option value="Tambourine">Tambourine</option>
                <option value="Wood Blocks/Temple Blocks">Wood Blocks/Temple Blocks</option>
                <option value="Tom-Tom">Tom-Tom</option>
                <option value="Bongos">Bongos</option>
                <option value="Congas">Congas</option>
                <option value="Claves">Claves</option>
                <option value="Drum Kit">Drum Kit</option>
                <option value="Timpani">Timpani</option>
                <option value="Glockenspiel">Glockenspiel</option>
                <option value="Xylohpone">Xylophone</option>
                <option value="Marimba">Marimba</option>
                <option value="Crotales">Crotales</option>
                <option value="Vibraphone">Vibraphone</option>
                <option value="Chimes">Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option value="Piano">Piano</option>
                <option value="Celesta">Celesta</option>
                <option value="Organ">Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option value="Harp">Harp</option>
                <option value="Violencello">Violoncello</option>
                <option value="Double Bass">Double Bass</option>
              </optgroup>
              
                <option value="Other">other</option>
              
            </select>

            <input type = "text" name="oInstrument6" id="oInstrument" style="display:none;" />

            <select id="part6" name="part6">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <label><input type="checkbox" name="dir6" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'new7' id='new7' placeholder="Enter Email address here" />
            <select id="Instrument7" name="Instrument7" onchange='otherOpt(this.value);'>
              <option value="">Select an Instrument</option>
              <optgroup label = "Woodwinds">
                <option value="Piccolo">Piccolo</option>
                <option value="Flute">Flute</option>
                <option value="Oboe">Oboe</option>
                <option value="Bassoon">Bassoon</option>
                <option value="Clarinet">Clarinet</option>
                <option value = "Bass">Bass Clarinet</option>
                <option value="Alto Saxophpone">Alto Saxophone</option>
                <option value="Tenor Saxophone">Tenor Saxaphone</option>
                <option value="Baritone Saxophone">Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option value="Trumpet">Trumpet</option>
                <option value="Horns">Horns</option>
                <option value="Tenor Trombone">Tenor Trombones</option>
                <option value="Bass Trombone">Bass Trombone</option>
                <option value="Baritone Horn/Euphonium">Baritone Horn/Euphonium</option>
                <option value="Tuba">Tuba</option>
              </optgroup>

              <optgroup label="Percussion">
                <option value="Snare Drum">Snare Drum</option>
                <option value="Bass Drum">Bass Drum</option>
                <option value="Cymbals">Cymbals</option>
                <option value="Tam-Tam">Tam-Tam</option>
                <option value="Triangle">Triangle</option>
                <option value="Tambourine">Tambourine</option>
                <option value="Wood Blocks/Temple Blocks">Wood Blocks/Temple Blocks</option>
                <option value="Tom-Tom">Tom-Tom</option>
                <option value="Bongos">Bongos</option>
                <option value="Congas">Congas</option>
                <option value="Claves">Claves</option>
                <option value="Drum Kit">Drum Kit</option>
                <option value="Timpani">Timpani</option>
                <option value="Glockenspiel">Glockenspiel</option>
                <option value="Xylohpone">Xylophone</option>
                <option value="Marimba">Marimba</option>
                <option value="Crotales">Crotales</option>
                <option value="Vibraphone">Vibraphone</option>
                <option value="Chimes">Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option value="Piano">Piano</option>
                <option value="Celesta">Celesta</option>
                <option value="Organ">Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option value="Harp">Harp</option>
                <option value="Violencello">Violoncello</option>
                <option value="Double Bass">Double Bass</option>
              </optgroup>
              
                <option value="Other">other</option>
              
            </select>

            <input type = "text" name="oInstrument7" id="oInstrument" style="display:none;" />

            <select id="part7" name="part7">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <label><input type="checkbox" name="dir7" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'new8' id='new8' placeholder="Enter Email address here" />
            <select id="Instrument8" name="Instrument8" onchange='otherOpt(this.value);'>
              <option value="">Select an Instrument</option>
              <optgroup label = "Woodwinds">
                <option value="Piccolo">Piccolo</option>
                <option value="Flute">Flute</option>
                <option value="Oboe">Oboe</option>
                <option value="Bassoon">Bassoon</option>
                <option value="Clarinet">Clarinet</option>
                <option value = "Bass">Bass Clarinet</option>
                <option value="Alto Saxophpone">Alto Saxophone</option>
                <option value="Tenor Saxophone">Tenor Saxaphone</option>
                <option value="Baritone Saxophone">Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option value="Trumpet">Trumpet</option>
                <option value="Horns">Horns</option>
                <option value="Tenor Trombone">Tenor Trombones</option>
                <option value="Bass Trombone">Bass Trombone</option>
                <option value="Baritone Horn/Euphonium">Baritone Horn/Euphonium</option>
                <option value="Tuba">Tuba</option>
              </optgroup>

              <optgroup label="Percussion">
                <option value="Snare Drum">Snare Drum</option>
                <option value="Bass Drum">Bass Drum</option>
                <option value="Cymbals">Cymbals</option>
                <option value="Tam-Tam">Tam-Tam</option>
                <option value="Triangle">Triangle</option>
                <option value="Tambourine">Tambourine</option>
                <option value="Wood Blocks/Temple Blocks">Wood Blocks/Temple Blocks</option>
                <option value="Tom-Tom">Tom-Tom</option>
                <option value="Bongos">Bongos</option>
                <option value="Congas">Congas</option>
                <option value="Claves">Claves</option>
                <option value="Drum Kit">Drum Kit</option>
                <option value="Timpani">Timpani</option>
                <option value="Glockenspiel">Glockenspiel</option>
                <option value="Xylohpone">Xylophone</option>
                <option value="Marimba">Marimba</option>
                <option value="Crotales">Crotales</option>
                <option value="Vibraphone">Vibraphone</option>
                <option value="Chimes">Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option value="Piano">Piano</option>
                <option value="Celesta">Celesta</option>
                <option value="Organ">Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option value="Harp">Harp</option>
                <option value="Violencello">Violoncello</option>
                <option value="Double Bass">Double Bass</option>
              </optgroup>
              
                <option value="Other">other</option>
              
            </select>

            <input type = "text" name="oInstrument8" id="oInstrument" style="display:none;" />

            <select id="part8" name="part8">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <label><input type="checkbox" name="dir8" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'new9' id='new9' placeholder="Enter Email address here" />
            <select id="Instrument9" name="Instrument9" onchange='otherOpt(this.value);'>
              <option value="">Select an Instrument</option>
              <optgroup label = "Woodwinds">
                <option value="Piccolo">Piccolo</option>
                <option value="Flute">Flute</option>
                <option value="Oboe">Oboe</option>
                <option value="Bassoon">Bassoon</option>
                <option value="Clarinet">Clarinet</option>
                <option value = "Bass">Bass Clarinet</option>
                <option value="Alto Saxophpone">Alto Saxophone</option>
                <option value="Tenor Saxophone">Tenor Saxaphone</option>
                <option value="Baritone Saxophone">Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option value="Trumpet">Trumpet</option>
                <option value="Horns">Horns</option>
                <option value="Tenor Trombone">Tenor Trombones</option>
                <option value="Bass Trombone">Bass Trombone</option>
                <option value="Baritone Horn/Euphonium">Baritone Horn/Euphonium</option>
                <option value="Tuba">Tuba</option>
              </optgroup>

              <optgroup label="Percussion">
                <option value="Snare Drum">Snare Drum</option>
                <option value="Bass Drum">Bass Drum</option>
                <option value="Cymbals">Cymbals</option>
                <option value="Tam-Tam">Tam-Tam</option>
                <option value="Triangle">Triangle</option>
                <option value="Tambourine">Tambourine</option>
                <option value="Wood Blocks/Temple Blocks">Wood Blocks/Temple Blocks</option>
                <option value="Tom-Tom">Tom-Tom</option>
                <option value="Bongos">Bongos</option>
                <option value="Congas">Congas</option>
                <option value="Claves">Claves</option>
                <option value="Drum Kit">Drum Kit</option>
                <option value="Timpani">Timpani</option>
                <option value="Glockenspiel">Glockenspiel</option>
                <option value="Xylohpone">Xylophone</option>
                <option value="Marimba">Marimba</option>
                <option value="Crotales">Crotales</option>
                <option value="Vibraphone">Vibraphone</option>
                <option value="Chimes">Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option value="Piano">Piano</option>
                <option value="Celesta">Celesta</option>
                <option value="Organ">Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option value="Harp">Harp</option>
                <option value="Violencello">Violoncello</option>
                <option value="Double Bass">Double Bass</option>
              </optgroup>
              
                <option value="Other">other</option>
              
            </select>

            <input type = "text" name="oInstrument9" id="oInstrument" style="display:none;" />

            <select id="part9" name="part9">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <label><input type="checkbox" name="dir9" value="1" /> Is this member a Director?</label>
          </li>

          <li>
            <input type='text' name = 'new10' id='new10' placeholder="Enter Email address here" />
            <select id="Instrument10" name="Instrument10" onchange='otherOpt(this.value);'>
              <option value="">Select an Instrument</option>
              <optgroup label = "Woodwinds">
                <option value="Piccolo">Piccolo</option>
                <option value="Flute">Flute</option>
                <option value="Oboe">Oboe</option>
                <option value="Bassoon">Bassoon</option>
                <option value="Clarinet">Clarinet</option>
                <option value = "Bass">Bass Clarinet</option>
                <option value="Alto Saxophpone">Alto Saxophone</option>
                <option value="Tenor Saxophone">Tenor Saxaphone</option>
                <option value="Baritone Saxophone">Baritone Saxophone</option>
              </optgroup>

              <optgroup label="Brass">
                <option value="Trumpet">Trumpet</option>
                <option value="Horns">Horns</option>
                <option value="Tenor Trombone">Tenor Trombones</option>
                <option value="Bass Trombone">Bass Trombone</option>
                <option value="Baritone Horn/Euphonium">Baritone Horn/Euphonium</option>
                <option value="Tuba">Tuba</option>
              </optgroup>

              <optgroup label="Percussion">
                <option value="Snare Drum">Snare Drum</option>
                <option value="Bass Drum">Bass Drum</option>
                <option value="Cymbals">Cymbals</option>
                <option value="Tam-Tam">Tam-Tam</option>
                <option value="Triangle">Triangle</option>
                <option value="Tambourine">Tambourine</option>
                <option value="Wood Blocks/Temple Blocks">Wood Blocks/Temple Blocks</option>
                <option value="Tom-Tom">Tom-Tom</option>
                <option value="Bongos">Bongos</option>
                <option value="Congas">Congas</option>
                <option value="Claves">Claves</option>
                <option value="Drum Kit">Drum Kit</option>
                <option value="Timpani">Timpani</option>
                <option value="Glockenspiel">Glockenspiel</option>
                <option value="Xylohpone">Xylophone</option>
                <option value="Marimba">Marimba</option>
                <option value="Crotales">Crotales</option>
                <option value="Vibraphone">Vibraphone</option>
                <option value="Chimes">Chimes</option>
              </optgroup>

              <optgroup label = "Keyboards">
                <option value="Piano">Piano</option>
                <option value="Celesta">Celesta</option>
                <option value="Organ">Organ</option>
              </optgroup>

              <optgroup label = "Strings">
                <option value="Harp">Harp</option>
                <option value="Violencello">Violoncello</option>
                <option value="Double Bass">Double Bass</option>
              </optgroup>
              
                <option value="Other">other</option>
              
            </select>

            <input type = "text" name="oInstrument10" id="oInstrument" style="display:none;" />

            <select id="part10" name="part10">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <label><input type="checkbox" name="dir10" value="1" /> Is this member a Director?</label>
          </li>
      </ul>

        <input type="submit" name="addButton" id="addButton" value="Add Members"/>
      </form>

      <form id = "editPhone" name = "editPhone" action = "changePhone.php" method = "post" class ="hidden2">
        <h3>Edit the Band's Phone Number</h3>
        <input type="text" placeholder="Telephone Number" id="changePhone" name = "changePhone" pattern = "[0-9]{10}" oninvalid="setCustomValidity('Phone number must be 10 characters, only numbers')" onchange="try{setCustomValidity('')}catch(e){}" required/>
        <input type="submit" name="submitPhone" id="submitPhone" value="Change Phone Number"/>
      </form>
    </div>

  	<div id="events" class="hidden">
      <h2>View Upcoming Events</h2>
      <?
        echo "<p>";
        $phpInit->getEvents();
        echo "</p>";
      ?>
  	</div>

  	<div id="members" class="hidden">
      <h2>View Band Members</h2>

      <ul>
        <?
          $phpInit->getBandMembers();
        ?>
      </ul>
  	</div>

  	<div id="contact" class="hidden">
      <h2>Contact Information</h2>
      <ul>
        <?
          $phpInit->getContactInfo();
        ?>
      </ul>
  	</div>

  </body>