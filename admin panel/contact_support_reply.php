<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-ContactSupportReply</title>
    <?php include 'css_jslinks.php'; ?>

    <style >
    /* head bar */

    .navbar-brand{
      font-family: 'Titillium Web', sans-serif;
      height:20%;
    }
    .navbar-brand .fa-comments{
      padding-right: 3%;
      font-size: 450%;
      color:#ff8838;
    }
    .feedback_heading{
      font-size:250%;
    }
    .head{
      padding-top: 5%;
      -webkit-box-shadow: 0 12px 12px -12px black;
         -moz-box-shadow: 0 8px 6px -6px black;
              box-shadow: 0 12px 12px -12px black;
    }

    /* form style */
    .container{
      padding:5% 5%;
    }
    .form-group{
      font-family: 'Noto Sans JP', sans-serif;
      font-size: 1.35rem;
      padding-top: 3%;
    }
    .form-contain{
      padding: 0;
    }
    textarea{
      resize:none;
    }


  </style>
    </style>
  </head>
  <body>
    <!-- contact head -->

    <nav class="navbar navbar-light bg-light">
    <div class="container-fluid head">
      <a class="navbar-brand">
        <i class="fas fa-comments"></i></i><span class="feedback_heading">CONTACT SUPPORT</span>
      </a>
    </div>
  </nav>

    <!-- table notice -->

    <div class="container" id="reply_contact_support_form">
      <?php
        $id=$_GET['id'];
        $c=$_GET['i'];
      ?>

        <form  method="POST" accept-charset="utf-8" enctype="multipart/form-data">
        <?php
         include 'db.php';

         $sql= "SELECT * FROM feedback where id='".$id."'";
         $row=mysqli_query($conn,$sql);
         while ($result = mysqli_fetch_array ($row)){?>

           <div class="form-group container-fluid">
               <label class="col-form-label" for="name">Sender Name</label>
                <input class=" form-control form-control-lg" type="text" name="name" value="<?php echo $result['Name']; ?>" readonly/>
          </div>
             <div class="form-group container-fluid">
                 <label class="form-control-lg" for="email">Email</label>
                 <input type="email" class=" form-control form-control-lg" name="email"  value="<?php echo $result['Email'] ?>" readonly/>
             </div>
             <div class="form-row">
               <div class="form-group col-md-6">
                 <label class="col-2 col-form-label" for="date">Date</label>
                 <input class=" form-control form-control-lg" type="text" name="date"  value="<?php echo $result['Date'];?>" readonly/>
               </div>
               <div class="form-group col-md-6">
                 <label for="Phone">Phone No.</label>
                 <input type="text" class="form-control form-control-lg"  value="<?php echo $result['Contact_No'] ?>" readonly>
               </div>
             </div>
             <div class="form-group">
                <label for="feedback">Comments/Queries</label>
                <textarea class="form-control form-control-lg" name="feedback" rows="3" readonly><?php echo $result['Message'] ?></textarea>
             </div>
             <?php if($c==1){
               $arr = explode("Reply:", $result['Reply'], 2);
               $sub= substr($arr[0],9);
               $rep=$arr[1];
               ?>
               <div class="form-group container-fluid">
                  <label for="subject">Subject</label>
                    <input class=" form-control form-control-lg" type="text" name="name" id="subject" value="<?php echo $sub; ?>" readonly/>
              </div>
               <div class="form-group">
                  <label for="subject">Reply</label>
                  <textarea class="form-control form-control-lg" name="reply" id="reply" rows="3"  readonly><?php echo $rep; ?></textarea>
               </div>
             <?php }else{ ?>
             <div class="form-group container-fluid">
                <label for="subject">Subject</label>
                  <input class=" form-control form-control-lg" type="text" name="name" id="subject" placeholder="Enter Subject" required/>
            </div>
             <div class="form-group">
                <label for="subject">Reply</label>
                <textarea class="form-control form-control-lg" name="reply" id="reply" rows="3" placeholder="Enter Reply" required></textarea>
             </div>

           <div class="form-group container-fluid">
               <input class="btn btn-outline-success btn-lg" type="submit" name="submit_button" required/>
           </div>
         <?php }}?>
      </form>

      <script type="text/javascript">

      $(document).ready(function(){
          $('#reply_contact_support_form').on('submit', function(e){
              //Stop the form from submitting itself to the server.
              e.preventDefault();
              var id = <?php echo  $_GET['id']?>;
              var subject = $('#subject').val();
              var reply = $('#reply').val();

              $.ajax({
                type: "POST",
                url: 'submit.php',
                data: {func:'contact_support_reply',id:id,subject:subject,reply:reply},
                success: function(data){
                   alert(data);
                   location.reload();
                   window.location="contact_support.php";
                  }
                })
            });
        });
      </script>
  </body>
</html>
