<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-EditNotice</title>

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

    .container{
      margin-top: 5%;
    }
    .form_contain{
      padding: 0 10% ;
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

    <!-- notice head -->

    <nav class="navbar navbar-light bg-light  d-flex justify-content-between">
    <div class="container-fluid head">
      <a class="navbar-brand">
        <i class="fas fa-scroll"></i><span class="notice_heading">NOTICES</span>
      </a>
        <a href="notice portal.php?i=0"> <button class="btn btn-outline-info" type="button" name="button">Show Notices</button> </a>
    </div>
  </nav>
    <!-- table notice -->

    <div class="container">
      <?php  $id=$_GET['id'];?>

       <form method="POST" accept-charset="utf-8" enctype="multipart/form-data" id="form_contain">
        <?php
         include 'db.php';

         $sql= "SELECT * FROM notice where id='".$id."'";
         $row=mysqli_query($conn,$sql);
         while ($result = mysqli_fetch_array ($row)){?>

           <div class="formgroup container-fluid">
               <label class="col-2 col-form-label" for="pdf_title">Title</label>
                <input class=" form-control form-control-lg" type="text" id="name" name="pdf_title" value="<?php echo $result['Title']; ?>" required/>
          </div>


             <div class="formgroup container-fluid">
               <div class="custom-file">
                 <input type="file" class="custom-file-input" id="file" name="file"  / >
                 <label class="custom-file-label form-control-lg" for="file"><?php echo $result['Title'] ?></label>
               </div>
             </div>
             <input type="hidden" id="id" name="Id" value="<?php echo $result['Id'] ?>">
             <input type="hidden"  id="org_file" name="org_file" value="<?php echo $result['Name'] ?>">
           <div class="formgroup container-fluid">
               <input class="btn btn-outline-success btn-lg" type="submit" name="submit_button" required/>
           </div>
         <?php }?>
      </form>

      <!-- script to show selected file name -->
      <script type="text/javascript">
      $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });

      $(document).ready(function(){
          $('#form_contain').on('submit', function(e){
              //Stop the form from submitting itself to the server.
              e.preventDefault();
              var name= $('#name').val();
              var id= $('#id').val();
              var org_file= $('#org_file').val();
              var files = $('#file')[0].files;
              var fd = new FormData();
              fd.append('file',files[0]);
              fd.append('name',name);
              fd.append('id',id);
              fd.append('org_file',org_file);
              fd.append('func',"Notice_Edit")
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
  </body>
</html>
