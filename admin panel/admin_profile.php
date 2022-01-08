<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-AdminProfile</title>
    <?php
    include 'css_jslinks.php';
    include 'db.php';
    ?>
    <link rel="stylesheet" href="css/admin_profile.css">
    <style media="screen">
    body{
      background-color: #d9d9d9 !important;
    }
    </style>

  </head>
  <body>
   <?php
   if(isset($_GET['i'])){
     $i= $_GET["i"];
   }
   else{
     $i=0;
   }
    ?>
    <!-- head bar -->
      <nav class="navbar navbar-light bg-light">
      <div class="container-fluid head">
        <a class="navbar-brand">
          <i class="far ico fa-id-badge"></i><span class="admin_heading">ADMIN PROFILE</span>
        </a>
      </div>
    </nav>

    <!-- admin profile -->
    <?php
    if(!isset($_SESSION))
    {
     session_start();
   }
    $id=$_SESSION["id"];
      $sql="select * from admin where Id='".$id."'";
      $result=mysqli_query($conn,$sql);
      while($row=mysqli_fetch_array($result)){
     ?>
     <center>
       <div class="link_bar d-flex justify-content-around">
           <a id="change_pass"><i class="fas ico fa-unlock-alt"></i>Change Password</a>
           <a id="log_out"><i class="fas ico fa-sign-out-alt"></i>Logout</a>
       </div>
    <div class="row">

      <div class="col content col-lg-8">
        <table>
          <tr>
            <td class="label">Id</td><td class="value"><?php echo $row['Id']; ?></td>
          </tr>
          <tr>
            <td class="label">Name</td><td class="value"><?php echo $row['Name']; ?></td>
          </tr>
          <tr>
            <td class="label">Father's Name</td><td class="value"><?php echo $row['Fname']; ?></td>
          </tr>
          <tr>
            <td class="label">Mother's Name</td><td class="value"><?php echo $row['Mname']; ?></td>
          </tr>
          <tr>
            <td class="label">Phone</td><td class="value"><?php echo $row['Phone']; ?></td>
          </tr>
          <tr>
            <td class="label">Address</td><td class="value"><?php echo $row['Address']; ?></td>
          </tr>
          <tr>
            <td class="label">Gender</td><td class="value"><?php echo $row['gender']; ?></td>
          </tr>
          <tr>
            <td class="label">Date Of Birth</td><td class="value"><?php echo $row['DOB']; ?></td>
          </tr>
          <tr>
            <td class="label">Email</td><td class="value"><?php echo $row['email']; ?></td>
          </tr>
          <tr>
            <td class="label">Joining</td><td class="value"><?php echo $row['joining']; ?></td>
          </tr>
          <tr>
            <td class="label">Role</td><td class="value"><?php echo $row['Role']; ?></td>
          </tr>
          <tr>
            <td class="label">Password</td><td class="value"><?php echo $row['Password']; ?></td>
          </tr>

        </table>
      </div>
      <div class="col col-lg-4">
        <?php echo '<img src="../images/'.$row['Id'] .'.jpg" height="300" width="300" class="img"  />' ?>
      </div>
    </div>


      <div class="password_head " id="password_head">
        <div class="mainDiv">

  <div class="cardStyle">
    <form method="post" name="change_password" id="change_password">
       <i class="fas fa-times-circle " id="close_div"></i>
       <i class="fas ico fa-unlock-alt fa-4x"></i>

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


  </center>
  <?php } ?>


  <script type="text/javascript">
   var text="";
  // logout
  $("#log_out").click(function(){
   window.location="logout.php";
  });



// password div show hide
  $( document ).ready(function() {
    var count = "<?php echo $i;  ?>" ;
    if(count=='1'){
      $("#password_head").css('display','block');
    }
  });


$("#change_pass").click(function(){
  $("#password_head").css('display','block');
});
$("#close_div").click(function(){
  $("#password_head").css('display','none');
});

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
    url: 'submit.php',
    data: {func:'admin_pass_change',id:id,password:pass},
    success: function(data){
       alert(data);
       location.reload();
      }
    });
}


  </script>
  </body>
</html>
