<?php
  //1. conection.
  include("./inc/connectionSecure.inc.php");
  function db_query($query) {
    // Connect to db
    $connection = db_connect();
    // Query the db
    $result = mysqli_query($connection,$query);    
    return $result;
  }

  $Username = $_REQUEST["username"];
  $Password  = MD5($_REQUEST["password"]);
  $Email  = $_REQUEST["email"];
  $Userlevel  = $_REQUEST["userlevel"];
  $Picture  = $_FILES["picture"]["name"];//chang variable

  // Query
  $query= "INSERT INTO 
    ibookuser(user_name, user_password, user_level, user_picture, user_email) 
    VALUES('$Username','$Password', '$Userlevel', '$Picture', '$Email')";
  
  // Call query function
  $result = db_query($query);
  
  // Close connection
  mysqli_close(db_connect());

  //part of file
  $target_file = 'images/' . basename($_FILES["picture"]["name"]);
  
  //up load file
  $check = move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);

  // Check User level admin('A') user('U')
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
      echo"</script>";
    }
  } else if ( ( ($result && $check) == false ) && ($Userlevel == 'A') ) {
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