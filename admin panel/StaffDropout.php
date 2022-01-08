<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-StudentDropoutList</title>
    <?php include 'css_jslinks.php' ?>
    <?php include('db.php'); ?>
    <style media="screen">

   .fa-sign-out-alt{
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
  margin-left:0;
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
    <span class="notice_heading"><i class="fas fa-sign-out-alt"></i>Staff Dropout</span>
  </a>
  <a class="" href="Staff_dropout_form.php">
  <button class="btn btn-outline-info" type="button" name="button" >Staff Dropout Form</button>
</a>
  </div>
  </nav>


  <!-- table notice -->
  <center>
  <div class="container">

  <table class="table table-striped table-hover" id="staff_dropout">
  <thead>
    <th>Name</th>
    <th>Father Name</th>
    <th>Mother Name</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Photograph</th>
    <th>DOB</th>
    <th>Gender</th>
    <th>Email</th>
    <th>Joining</th>
    <th>Dropout</th>
    <th>Last Class Teacher</th>
    <th>Role</th>
    <th>AssignedID</th>
    <th>Reason</th>

  </thead>

  </table>

  </div>

  </center>
  <script type="text/javascript">
  $(document).ready(function () {
       var dataTable = $('#staff_dropout').DataTable({
           "responsive": true,
           "processing": true,
           "serverSide": true,
           "ajax": {
               url: "submit.php", // json datasource
               data: {func: 'pagination', page:'staff_dropout'}, // Set the POST variable  array and adds action: getEMP
               type: 'post',  // method  , by default get
           },
           error: function () {  // error handling
             alert("Error occured");
           }
       });
   });
  </script>
  </body>
