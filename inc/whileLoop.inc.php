<?php
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
    // $result2 = mysqli_query($connection, $query2);
    $result2= db_query($query2);
    $row2 = mysqli_fetch_array($result2);
    echo "<label class='switch'>";
      echo "<p class='favorite-text'>" . "favorite" .  "</p>";
      // Read status from favorite data base
      echo "<p class='readStatus' readStatus='" . $row2["status"] . "'></p>";
      // User id
      echo "<p  class='dataUser' style='display:none' dataUser='" . $userID . "'></p>";
      // Status sent to data base
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
} ?>