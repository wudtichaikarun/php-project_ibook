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

//delete favorit book
  $(".favorit-icon").click(function(){
    var form = $(this);
    var item_bookID_Yes = $(this).parent().find('.sliderFav').attr('data-bookID');
    var data_delFav = 'del';
    var data_status_yes = 'Yes';

    var user_id = $(this).parent().find('.dataUser').attr('dataUser');

    var readFavStatus = $(this).parent().find('.readStatus').attr('readStatus');

    var StatusCheckbok_checked = $(this).parent().find('input').val();


    console.log(item_bookID_Yes);
    console.log(data_delFav);
    console.log(readFavStatus);
    console.log(user_id );
    console.log(StatusCheckbok_checked);
    // console.log(StatusCheckbok_change);

    //console.log(StatusCheckbok_Unchecked);
    if (readFavStatus == 'Yes'){
      //delete favorite book from data base
      var jqxhr = $.ajax({
        url: "delFavorite.php",
        dataType:'html',
        type: 'POST',
        data: {'item_bookID_Yes':item_bookID_Yes, 'data_delFav':data_delFav, 'data_status_yes':data_status_yes, 'user_id':user_id},
        beforeSend:function() { $.blockUI(); },
        complete:function(){ $.unblockUI(); },
        success: showResult
        })
        .fail(function (xhr, status, exception){
          alert(status);
        });
        function showResult(result) {
          //alert('fukkk');
        form .parent().parent().attr('style', 'display:none');
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
if(!isset($_SESSION["UserLevel"])){
  echo "<script>";
  echo "alert('Error Please Log in');";
  echo "window.location = 'iBookLogin.php';";
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

      $query2 = "SELECT * FROM favorite WHERE user_id='$userID' ";
      $result2 = mysqli_query($con, $query2);
        while($row2 = mysqli_fetch_array($result2))
        {
    echo "<div class='col-md-2'>";
            $bookID = $row2["fav_bookID"];

            $query = "SELECT * FROM books WHERE book_id='$bookID'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_array($result);
            // $bookID = $row["book_id"];
            // $userID = $_SESSION["UserId"];
            //book_picture
            echo "<a href='file/". $row["book_file"] ."' target='_blank'>" .
             "<img src= 'images/" . $row["book_picture"] . "'/>" . "</a>";

             //echo "<input type='hidden' class='findStatusYes' value=''" . $row2["status"] . "'>";
            // book_id
              echo "<p class='name-books' style='display:none'>" . "ID:" . $row["book_id"] . "</p>";
            //book_name
              echo "<p class='name-books'>" . "name: " . $row["book_name"] . "</p>";

            echo "<label class='switch'>";
              echo "<p class='favorite-text'>" . "favorite" . "</p>";
              //read status from favorite data base
              echo "<p class='readStatus' readStatus='" . $row2["status"] . "'></p>";

              //user id
              echo "<p  class='dataUser' style='display:none' dataUser='" . $userID . "'></p>";

              echo "<input type='checkbox' class='favorit-icon'>";
              //book id
              echo "<div class='sliderFav'title='Click for Delete favorite book' data-bookID='" .$bookID . "'></div>";
              // echo "<br />";
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
    <li>หนังสือ:</li>
    <li>หนังสือแนะนำ</li>
    <li>หนังสือมาใหม่</li>
    <li>หนังสือแจกฟรี</li>
    <li>หนังสือทั้งหมด</li>
  </ul>
  <ul class="footer-magazeen">
    <li>นิตยสาร:</li>
    <li>นิตยสารแนะนำ</li>
    <li>นิตยสารมาใหม่</li>
    <li>นิตยสารแจกฟรี</li>
    <li>นิตยสารทั้งหมด</li>
  </ul>
  <ul class="footer-you">
    <li>ผู้อ่าน:</li>
    <li>เข้าสู่ระบบ</li>
    <li>สมัครสมาชิค</li>
    <li>ลืมรหัสผ่าน</li>
    <li>ปัญหาการใช้งาน</li>
  </ul>
  <ul class="footer-us">
    <li>เกี่ยวกับเรา:</li>
    <li>เกี่ยวกับเรา</li>
    <li>ข่าวและกิจกรรม</li>
    <li>คู่มือการใช้</li>
    <li>ติดต่อเรา</li>
  </ul>
</div>

</body>
</html>
