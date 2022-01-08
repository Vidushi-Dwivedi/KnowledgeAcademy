<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-PhotoGalleryEdit</title>
    <?php include 'css_jslinks.php';
    include 'db.php';?>
    <style >
    /* head bar */

    .navbar-brand{
      font-family: 'Titillium Web', sans-serif;
      height:20%;
    }
    .navbar-brand .fa-camera-retro{
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
      <nav class="navbar navbar-light bg-light">
      <div class="container-fluid head">
        <a class="navbar-brand">
          <i class="fas fa-camera-retro"></i><span class="notice_heading">PHOTO GALLERY</span>
        </a>
      </div>
    </nav>

   <?php
        $id=$_GET['id'];
        $sql="select * from photo_gallery where Id='".$id."'";
        $result=mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
    ?>
    <!-- form upload -->
       <div class="form_contain" id="gallery_upload_form">
         <form  method="POST" accept-charset="utf-8" enctype="multipart/form-data">
             <div class="formgroup container-fluid">
                 <label class="col-2 col-form-label" for="title">Title</label>
                   <input class=" form-control form-control-lg" type="text" name="title" id="title" placeholder="Enter Title" value="<?php echo $row['Title'] ?>" required/>
            </div>

                <div class="formgroup container-fluid">
                  <label class="col-2 col-form-label" for="date">Date</label>
                  <input class=" form-control form-control-lg" type="date" name="date" id="date" value="<?php echo $row['Event_Date'] ?>" required/>
               </div>
               <div class="formgroup container-fluid">
                 <div class="custom-file">
                   <input type="file" class="custom-file-input" id="file" name="file" >
                   <label class="custom-file-label form-control-lg" for="file" ><?php echo $row['Image'] ?></label>
                 </div>
               </div>
             <div class="formgroup container-fluid">
                 <input class="btn btn-outline-success btn-lg" type="submit" name="submit" required/>
             </div>
         </form>
       </div>
<?php } ?>
       <script>

       // the name of the file appear on select
       $(".custom-file-input").on("change", function() {
         var fileName = $(this).val().split("\\").pop();
         $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
       });

       // file ajax submission
                 $(document).ready(function(){
                     $('#gallery_upload_form').on('submit', function(e){
                         //Stop the form from submitting itself to the server.
                         e.preventDefault();
                         var c=0;
                         var title = $('#title').val();
                         var date = $('#date').val();
                         var fd = new FormData();

                         fd.append('func','gallery edit');
                         fd.append('id',<?php echo $id ?>);
                         fd.append('title',title);
                         fd.append('date',date);
                         var files = $('#file')[0].files;
                         if(files.length > 0 ){
                            fd.append('file',files[0]);
                            c=1;
                         }
                         fd.append('img_changed',c);
                         $.ajax({
                           type: "POST",
                           url: 'submit.php',
                           processData:false,
                           contentType: false,
                           data: fd,
                           success: function(data){
                                alert(data);
                                location.reload();
                           }
                         })
                     });
                 });
      </script>


  </body>
</html>
