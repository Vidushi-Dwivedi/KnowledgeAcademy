<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>notice_portal</title>

   <?php include 'css_jslinks.php' ?>
    <style media="screen">

   .fa-scroll{
     color:#ff8838;
   }
   .navbar-brand{
    font-family: 'Titillium Web', sans-serif;
   height:20%;
   }
   .navbar-brand .fa-scroll{
    padding-right: 3%;
    font-size: 450%;
   }
   .notice_heading{
   font-size:250%;
   }
  .nav{
   padding-top: 5%;
   -webkit-box-shadow: 0 12px 12px -12px black;
	   -moz-box-shadow: 0 8px 6px -6px black;
	        box-shadow: 0 12px 12px -12px black;
  }
  .row{
    width:40%;
  }
  @media only screen and (max-width: 990px) {
    .row{
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
/* table styling */

.container{
  width: 80%;
  font-family: 'Noto Sans JP', sans-serif;
  margin-top: 5%;
}
.icon{
  color: black;
}

thead{
    font-family: 'Noto Sans JP', sans-serif;
    font-size: 1.2rem;
  }
</style>

  </head>
  <body>

<!-- head bar -->
<nav class="navbar navbar-light bg-light">
<div class="container-fluid nav">
  <a class="navbar-brand">
    <i class="fas fa-scroll"></i><span class="notice_heading">NOTICES</span>
  </a>
  <div class="row d-flex justify-content-end">
    <a class="col-lg-4  btn btn-light add_event justify-content-end" href="upload_notice.php"> <button class="btn btn-outline-info" type="button" name="button"><i class="fa fa-plus-square fa-2x"><span class="align-self-center icon_text"> Add Notice</span></i></button>  </a>
  </div>

</div>
</nav>


<!-- table notice -->
  <center>
<div class="container">

  <table class="table table-striped table-hover" id="notices">
<thead>
    <th>ID</th>
    <th>Filename</th>
    <th>Upload Date</th>
    <th>Action</th>
    <th>Edit</th>
    <th>Delete</th>
</thead>

</table>

</div>
</center>
<script type="text/javascript">
$(document).ready(function () {
     var dataTable = $('#notices').DataTable({
         "responsive": true,
         "processing": true,
         "serverSide": true,
         "ajax": {
             url: "submit.php", // json datasource
             data: {func: 'pagination', page:'notices'}, // Set the POST variable  array and adds action: getEMP
             type: 'post',  // method  , by default get
         },
         error: function () {  // error handling
           alert("Error occured");
         }
     });
var i=<?php echo $_GET['i']; ?>;
if(i==1){
  alert("Deleted.");
}
else if(i==2){
  alert("Deletion Failed.");
}
 });
</script>

</body>
