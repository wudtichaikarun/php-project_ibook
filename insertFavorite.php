<?php
    include("conection.php");

    $BookID = $_POST['item_bookID_no'];
    $actADD = $_POST['data_addFav'];
    $Status = $_POST['data_status_yes'];
    $UserID  = $_POST['user_id'];

    if($actADD == 'add'){
      //2. consultation.
      $sql= "INSERT INTO favorite(status, user_id, fav_bookID) VALUES('$Status',
      '$UserID ', '$BookID')";
      // execute the query.
      $result = mysqli_query($con, $sql);

      if(mysqli_affected_rows($con) != 0){
        echo "true,Add-favorite-Yes";
      }else{
        echo "false,Add-favorite-No";
      }


    }

?>
