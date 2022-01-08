<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-LeaveRequests</title>
    <?php include 'css_jslinks.php' ?>
      <link rel="stylesheet" href="css/attendance_header.css">
    <?php
    if(!isset($_SESSION))
    {
     session_start();
   }
    $s_id=$_SESSION["id"];

     ?>
     <style media="screen">

     .fa-clipboard-check,.fa-list-ul{
       color:#ff8838;
    }
    .navbar-brand{
     font-family: 'Titillium Web', sans-serif;
    height:20%;
    }
    .navbar-brand .fa-clipboard-check{
     padding-right: 3%;
     font-size: 450%;
    }
    .notice_heading{
    font-size:250%;
    }
    .nav{
    padding-top: 5%;
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
     <i class="fas fa-clipboard-check"></i><span class="notice_heading">PENDING LEAVE REQUESTS</span>
    </a>
    </div>
    </nav>
    <nav class="navbar second navbar-expand-lg second  nav-fill w-fill">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><i class="fas fa-ellipsis-h"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav justify-content-between w-100">
        <li class="nav-item active">
          <a class="nav-link" href="Teacher_Attendance_Portal.php"><i class="fas fa-clipboard-check"></i> Teacher Attendance Portal <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="log_Teacher_Attendance.php"><i class="fas fa-clipboard-check"></i> Log Teacher Attendance <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="LeaveRequest.php"><i class="fas fa-clipboard-check"></i> Pending Leave Requests <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="ApprovedLeave.php"><i class="fas fa-clipboard-check"></i> Approved Leave Requests <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="DeniedRequests.php"><i class="fas fa-clipboard-check"></i> Denied Leave Requests <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="Dashboard.php"><i class="fas fa-list-ul"></i> Dashboard <span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
    </nav>


    <!-- table notice -->
    <center>
    <div class="container">

    <table class="table table-striped table-hover" id="notices">
    <thead>
     <th>TeacherID</th>
     <th>Teacher Name</th>
     <th>From Date</th>
     <th>To Date</th>
     <th>Type</th>
     <th>Documents</th>
     <th>Reason</th>
     <th>Action</th>
    </thead>

    </table>

    </div>
    </center>
    <script type="text/javascript">
    $(document).ready(function () {
      var sid=<?php echo $s_id ?>;
      var dataTable = $('#notices').DataTable({
          "responsive": true,
          "processing": true,
          "serverSide": true,
          "ajax": {
              url: "submit.php", // json datasource
              data: {func: 'pagination', page:'leave_requests',s_id:sid}, // Set the POST variable  array and adds action: getEMP
              type: 'post',  // method  , by default get
          },
          error: function () {  // error handling
            alert("Error occured");
          }
      });

    });
    </script>

    </body>
