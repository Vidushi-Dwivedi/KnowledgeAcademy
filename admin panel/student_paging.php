<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include 'css_jslinks.php' ?>
    <title>KnowledgeAcademy-Student</title>
    <style media="screen">

   .fa-graduation-cap{
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
  margin-left:2%;
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
  <nav class="navbar navbar-light bg-light d-flex justify-content-between">
  <div class="container-fluid nav">
  <a class="navbar-brand">
    <span class="notice_heading"><i class="fas fa-graduation-cap" ></i>STUDENT PORTAL</span>
  </a>
  </div>

  </nav>
  <div class="d-flex justify-content-end">
    <a href="student2.php"> <button class="btn btn-outline-primary" type="button " name="button"> <i class="fa fa-plus-square fa-2x"></i> Add Student</button> </a>
  </div>

  <!-- table notice -->
  <center>
  <div class="container">

  <table class="table table-striped table-hover" id="student_paging">
  <thead>
  <th>ID</th>
    <th>Name</th>
    <th>Fathers Name</th>
    <th>Mothers Name</th>
    <th>Phone</th>
    <th>Address</th>
    <th> Class </th>
                <th> Email </th>
                <th> Gender </th>
    <th>Photo</th>
    <th> Password </th>
    <th> Date Of Birth </th>
                <th> Year </th>

    <th>Admission Date</th>
    <th>admission_class</th>
    <th> Update </th>
                <th> Delete </th>

  </thead>

  </table>

  </div>

  </center>
  <script type="text/javascript">
  $(document).ready(function () {
       var dataTable = $('#student_paging').DataTable({
           "responsive": true,
           "processing": true,
           "serverSide": true,
           "ajax": {
               url: "submit.php", // json datasource
               data: {func: 'pagination', page:'student_paging'}, // Set the POST variable  array and adds action: getEMP
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
