<?php session_start();
$userID = $_SESSION["UserId"];
$userLEVEL = $_SESSION["UserLevel"];
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
  <script src="js/jquery-3.2.0.min.js"></script>
  <script src="js/jquery.blockUI.js"></script>
  <script src="css/bootstrap.min.js"></script>

<script>
$(document).ready(function(){

  //delete book
  $(".delete-icon").click(function(){
    var isThis = $(this);
          swal({
        title: "Confirm Delete!",
        text: "Do you want to delete this book!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        if(isConfirm){
            var href = isThis.parent().find('.a_del_book').attr('href');
            window.location.href = href;
            swal("Conplete","Close complete","success");
        }else{
            swal("Cancel","Cancel delete book!","warning");
        }

      });
  });


  //select favorite book
    $(".favorit-icon").click(function(){
      //e.preventDefault();
      var form = $(".row");
      //fron icon favorite
      var item_bookID_Yes = $(this).parent().find('.sliderFav').attr('data-bookID');
      var item_bookID_no = $(this).parent().find('.slider').attr('data-bookID');
      var data_addFav = 'add';
      var data_delFav = 'del';
      var data_status_yes = 'Yes';

      //var favoriteText = $(this).parent().find('.favorite-text');
      var whiteYes = $(this).parent().find('.readStatus');
      //จริงๆไม่ต้องส่งไปเพราะมีในตัวแปร session แล้ว แต่ถ้าแก้ต้องแก้ file favorite ด้วย
      var user_id = $(this).parent().find('.dataUser').attr('dataUser');
      //read from favorite book by fech array
      var readFavStatus = $(this).parent().find('.readStatus').attr('readStatus');


      console.log(item_bookID_Yes);
      console.log(item_bookID_no);
      console.log(data_addFav);
      console.log(data_delFav);
      console.log(readFavStatus);
      console.log(user_id );


        if (readFavStatus == 'Yes'){
          //delete favorite book from data base
          var jqxhr = $.ajax({
            url: "delFavorite.php",
            dataType:'html',
            type: 'POST',
            data: {'item_bookID_Yes':item_bookID_Yes, 'data_delFav':data_delFav, 'user_id':user_id},
            beforeSend:function() { $.blockUI(); },
            complete:function(){ $.unblockUI(); },
            success: showResult
          })

            .fail(function (xhr, status, exception)
            {
              alert(status);
            });
          function showResult(result) {
            //favoriteText.replaceWith("<p class='favorite-text'>favorite</p>");
            whiteYes.replaceWith(  "<p class='readStatus' readStatus=''></p>");
            //alert(result)
          }
        }
          else{
            //add favorite to data base
            var jqxhr = $.ajax({
              url: "insertFavorite.php",
              dataType:'html',
              type: 'POST',
              data: {'item_bookID_no':item_bookID_no, 'data_addFav':data_addFav,'data_status_yes':data_status_yes, 'user_id':user_id},
              beforeSend:function() { $.blockUI(); },
              complete:function(){ $.unblockUI(); },
              success: showResult
              })

              .fail(function (xhr, status, exception)
              {
                alert(status);
              });

              function showResult(result) {
                //alert(result)
                if(result.length != 0){
                  //alert("have value");
                  //favoriteText.replaceWith("<p class='favorite-text'>favorite</p>");
                  whiteYes.replaceWith( "<p class='readStatus' readStatus='Yes'></p>");
                }
              }
          }

      });


          var userLEVEL = $('#userLEVEL').val();
          $("#chkUserlevel").click(function(){
             if(userLEVEL == 'A'){
              $('#chkUserlevel').attr('href', 'indexAdmin.php');
            }
            if(userLEVEL == 'U'){
              $('#chkUserlevel').attr('href', 'index.php');
            }
          });

      //hide manu banner
          if(userLEVEL == 'A'){
            $('#addNewBook').attr('style', '');
            $('#editUser').attr('style', '');
          }

          if(userLEVEL == 'U'){
            $('.banner-list').attr('id', 'banner');
          }

          //search data autocomplete
              $("#word").keyup(function(){
                //var act = 'autocomplete';
                if($("#word").val() != ""){
                  var jqxhr = $.ajax({
                    url: "adminSearchBook.php",
                    data: "act=" + "autocomplete"+ "&word=" + $("#word").val(),
                    type: "POST",
                    async: false
                  })


                  .done(function(data, status) {
                       $("#hint").html(data);
                  })

                  .fail(function(xhr,status,exception){
                    alert(status);
                  });

                }else{
                   $("#hint").html('');
                }

              });

          //search data getbook
          $("#btn-search").click(function(){
            var word = $("#word").val();
            var act = 'getbook';

            if(word != ''){
              var jqxhr = $.ajax({
                url: "adminSearchBook.php",
                dataType:'html',
                type: 'POST',
                data: {'word':word,'act':act },
                beforeSend:function() { $.blockUI(); },
                complete:function(){ $.unblockUI(); },
                success: showResult
                })
                //Success
                // .done(function (data, status)//<---------what is status
                // {
                //   msg = data.split(",");
                //   flag = msg[0];
                //   //$("#msg1").html(msg[1]);
                // })
                //Fail
                .fail(function (xhr, status, exception){
                  alert(status);
                });

                function showResult(result) {
                  //alert ("hello");
                  $('.row').remove();
                  $('.container').html(result)
                }
             }
          });

      });

        function setword(x){
          $("#word").val(x);
          $("#hint").html('');
        }


