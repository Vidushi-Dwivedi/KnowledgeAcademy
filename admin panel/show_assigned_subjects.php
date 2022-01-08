<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include 'css_jslinks.php' ?>
    <title>KnowledgeAcademy-ShowAssignedSubjects</title>
    <style media="screen">

   .fa-swatchbook{
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
  width: 100%;
  font-family: 'Noto Sans JP', sans-serif;
  margin-top: 5%;
  /* margin-left:5%; */
  }
  .icon{
  color: black;
  }
  .dataTables_info{
    text-align: left;
  }
  .dataTables_paginate{
    text-align: left;
  }
  .dataTables_paginate a {
  display: inline-block;
  padding: 10px;
  color:black;
}
  thead{
    font-family: 'Noto Sans JP', sans-serif;
    font-size: 0.8rem;
    text-align: center;
  }
  tbody{
    font-size: 0.8rem;
    text-align: center;
  }
  img{
    width:150px;
  }
  </style>

  </head>
  <body>

  <!-- head bar -->
  <nav class="navbar navbar-light bg-light">
  <div class="container-fluid nav d-flex justify-content-between">
  <a class="navbar-brand">
    <span class="notice_heading"><i class="fas fa-swatchbook"></i>Subject-Teacher Assigned</span>
  </a>
  <div class="">
    <a href="assign_subject.php"> <button class="btn btn-outline-info" type="button" name="button">Assign Teacher</button> </a>
    <a href="dashboard.php"> <button class="btn btn-outline-info" type="button" name="button">Dashboard</button> </a>
    </div>
  </div>

  </nav>


  <!-- table notice -->
  <center>
  <div class="container">
  <center>

  <table class="table table-striped table-hover" id="teaches">
  <thead>
    <th>ClassID</th>
    <th>TeacherID</th>
    <th>Eng Lit</th>
    <th>Eng Lang</th>
    <th>Hindi Lit</th>
    <th>Hindi Lang</th>
    <th>Maths</th>
    <th>Science</th>
    <th>Social Science</th>
    <th>Computer</th>
    <th>General Knowledge</th>
    <th>Art</th>
    <th>Edit</th>
    <th>Delete</th>

  </thead>

  </table>

</center>
  </div>

  </center>
  <script type="text/javascript">
  $(document).ready(function () {
       var dataTable = $('#teaches').DataTable({
           "responsive": true,
           "processing": true,
           "serverSide": true,
           "ajax": {
               url: "submit.php", // json datasource
               data: {func: 'pagination', page:'teaches'}, // Set the POST variable  array and adds action: getEMP
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
