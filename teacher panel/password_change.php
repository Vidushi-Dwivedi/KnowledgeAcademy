<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
    if(!isset($_SESSION))
    {
     session_start();
   }
    $id=$_SESSION["id"];
   include 'css_jslinks.php';
     ?>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-PasswordChange</title>
    <link rel="stylesheet" href="css/head.css">
    <style media="screen">
    /* password form */

    .mainDiv {
    display: flex;

    align-items: center;
    justify-content: center;
    background-color: #f9f9f9;
    font-family: 'Open Sans', sans-serif;
    box-shadow:  10px 10px 20px #646161,
           -10px -10px 20px #646161;
    border:2px solid #101627;
    }
    .cardStyle {
    width: 500px;
    border-color: white;
    background: #fff;
    padding: 36px 0;
    border-radius: 4px;
    margin: 30px 0;
    box-shadow: 0px 0 2px 0 rgba(0,0,0,0.25);
    }
    #signupLogo {
    max-height: 100px;
    margin: auto;
    display: flex;
    flex-direction: column;
    }
    .formTitle{
    font-weight: 600;
    margin-top: 20px;
    color: #2F2D3B;
    text-align: center;
    }
    .inputLabel {
    font-size: 12px;
    color: #555;
    margin-bottom: 6px;
    margin-top: 24px;
    }
    .inputDiv {
    width: 70%;
    display: flex;
    flex-direction: column;
    margin: auto;
    }
    input {
    height: 40px;
    font-size: 16px;
    border-radius: 4px;
    border: none;
    border: solid 1px #ccc;
    padding: 0 11px;
    }
    input:disabled {
    cursor: not-allowed;
    border: solid 1px #eee;
    }
    .buttonWrapper {
    margin-top: 40px;
    }
    .submitButton {
    width: 70%;
    height: 40px;
    margin: auto;
    display: block;
    color: #fff;
    background-color: #065492;
    border-color: #065492;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.12);
    box-shadow: 0 2px 0 rgba(0, 0, 0, 0.035);
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    }
    .submitButton:disabled,
    button[disabled] {
    border: 1px solid #cccccc;
    background-color: #cccccc;
    color: #666666;
    }
    .wrapper{
      background: url(../images/student_bg.jpg) #fde8cd;
    }
    .password_head{
    padding: 5% 20% 5% 20%;

    }
    .cardStyle{
    width:100%;
    }
    .fa-times-circle{
    position: absolute;
    right:5%;
    top:2%;
    color:red;
    }
    .lock_icon{
      text-align: center;
    }
    .lock_icon .ico{
      color: black;
      }
    /* password strength checker */
    #pwd_strength_wrap {
      border: 1px solid #D5CEC8;
      display: none;
      float: left;
      padding: 10px;
      position: relative;
      width: 320px;
    }
    #pwd_strength_wrap:before, #pwd_strength_wrap:after {
      content: ' ';
      height: 0;
      position: absolute;
      width: 0;
      border: 10px solid transparent; /* arrow size */
    }
    #pwd_strength_wrap:before {
    border-bottom: 7px solid rgba(0, 0, 0, 0);
    border-right: 7px solid rgba(0, 0, 0, 0.1);
    border-top: 7px solid rgba(0, 0, 0, 0);
    content: "";
    display: inline-block;
    left: -18px;
    position: absolute;
    top: 10px;
    }
    #pwd_strength_wrap:after {
      border-bottom: 6px solid rgba(0, 0, 0, 0);
    border-right: 6px solid #fff;
    border-top: 6px solid rgba(0, 0, 0, 0);
    content: "";
    display: inline-block;
    left: -16px;
    position: absolute;
    top: 11px;
    }
    #pswd_info ul {
      list-style-type: none;
      margin: 5px 0 0;
      padding: 0;
    }
    #pswd_info ul li {

      padding: 0 0 0 20px;
    }
    #pswd_info ul li.valid {
      background-position: left -42px;
      color: green;
    }
    #passwordStrength {
    display: block;
    height: 5px;
    margin-bottom: 10px;
    transition: all 0.4s ease;
    }
    .strength0 {
    background: none; /* too short */
    width: 0px;
    }
    .strength1 {
    background: none repeat scroll 0 0 #FF4545;/* weak */
    width: 25px;
    }
    .strength2 {
    background: none repeat scroll 0 0 #FFC824;/* good */
    width: 75px;
    }
    .strength3 {
      background: none repeat scroll 0 0 #6699CC;/* strong */
    width: 100px;
    }

    .strength4 {
      background: none repeat scroll 0 0 #008000;/* best */
    width: 150px;
    }
    </style>
  </head>
  <body>
    <!-- headbar -->
    <?php include 'headbar.php' ?>
    <!-- password change -->
    <div class="wrapper">


    <div class="password_head " id="password_head">
      <div class="mainDiv">

  <div class="cardStyle">
  <form method="post" name="change_password" id="change_password">
  <div class="lock_icon">
    <i class="fas ico fa-unlock-alt fa-4x"></i>
  </div>

    <h2 class="formTitle">
      Change Password
    </h2>

  <div class="inputDiv">
    <label class="inputLabel" for="password">New Password</label>
    <input type="password" id="pwd" name="password" required>
    <div id="pwd_strength_wrap">
       <div id="passwordDescription">Password not entered</div>
       <div id="passwordStrength" class="strength0"></div>
       <div id="pswd_info">
               <strong>Strong Password Tips:</strong>
               <ul>
                       <li class="invalid" id="length">At least 6 characters</li>
                       <li class="invalid" id="pnum">At least one number</li>
                       <li class="invalid" id="capital">At least one lowercase &amp; one uppercase letter</li>
                       <li class="invalid" id="spchar">At least one special character</li>
               </ul>
       </div><!-- END pswd_info -->
  </div>
  </div>

  <div class="inputDiv">
    <label class="inputLabel" for="confirmPassword">Confirm Password</label>
    <input type="password" id="confirmPassword" name="confirmPassword">
  </div>

  <div class="buttonWrapper">
    <button type="submit" id="submitButton" onclick="validateSignupForm()" class="submitButton pure-button pure-button-primary">
      <span>Continue</span>

    </button>
  </div>

  </form>
  </div>
  </div>
    </div>

  </div>

  <script type="text/javascript">
   var text="";





  // password change with validation
  var password = document.getElementById("pwd");
  var confirm_password = document.getElementById("confirmPassword");



  function validatePassword() {
  if(password.value != confirm_password.value) {
  confirm_password.setCustomValidity("Passwords Don't Match");
  return false;
  } else {
  confirm_password.setCustomValidity('');
  return true;
  }
  }

  confirm_password.onkeyup = validatePassword();




  // CHECKING PASSWORD strength
  $("input#pwd").on("focus keyup", function () {

  });

  $("input#pwd").blur(function () {

  });
  $("input#pwd").on("focus keyup", function () {
        var score = 0;
        var a = $(this).val();
        var desc = new Array();

        // strength desc
        desc[0] = "Too short";
    desc[1] = "Weak";
    desc[2] = "Good";
    desc[3] = "Strong";
    desc[4] = "Best";

  });

  $("input#pwd").blur(function () {

  });
  $("input#pwd").on("focus keyup", function () {
        var score = 0;
        var a = $(this).val();
        var desc = new Array();

        // strength desc
        desc[0] = "Too short";
        desc[1] = "Weak";
        desc[2] = "Good";
        desc[3] = "Strong";
        desc[4] = "Best";

        // password length
        if (a.length >= 6) {
            $("#length").removeClass("invalid").addClass("valid");
            score++;
        } else {
            $("#length").removeClass("valid").addClass("invalid");
        }

        // at least 1 digit in password
        if (a.match(/\d/)) {
            $("#pnum").removeClass("invalid").addClass("valid");
            score++;
        } else {
            $("#pnum").removeClass("valid").addClass("invalid");
        }

        // at least 1 capital & lower letter in password
        if (a.match(/[A-Z]/) && a.match(/[a-z]/)) {
            $("#capital").removeClass("invalid").addClass("valid");
            score++;
        } else {
            $("#capital").removeClass("valid").addClass("invalid");
        }

        // at least 1 special character in password {
        if ( a.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) ) {
                $("#spchar").removeClass("invalid").addClass("valid");
                score++;
        } else {
                $("#spchar").removeClass("valid").addClass("invalid");
        }


        if(a.length > 0) {
                //show strength text
                $("#passwordDescription").text(desc[score]);
                // show indicator
                $("#passwordStrength").removeClass().addClass("strength"+score);
        } else {
                $("#passwordDescription").text("Password not entered");
                $("#passwordStrength").removeClass().addClass("strength"+score);
        }
  });

  $("input#pwd").blur(function () {

  });
  $("input#pwd").on("focus keyup", function () {
        var score = 0;
        var a = $(this).val();
        var desc = new Array();

        // strength desc
        desc[0] = "Too short";
        desc[1] = "Weak";
        desc[2] = "Good";
        desc[3] = "Strong";
        desc[4] = "Best";

        $("#pwd_strength_wrap").fadeIn(400);

        // password length
        if (a.length >= 6) {
            $("#length").removeClass("invalid").addClass("valid");
            score++;
        } else {
            $("#length").removeClass("valid").addClass("invalid");
        }

        // at least 1 digit in password
        if (a.match(/\d/)) {
            $("#pnum").removeClass("invalid").addClass("valid");
            score++;
        } else {
            $("#pnum").removeClass("valid").addClass("invalid");
        }

        // at least 1 capital & lower letter in password
        if (a.match(/[A-Z]/) && a.match(/[a-z]/)) {
            $("#capital").removeClass("invalid").addClass("valid");
            score++;
        } else {
            $("#capital").removeClass("valid").addClass("invalid");
        }

        // at least 1 special character in password {
        if ( a.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) ) {
                $("#spchar").removeClass("invalid").addClass("valid");
                score++;
        } else {
                $("#spchar").removeClass("valid").addClass("invalid");
        }


        if(a.length > 0) {
                //show strength text
                $("#passwordDescription").text(desc[score]);
                text=desc[score];
                // show indicator
                $("#passwordStrength").removeClass().addClass("strength"+score);
        } else {
                $("#passwordDescription").text("Password not entered");
                $("#passwordStrength").removeClass().addClass("strength"+score);
        }
  });

  $("input#pwd").blur(function () {
        $("#pwd_strength_wrap").fadeOut(400);
  });


  function validateSignupForm() {
  var form = document.getElementById('change_password');

  for(var i=0; i < form.elements.length; i++){
    if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
      form.elements[i].setCustomValidity('There are some required fields!');
      return false;
    }
  }

  if (!validatePassword()) {
  return false;
  }


  if(text=="Good"||text=="Strong"||text=="Best"){
  change_password();
  }
  else{
  password.setCustomValidity('Password is not strong enough!');
  }
  }

  function change_password(){
  var id=<?php echo $id ?>;
  var pass=document.getElementById("pwd").value;
  $.ajax({
    type: "POST",
    url: 'teacher_submit.php',
    data: {func:'teacher_pass_change',id:id,password:pass},
    success: function(data){
       alert(data);
       location.reload();
      }
    });
  }


  </script>
  </body>
</html>
