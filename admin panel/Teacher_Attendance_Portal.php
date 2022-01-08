<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-TeacherAttendance</title>
    <?php include 'css_jslinks.php' ?>
    <link rel="stylesheet" href="css/attendance_header.css">

    <style media="screen">
     /* head style */
    .fa-clipboard-check,.fa-list-ul{
      color:#ff8838;
   }
    .navbar-brand{
     font-family: 'Titillium Web', sans-serif;
    height:20%;
    }
    .navbar-brand .fa-clipboard-check{
     padding-right: 1%;
     font-size: 450%;
    }
    .notice_heading{
    font-size:250%;
    }
   .nav{
    padding-top: 5%;
   }
   .row{
     width:20%;
   }
   @media only screen and (max-width: 810px) {
     .row{
       width:100%;
     }
}
   .icon_text{
     font-size: 50%;
     font-family: 'Noto Sans JP', sans-serif !important;
   }
   .add_event{
     width:100%;
   }
   .form1{
     width: 100%;
   }
   .add_attendance{
     margin-right: 1%;
     margin-bottom: 2%;
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
        <i class="fas fa-clipboard-check"></i><span class="notice_heading">TEACHER ATTENDANCE</span>
      </a>
      <!-- <div class="row d-flex justify-content-end">

        <a href="ApprovedLeave.php"> <button type="button" class="btn btn-outline-info" name="button">Approved Leave Request</button> </a>
        <a href="DeniedRequests.php"> <button type="button" class="btn btn-outline-info" name="button">Denied Leave Request</button> </a>
        <a href="LeaveRequest.php"> <button type="button" class="btn btn-outline-info" name="button">Leave Request</button> </a>
        <button type="button" class="btn btn-outline-info" id="ChangeLeaveYear" name="button">ChangeLeaveYear</button>
        <a href="log_Teacher_Attendance.php"> <button type="button" class="btn btn-outline-info" name="button">  Log Attendance</button> </a>
      </div>
      <div class="form1 d-flex justify-content-end">
          <form class="col-lg-3 d-flex" action="search_attendance_teacher.php" method="post">
            <input class="form-control me-2 notice_text" type="text" name="Teacher_attendance_Search_ID" placeholder="Enter Teacher ID" aria-label="Search">
            <button class="btn btn-outline-success add_attendance" type="submit" id="btn_search" name="submit" value="attendance_search_id" >Search</button>
          </form>
          <form class="col-lg-3 d-flex" action="search_attendance_teacher.php" method="post">
            <input class="form-control me-2 notice_text" type="date" name="Teacher_attendance_Search_Date" placeholder="Enter Date" aria-label="Search">
            <button class="btn btn-outline-success add_attendance" type="submit" id="btn_search" name="submit" value="attendance_search_date">Search</button>
          </form>
      </div> -->
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
      <a class="nav-link" href="#" id="ChangeLeaveYear"><i class="fas fa-clipboard-check"></i> Reset Yearly Leave <span class="sr-only">(current)</span></a>
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
 <th>Attendance ID</th>
 <th>Teacher Name</th>
 <th>Teacher ID</th>
 <th>Status</th>
 <th>Attendance Date</th>
 <th>Edit</th>
 <th>Delete</th>
</thead>

</table>

</div>
</center>



<script type="text/javascript">

$(document).ready(function(){

  $(document).ready(function () {
    var dataTable = $('#notices').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "submit.php", // json datasource
            data: {func: 'pagination', page:'teacher_attendance'}, // Set the POST variable  array and adds action: getEMP
            type: 'post',  // method  , by default get
        },
        error: function () {  // error handling
          alert("Error occured");
        }
    });

  });

$("#ChangeLeaveYear").click(function(){
  $.ajax({
    url: 'submit.php',
    type: 'POST',
    data: { func:"ChangeLeaveYear" },
    success: function(response){
      alert(response);
    }
  });
});
// Delete
$('.delete').click(function(){
 var el = this;

 // Delete id
 var deleteid = $(this).data('id');

 var confirmalert = confirm("Are you sure?");
 if (confirmalert == true) {
    // AJAX Request
    $.ajax({
      url: 'submit.php',
      type: 'POST',
      data: { func:"delete_teacher_attendance",attendance_id: deleteid },
      success: function(response){

        if(response == 1){
    // Remove row from HTML Table
    $(el).closest('tr').children('td, th').css('background','#dd8d8d');
    $(el).closest('tr').children('td, th').fadeOut(800,function(){
       $(this).remove();
    });

        }else{
    alert('Invalid ID.');

        }

      }
    });
 }

});

});

</script>
  </body>
</html>
