<?php
  session_start();
  $UserID = $_SESSION['UserId'];

  include("./inc/connectionSecure.inc.php");
	// Function query
  function db_query ($query) {
    // Connect to the database
    $connection = db_connect(); 
    // Query the database
    $result = mysqli_query($connection,$query);    
    return $result;
	}
  
  //books
  $bookName = $_REQUEST["book_name"];
  $bookPicture  = $_FILES["book_picture"]["name"];//chang variable
  $bookFile = $_FILES["book_file"]["name"];//chang variable
  $categorysId  = $_REQUEST["categorys_id"];
  //books_series
  $seriesName  = $_REQUEST["series_name"];
  $seriesNumber = $_REQUEST["series_number"];
  //part of file
  $target_file_picture = 'images/' . basename($_FILES["book_picture"]["name"]);
  $target_file = 'file/' . basename($_FILES["book_file"]["name"]);
  //up load file
  $check1 = move_uploaded_file($_FILES["book_picture"]["tmp_name"], $target_file_picture);
  $check2 = move_uploaded_file($_FILES["book_file"]["tmp_name"], $target_file);
  // echo $check;//show
  if ($check1 && $check2) {
    $query = "INSERT INTO books(book_name, book_picture, book_file, categorys_id) VALUES('$bookName',
    '$bookPicture', '$bookFile', '$categorysId')";
    $result = db_query($query);
    $query2 = "insert into modify_ibooks values(NULL, '$UserID', 'add_book', NULL)";
    $result2 = db_query($query2);
    if (($seriesName && $seriesNumber) != '') {
      $query3 = "insert into books_series values(NULL, '$bookName', '$seriesName', '$seriesNumber', '$categorysId')";
      $result3 = db_query($query3);
    }
    if ($result && $result2) {
      echo"<script>";
        echo"alert('Addition-Sucess');";
        echo"window.location = 'addNewBook.php';";
      echo"</script>";
    } else { 
      echo"<script>";
        echo"alert('sory-unsucess!!');";
        echo"window.location = 'addNewBook.php';";
      echo"</script>";
      mysqli_close($con);
    }
  }
?>
