<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>KnowledgeAcademy-Upload Notice</title>
    <?php include 'css_jslinks.php' ?>

   <style media="screen">

   /* head bar */

   .navbar-brand{
     font-family: 'Titillium Web', sans-serif;
     height:20%;
   }
   .navbar-brand .fa-scroll{
     padding-right: 3%;
     font-size: 450%;
     color:#ff8838;
   }
   .notice_heading{
     font-size:250%;
   }
    .head{
     padding-top: 5%;
     -webkit-box-shadow: 0 12px 12px -12px black;
   	   -moz-box-shadow: 0 8px 6px -6px black;
   	        box-shadow: 0 12px 12px -12px black;
   }

   /* form style */

   .form_contain{
     padding: 0 10% ;
     margin:5%;
   }
   .col-2{
       font-family: 'Noto Sans JP', sans-serif;
       font-size: 1.35rem;
   }
   .custom-file{
     margin: 2% 0;
   }
   </style>




</head>
  <body>
  <!-- head bar -->
    <nav class="navbar navbar-light bg-light ">
    <div class="container-fluid head d-flex justify-content-between">
      <a class="navbar-brand">
        <i class="fas fa-scroll"></i><span class="notice_heading">NOTICES</span>
      </a>
      <a href="notice portal.php?i=0"> <button class="btn btn-outline-info" type="button" name="button">Show Notices</button> </a>
    </div>
  </nav>

<!-- form -->
<div class="form_contain" id="form_contain" >
   <form method="POST">
       <div class="formgroup container-fluid">
           <label class="col-2 col-form-label" for="pdf_title">Title</label>
             <input class=" form-control form-control-lg" type="text" id="name" name="pdf_title" placeholder="Enter Title" required/>
      </div>
         <div class="formgroup container-fluid">
           <div class="custom-file">
             <input type="file" class="custom-file-input" id="file" name="file">
             <label class="custom-file-label form-control-lg" for="file">Choose file</label>
           </div>
         </div>
       <div class="formgroup container-fluid">
           <input class="btn btn-outline-success btn-lg" type="submit" name="submit_button" required/>
       </div>
   </form>
 </div>

 <script>
// the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

$(document).ready(function(){
    $('#form_contain').on('submit', function(e){
        //Stop the form from submitting itself to the server.
        e.preventDefault();
        var name= $('#name').val();
        var files = $('#file')[0].files;
        var fd = new FormData();
        fd.append('file',files[0]);
        fd.append('name',name);
        fd.append('func',"Notice_Upload")
        $.ajax({
          type: "POST",
          url: 'submit.php',
          processData:false,
          contentType: false,
          data: fd,
          success: function(data){
                alert(data);
                location.reload();
                // alert("kk");
          }
        });
      });
    });
</script>

  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> -->
  </body>
</html>
