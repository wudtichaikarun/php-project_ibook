<?php
session_start();
$Username = $_REQUEST["username"];
$Password  = MD5($_REQUEST["password"]);

//1. conection:
include("conection.php");
//Close auto commit
//mysqli_autocommit($con, FALSE);

//2. consultation:
//$query = "SELECT * FROM user WHERE BINARY Username = BINARY '$Username' AND Password = '$Password'";
$sql = "SELECT * FROM ibookuser WHERE BINARY user_name='$Username' AND user_password='$Password'";
//3. execute the query.
$result = mysqli_query($con, $sql);

//condition
if(mysqli_num_rows($result) == 0){
  echo "<script>";
  echo "alert('Error! incorrect Username or Password.');";
  echo "window.location = 'iBookLogin.php';";
  echo "</script>";
}else {
  $row = mysqli_fetch_array($result);
  $_SESSION['UserName'] = $row["user_name"];
  $_SESSION["UserId"] = $row["user_id"];
  $_SESSION["UserLevel"] = $row["user_level"];
  $UserId = $row["user_id"];

  $sql2 = "insert into Book_read_log values(NULL, '$UserId', 'login', NULL)";
  $query2 = mysqli_query($con, $sql2);
  //condition
  if($row["user_level"] == 'A'){
    header("Location: indexAdmin.php");
    exit();
  }else if ($row["user_level"] == 'U'){
    header("Location: index.php");
    exit();
  }
  else{
    header("iBookLogin.php");
    exit();
  }
}
//5. close connection
mysqli_close($con);
?>
