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
  <script src="dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<script>
  $(document).ready(function () {
    // Add attr for home banner
    var userLEVEL = $('#userLEVEL').val();
    $("#chkUserlevel").click(function () {
      if(userLEVEL == 'A'){
        $('#chkUserlevel').attr('href', 'indexAdmin.php');
      } else if (userLEVEL == 'U') {
        $('#chkUserlevel').attr('href', 'index.php');
      } else {
        $('#chkUserlevel').attr('href', 'login.php');
      }
    } );
    // Hide manu banner
    if (userLEVEL == 'A') {
      $('#addNewBook').attr('style', '');
      $('#editUser').attr('style', '');
    } else if (userLEVEL == 'U') {
      $('.banner-list').attr('id', 'banner');
    }
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
      // console.log(item_bookID_Yes, item_bookID_no, data_addFav, data_delFav, readFavStatus, user_id);
      if (readFavStatus == 'Yes') {
        // Delete favorite book from data base
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
    $("#word").keyup(function(){
      if ($("#word").val() != "") {
        var jqxhr = $.ajax({
          url: "adminSearchBook.php",
          data: "act=" + "autocomplete"+ "&word=" + $("#word").val(),
          type: "POST",
          async: false
        } ).done(function (data, status) {
              $("#hint").html(data);
        } ).fail(function (xhr,status,exception) {
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
        function showResult(result) {
          //alert ("hello");
          $('.row').remove();
          $('.container').html(result)
        }
      }
    } );
  } ); // End of document ready
  // Set word
  function setword (x) {
    $("#word").val(x);
    $("#hint").html('');
  }
</script>
</head>
<body>
  <?php
  echo "<input type='hidden' id='userLEVEL' value='$userLEVEL'>";
  // Condition check Userlevel
  if ( ($userLEVEL != 'U') && ($userLEVEL != 'A') ) {
    echo "<script>";
    echo "alert('Error Please Log in');";
    echo "window.location = 'iBookLogin.php';";
    echo "</script>";
  } else {
    // Conection database
    include("conection.php");
    // Nav menu
    include_once('./inc/navOtherPage.inc.php');
    ?>
    <div class="container">
      <div class="row">
      <?php
        $query = "SELECT * FROM books WHERE categorys_id='8'";
        $result = mysqli_query($con, $query);
        // Loop create object
        include_once('./inc/whileLoop.inc.php');
      echo "</div>"; // End of row
    echo "</div>"; // End of container
    mysqli_close($con);
  } // End of else condition check userlevel
  // Footer
  include_once('./inc/footer.inc.php');
  ?>
</div>
</body>
</html>
