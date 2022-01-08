<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-ContactUs</title>
    <?php include 'css_jslinks.php'; ?>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <style media="screen">
    body{
      background-image: linear-gradient(to bottom,#1b262c, #051c3d, #2d4c6b, #5b8199, #92bac8, #d1f4f9) !important;
    }
    /* form style */
      .heading{
        font-family: 'Titillium Web', sans-serif;
        padding: 85px 0;
        font-weight: 700 !important;
        color: white;
        text-shadow: 0px 0px 1px  #2f3031;
      }
      .subhead{
        font-weight: 200;
      }
      .form{
        width:43%;
        height:350px;
        margin-bottom: 100px;
        border: 3px outset black ;
        padding:2%;
        border-radius: 5px;
        background: #e0e0e0;
        box-shadow:  5px 5px 9px #5a5a5a,
             -5px -5px 9px #ffffff;
             text-align: left;
      }
      .form-group{
        font-family: 'Noto Sans JP', sans-serif;
        font-size: 1.35rem;
        padding-top: 3%;
      }
    </style>
  </head>
  <body>
    <?php
     include 'header.html';
     ?>
    <center>
      <div class="heading display-4">
        Forgot Password!?
        <!-- <div class="subhead h6">
          An OTP has been sent to your registered mail.
        </div> -->
      </div>



    <div class="form" id="forgot_password">
      <form>
        <div class="form-group">
        <label for="New_Pass">New Password*</label>
          <input type="text" id="New_Pass" name="New_Pass" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" id="Con_Pass" name="Con_Pass" class="form-control" required>
            </div>


      </form>
      <div class="form-group">
        <button id="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
     </div>
    </center>
    </div>
    <?php
     include 'footer.php';
     ?>

    <script type="text/javascript">
    $(document).ready(function(){

        $('#submit').on('click', function(e){
            //Stop the form from submitting itself to the server.
            e.preventDefault();
            var np=document.getElementById('New_Pass').value;
            var cp=document.getElementById('Con_Pass').value;
            if(np==""){

            }
            else{
              if(cp==""){

              }
              else{
                if(np==cp){
                  $.ajax({
                    type: "POST",
                    url: 'sendotp.php',
                    data: {func:'otp_change',cp:cp,np:np},
                    success: function(data){
                      alert(data);
                    }
                  })
                }
                else{
                  alert('Password don\'t match. Try again!' );
                }
              }
            }
        });
    });
    </script>
  </body>
</html>
