<?php session_start();
$userID = $_SESSION["UserId"];
echo "userName:".$_SESSION['UserName']." id:".$_SESSION["UserId"]." level:".$_SESSION["UserLevel"] ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>IndexAdminMenu</title>
  <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
  <script src="js/jquery-3.2.0.min.js"></script>
  <script src="css/bootstrap.min.js"></script>
  <script src="dist/sweetalert.min.js"></script>
  <script src="js/jquery.blockUI.js"></script>
  <script src="js/jquery-crud.js" type="text/javascript"></script>
</head>
<body>
  <?php
  // Condition check userlevel
  if (!isset($_SESSION["UserName"]) || $_SESSION["UserLevel"] != 'A') {
    echo "<script>";
    echo "alert('Error Please Log in');";
    echo "window.location = 'iBookLogin.php';";
    echo "</script>";
  } else {
    // Connect database
    include("./inc/connectionSecure.inc.php");
    // Nav menu
    include_once('./inc/navAdmin.inc.php')
    ?>
    <div class="container">
      <div class="row">
        <?php
        function db_query ($query) {
          // Connect to the database
          $connection = db_connect(); 
          // Query the database
          $result = mysqli_query($connection,$query);    
          return $result;
        }
        $result = db_query("SELECT * FROM books");
        // $query = "SELECT * FROM books";
        // $result = mysqli_query($con, $query);
        // Loop create objects
        include_once('./inc/whileLoop.inc.php');
      echo "</div>"; // End of row
    echo "</div>"; // End of container
    // Close connection
    mysqli_close(db_connect());
  } // End of else condition check userlevel
  // Footer
  include_once('./inc/footer.inc.php');
  ?>
</body>
</html>
