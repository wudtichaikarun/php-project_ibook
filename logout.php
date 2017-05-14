<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>logout</title>
  </head>
  <body>
<h2>logout.php</h2>
<?
session_start();
$UserId = $_SESSION["UserId"];

include("conection.php");

$sql = "insert into Book_read_log values(NULL, '$UserId', 'logout', NULL)";
$query = mysqli_query($con, $sql);
session_destroy();
header("Location: iBookLogin.php");

mysqli_close($con);
?>
  </body>
</html>
