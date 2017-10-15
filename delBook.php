<?php
  session_start();
  include('conection.php');
  $UserID = $_SESSION['UserId'];
  $bookID = $_REQUEST['bookId'];
  $act = 'del_book';
  $sql = "SELECT * FROM books WHERE book_id='$bookID' ";
  $query = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($query);
  $Picture = $row['book_picture'];
  $file = $row['book_file'];
  unlink("images/$Picture");
  unlink("file/$file");
  $sql2 = "DELETE FROM books WHERE book_id='$bookID'";
  $query = mysqli_query($con, $sql2);
  $sql3 = "SELECT fav_bookID FROM favorite WHERE fav_bookID='$bookID'";
  $query3 = mysqli_query($con, $sql3);
  $result2 = mysqli_fetch_array($query3);
  //delete favorite if has.
  if ($result2 != 0) {
    $sql4 = "DELETE FROM favorite WHERE fav_bookID='$bookID'";
  }
  //Insert data to modify_ibooks
  $sql4 = "insert into modify_ibooks value(NULL, '$UserID', '$act', NULL)";
  $query4 = mysqli_query($con, $sql4);
  // Check are you user or admin and Link to page
  if($query && $query4){
    ?>
    <script>
      //alert('Delete-Sucess');
      window.location = 'indexAdmin.php';
    </script>
    <?php
  } else { 
    ?>
    <script>;
      //alert('Delete-unsucess!!');
      window.location = 'indexAdmin.php';;
    </script>
    <?php
    mysqli_close($con);
  }
?>
