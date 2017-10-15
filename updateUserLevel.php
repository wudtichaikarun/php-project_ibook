<?php
  include("conection.php");
  $userID = $_POST['user_id_update'];
  $userLevel = $_POST['user_level_update'];
  $act = $_POST['act'];
  if ($act == 'update') {
    $sql= "UPDATE ibookuser SET user_level='$userLevel' WHERE user_id='$userID'";
    $result = mysqli_query($con, $sql);
  } else if ($act == 'delete') {
    $sql= "DELETE from ibookuser  WHERE user_id='$userID'";
    $result = mysqli_query($con, $sql);
  }
?>
