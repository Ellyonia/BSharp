<html lang="en">
  <head>
    <title>Name the files!</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src='js/bandPage.js'></script> 
  </head>
  <body id="upload">
  	<h1>Please Select the instrument and part for each file you are uploading</h1>
  </body>
</html>
<? 

include 'phpAPI.php';



$phpInit = new phpAPI();
$phpInit->upload();


?>