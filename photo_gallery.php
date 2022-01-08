<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-PhotoGallery</title>
    <link rel="stylesheet" href="photo_gallery.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <?php include 'css_jslinks.php' ?>
  </head>
  <body>


    <?php
     include 'header.html';
     ?>
   <center style="padding-top: 8%;">
     <a class="heading">
       <i class="fas fa-camera-retro"></i><span class="head_cap">Photo Gallery</span>
     </a>
   </center>
   <hr>
     <?php
    include("db.php");
  $sql="SELECT * FROM photo_gallery order by Event_Date desc";
    $result=mysqli_query($conn,$sql);
    ?>
    <div class="layout">

      <div class="row">

    <?php
    while ($row = mysqli_fetch_array($result)) {

      echo
                      '     <div class="col-lg-3 col-md-6">
                                   <img src="images/'.$row['Image'] .'" height="200" width="200" class="img"  />
                                   <p class="Event_Title">'
                                     .$row['Title'].
                                   '</p>
                                   <p class="Event_Date">['
                                     . date("d-m-Y", strtotime($row['Event_Date'])).
                                   ']</p>
                              </div>

                     ';
     }
     ?>

   </div>

 </div>
 <?php
  include 'footer.php';
  ?>
  </body>
</html>
