<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>iBookLogin</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.css">

<script src="js/jquery-3.2.0.min.js"></script>

<script>
$(document).ready(function(){
  function chkUser(){
    //create variable a,b,c we use jqxhr
		var jqxhr = $.ajax({
			url: "chkAjaxLogin.php",
			data: "username=" + $("#username").val(),
			method: "POST",
			async: false
		})
		//Success
		.done(function (data, status)
		{
			msg = data.split(",");
			flag = msg[0].trim();
			$("#chk_username").html(msg[1]);
		})
		//Fail
		.fail(function (xhr, status, exception)
		{
			alert(status);
		});
    if(flag == 'false'){
      return false;
    }else {
      return true;
    }
    // console.log(flag);
    // console.log(msg);
  }
	$("#username").change(chkUser);

});

</script>
</head>
<body>
<div class="container">
  <img src="images/user1.png">

  <form action="iBookChkLogin.php" method="post">

    <div class="form-input">
      <input type="text"  id="username" name="username" placeholder="Username" >
      <p id="chk_username"></p>
    </div>

   <div class="form-input">
     <input type="password" name="password" placeholder="Password">
     <p id="login_chk_password"></p>
   </div>

   <input type="submit" name="submit" value="LOGIN" class="btn-login"><br>
   <a href="register.php">Register</a>
   <!-- <a href="#">Register</a> -->

 </form>
</div>


</body>
</html>
