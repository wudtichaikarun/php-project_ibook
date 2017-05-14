<?php
session_start();
$UserID = $_SESSION['UserId'];
include("conection.php");
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
if($check1 && $check2){
  $sql= "INSERT INTO books(book_name, book_picture, book_file, categorys_id) VALUES('$bookName',
  '$bookPicture', '$bookFile', '$categorysId')";
  $result = mysqli_query($con, $sql);

  $sql2 = "insert into modify_ibooks values(NULL, '$UserID', 'add_book', NULL)";
  $query2 = mysqli_query($con, $sql2);

  if(($seriesName && $seriesNumber) != ''){
    $sql3 = "insert into books_series values(NULL, '$bookName', '$seriesName', '$seriesNumber', '$categorysId')";
    $query3 = mysqli_query($con, $sql3);
  }

  if($result && $query2){
        ?>
          <script>
            alert('Addition-Sucess');
            window.location = 'addNewBook.php';
          </script>
<?php
   }else{ ?>
          <script>;
            alert('sory-unsucess!!');
            window.location = 'addNewBook.php';;
          </script>
<?php
mysqli_close($con);
  }
}
?>
