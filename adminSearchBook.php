<?php session_start();
$userID = $_SESSION["UserId"];
$word = $_REQUEST["word"];
$act = $_REQUEST["act"];
//1. conection:
	include("conection.php");

  if($act == "autocomplete"){
    $sql = "SELECT * FROM books WHERE book_name like '%$word%' ";
  	$result = mysqli_query($con, $sql);
  echo "<table class='hint'>";
    while ($row = mysqli_fetch_array($result)) {
      $new = htmlspecialchars($row['book_name'], ENT_QUOTES);
      echo "<tr id='search_data'><td onclick='setword(\"$new\")'>" . $row['book_name'] . "</td></tr>";
    }
    echo "</table>";
  }else if($act == "getbook"){
    echo "<div class='row'>";

    $sql = "SELECT * FROM books WHERE book_name='$word' ";
    $result = mysqli_query($con, $sql);
      while ($row = mysqli_fetch_array($result)) {
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
            echo "<p class='favorite-text'>" . "favorite" .  "</p>";
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
              echo "<div class='sliderFav ' data-bookID='" . $bookID . "' chkRedfavorite='" . $row2["status"] . "'></div>";
            }else{
                echo "<div class='slider' data-bookID='" . $bookID . "' chkRedfavorite='" . $row2["status"] . "'></div>";
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
}else {
  echo "false";
}

?>