</script>
</head>
<body>
<?php
echo "<input type='hidden' id='userLEVEL' value='$userLEVEL'>";
//condition check Userlevel
if( ($userLEVEL != 'U') && ($userLEVEL != 'A') ){
echo "<script>";
echo "alert('Error Please Log in');";
// echo "window.location = 'iBookLogin.php';";
echo "</script>";
}else{
//1. conection:
include("conection.php");
?>

<div class="banner">
<div class="logo"><img src="images/ibooks-symbol.png" alt=""></div>
<div class="test"></div>
<ul class="banner-list">
  <li id='home'><a id='chkUserlevel'>Home</a></li>
  <li id='addNewBook' style='display:none'><a href="addNewBook.php">Add new book</a></li>
  <li id='favorite'><a href='favoriteBook.php'>favorite book</a></li>
  <li id='editUser' style='display:none'><a href='userLevelUpdate.php'>Edit User</a></li>
  <li id='search'>
    <div id='form-search'>
        <input id='word' type="text" name="search" title="Filter by book name" placeholder="Book name"/>
        <span id="hint"></span>
        <input id='btn-search' type="submit" value="Search">
    </div>
  </li>
  <li id='logout'><a href='logout.php'>Log out</a></li>
</ul>
</div>

<!-- Wrapper for slides -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="images/2.jpg" alt="Chania">
    </div>

    <div class="item">
      <img src="images/3.jpg" alt="Chania">
    </div>

    <div class="item">
      <img src="images/4.png" alt="Flower">
    </div>

    <div class="item">
      <img src="images/5.png" alt="Flower">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!-- MENU -->
<ul class="category_menu">
  <li><a href='technology.php'>Technology</a></li>
  <li><a href='science.php'>Science</a></li>
  <li><a href='howTo.php'>How-to</a></li>
  <li><a href='math.php'>Math</a></li>
  <li><a href='history.php'>History</a></li>
  <li><a href='graphic.php'>Graphic</a></li>
  <li><a href='language.php'>Language</a></li>
  <li><a href='other.php'>Other</a></li>
</ul>

  <div class="container">
    <div class="row">
    <?php

      $query = "SELECT * FROM books WHERE categorys_id='4'";
      $result = mysqli_query($con, $query);

        while($row = mysqli_fetch_array($result))
        {
          $bookID = $row["book_id"];
          $actADD = "add";
          $actDEL = "del";
          $statusYES = "Yes";

    echo "<div class='col-md-2'>";
          //book_picture
            //echo "<img src= 'images/" . $row["book_picture"] . "'/>";

            echo "<a href='../pdfTest/pdf.js/web/viewer.php?bookname=\"". $row["book_file"] ."\"' target='_blank' >" .
             "<img src= 'images/" . $row["book_picture"] . "'/>" . "</a>";

            //echo "<embed src='file/" . $row["book_name"] .  "'/>";
          // book_id
            echo "<p style='display:none'>" . "ID:" . $row["book_id"] . "</p>";
          //book_name
            echo "<p class='name-books'>". $row["book_name"] . "</p>";

          //favorite
            $query2 = "SELECT * FROM favorite WHERE fav_bookID='$bookID' AND user_id='$userID'";
            $result2 = mysqli_query($con, $query2);
            $row2 = mysqli_fetch_array($result2);

            echo "<label class='switch'>";
              echo "<p class='favorite-text'>" . "favorite" . $row2["status"] . "</p>";
              //read status from favorite data base
              echo "<p class='readStatus' readStatus='" . $row2["status"] . "'></p>";
              //act del favorite
            //echo "<p  class='dataAddFav' style='display:none' dataAddFav='" . $actADD . "'></p>";
              //act del favorite
            //echo "<p  class='dataDelFav' style='display:none' dataDelFav='" . $actDEL . "'></p>";
              //user id
              echo "<p  class='dataUser' style='display:none' dataUser='" . $userID . "'></p>";
              //status sent to data base
            //echo "<p  class='dataStatusYes' style='display:none' dataStatusYes='" . $statusYES . "'></p>";

              echo "<input type='checkbox' name='checkboxFav' class='favorit-icon'>";
              //book id
              if($row2["status"]  == 'Yes'){
                echo "<div class='sliderFav 'title='Click for Delete favorite book' data-bookID='" . $bookID . "' chkRedfavorite='" . $row2["status"] . "'></div>";
              }else{
                  echo "<div class='slider' title='Click for Add favorite book' data-bookID='" . $bookID . "' chkRedfavorite='" . $row2["status"] . "'></div>";
              }

            echo "</label>";

            //delete
            echo "<label class='switch2'>";
              echo "<p class='favorite-text'>" . "Delete" .  "</p>";
              echo "<input type='checkbox' class='delete-icon'>";

              echo "<a href= 'delBook.php?bookId=" . $bookID . "' class='a_del_book' style='display:none'>dell</a>";

              echo "<div class='slider-delete'></div>";

            echo "</label>";
          echo "</div>";
        }

    echo "</div>";
  echo "</div>";

  mysqli_close($con);
}
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
</div>

</body>
</html>
