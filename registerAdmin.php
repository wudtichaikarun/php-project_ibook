<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>register</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
  <script type="text/javascript" src="js/jquery-3.2.0.min.js"></script>
  <script type="text/javascript" src="jquery.js" ></script>
  <script src="js/checkForm.js" type="text/javascript"></script>
</head>
<body>
  <div class="containerRegister">
    <img src="images/user1.png">
    <!-- create input form ,,,enctype="multipart/form-data" for uplode picture-->
    <form  method="post" enctype="multipart/form-data" >
      <!-- username -->
      <div class="form-input">
        <input type="text" name="username" id="username" placeholder="Username" >
        <p id="chk_username"></p>
      </div>
      <!-- password -->
      <div class="form-input">
        <input type="password" name="password" id="password" placeholder="Password">
        <p id="chk_password"></p>
        <p></p>
      </div>
      <!-- confirm password -->
      <div class="form-input">
        <input type="password" name="cfm_password" id="cfm_password" placeholder="Confirm Password">
        <p id="chk_cfm_password"></p>
        <p></p>
      </div>
      <!-- email Address -->
      <div class="form-input">
        <input type="text" name="email" id="emailid" placeholder="E-mail">
        <p id="chk_email"></p>
      </div>
      <!-- user level -->
      <div class="userlevel">
        <input type="radio" name="userlevel" id="userlevel" value="U" checked> User
        <input type="radio" name="userlevel" id="userlevel" value="A"> Admin
      </div>
      <!-- upload picture file -->
      <p>
        <img src="images/file.png" id="upfile1" style="cursor:pointer" />
        <span id=load-file-pic>Upload picture file.</span>
        <input type="file" name="picture" id="file_picture" style="display:none" >
        <p id="chk_file_picture"></p>
      </p>
      <!-- submit btn -->
      <input type="submit" name="submit" value="Register" class="btn-login" id="btn-submit"><br>
      <a href="userLevelUpdate.php">Back</a>
    </form>
  </div>
</body>
</html>
