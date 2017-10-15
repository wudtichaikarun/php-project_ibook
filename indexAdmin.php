<?php session_start();
$userID = $_SESSION["UserId"];
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
  if (!isset($_SESSION["UserLevel"]) || $_SESSION["UserLevel"] != 'A') {
    echo "<script>";
    echo "alert('Error Please Log in');";
    echo "window.location = 'iBookLogin.php';";
    echo "</script>";
  } else {
    // Connect database
    include("conection.php");
    // Nav menu
    include_once('./inc/navAdmin.inc.php')
    ?>
    <div class="container">
      <div class="row">
        <?php
        $query = "SELECT * FROM books";
        $result = mysqli_query($con, $query);
        // Loop create objects
        include_once('./inc/whileLoop.inc.php');
      echo "</div>"; // End of row
    echo "</div>"; // End of container
    mysqli_close($con);
  } // End of else condition check userlevel
  // Footer
  include_once('./inc/footer.inc.php');
  ?>
</body>
</html>
