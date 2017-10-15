<?php
  //1. conection.
  include("conection.php");
  $Username = $_REQUEST["username"];
  $Password  = MD5($_REQUEST["password"]);
  $Email  = $_REQUEST["email"];
  $Userlevel  = $_REQUEST["userlevel"];
  $Picture  = $_FILES["picture"]["name"];//chang variable
  //2. consultation.
  $sql= "INSERT INTO ibookuser(user_name, user_password, user_level, user_picture, user_email) VALUES('$Username',
  '$Password', '$Userlevel', '$Picture', '$Email')";
  //3. execute the query.
  $result = mysqli_query($con, $sql) or die ("Error in query: $sql" . mysqli_error());
  mysqli_close($con);
  //part of file
  $target_file = 'images/' . basename($_FILES["picture"]["name"]);
  //up load file
  $check = move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
  // echo $check;//show
  if ($result && $check) {
    if ($Userlevel == 'A') {
      echo"<script>";
        echo"alert('Addition-Sucess');";
        echo"window.location = 'registerAdmin.php';";
      echo"</script>";
    } else { 
      echo"<script>";
        echo"alert('Addition-Sucess!!');";
        echo"window.location = 'register.php';";
      echo"</script>"
    }
  } else if (($result && $check == false) && ($Userlevel == 'A')) {
    echo"<script>";
      echo"alert('sory-unsucess!!');";
      echo"window.location = 'registerAdmin.php';";
    echo"</script>";
  } else {
    echo"<script>";
      echo"alert('sory-unsucess!!');";
      echo"window.location = 'register.php';";
    echo"</script>";
  }
?>
