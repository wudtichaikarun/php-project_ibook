<?php
  include("conection.php");
  $BookID = $_POST['item_bookID_Yes'];
  $actDEL = $_POST['data_delFav'];
  $UserID  = $_POST['user_id'];
  if ($actDEL == 'del') {
    $sql= "DELETE From favorite WHERE fav_bookID='$BookID' and user_id='$UserID'";
    $result = mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) != 0) {
      echo "true,DELETE-favorite-Yes";
    } else {
      echo "false,DELETE-favorite-No";
    }
  }
?>
