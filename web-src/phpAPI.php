<?php

class phpAPI
{

     
    function phpAPI()
    {
        session_start();

        $con = mysql_connect("localhost", "DBandGUI", "narwhal");
        if(!$con)
            die('Could not connect: ' . mysql_error());

        mysql_select_db("BSharp", $con)
        or die("Unable to select database: " . mysql_error());
    }



    public function addUser()
    {   
        //add a user to the system
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $email = $_POST['newEmail'];
        $password = $_POST['newPassword'];
        $repass = $_POST['reTypePass'];

        if(empty($fname) || empty($lname) || empty($email))
        {
        	header("Location: error.php");
        	return;
        }
        
        $fname = mysql_real_escape_string($fname);
        $lname = mysql_real_escape_string($lname);
        $email = mysql_real_escape_string($email);
        $password = mysql_real_escape_string($password);
        $repass = mysql_real_escape_string($repass);


        $count = "SELECT * from Users WHERE(username = '$email')";
        

        if(!mysql_query($count))
        {
            header('Location: error.php');
        }
        else if($repass == $password)
        {
            $result = mysql_query($count);
            $num_rows = mysql_num_rows($result);

            if($num_rows > 0)
            {
                header('Location: EmailTaken.php');
            }
            else
            {
                if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).+$/", $password) != 0)
                {


                    $query = "INSERT INTO Users(fname, lname, username,password) VALUES 
                        ('$fname', '$lname','$email','$password')";
                    if(!mysql_query($query))
                    {

                        header('Location: error.php');
                    }
                    else
                    {
                        $getID = mysql_query("SELECT user_id from Users where username = '$email' and password = '$password'");

                        $temp = mysql_fetch_assoc($getID);
                        $_SESSION['uid'] = $temp['user_id'];

                        header('Location: user_page.php');
                    }
                }
                else
                    header('Location: badPass.php');
            }
        }
        else
            header('Location: error.php');
        
