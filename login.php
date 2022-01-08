
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'css_jslinks.php' ?>
    <link rel="stylesheet" type="text/css" href="footer.css">
    <link rel="stylesheet" type="text/css" href="header.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title> User Login and Registration </title>
</head>
<body>
  <?php include 'header.html' ?>
    <div class="container">
        <div class="login-box">
        <div class="login-content">
            <div >
                <center><div class='head'> Login Here </div></center>
                <form name ="f1" id="f1" method="post">
                <div class="form-group">
                <label for="Role">Role*</label>
    <select class="form-control form-control-lg" id="role" name="role" required>
      <option>Admin</option>
      <option>Student</option>
      <option>Teacher</option>
    </select>
</div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="user" name="user" class="form-control" required>
</div>
<div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
</div>
<button type="submit" id="btn" class="btn btn-primary">Login</button>
</form>
</div>
</div>
<!-- <div class="fp">
  <center>
   Forgot Password? <a href="forgot_password.php">Click Here</a>
  </center>
</div> -->
</div>
</div>
  <?php include 'footer.php' ?>
<script>
            $(document).ready(function(){
                $('#f1').on('submit', function(e){
                    //Stop the form from submitting itself to the server.
                    e.preventDefault();

                     var role=document.getElementById('role').value;
                     var user=document.getElementById('user').value;
                     var password=document.getElementById('password').value;
                     $.ajax({
                       type: "POST",
                       url: 'validation.php',
                       data:{role:role,user:user,password:password},
                       success: function(data){
                          if(data==1){
                            window.open('admin panel/dashboard.php');

                          }
                          else if(data==2){
                            window.open('student panel/profile.php');
                          }
                          else if(data==3){
                            window.open('teacher panel/profile.php');
                          }
                          else{
                            alert("Invalid credentials");
                            window.reload();
                          }
                             // console.log(data);
                             // location.reload();
                       }

                    });
                  });
                });
        </script>
</body>
</html>
