<?php session_start();
$userID = $_SESSION["UserId"];
$userLEVEL = $_SESSION["UserLevel"];
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
  <script src="js/jquery-3.2.0.min.js"></script>
  <script src="js/jquery.blockUI.js"></script>
  <script src="css/bootstrap.min.js"></script>
  <script src="js/jquery-crud.js" type="text/javascript"></script>
</head>
<body>
  <?php
  echo "<input type='hidden' id='userLEVEL' value='$userLEVEL'>";
  //condition check Userlevel
  if(!isset($_SESSION["UserLevel"]) || $_SESSION["UserLevel"] != 'U'){
    echo "<script>";
    echo "alert('Error Please Log in');";
    echo "window.location = 'iBookLogin.php';";
    echo "</script>";
  } else {
    //1. conection:
    include("conection.php");
    // Nav menu
    include_once('./inc/navOtherPage.inc.php');
    ?>
    <div class="container">
      <div class="row">
        <?php
        $query = "SELECT * FROM books";
        $result = mysqli_query($con, $query);
        // Loop create object
        include_once('./inc/whileLoopUser.inc.php');
      echo "</div>"; // End of row
    echo "</div>"; // End of container
    mysqli_close($con);
  } // End of else condition check userlevel
  // Footer
  include_once('./inc/footer.inc.php');
  ?>
</body>
</html>
