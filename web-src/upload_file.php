<html lang="en">
  <head>
    <title>Name the files!</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src='js/bandPage.js'></script> 
  </head>
  <body id="upload">
  	<div id="top_bar">
      <a href="logout.php" class="logout">Log Out</a>
    </div>
  </body>
</html>
<? 

include 'phpAPI.php';



$phpInit = new phpAPI();
$phpInit->upload();


?>