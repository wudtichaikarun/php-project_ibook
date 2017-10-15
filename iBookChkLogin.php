<?php
  session_start();
  $Username = $_REQUEST["username"];
  $Password  = MD5($_REQUEST["password"]);
  include("conection.php");
  $sql = "SELECT * FROM ibookuser WHERE BINARY user_name='$Username' AND user_password='$Password'";
  $result = mysqli_query($con, $sql);
  if (mysqli_num_rows($result) == 0) {
    echo "<script>";
    echo "alert('Error! incorrect Username or Password.');";
    echo "window.location = 'iBookLogin.php';";
    echo "</script>";
  } else {
    $row = mysqli_fetch_array($result);
    $_SESSION['UserName'] = $row["user_name"];
    $_SESSION["UserId"] = $row["user_id"];
    $_SESSION["UserLevel"] = $row["user_level"];
    $UserId = $row["user_id"];
    $sql2 = "insert into Book_read_log values(NULL, '$UserId', 'login', NULL)";
    $query2 = mysqli_query($con, $sql2);
    // Check user level user(U) or admin(A)
    if ($row["user_level"] == 'A') {
      header("Location: indexAdmin.php");
      exit();
    } else if ($row["user_level"] == 'U') {
      header("Location: index.php");
      exit();
    } else {
      header("iBookLogin.php");
      exit();
    }
  }
  // close connection
  mysqli_close($con);
?>
