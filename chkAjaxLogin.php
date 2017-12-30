
<?php
	include("./inc/connectionSecure.inc.php");
	// Function query
  function db_query ($query) {
    // Connect to the database
    $connection = db_connect(); 
    // Query the database
    $result = mysqli_query($connection,$query);    
    return $result;
	}
	
	$UserName = $_REQUEST["username"];
	$query = "SELECT * FROM ibookuser WHERE user_name = '$UserName'";
	$result = db_query($query);
	
	if (mysqli_num_rows($result) != 0) {
		echo "true,<span style='color:green'>ยินดีต้อนรับคุณ $UserName </span>";
	} else {
		echo "false,<span style='color:red'>ชื่อผู้ใช้งาน ไม่ถูกต้อง</span>";
	}
?>
