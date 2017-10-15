<?php
  include("conection.php");
  $BookID = $_REQUEST["bookID"];
  $ACT = $_REQUEST["act"];
  if ($ACT == 'del') {
    //2. consultation.
    $sql= "DELETE From books WHERE book_id='$BookID'";
    $sql2= "DELETE From favorite WHERE fav_bookID='$BookID'";
    // execute the query.
    $result = mysqli_query($con, $sql) or die ("Error in query: $sql" . mysqli_error());
    $result2 = mysqli_query($con, $sql2) or die ("Error in query: $sql2" . mysqli_error());
    mysqli_close($con);
    // Link to indexAdmin Page
    echo"<script> window.location = 'indexAdmin.php'; </script>";
  } 
?>
