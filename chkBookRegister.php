
<?php
	include("conection.php");
	$UserName = $_REQUEST["username"];
	$sql = "SELECT * FROM ibookuser WHERE user_name = '$UserName'";
	$result = mysqli_query($con, $sql);
	if(mysqli_num_rows($result) == 0){
		echo "true,<span style='color:green'>สามารถใช้งานชื่อนี้ได้ครับ</span>";
	}
	else{
		echo "false,<span style='color:red'>ไม่สามารถใช้งานชื่อนี้ได้ครับ</span>";
	}
?>
