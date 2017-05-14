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

<script>

$(document).ready(function(){
  var flag = false;
	$("#username").change(function()
	{
		//create variable a,b,c we use jqxhr
		var jqxhr = $.ajax({
			url: "chkBookRegister.php",
			data: "username=" + $("#username").val(),
			method: "POST",
			async: false
		})
		//Success
		.done(function (data, status)
		{
			msg = data.split(",");
			flag = msg[0];
			$("#chk_username").html(msg[1]);
      return true;
		})
		//Fail
		.fail(function (xhr, status, exception)
		{
			alert(status);
      return false;
		});
   });

  //  $("#btn").click(function () {
  //    if(flag == 'false'){
  //      alert("กรุณาตรวจสอบข้อมูลให้ถูกต้อง")
  //    }else {
  //      alert("บันทึกข้อมูลเรียบร้อย")
  //    }
  //  });

function chkPWD() {
  var chkPassWord = $("#password").val();
  if(chkPassWord.length >= 4 && chkPassWord.length <= 8){
    $("#chk_password").html("<span style='color:green'>ใช้งานรหัสผ่านนี้ได้</span>");
    return true;
  }else{
    $("#chk_password").html("<span style='color:red'>กรุณาใส่รหัสผ่าน4-8ตัวอักษร</span>");
    return false;
  }
}
$("#password").change(chkPWD);


//chk password
  // $("#password").change(function(){
  //   var chkPassWord = $("#password").val();
  //   if(chkPassWord.length >= 4 && chkPassWord.length <= 8){
  //     $("#chk_password").html("<span style='color:green'>ใช้งานรหัสผ่านนี้ได้</span>");
  //     return true;
  //   }else{
  //     $("#chk_password").html("<span style='color:red'>กรุณาใส่รหัสผ่าน4-8ตัวอักษร</span>");
  //     return false;
  //   }
  // });

//chk  confirm password
  $("#cfm_password").change(function(){
    var password1= $("#password").val();
    var password2= $("#cfm_password").val();
    if(password1 == password2){
      $("#chk_cfm_password").html("<span style='color:green'>รหัสผ่านตรงกัน</span>");
      return true;
    }else{
      $("#chk_cfm_password").html("<span style='color:red'>รหัสผ่านไม่ตรงกัน</span>");
      return false;
    }
  });

//chk emile form
  $('#emailid').focusout(function(){
      $('#emailid').filter(function(){
         var emil=$('#emailid').val();
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( emil ) ) {
      $("#chk_email").html("<span style='color:red'>กรุณาใส่ Email ที่ถูกต้อง</span>");
      return false;
      }
  else if($('#emailid').val() == ''){
      $("#chk_email").html("<span style='color:red'>กรุณาใส่ Email Adress</span>");
      return false;
  }
  else{
      $("#chk_email").html("<span style='color:green'>กรุณายืนยันการสมัครอีกครั้งที่Emailนี้</span>");
      return true;
      }
      })
  });

//chk upload file picture
  $("#btn-submit").click(function(){
   var chk_filePicture = $("#file_picture").val();
    if(chk_filePicture == ''){
      $("#chk_file_picture").html("<span style='color:red'>กรุณาคลิกที่ไอคอนเพื่อเลือกรูปภาพ</span>");
    }
    // else
    // {
    //   $("#chk_file_picture").html(chk_filePicture);
    // }
  });

//chane button upload file style picture trigger
  $("#upfile1").click(function () {
    $("#file_picture").trigger('click');
  });

  $('form').submit(function () {
    // Get the Login Name value and trim it
    var username = $('#username').val();
    var password = $('#password').val();
    var cfm_password = $('#cfm_password').val();
    var emailid = $('#emailid').val();
    var file_picture = $('#file_picture').val();

    // Check if empty of not
    if ((username || password || cfm_password || emailid || file_picture) == '') {
        alert('กรุณากรอกข้อมูลให้ครบถ้วน');
        return false;
    }
    // else if(password == '') {
    //     alert('กรุณาตรวจสอบ password อีกครั้ง');
    //     return false;
    // }
    else
    {
      alert('Yes');
      return true;
    }
});
console.log(flag);
});

</script>
</head>
<body>
<div class="containerRegister">
  <img src="images/user1.png">

  <!-- create input form ,,,enctype="multipart/form-data" for uplode picture-->
  <form  method="post" enctype="multipart/form-data">
      <!-- <form action="user_create.php" method="post" enctype="multipart/form-data"> -->

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
   <input type="hidden" name="userlevel" value="U">
<!-- upload picture file -->
     <p>
       <img src="images/selected-file.png" id="upfile1" style="cursor:pointer" />
       Upload picture file.
       <input type="file" name="picture" id="file_picture" style="display:none" >
       <p id="chk_file_picture"></p>
     </p>
<!-- submit btn -->
   <input type="submit" name="submit" value="Register" class="btn-login" id="btn-submit"><br>
   <a href="iBookLogin.php">Login</a>
   <!-- <a href="#">Register</a> -->

 </form>
</div>

</body>
</html>
