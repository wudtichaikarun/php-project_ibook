<?php
  session_start();
  $Username = $_REQUEST["username"];
  $Password  = MD5($_REQUEST["password"]);
  include("./inc/connectionSecure.inc.php");
  function db_query ($query) {
    // Connect to the database
    $connection = db_connect(); 
    // Query the database
    $result = mysqli_query($connection,$query);    
    return $result;
  }

  $query = "SELECT user_name, user_id, user_level  FROM ibookuser WHERE BINARY user_name='$Username' AND user_password='$Password'";
  $result = db_query($query);

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

    // Store user login logs
    $insert = "insert into Book_read_log values(NULL, '$UserId', 'login', NULL)";
    $insert_result = db_query($insert);

    // Check user level user(U) or admin(A)
    if ($_SESSION["UserLevel"] === 'A') {
      header("Location: indexAdmin.php");
      exit();
    } else if ($_SESSION["UserLevel"] === 'U') {
      header("Location: index.php");
      exit();
    } else {
      header("iBookLogin.php");
      exit();
    }
  }
  // close connection
  mysqli_close(db_connect());
?>
