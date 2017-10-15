<?php
  $con= mysqli_connect("localhost","root","romantic","iBook") or die("Error: " . mysqli_error());
  $encode = mysqli_query($con, "SET NAMES UTF8");
?>
