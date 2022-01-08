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
      form{
        width:43%;
        height:570px;
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
      .img1{
        height: 55%;
        width: 18%;
        position:absolute;
        top:465px;
        right:15%;
      }
      .img2{
        height: 60%;
        width: 18%;
        position:absolute;
        top:430px;
        left:13%;
      }
    </style>
  </head>
  <body>
    <?php
     include 'header.html';
     ?>
    <center>
      <div class="heading display-4">
        CONTACT US
        <div class="subhead h6">
          We at Knowledge Academy keep working to provide you with the best services. If you have any queries or suggestions, do write to us, we would be glad to help you.
        </div>
      </div>

    </center>
    <img class="img1" src="images/contact_form.png" alt="">
    <img class="img2" src="images/contact1.png" alt="">
    <center>

    <div class="form" id="contact_form">
      <form>
          <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" class="form-control form-control-lg" id="Name" placeholder="Name" required>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="Email">Email</label>
              <input type="email" class="form-control form-control-lg" id="Email" placeholder="Email"required>
            </div>
            <div class="form-group col-md-6">
              <label for="Phone">Phone No.</label>
              <input type="password" class="form-control form-control-lg" id="Phone" placeholder="Phone" required>
            </div>
          </div>
          <div class="form-group">
             <label for="feedback">Comments/Queries</label>
             <textarea class="form-control form-control-lg" id="feedback" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
         </div>

      </form>

    </center>
    </div>
    <?php
     include 'footer.php';
     ?>

    <script type="text/javascript">
    $(document).ready(function(){
        $('#contact_form').on('submit', function(e){
            //Stop the form from submitting itself to the server.
            e.preventDefault();
            var name = $('#Name').val();
            var email = $('#Email').val();
            var phone = $('#Phone').val();
            var feedback=$('#feedback').val();

            function validate_mobile(mobile)
            {
              var phoneno = /^\d{10}$/;
              if(mobile.match(phoneno))
              {
                return true;
              }
              else
              {
               return false;
              }
            }

            if(validate_mobile(phone)==true){
              if( feedback!=''){
                $.ajax({
                  type: "POST",
                  url: 'contact_submit.php',
                  data: {func:'contact',name:name,phone:phone,email:email,feedback:feedback},
                  success: function(data){
                        alert(data);

                        location.reload();
                  }
                })
              }
              else{
                alert('Suggestion/Query cannot be empty.');
              }
            }
            else{
              alert('Invaid Mobile Number');
            }


        });
    });
    </script>
  </body>
</html>
