<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>addNewBook</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery-3.2.0.min.js"></script>
  <script src="js/jquery.blockUI.js"></script>
  <script src="js/polyfiller.js"></script>
  <script src="css/bootstrap.min.js"></script>
  <script>
    webshims.setOptions('forms-ext', {
    replaceUI: 'auto',
    types: 'number'
    } );
    webshims.polyfill('forms forms-ext');
    $(document).ready(function () {
      document.querySelector("html").classList.add('js');
      var fileInput = document.querySelector( ".input-file" ),
          fileInputPic = document.querySelector( ".input-file-pic" ),
          button = document.querySelector( ".input-file-trigger" ),
          buttonPic = document.querySelector( ".input-file-trigger-pic" ),
          the_return_pic = document.querySelector(".file-return-pic"),
          the_return = document.querySelector(".file-return");

      button.addEventListener( "keydown", function (event) {
        if ( event.keyCode == 13 || event.keyCode == 32 ) {
            fileInput.focus();
        }
      } );

      buttonPic.addEventListener( "keydown", function (event) {
        if ( event.keyCode == 13 || event.keyCode == 32 ) {
            fileInput.focus();
        }
      } );

      button.addEventListener( "click", function (event) {
        fileInput.focus();
        return false;
      } );

      buttonPic.addEventListener( "click", function (event) {
        fileInput.focus();
        return false;
      } );

      fileInput.addEventListener( "change", function (event) {
        the_return.innerHTML = this.value;
      } );

      fileInputPic.addEventListener( "change", function (event) {
        the_return_pic.innerHTML = this.value;
      } );
    } );
  </script>
</head>
<body>
  <div class="containerAddNewBook">
    <img src="images/book-and-plus-sign.png">
    <h4 id='addNewBookHeader'>Add new book</h4>
    <form action="iBookUpdate.php" method="post" enctype="multipart/form-data">
      <!-- book_picture -->
      <div class="input-file-container">
        <input class="input-file-pic" id="my-pic-file" type="file" name="book_picture">
        <label tabindex="0" for="my-pic-file" class="input-file-trigger-pic">Select Book Picture</label>
      </div>
      <p class="file-return-pic"></p>
      <!-- book_file -->
      <div class="input-file-container">
        <input class="input-file" id="my-file" type="file" name="book_file">
        <label tabindex="0" for="my-file" class="input-file-trigger">Select Book File...</label>
      </div>
      <p class="file-return"></p>
      <!-- categorys -->
      <div class="form-row">
        <label for="c4"> Category Select. :</label>
        <select id='c4' name="categorys_id">
          <?php
          // Conection.
          include("conection.php");
          // Consultation.
          $query = "SELECT * FROM categorys";
          // Execute the query.
          $result = mysqli_query($con, $query) or die ("Error in query: $sql" . mysqli_error());
          while($row = mysqli_fetch_array($result)) {
            echo "<option value='". $row["categorys_id"] . "'>". $row["categorys_id"] . "-" . $row["categorys_name"] . "</option>";
          }
          // Close connection.
          mysqli_close($con);
          ?>
        </select>
      </div>
      <!-- book_name: -->
      <div class="form-row">
        <label for="c3">Book Name. :</label>
        <input type="text"  id="c3" name="book_name" placeholder='book name'>
      </div><br>
      <!-- series_name -->
      <div class="form-row">
        <label for="c2">Serice Name :</label>
        <input type="text"  id="c2" name="series_name" placeholder='ignore if done have' >
      </div>
      <!-- series_number -->
      <div class="form-row">
        <label for="c1">Serice Number :</label>
        <input type="number" value="1" min="0" step="0.01" data-number-to-fixed=""
          data-number-stepfactor="100" name="series_number" class="currency" id="c1" />
      </div>
      <input type="submit" name="submit" value="Add New Book" class="btn-login">
      <br>
      <a href="indexAdmin.php" id='homeLink'>Back</a>
    </form>
  </div>
</body>
</html>
