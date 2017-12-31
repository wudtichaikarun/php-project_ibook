var flag = false;
$(document).ready(function () {
  function chkUser () {
    //create variable a,b,c we use jqxhr
    var jqxhr = $.ajax({
      url: "chkBookRegister.php",
      data: "username=" + $("#username").val(),
      method: "POST",
      async: false
    })
    //Success
    .done(function (data, status) {
      msg = data.split(",");
      flag = msg[0].trim();
      $("#chk_username").html(msg[1]);
    })
    //Fail
    .fail(function (xhr, status, exception) {
      alert(status);
    });
    if (flag == 'false') {
      return false;
    } else {
      return true;
    }
  }
  $("#username").change(chkUser);
  //chk password
  function chkPWD () {
    var chkPassWord = $("#password").val();
    if (chkPassWord.length >= 4 && chkPassWord.length <= 8) {
      $("#chk_password").html("<span style='color:green'>ใช้งานรหัสผ่านนี้ได้</span>");
      return true;
    } else {
      $("#chk_password").html("<span style='color:red'>กรุณาใส่รหัสผ่าน4-8ตัวอักษร</span>");
      return false;
    }
  }
  $("#password").change(chkPWD);

  //chk  confirm password
  function confirmPWD(){
    var password1= $("#password").val();
    var password2= $("#cfm_password").val();
    if (password1 == password2) {
      $("#chk_cfm_password").html("<span style='color:green'>รหัสผ่านตรงกัน</span>");
      return true;
    } else {
      $("#chk_cfm_password").html("<span style='color:red'>รหัสผ่านไม่ตรงกัน</span>");
      return false;
    }
  }
  $("#cfm_password").change(confirmPWD);
  //chk emile form
  function chkEmail () {
    var emil=$('#emailid').val();
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if(!emailReg.test(emil)) {
      $("#chk_email").html("<span style='color:red'>กรุณาใส่ Email ที่ถูกต้อง</span>");
      return false;
    } else if($('#emailid').val() == '') {
      $("#chk_email").html("<span style='color:red'>กรุณาใส่ Email Adress</span>");
      return false;
    } else {
      $("#chk_email").html("<span style='color:green'>กรุณายืนยันการสมัครอีกครั้งที่Emailนี้</span>");
      return true;
    }
  }
  $('#emailid').blur(chkEmail);
  //chk picture file
  function chkPic() {
    var chk_filePicture = $("#file_picture").val();
    if(chk_filePicture == '') {
      $("#chk_file_picture").html("<span style='color:red'>กรุณาคลิกที่ไอคอนเพื่อเลือกรูปภาพ</span>");
      return false;
    } else {
      $("#load-file-pic").text("You have a file.");
      $("#chk_file_picture").html("<span style='color:green'>มีข้อมูล file แล้ว</span>");
      $('#upfile1').removeAttr("src");
      $('#upfile1').attr("src", "images/file-success.png");
      return true;
    }
  }
  $('form').change(chkPic);
  //when user click submit btn
  $('form').submit(function () {
    // Get the Login Name value and trim it
    var username = $('#username').val();
    var password = $('#password').val();
    var cfm_password = $('#cfm_password').val();
    var emailid = $('#emailid').val();
    var chk_filePicture = $("#file_picture").val();
    // Check if empty of not
    if ((username || password || cfm_password || emailid ) == '') {
        alert('กรุณากรอกข้อมูลให้ครบถ้วน');
        return false;
    } else if (chkUser() && chkPWD() && confirmPWD() && chkEmail() && chkPic()) {
      $('form').attr('action', 'user_create.php');
      return true;
    } else {
      alert('กรุณาตรวจสอบข้อมูลอีกครั้ง');
      return false;
    }
  } );
  //chane button upload file style picture trigger
  $("#upfile1").click(function () {
    $("#file_picture").trigger('click');
  } );
} );