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
        $user_id = 444; //$_POST['user_id'];    // manually added just for a test
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $email = $_POST['newEmail'];
        $password = $_POST['newPassword'];


        $query = "INSERT INTO Users(fname, lname, user_id, username,password) VALUES 
            ('$fname', '$lname',555,'$email','$password')";

/*
        $query = "INSERT INTO Users(fname, lname, user_id, username,password) VALUES 
            ('" . $_POST['firstName'] . "', '" . $_POST['lastName'] . "',444,'" . $_POST['newEmail'] . "','" . $_POST['newPassword'] . "')";*/
        if(!mysql_query($query))
        {
            header('Location: band_page.php');
            //return false;
        }
        else
        {
            header('Location: error.php');
            //return; 
        }
    
    }


    public function validateUser()
    {

        
        
        $valid = 0;

       // $sql = "SELECT password, user_id FROM Users WHERE username = '$email'";
        $sql = "SELECT * FROM Users where username = '" . $_POST['email'] . "' and password = '" . $_POST['password'] ."'";

        $result = mysql_query($sql); /* or die(mysql_error());*/

        if(mysql_num_rows($result) > 0)
            header('Location: band_page.php');
        else
            header('Location: index.php');
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


}
?>