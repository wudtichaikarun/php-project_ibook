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
        if (readFavStatus == 'Yes') {
          //delete favorite book from data base
          var jqxhr = $.ajax({
            url: "delFavorite.php",
            dataType:'html',
            type: 'POST',
            data: {'item_bookID_Yes':item_bookID_Yes, 'data_delFav':data_delFav, 'data_status_yes':data_status_yes, 'user_id':user_id},
            beforeSend:function () { $.blockUI(); },
            complete:function () { $.unblockUI(); },
            success: showResult
          } ).fail(function (xhr, status, exception) {
            alert(status);
          } );
          function showResult (result) {
            form .parent().parent().attr('style', 'display:none');
          }
        }
      } );
      // Woking by check user level
      var userLEVEL = $('#userLEVEL').val();
        $("#chkUserlevel").click(function () {
          if (userLEVEL == 'A') {
            $('#chkUserlevel').attr('href', 'indexAdmin.php');
          } else if (userLEVEL == 'U') {
            $('#chkUserlevel').attr('href', 'index.php');
          } else {
            alert('Error Please Log in');
            window.location = 'iBookLogin.php';
          }
        } );
        //hide manu banner
        if (userLEVEL == 'A') {
          $('#addNewBook').attr('style', '');
          $('#editUser').attr('style', '');
        }
        if (userLEVEL == 'U') {
          $('.banner-list').attr('id', 'banner');
        }
        //search data autocomplete
        $("#word").keyup(function () {
          //var act = 'autocomplete';
          if($("#word").val() != ""){
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
        //search data getbook
        $("#btn-search").click(function () {
          var word = $("#word").val();
          var act = 'getbook';
          if (word != '') {
            var jqxhr = $.ajax({
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
    } );
    function setword (x) {
      $("#word").val(x);
      $("#hint").html('');
    }
  </script>
</head>
<body>
<?php
echo "<input type='hidden' id='userLEVEL' value='$userLEVEL'>";
//condition check Userlevel
if (!isset($_SESSION["UserLevel"])) {
  echo "<script>";
  echo "alert('Error Please Log in');";
  echo "window.location = 'iBookLogin.php';";
  echo "</script>";
} else {
  //1. conection:
  include("conection.php");
  // Nav menu
  include_once('./inc/navAdmin.inc.php');
  echo"<div class='container'>";
    echo"<div class='row'>";
      $query2 = "SELECT * FROM favorite WHERE user_id='$userID' ";
      $result2 = mysqli_query($con, $query2);
      while($row2 = mysqli_fetch_array($result2)) {
        echo "<div class='col-md-2'>";
          $bookID = $row2["fav_bookID"];
          $query = "SELECT * FROM books WHERE book_id='$bookID'";
          $result = mysqli_query($con, $query);
          $row = mysqli_fetch_array($result);
          //book_picture
          echo "<a href='../pdfTest/pdf.js/web/viewer.php?bookname=\"". $row["book_file"] ."\"' target='_blank' >" .
            "<img src= 'images/" . $row["book_picture"] . "'/>" . "</a>";
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
          echo "</label>";
        echo "</div>";
      }
    echo "</div>"; // div.row end
  echo "</div>"; // div.container end
  mysqli_close($con);
}
  // Footer
  include_once('./inc/footer.inc.php');
?>
</div>
</body>
</html>
