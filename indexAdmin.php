<?php session_start();
$userID = $_SESSION["UserId"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>IndexAdminMenu</title>
  <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
  <script>
    $(document).ready(function () {
      // Delete book
      $(".delete-icon").click(function () {
        var isThis = $(this);
        // Confirm modal
        swal ({
          title: "Confirm Delete!",
          text: "Do you want to delete this book!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Delete",
          closeOnConfirm: false,
          closeOnCancel: false
          }, function (isConfirm) {
              if (isConfirm) {
                swal ({
                  title: "Delete Sucess",
                  text: "delete book success",
                  type: "success",
                  confirmButtonColor: "#90EE90",
                  confirmButtonText: "Sucess",
                  closeOnConfirm: false,
                }, function (isConfirm) {
                    if (isConfirm) {
                      var href = isThis.parent().find('.a_del_book').attr('href');
                      window.location.href = href;
                    }
                } );
              } else {
                  swal("Cancel","Cancel delete book!","warning");
              }
          } );
      } );
      // Select favorite book
      $(".favorit-icon").click(function () {
        var form = $(".row");
        var item_bookID_Yes = $(this).parent().find('.sliderFav').attr('data-bookID');
        var item_bookID_no = $(this).parent().find('.slider').attr('data-bookID');
        var data_addFav = 'add';
        var data_delFav = 'del';
        var data_status_yes = 'Yes';
        var whiteYes = $(this).parent().find('.readStatus');
        //จริงๆไม่ต้องส่งไปเพราะมีในตัวแปร session แล้ว แต่ถ้าแก้ต้องแก้ file favorite ด้วย
        var user_id = $(this).parent().find('.dataUser').attr('dataUser');
        //read from favorite book by fech array
        var readFavStatus = $(this).parent().find('.readStatus').attr('readStatus');
        /* console.log(item_bookID_Yes);
        console.log(item_bookID_no);
        console.log(data_addFav);
        console.log(data_delFav);
        console.log(readFavStatus);
        console.log(user_id ); */
        if (readFavStatus == 'Yes') {
          //delete favorite book from data base
          var jqxhr = $.ajax({
            url: "delFavorite.php",
            dataType:'html',
            type: 'POST',
            data: {'item_bookID_Yes':item_bookID_Yes, 'data_delFav':data_delFav, 'user_id':user_id},
            beforeSend:function() { $.blockUI(); },
            complete:function(){ $.unblockUI(); },
            success: showResult
          } ).fail(function (xhr, status, exception) {
              alert(status);
          } );
          function showResult(result) {
            //favoriteText.replaceWith("<p class='favorite-text'>favorite</p>");
            whiteYes.replaceWith(  "<p class='readStatus' readStatus=''></p>");
            //alert(result)
          }
        } else {
          //add favorite to data base
          var jqxhr = $.ajax({
            url: "insertFavorite.php",
            dataType:'html',
            type: 'POST',
            data: {'item_bookID_no':item_bookID_no, 'data_addFav':data_addFav,'data_status_yes':data_status_yes, 'user_id':user_id},
            beforeSend:function() { $.blockUI(); },
            complete:function(){ $.unblockUI(); },
            success: showResult
          } ).fail(function (xhr, status, exception) {
              alert(status);
          } );
          function showResult(result) {
            //alert(result)
            if (result.length != 0) {
              //alert("have value");
              //favoriteText.replaceWith("<p class='favorite-text'>favorite</p>");
              whiteYes.replaceWith( "<p class='readStatus' readStatus='Yes'></p>");
            }
          }
        }
      } );
      // Search data autocomplete
      $("#word").keyup(function () {
        //var act = 'autocomplete';
        if($("#word").val() != ""){
          var jqxhr = $.ajax( {
            url: "adminSearchBook.php",
            data: "act=" + "autocomplete"+ "&word=" + $("#word").val(),
            type: "POST",
            async: false
          } ).done (function (data, status) {
              $("#hint").html(data);
          } ).fail (function (xhr,status,exception) {
            alert(status);
          } );
        } else {
          $("#hint").html('');
        }
      } );
      // Search data getbook
      $("#btn-search").click(function () {
        var word = $("#word").val();
        var act = 'getbook';
        if (word != '') {
          var jqxhr = $.ajax( {
            url: "adminSearchBook.php",
            dataType:'html',
            type: 'POST',
            data: {'word':word,'act':act },
            beforeSend:function() { $.blockUI(); },
            complete:function(){ $.unblockUI(); },
            success: showResult
          } ).fail(function (xhr, status, exception) {
              alert(status);
          } );
          function showResult (result) {
            //alert ("hello");
            $('.row').remove();
            $('.container').html(result)
          }
        }
      } );
    } ); // End of document ready
    function setword(x){
      $("#word").val(x);
      $("#hint").html('');
    }
  </script>
</head>
<body>
  <?php
  // Condition check Userlevel
  if (!isset($_SESSION["UserLevel"]) || $_SESSION["UserLevel"] != 'A') {
    echo "<script>";
    echo "alert('Error Please Log in');";
    echo "window.location = 'iBookLogin.php';";
    echo "</script>";
  } else {
    //1. conection:
    include("conection.php");
    include_once('./inc/navAdmin.inc.php')
    ?>
    <div class="container">
      <div class="row">
        <?php
        $query = "SELECT * FROM books";
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_array($result)) {
          $bookID = $row["book_id"];
          $actADD = "add";
          $actDEL = "del";
          $statusYES = "Yes";
          echo "<div class='col-md-2'>";
            // Book_picture
            echo "<a href='../pdfTest/pdf.js/web/viewer.php?bookname=\"". $row["book_file"] ."\"' target='_blank' >" .
              "<img src= 'images/" . $row["book_picture"] . "'/>" . "</a>";
            // Book_id
            echo "<p style='display:none'>" . "ID:" . $row["book_id"] . "</p>";
            // Book_name
            echo "<p class='name-books'>". $row["book_name"] . "</p>";
            // Favorite
            $query2 = "SELECT * FROM favorite WHERE fav_bookID='$bookID' AND user_id='$userID'";
            $result2 = mysqli_query($con, $query2);
            $row2 = mysqli_fetch_array($result2);
            echo "<label class='switch'>";
              echo "<p class='favorite-text'>" . "favorite" .  "</p>";
              //read status from favorite data base
              echo "<p class='readStatus' readStatus='" . $row2["status"] . "'></p>";
              // Act del favorite
              //echo "<p  class='dataAddFav' style='display:none' dataAddFav='" . $actADD . "'></p>";
              // Act del favorite
              //echo "<p  class='dataDelFav' style='display:none' dataDelFav='" . $actDEL . "'></p>";
              // User id
              echo "<p  class='dataUser' style='display:none' dataUser='" . $userID . "'></p>";
              // Status sent to data base
              //echo "<p  class='dataStatusYes' style='display:none' dataStatusYes='" . $statusYES . "'></p>";
              echo "<input type='checkbox' name='checkboxFav' class='favorit-icon'>";
              // Book id
              if ($row2["status"]  == 'Yes') {
                echo "<div class='sliderFav 'title='Click for Delete favorite book' data-bookID='" . $bookID . "' chkRedfavorite='" . $row2["status"] . "'></div>";
              } else {
                echo "<div class='slider' title='Click for Add favorite book' data-bookID='" . $bookID . "' chkRedfavorite='" . $row2["status"] . "'></div>";
              }
            echo "</label>";
            // Delete book
            echo "<label class='switch2'>";
              echo "<p class='favorite-text'>" . "Delete" .  "</p>";
              echo "<input type='checkbox' class='delete-icon'>";
              echo "<a href= 'delBook.php?bookId=" . $bookID . "' class='a_del_book' style='display:none'>dell</a>";
              echo "<div class='slider-delete'></div>";
            echo "</label>";
          echo "</div>"; // End of col-md-2
        }
      echo "</div>"; // End of row
    echo "</div>"; // End of container
      mysqli_close($con);
  } // End of else condition check userlevel
  ?>

  <!-- FOOTER -->
  <div class="footerIbook">
    <ul class="footer-book">
      <li>หมวดหนังสือ</li>
      <li>หนังสือแนะนำ</li>
      <li>หนังสือมาใหม่</li>
      <li>หนังสือแจกฟรี</li>
      <li>หนังสือทั้งหมด</li>
    </ul>
    <ul class="footer-magazeen">
      <li>หมวดนิตยสาร</li>
      <li>นิตยสารแนะนำ</li>
      <li>นิตยสารมาใหม่</li>
      <li>นิตยสารแจกฟรี</li>
      <li>นิตยสารทั้งหมด</li>
    </ul>
    <ul class="footer-you">
      <li>เกี่ยวกับผู้อ่าน</li>
      <li>เข้าสู่ระบบ</li>
      <li>สมัครสมาชิค</li>
      <li>ลืมรหัสผ่าน</li>
      <li>ปัญหาการใช้งาน</li>
    </ul>
    <ul class="footer-us">
      <li>เกี่ยวกับเรา</li>
      <li>เกี่ยวกับเรา</li>
      <li>ข่าวและกิจกรรม</li>
      <li>คู่มือการใช้</li>
      <li>ติดต่อเรา</li>
    </ul>
  </div>  <!-- End of FOOTER -->
  <script src="css/bootstrap.min.js"></script>
  <script src="dist/sweetalert.min.js"></script>
  <script src="js/jquery.blockUI.js"></script>
  <script src="js/jquery-3.2.0.min.js"></script>
</body>
</html>
