<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-PhotoGallerySearch</title>
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
    .feedback_heading{
      font-size:250%;
    }
    .head{
      padding-top: 5%;
      -webkit-box-shadow: 0 12px 12px -12px black;
         -moz-box-shadow: 0 8px 6px -6px black;
              box-shadow: 0 12px 12px -12px black;
    }
    .nav{
     padding-top: 5%;
     -webkit-box-shadow: 0 12px 12px -12px black;
       -moz-box-shadow: 0 8px 6px -6px black;
            box-shadow: 0 12px 12px -12px black;
    }
    .row_head{
      width:50%;
    }
    @media only screen and (max-width: 990px) {
      .row_head{
        width:100% !important;
        margin-bottom: 3% !important;
      }
      .add_event{
        width:20% !important;
      }
 }
    .icon_text{
      font-size: 50%;
      font-family: 'Noto Sans JP', sans-serif !important;
    }
    .add_event{
      width:80%;
    }
    /* layout photo grid */
    .layout{
      padding: 3% 2% 2% 2%;
    }
    .img{
      width:100%;
      height:70%;
      padding: 2% 2%;
      border-radius: 8px;
      box-shadow:  12px 12px 24px #9bb4c3;
        text-align: center;
    }
    .Event_Title{
      padding-top: 3%;
      padding-bottom:1%;
      margin-bottom: 0;
      font-family: 'Montserrat', sans-serif;
      font-size: 1.2rem;
        text-align: center;
    }
    .Event_Date{
      padding-top: 0;
      padding-bottom:1%;
      font-family: 'Montserrat', sans-serif;
      font-size: 1rem;
        text-align: center;
        margin-bottom: 0;
    }
    .icon{
      color: black;
    }
    .add_icon{
      text-align: center;
      padding-bottom:1%;
      margin-bottom: 3%;
    }
    </style>
  </head>
  <body>
    <!-- PhotoGalleryPortal head -->

    <nav class="navbar navbar-light bg-light">
    <div class="container-fluid head">
      <a class="navbar-brand">
        <i class="fas fa-camera-retro"></i></i><span class="feedback_heading">PHOTO GALLERY</span>
      </a>
      <div class="row row_head d-flex justify-content-end">
        <a class="col-lg-4 btn btn-light add_event " href="gallery_upload.php"><i class="fa fa-plus-square fa-2x"><span class="align-self-center icon_text"> Add Photo</span></i> </a>
        <form class="col-lg-8 col-md-6 d-flex justify-content-end" action="gallery_portal_search.php" method="post">
            <input class="form-control me-2 notice_text" type="text" name="Gallery_Search" placeholder="Enter Title" aria-label="Search">
            <button class="btn btn-outline-success add_notice" type="submit" id="btn_search" name="gallery_search_enter" value="Search">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- php for writing search -->
  <?php
  if(isset($_POST["gallery_search_enter"])){
    $val=$_POST['Gallery_Search'];
    if($val!=''){
      $sql="select * from photo_gallery where title='".$val."'";
      $result=mysqli_query($conn,$sql);

  ?>
      <div class="layout">
        <div class="row">
  <?php
      if(mysqli_num_rows($result)>0){

        while ($row = mysqli_fetch_array($result)) {

          echo
                          '     <div class="col-lg-3 col-md-6">
                                       <img src="../images/'.$row['Image'] .'" height="200" width="200" class="img"  />
                                       <p class="Event_Title">'
                                         .$row['Title'].
                                       '</p>
                                       <p class="Event_Date">['
                                         .$row['Event_Date'].
                                       ']</p>
                                       <p class="add_icon">
                                        <a class="icon" href="photo_gallery_edit.php?id='.$row['Id'].'"><i class="fa fa-edit "></i></a>
                                        <a class="icon delete" data-id='.$row['Id'].' data-title='.$row['Image'].' ><i class="fa fa-trash"></i></a>
                                       </p>
                                  </div>

                         ';
         }
      }
      else{
        echo '<p class="text-center">No Image Found.</p>';
      }
   ?>
     </div>
     </div>
   <?php }} ?>
   <script type="text/javascript">
   $(document).ready(function(){

   // Delete
   $('.delete').click(function(e){
     e.preventDefault();
    var el = this;

    // Delete id
    var deleteid = $(this).data('id');
    var title = $(this).data('title');

    var confirmalert = confirm("Are you sure?");
    if (confirmalert == true) {
       // AJAX Request
       $.ajax({
         url: 'submit.php',
         type: 'POST',
         data: { func:"delete_photo_gallery",photo_id: deleteid,photo_title:title },
         success: function(response){
           if(response == 1){
       // Remove row from HTML Table
       $(el).closest('div').css('background','#dd8d8d');
       $(el).closest('div').fadeOut(800,function(){
          $(this).remove();
       });

           }else{
       alert('Invalid ID.'+response);

           }

         }
       });
    }

   });

   });

   </script>
  </body>
</html>