        //mysql_close($con);
    
    }


    public function validateUser()
    {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $email = mysql_real_escape_string($email);
        $password = mysql_real_escape_string($password);
        
        $valid = 0;

       // $sql = "SELECT password, user_id FROM Users WHERE username = '$email'";
        $sql = "SELECT * FROM Users where username = '$email' and password = '$password'";

        $result = mysql_query($sql); /* or die(mysql_error());*/

        if(mysql_num_rows($result) > 0){
            

            $getID = mysql_query("SELECT user_id from Users where username = '$email' and password = '$password'");

            $temp = mysql_fetch_assoc($getID);
            $_SESSION['uid'] = $temp['user_id'];


            header('Location: user_page.php');
        }
        else
            header('Location: index.php');
        
    }

	public function makeBand()
	{
		//Update post names...
		$about = $_POST['aboutBand'];
		$name = $_POST['bandName'];
		$phone = $_POST['phone'];

        $about = mysql_real_escape_string($about);
        $name = mysql_real_escape_string($name);
        $phone = mysql_real_escape_string($phone);

        $uid = $_SESSION['uid'];
		
		$query = "INSERT INTO Band(band_name, band_phone, band_info)
			VALUES ('$name', '$phone', '$about');";


        
		
		if(!mysql_query($query))
		{
			header('Location: error.php');
		}
		else
		{

            $id = mysql_insert_id();
            $_SESSION['bID'] = $id;
            $bandIn = "INSERT Into BandsIn(band_id, user_id, directorFlag) values ($id, $uid, 1)";

            mysql_query($bandIn);
            $this->getBandsAllowed();
			header("Location: band_page.php?id=" . $_SESSION['bID'] );
		}
		
		//mysql_close($con);
	}


    public function logout()
    {
        echo "Log Out Successful";
        session_destroy();
        header("Location: index.php");

    }

    public function getBands()
    {
        $uid = $_SESSION['uid'];
        $query = mysql_query("SELECT Band.band_name, Band.band_id, BandsIn.directorFlag from BandsIn INNER JOIN Band ON BandsIn.band_id=Band.band_id where BandsIn.user_id = " . $_SESSION['uid']);

        


        while ($temp = mysql_fetch_assoc($query)) {

            $bName = $temp['band_name'];
            $bName = mysql_real_escape_string($bName);

            //checking
            $bid = $temp['band_id'];

            $dir = $temp['directorFlag'];



            if($dir == 0) {
                echo "<li><a href='band_page.php?id=" . $temp['band_id'] . "'><img src='img/User-icon.png' class='isDirector' height='15' width='15'>$bName</a></li>";
            }   
            else {
                echo "<li><a href='band_page.php?id=" . $temp['band_id'] .  "'><img src='img/wizard.png' class='isDirector' height='15' width='15'>$bName</a></li>";
            }

        }



    }

    public function getBandInfo(){

        
        $bID = $_SESSION['bID'];


        $query = "SELECT band_info from Band where band_id = $bID";
        $result = mysql_query($query);
        $temp = mysql_fetch_assoc($result);
        $info = mysql_real_escape_string($temp['band_info']);
        echo nl2br($info);

    }

     public function getBandName(){
             
        $bID = $_SESSION['bID'];
        $query = "SELECT band_name from Band where band_id = $bID";
        $result = mysql_query($query);
        $temp = mysql_fetch_assoc($result);
        $name = mysql_real_escape_string($temp['band_name']);
        echo $name;

    }

    public function setBID(){
        $_SESSION['bID'] = $_GET['id'];
        
    }

    public function getBandMembers(){



        $query = mysql_query("SELECT Users.fname, Users.lname from BandsIn INNER JOIN Users on BandsIn.user_id=Users.user_id where BandsIn.band_id = " . $_SESSION['bID']);

        while($temp = mysql_fetch_assoc($query)){
            $fname = $temp['fname'];
            $lname = $temp['lname'];


            echo "<li>$lname, $fname</li>";
        }

    }

    public function changeAbout(){

        $bID = $_SESSION['bID'];
        $newInfo = $_POST['newInfo'];
        $newInfo = mysql_real_escape_string($newInfo);

        mysql_query("UPDATE Band SET band_info= '$newInfo' where band_id = $bID");


        header("Location: band_page.php?id=" . $_SESSION['bID'] );

    }


    public function addBandMembers() {

        $bID = $_SESSION['bID'];

/*
        $members = $_SESSION['newMembers'];
        $dirFlags = $_SESSION['dirFlags'];
        $instruments = $_SESSION['instruments'];
        $parts = $_SESSION['parts'];
*/


        $members = array();
        $dirFlags = array();
        $instruments = array();
        $parts = array();

        for($i = 0; $i <=9; $i++){

            if($_POST['new' . strval($i+1)] != ""){

                array_push($members, $_POST['new' . strval($i+1)]);
                if(isset($_POST['dir' . strval($i+1)]))
                    array_push($dirFlags, 1);
                else
                    array_push($dirFlags, 0);

                if($_POST['Instrument' . strval($i+1)] != 'Other')
                    array_push($instruments, $_POST['Instrument' . strval($i+1)]);
                else
                    array_push($instruments, $_POST['oInstrument' . strval($i+1)]);

                array_push($parts, $_POST['part' . strval($i+1)]);
            }



        }
/*
        $members = array($_POST['new1'], $_POST['new2'], $_POST['new3'], $_POST['new4'], $_POST['new5'], $_POST['new6'], $_POST['new7'], $_POST['new8'], $_POST['new9'], $_POST['new10']);
        $dirFlags = array($_POST['dir1'], $_POST['dir2'], $_POST['dir3'], $_POST['dir4'], $_POST['dir5'], $_POST['dir6'], $_POST['dir7'], $_POST['dir8'], $_POST['dir9'], $_POST['dir10']);
        $instruments = array($_POST['Instrument1'], $_POST['Instrument2'], $_POST['Instrument3'], $_POST['Instrument4'], $_POST['Instrument5'], $_POST['Instrument6'], $_POST['Instrument7'], $_POST['Instrument8'], $_POST['Instrument9'], $_POST['Instrument10']);
        $parts = array($_POST['part1'], $_POST['part2'], $_POST['part3'], $_POST['part4'], $_POST['part5'], $_POST['part6'], $_POST['part7'], $_POST['part8'], $_POST['part9'], $_POST['part10']);
*/





        foreach ($members as $key => $value) {
            $value = mysql_real_escape_string($value);
            $temp = mysql_query("SELECT user_id from Users where username = '$value'");
            $uID = mysql_fetch_assoc($temp);
            $uID = $uID['user_id'];


            if($dirFlags[$key] == 1)
                $isDir = 1;
            else
                $isDir = 0;

            $instrument = $instruments[$key];
            $pID = $parts[$key];


            $query = "INSERT into BandsIn values($bID, $uID, '$instrument', $pID, $isDir)";
            mysql_query($query);

        }
        header("Location: band_page.php?id=$bID");


    }

    public function getContactInfo() {


        $bID = $_SESSION['bID'];

        $bPhone = mysql_query("SELECT band_phone from Band where band_id = $bID");

        $bPhone = mysql_fetch_assoc($bPhone);

        $query = mysql_query("SELECT Users.username, Users.lname, Users.fname from BandsIn INNER JOIN Users on BandsIn.user_id=Users.user_id where BandsIn.band_id = " . $_SESSION['bID'] . " AND BandsIn.directorFlag = 1");

        while($temp = mysql_fetch_assoc($query)){
            echo "<li>" . $temp['lname'] . ", " . $temp['fname'] . " - " . $temp['username'] . "</li>";
        }

        echo "<li>Band Phone Number - " . $bPhone['band_phone'] . "</li>";

    }

    public function setBandPhone() {

        $bID = $_SESSION['bID'];
        $phone = $_POST['changePhone'];

        $query = "UPDATE Band set band_phone = $phone where band_id = $bID";

        mysql_query($query);

        header("Location: band_page.php?id=" . $_SESSION['bID'] );
    }

    public function validateUserInBand() {
    
        $bandId = $_SESSION['bID'];
        $userID = $_SESSION['uid'];
        
        $query = "SELECT * FROM BandsIn WHERE BandsIn.band_id='$bandID' AND BandsIn.user_id='$userID')";
        
        mysql_query($query);
        
        if(mysql_num_rows($result) == 0)
        	header("Location: error.php");
    }

    public function getBandsAllowed() {

        $uID = $_SESSION['uid'];
        $bandsAllowed= array();
        array_push($bandsAllowed, 0);

        $query = "SELECT band_id from BandsIn where user_id = $uID";
        $result = mysql_query($query);

        if(mysql_num_rows($result) > 0){

            while($temp = mysql_fetch_assoc($result)){
                array_push($bandsAllowed, $temp['band_id']);

            }

            $_SESSION['allowed'] = $bandsAllowed;
        }
    }

    public function checkAllowed() {
        $bID = $_SESSION['bID'];

        if((array_search($bID, $_SESSION['allowed'])) < 1 || (array_search($bID, $_SESSION['allowed'])) == FALSE){
            
            header('Location: error.php');
        }
    }

    public function checkLoggedIn() {

        if(!isset($_SESSION['uid']))
            header('Location: NotLoggedIn.php');
    }

    public function changeEvents(){

        $bID = $_SESSION['bID'];
        $newEvents = $_POST['changeEvents'];
        $newEvents = mysql_real_escape_string($newEvents);

        mysql_query("UPDATE Band SET events = '$newEvents' where band_id = $bID");


        header("Location: band_page.php?id=" . $_SESSION['bID'] );

    }

    public function getEvents(){
        
        $bID = $_SESSION['bID'];


        $query = "SELECT events from Band where band_id = $bID";
        $result = mysql_query($query);
        $temp = mysql_fetch_assoc($result);
        $events = $temp['events'];
        echo nl2br($events);

    }

    public function getEventsForEdit(){
        
        $bID = $_SESSION['bID'];


        $query = "SELECT events from Band where band_id = $bID";
        $result = mysql_query($query);
        $temp = mysql_fetch_assoc($result);
        $events = $temp['events'];
        echo $events;

    }

    public function displayPDF(){
        $bID = $_SESSION['bID'];
        $uID = $_SESSION['uid'];
        $piece = $_GET['p'];
        $piece = mysql_real_escape_string($piece);



        $query = "SELECT piece_id from Pieces where band_id = $bID AND piece_name = '$piece'";
        $result = mysql_query($query);
        $temp = mysql_fetch_assoc($result);
        $pID = $temp['piece_id'];

        $query = "SELECT instrument from BandsIn where band_id= $bID AND user_id = $uID";
        $result = mysql_query($query);
        $temp = mysql_fetch_assoc($result);
        $instrument = $temp['instrument'];

        $bandName = str_replace(' ', '%20', $bandName);
        
        $query = "SELECT part_id from BandsIn where band_id = $bID AND user_id = $uID";
        $result = mysql_query($query);
        $temp = mysql_fetch_assoc($result);
        $part = $temp['part_id'];

        $query = "SELECT directorFlag from BandsIn where band_id = $bID AND user_id = $uID";
        $result = mysql_query($query);
        $temp = mysql_fetch_assoc($result);
        $isDir = $temp['directorFlag'];


        $fileLocation = "../Music/" . $bID . "/" . $pID . "/" . strtolower($instrument) . "_" . $part . ".pdf";


        //$instrument = "Piccolo";
        //$fileLocation = "../Music/Mustang%20Band/Western%20Peruna/" . $instrument . ".pdf";
        //$fileLocation = "Piccolo.pdf";
        
        echo "<html>";
        echo "<iframe src=$fileLocation width='100%' height='97%'> ";
        echo "</html>";
    }

    public function getMusicList(){
        $bID = $_SESSION['bID'];
        $uID = $_SESSION['uid'];

        $query = "SELECT band_name from Band where band_id = $bID";
        $result = mysql_query($query);
        $temp = mysql_fetch_assoc($result);
        $bandName = mysql_real_escape_string($temp['band_name']);

        $query2 = mysql_query("SELECT directorFlag from BandsIn where band_id = $bID");
        $temp2 = mysql_fetch_assoc($query2);
        $isDir = $temp2['directorFlag'];





        $query = "SELECT piece_name, piece_id from Pieces where band_id= $bID";
        $result = mysql_query($query);

        while($temp = mysql_fetch_assoc($result)){
            $piece = $temp['piece_name'];
            $pieceID = $temp['piece_id'];
            $forURL = str_replace(' ', '%20', $piece);
            if(!$isDir)
                echo "<li><a href=MusicDisplay.php?p=$forURL target='_blank'>$piece</a></li>";
            else
                echo "<li><a href=../Music/$bID/$pieceID/>$piece</a></li>";
                //echo "<li><a href=DirectorChoosePart.php?p=$piece target='_blank'>$piece</a></li>";
        }



    }

        public function showParts(){
        $bID = $_SESSION['bID'];
        $uID = $_SESSION['uid'];
        $pID = $_GET['p'];

        $query = "SELECT band_name from Band where band_id = $bID";
        $result = mysql_query($query);
        $temp = mysql_fetch_assoc($result);
        $bandName = mysql_real_escape_string($temp['band_name']);

    }

    public function upload(){
        $files = array();

        $bID = $_SESSION['bID'];

        $pieceName = $_POST['pieceName'];
        $pieceName = mysql_real_escape_string($pieceName);
        $_SESSION['pieceName'] = $pieceName;

        //$bandName = str_replace(' ', '\ ', $bandName);

        mysql_query("INSERT into Pieces(piece_name, band_id) values('$pieceName', $bID)");
        $pID = mysql_query("SELECT piece_id from Pieces where piece_name = '$pieceName' AND band_id = $bID");
        $pID = mysql_fetch_assoc($pID);
        $pID = $pID['piece_id'];


        
        mkdir('/var/www/DB-GUI/Music/' . $bID . '/' . $pID . '/', 0777, true);
        
        $count = 0;
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo '<form id = "Parts" action = "parts.php" method = "post">';
            echo '<ul>';
            foreach ($_FILES['files']['name'] as $i => $name) {
                if (strlen($_FILES['files']['name'][$i]) > 1) {

                    if (move_uploaded_file($_FILES['files']['tmp_name'][$i], '/var/www/DB-GUI/Music/' . $bID . '/'.$pID . '/' . $name)) {
                        $count++;
                    }
                    array_push($files, '/var/www/DB-GUI/Music/' . $bID . '/'.$pID . '/' . $name);

                    echo "<li>";
                    echo "$name";
                    echo '<select id="fileInstrument' . $i . '" name="fileInstrument' . $i . '" onchange="otherOpt(this.value);">
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

                            <input type = "text" name="oInstrumentFile' . $i . '"  id="oInstrumentFile"  style="display:none;" />

                            <label for="filePart ' . $i . '">Choose the Part</label>
                            <select id="filePart' . $i . '"  name="filePart' . $i . '" >
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                            </select>
                            </li>';
                }
            }
            $_SESSION['files'] = $files;

            echo '</ul>';
            echo '<input type="submit" name="partSet" id="partSet" value="Set Parts and Name Files"/></form>';
        }

        
    }

    public function renameFiles(){
        $bID = $_SESSION['bID'];
        $pieceName = $_SESSION['pieceName'];

        $files = $_SESSION['files'];

        $instruments = array();
        $parts = array();

        $pID = mysql_query("SELECT piece_id from Pieces where piece_name = '$pieceName' AND band_id = $bID");
        $pID = mysql_fetch_assoc($pID);
        $pID = $pID['piece_id'];



        $count = 0;
        foreach ($files as $i => $name) {
            if (strlen($files[$i]) > 1) {
                if($_POST['fileInstrument' . strval($i)] != ""){
                    $instrument = $_POST['fileInstrument' . strval($i)];

                    if($instrument != 'Other')
                        array_push($instruments, $instrument);
                    else
                        array_push($instruments, $_POST['oInstrumentFile' . strval($i)]);

                    array_push($parts, $_POST['filePart' . strval($i)]);

                    $fileName = $instruments[$i] . '_' . $parts[$i];
                    $fileName = str_replace(' ', '_', $fileName);
                    rename($files[$i], '/var/www/DB-GUI/Music/' . $bID . '/'.$pID . '/' . strtolower($fileName) . '.pdf');
                    $count++;
                }
            }
        }
        header("Location: band_page.php?id=" . $_SESSION['bID'] );
    }


    public function ifDirGetManagement() {
        $bID = $_SESSION['bID'];

        $query = mysql_query("SELECT directorFlag from BandsIn where band_id = $bID");
        $temp = mysql_fetch_assoc($query);
        $isDir = $temp['directorFlag'];


        if($isDir == 1)
            echo "<li><a href='#management' class='notselected'>Band Management</a></li>";
        else
            return;
    }

    public function checkFacebook() {

    }

    public function testAndroid() {
        $test = $_POST['userName'];
        $test2 = $_POST['password'];
        echo "$test";
        error_log("$test", 0);
        error_log("$test2", 0);



        // String $testJson = '{"widget": {
        //     "valid": "1",
        //     "bands": [
        //         { "id":"1"}, 
        //         { "id":"3"}, 
        //         { "id":"8"}
        //     ]
        //     }}';

        $testing = array(
            "valid" => 1,
            );

        // array(
        //         "band_id" => 1,
        //         "band_id" => 3)

        $testJson = "{
                        'user': {
                            'id': 1,
                            'bands': {
                                'bandIDs': [
                                    {'bid': 1},
                                    {'bid': 3}
                                ]
                            }
                        }
                    }";

        $diffTest = '{"menu": {
                          "id": "file",
                          "value": "File",
                          "popup": {
                            "menuitem": [
                              {"value": "New", "onclick": "CreateNewDoc()"},
                              {"value": "Open", "onclick": "OpenDoc()"},
                              {"value": "Close", "onclick": "CloseDoc()"}
                            ]
                          }
                        }}';


        $results = array(
            "result"   => "success",
            "username" => "some username",
            "projects" => "some other value"
        );

        echo json_encode($testing);

        return;

    }




}




?>
