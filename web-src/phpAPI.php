<?

class phpAPI
{

     
    function phpAPI()
    {
        session_start();

        $con = mysql_connect("localhost", "root", "narwhal");
        if(!$con)
            die('Could not connect: ' . mysql_error());

        mysql_select_db("BSharp", $con)
        or die("Unable to select database: " . mysql_error());
    }


    public function addUser()
    {   
        //add a user to the system
        $user_id = $_POST['user_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "INSERT INTO Users(fname, lname, user_id, username,password) VALUES 
            ('$fname','$lname','$user_id','$username','$password)";
        if(!mysql_query($query))
        {
            return false;
        }
        else
        {
            return; 
        }
    
    }


    public function validateUser()
    {



        $sql = "SELECT password, user_id FROM Users WHERE username = '$email'";

        $result = mysql_query($sql) or die(mysql_error());
        while($row = mysql_fetch_assoc($result))
        {
            foreach($row as $cname => $cvalue)
            {
                if ($cname == "password")
                    if ( $password == $cvalue)
                        $valid = 1;

              if ($cname == "user_id")
                $_SESSION['cID'] = $cvalue;
            }
        }
        if ($valid == 1)
            header("Location: band_page.php");
        else
            header("Location: index.php");
        
    }


}
?>