<!-- Team 6
Ryan Tanner
Robert Stewart
Guy Cockrum
Nick Morris
Cameron Keith
Chris Linstromberg 
  B# -->


<?php

    session_start();

    if(isset($_POST['signIn'])){
         $_SESSION['email'] = $_POST['email'];
         $_SESSION['password'] = $_POST['password'];

         header("Location: user_page.php");

    }

    if(isset($_POST['signUp'])){
         $_SESSION['email'] = $_POST['newEmail'];
         $_SESSION['password'] = $_POST['newPassword'];
         $_SESSION['repass'] = $_POST['reTypePass'];
         $_SESSION['fname'] = $_POST['firstName'];
         $_SESSION['lname'] = $_POST['laststName'];

         header("Location: user_page.php");

    }



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Welcome to B#</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src='js/IndexJS.js'></script>
  </head>

  <body>
    <img src="img/logo.png" id = "ilogo" alt = "B Sharp Logo">
    
    <!-- Testing Facebook -->
    <div id="loginContainer">
      <div id="fbbuttoncontainer">
        <form action="checkFacebook.php" method="POST">
          <input type="submit" name="fb" id="fbLogin" value>
        </form>
      </div>

      <!--<fb: login-button show-faces="true" width="200" max-rows="1"></fb: login-button>-->
      <form id="login" action = "validateUserLogin.php" method = "post">
          <div class="logEmail">
              <label>Email: </label>
              <input type="email" name = "email" id="email" required maxlength="45" placeholder="email@example.com" oninvalid="setCustomValidity('Please enter a valid email address')" onchange="try{setCustomValidity('')}catch(e){}"/>
          </div>
          <div class="logPass"> 
              <label>Password:</label>
              <input type="password" id="logPass" name = "password" maxlength="45" pattern = "{8,}" placeholder = "Password" oninvalid="setCustomValidity('Password must be greater than 8 characters')" onchange="try{setCustomValidity('')}catch(e){}" required/>
              <input type="submit" value="Login" name="signIn" id="signIn" /> 
          </div>
      </form>
    </div>

    <div class='info'>
      <p>We are a start up whose focus is to create a way for performing ensembles to digitially store their sheet music for ease of performers to access any sheet music they have lost.</p>
    </div>

    <div class="page">
        <form id="register" class = "register" method = "post" action = "addUser.php">

            <header>Create a B# Account</header>
            <div class="hr"><hr /></div>
            <input type="hidden" name="setPassword">
        <ul>
            <li>
                <input type="text" maxlength="20" placeholder="First Name" pattern = "^[A-Za-z-']*$" id="firstName" name = "firstName" oninvalid="setCustomValidity('Please enter only Letters or these symbols: - or a single quote')" onchange="try{setCustomValidity('')}catch(e){}" required/>
                <input type="text" maxlength-"20" placeholder="Last Name" pattern = "^[A-Za-z-']*$" id="lastName" name = "lastName" oninvalid="setCustomValidity('Please enter only Letters or these symbols: - or a single quote')" onchange="try{setCustomValidity('')}catch(e){}" required/>
            </li>

            <li>
                <input type="email" maxlength="45" placeholder="Email" id="newEmail" name = "newEmail"oninvalid="setCustomValidity('Please eneter a valid email address')" onchange="try{setCustomValidity('')}catch(e){}" required/>
            </li>

            <li>
                <input type="password" maxlength="45" id="newPassword" name = "newPassword" pattern = "{8,}" placeholder = "Password" oninvalid="setCustomValidity('Password must be greater than 8 characters')" onchange="try{setCustomValidity('')}catch(e){}" required/>
            </li>
            <li>
                <input type="password" maxlength="45" id="reTypePass" name = "reTypePass" pattern = "{8,}" placeholder = "Re-Type Password" oninvalid="setCustomValidity('Password must be the same as above and be greater than 8 characters')" onchange="try{setCustomValidity('')}catch(e){}" required/>
            </li>
        </ul>
                <input type="submit" value="Sign Up" id="signUp" name = "signUp" />
      </form>
</div>
 
  </body>
</html>
