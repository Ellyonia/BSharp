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
    <form id="login" action = "validateUserLogin.php" method = "post">
        <div class="logEmail">
            <label>Email: </label>
            <input type="email" name = "email" id="email" required placeholder="email@example.com" oninvalid="setCustomValidity('Please eneter a valid email address')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </div>
        <div class="logPass"> 
            <label>Password:</label>
            <input type="password" id="logPass" name = "password" pattern = "[a-zA-Z0-9:.,?!@]{8,}" placeholder = "Password" oninvalid="setCustomValidity('Password must be greater than 8 characters')" onchange="try{setCustomValidity('')}catch(e){}" required/>
            <input type="submit" value="Login" name="signIn" id="signIn" /> 
        </div>
    </form>

    <div class='info'>
      <p>Some info about the site: Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>

    <div class="page">
        <form id="register" class = "register" method = "post" action = "addUser.php">

            <header>Create a B# Account</header>
            <div class="hr"><hr /></div>
            <input type="hidden" name="setPassword">
        <ul>
            <li>
                <input type="text" placeholder="First Name" pattern = "^[A-Za-z-_'.]*$" id="firstName" name = "firstName" oninvalid="setCustomValidity('Please eneter only Letters or these symbols: &#39 &quot _ or - ')" onchange="try{setCustomValidity('')}catch(e){}" required/>
                <input type="text" placeholder="Last Name" pattern = "^[A-Za-z-_'.]*$" id="lastName" name = "lastName" oninvalid="setCustomValidity('Please eneter a valid email address')" onchange="try{setCustomValidity('')}catch(e){}" required/>
            </li>

            <li>
                <input type="email" placeholder="Email" id="newEmail" name = "newEmail"oninvalid="setCustomValidity('Please eneter a valid email address')" onchange="try{setCustomValidity('')}catch(e){}" required/>
            </li>

            <li>
                <input type="password" id="newPassword" name = "newPassword" pattern = "[a-zA-Z0-9:.,?!@]{8,}" placeholder = "Password" oninvalid="setCustomValidity('Password must be greater than 8 characters')" onchange="try{setCustomValidity('')}catch(e){}" required/>
            </li>
            <li>
                <input type="password" id="reTypePass" name = "reTypePass" pattern = "[a-zA-Z0-9:.,?!@]{8,}" placeholder = "Re-Type Password" oninvalid="setCustomValidity('Password must be the same as above and be greater than 8 characters')" onchange="try{setCustomValidity('')}catch(e){}" required/>
            </li>
        </ul>
                <input type="submit" value="Sign Up" id="signUp" name = "signUp" />
      </form>
</div>
 
  </body>
</html>
