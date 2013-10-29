<?

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


        $count = "SELECT * from Users WHERE(username = '$email')";
        

        if(!mysql_query($count))
        {
            header('Location: error.php');
        }
        else
        {
            $result = mysql_query($count);
            $num_rows = mysql_num_rows($result);

            if($num_rows > 0)
            {
                header('Location: EmailTaken.php');
            }
            else
            {
                $query = "INSERT INTO Users(fname, lname, username,password) VALUES 
                    ('$fname', '$lname','$email','$password')";
        /*
                $query = "INSERT INTO Users(fname, lname, user_id, username,password) VALUES 
                    ('" . $_POST['firstName'] . "', '" . $_POST['lastName'] . "',444,'" . $_POST['newEmail'] . "','" . $_POST['newPassword'] . "')";*/
                if(!mysql_query($query))
                {

                    header('Location: error.php');
                }
                else
                {
                    $getID = mysql_query("SELECT user_id from Users where username = '" . $_POST['email'] . "' and password = '" . $_POST['password'] ."'");

                    $temp = mysql_fetch_assoc($getID);
                    $_SESSION['uid'] = $temp['user_id'];

                    header('Location: user_page.php');
                }
            }
        }
        
        //mysql_close($con);
    
    }


    public function validateUser()
    {

        
        
        $valid = 0;

       // $sql = "SELECT password, user_id FROM Users WHERE username = '$email'";
        $sql = "SELECT * FROM Users where username = '" . $_POST['email'] . "' and password = '" . $_POST['password'] ."'";

        $result = mysql_query($sql); /* or die(mysql_error());*/

        if(mysql_num_rows($result) > 0){
            

            $getID = mysql_query("SELECT user_id from Users where username = '" . $_POST['email'] . "' and password = '" . $_POST['password'] ."'");

            $temp = mysql_fetch_assoc($getID);
            $_SESSION['uid'] = $temp['user_id'];


            header('Location: user_page.php');
        }
        else
            header('Location: index.php');
        
        //mysql_close($con);
        /*

        while($row = mysql_fetch_assoc($result))
        {
            foreach($row as $cname => $cvalue)
            {
                if ($cname == "password"){
                    if ( $password == $cvalue){
                        $valid = 1;
                    }
                }
                if ($cname == "user_id"){
                    $_SESSION['cID'] = $cvalue;
                }
            }
        }
        if ($valid == 1)
            header("Location: band_page.php");
        else
            header("Location: index.php");
        */
    }

	public function makeBand()
	{
		//Update post names...
		$about = $_POST['aboutBand'];
		$name = $_POST['bandName'];
		$phone = $_POST['phone'];

        $about = $_POST['aboutBand'];

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
			header("Location: band_page.php?id=" . $_SESSION['bID'] );
		}
		
		//mysql_close($con);
	}


    public function logout()
    {
        echo "Log Out Successful";
        session_destroy();

    }

    public function getBands()
    {
        $uid = $_SESSION['uid'];
        $query = mysql_query("SELECT Band.band_name, Band.band_id from BandsIn INNER JOIN Band ON BandsIn.band_id=Band.band_id where BandsIn.user_id = " . $_SESSION['uid']);

        


        while ($temp = mysql_fetch_assoc($query)) {
            echo "<li><a href='band_page.php?id=" . $temp['band_id'] . "'>" . $temp['band_name'] . "</a></li>";

        }



    }

    public function getBandInfo(){

        
        $bID = $_SESSION['bID'];


        $query = "SELECT band_info from Band where band_id = $bID";
        $result = mysql_query($query);
        $temp = mysql_fetch_assoc($result);
        echo $temp['band_info'];

    }

    public function setBID(){
        $_SESSION['bID'] = $_GET['id'];
        
    }

    public function getBandMembers(){



        $query = mysql_query("SELECT Users.fname, Users.lname from BandsIn INNER JOIN Users on BandsIn.user_id=Users.user_id where BandsIn.band_id = " . $_SESSION['bID']);

        while($temp = mysql_fetch_assoc($query)){
            echo "<li>" . $temp['lname'] . ", " . $temp['fname'] . "</li>";
        }

    }

    public function changeAbout(){

        $bID = $_SESSION['bID'];
        $newInfo = $_POST['newInfo'];

        mysql_query("UPDATE Band SET band_info= '$newInfo' where band_id = $bID");


        header("Location: band_page.php?id=" . $_SESSION['bID'] );

    }




}




?>
