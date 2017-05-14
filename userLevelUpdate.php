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
  <script src="js/jquery-3.2.0.min.js"></script>
  <script src="js/jquery.blockUI.js"></script>
  <script src="css/bootstrap.min.js"></script>

  <script src="dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">

<script>
  $(document).ready(function(){

    //add user btn chang colorr
    $('#addUser').mouseover(function(){
      $(this).attr('src','images/addUserHover.png');
      //alert ('hello');
    });
    $('#addUser').mouseout(function(){
      $(this).attr('src','images/addUser.png');
      //alert ('hello');
    });
    $('#addUser').click(function(){
      window.location.assign('registerAdmin.php');
    });

//btn update click
    $(".btn_user_level_update").click(function(){
      //alert("hello");
      //var askUser= confirm("Do you Update userlevel right?");
      var act = "update";
      var user_id_update = $(this).parent().find('.user_levelUpdate_id').attr('userIdUpdate');
      var user_level_update = $(this).parent().find('input[name= userlevel]:checked').val();

        swal({
          title: "Confirm Update",
          text: "Do you want to update information!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Confirm",
          closeOnConfirm: false,
          closeOnCancel: false,
          //showLoaderOnConfirm: true,
           },
          function(isConfirm){
             if(isConfirm){
               var jquxhr = $.ajax({
                 url: "updateUserLevel.php",
                 dataType:'html',
                 type: 'POST',
                 data: {'user_id_update':user_id_update, 'user_level_update':user_level_update,'act':act},
                 beforeSend:function() { $.blockUI(); },
                 complete:function(){ $.unblockUI(); },
                 success: showResult
               })

               .fail(function (xhr, status, exception){
                 alert(status);
               });

               function showResult(result) {

               }
                   swal({
                         title: "Update Sucess",
                         text: "userlevel update success",
                         type: "success",
                         //showCancelButton: true,
                         confirmButtonColor: "#90EE90",
                         confirmButtonText: "Sucess",
                         closeOnConfirm: false,
                         //closeOnCancel: false,
                         //showLoaderOnConfirm: true,
                          },
                          function(isConfirm){
                          if(isConfirm){
                              window.location.reload();
                            }
                          });

             }else{
                swal("Cancel","Cancel delete book!","warning");
               }
    });
  });

  //delete
      $(".btn_user_level_delete").click(function(){
        sweetAlert("title Alert", "virus", "error");
        //alert("hello");
        //var askUser= confirm("Do you Update userlevel right?");
        var act = "delete";
        var user_id_update = $(this).parent().find('.user_levelUpdate_id').attr('userIdUpdate');
        var user_level_update = $(this).parent().find('input[name= userlevel]:checked').val();

          swal({
            title: "Confirm Delete",
            text: "Do you want to delete this user!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Confirm",
            closeOnConfirm: false,
            closeOnCancel: false,
            //showLoaderOnConfirm: true,
             },
            function(isConfirm){
               if(isConfirm){
                 var jquxhr = $.ajax({
                   url: "updateUserLevel.php",
                   dataType:'html',
                   type: 'POST',
                   data: {'user_id_update':user_id_update, 'user_level_update':user_level_update,'act':act},
                   beforeSend:function() { $.blockUI(); },
                   complete:function(){ $.unblockUI(); },
                   success: showResult
                 })

                 .fail(function (xhr, status, exception){
                   alert(status);
                 });

                 function showResult(result) {

                 }
                     swal({
                           title: "Delete Sucess",
                           text: "delete user success",
                           type: "success",
                           //showCancelButton: true,
                           confirmButtonColor: "#90EE90",
                           confirmButtonText: "Sucess",
                           closeOnConfirm: false,
                           //closeOnCancel: false,
                           //showLoaderOnConfirm: true,
                            },
                            function(isConfirm){
                            if(isConfirm){
                                window.location.reload();
                              }
                            });

               }else{
                  swal("Cancel","Cancel delete this user!","warning");
                 }
      });
    });

});

</script>
</head>
<body>
<?php
//condition check Userlevel
if(!isset($_SESSION["UserLevel"]) || $_SESSION["UserLevel"] != 'A'){
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
    <li><a href='indexAdmin.php'>Home</a></li>
    <li><a href="addNewBook.php">Add new book</a></li>
    <li><a href='favoriteBook.php'>favorite book</a></li>
    <li><a href='userLevelUpdate.php'>Edit User</a></li>
    <li>
      <form id='form-search'>

          <input id='word' type="text" name="search" title="Filter by book name" placeholder="User name"/>
          <span id="hint"></span>
          <input id='btn-search' type="submit" value="Search">
      </form>
    </li>
    <li><a href='logout.php'>Log out</a></li>
  </ul>
</div>

  <div class="container">
    <div class="row">
    <?php

      $query = "SELECT * FROM ibookuser WHERE user_level='A'";
      $result = mysqli_query($con, $query);
      echo "<p class='font_header'>-----Admin------<img id='addUser' src='images/addUser.png' /> Add User</p>";

        while($row = mysqli_fetch_array($result))
        {

          echo "<div class='col-md-2 profile'>";
            $user_level = $row["user_level"];
            echo "<form class='user_level'>";
              echo "<img src= 'images/" . $row["user_picture"] . "'/>";
              echo "<p class='user_levelUpdate_id' userIdUpdate='" . $row["user_id"] . "' >" . "ID: " . $row["user_id"] . "</p>";
              echo "<p class='user_levelUpdate_name'>" . "Username: " . $row["user_name"] . "</p>";
              echo "<input type='radio' name='userlevel' value='U'>". " User" ."&nbsp &nbsp";
              echo "<input type='radio' name='userlevel' value='A' checked>". " Admin" ."<br>";

            echo "</form>";
            echo "<button class='btn_user_level_delete'>" . "Delete" . "</button>";
            echo "<button class='btn_user_level_update'>" . "Update" . "</button>";
          echo "</div>";
        }
        echo "</div>";//close row

        echo "<div class='row'</div>";//open row

      $query2 = "SELECT * FROM ibookuser WHERE user_level='U'";
      $result2 = mysqli_query($con, $query2);
      echo "<p class='font_header'>-----Normal User ------</p>";

          while($row2 = mysqli_fetch_array($result2))
          {
          echo "<div class='col-md-2 profile'>";
              $user_level = $row2["user_level"];
            echo "<form class='user_level'>";
              echo "<img src= 'images/" . $row2["user_picture"] . "'/>";
              echo "<p class='user_levelUpdate_id' userIdUpdate='" . $row2["user_id"] . "' >" . "ID: " . $row2["user_id"] . "</p>";
              echo "<p class='user_levelUpdate_name'>" . "Username: " . $row2["user_name"] . "</p>";
              echo "<input type='radio' name='userlevel' value='U' checked>". " User" ."&nbsp &nbsp";
              echo "<input type='radio' name='userlevel' value='A'>". " Admin" ."<br>";

            echo "</form>";
            echo "<button class='btn_user_level_delete'>" . "Delete" . "</button>";
            echo "<button class='btn_user_level_update'>" . "Update" . "</button>";
          echo "</div>";//close-col-md-2
          }
        echo "</div>";//close row

  echo "</div>";//container

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
