<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-TeacherLog</title>
    <?php include 'css_jslinks.php'; ?>
      <link rel="stylesheet" href="css/attendance_header.css">
    <style media="screen">

    /* head bar */

    .navbar-brand,.fa-list-ul{
      font-family: 'Titillium Web', sans-serif;
      height:20%;
    }
    .fa-clipboard-check{
      color:#ff8838;
   }
    .navbar-brand .fa-clipboard-check{
      padding-right: 3%;
      font-size: 450%;
      color:#ff8838;
    }
    .notice_heading{
      font-size:250%;
    }
     .head{
      padding-top: 5%;
    }

    .form_contain{
      padding: 0 10% ;
      margin:5%;
    }
    .col-2,.col-4{
        font-family: 'Noto Sans JP', sans-serif;
        font-size: 1.35rem;
    }

    </style>
  </head>
  <body>
    <!-- head bar -->
      <nav class="navbar navbar-light bg-light">
      <div class="container-fluid head">
        <a class="navbar-brand">
          <i class="fas fa-clipboard-check"></i><span class="notice_heading">Teacher Attendance</span>
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

    <!-- form -->
    <div class="form_contain" id="teacher_attendance_form">
       <form  method="POST" accept-charset="utf-8" enctype="multipart/form-data">
           <div class="formgroup container-fluid">
               <label class="col-4 col-form-label" for="teacher_id">Teacher-ID* </label>
                 <input class=" form-control form-control-lg" type="text" name="teacher_id" id="teacher_id" placeholder="Enter Teacher ID" required/>
          </div>

              <div class="formgroup container-fluid">
                <label class="col-2 col-form-label" for="attendance_date">Date*</label>
                <input class=" form-control form-control-lg" type="date" name="attendance_date" id="date" required/>
             </div>
             <div class="form-group container-fluid">
             <label class="col-2 col-form-label" for="Status">Status*</label>
             <select class="form-control form-control-lg" id="Status" name="status" required>
               <option value="1">Present</option>
               <option value="2">Absent</option>
               <option value="3">Late</option>
               <option value="4">Half Day</option>
             </select>
             </div>
           <div class="formgroup container-fluid">
               <input class="btn btn-outline-success btn-lg" type="submit" name="submit_button" required/>
           </div>
       </form>
     </div>

     <script>
               $(document).ready(function(){
                   $('#teacher_attendance_form').on('submit', function(e){
                       //Stop the form from submitting itself to the server.
                       e.preventDefault();
                       var id = $('#teacher_id').val();
                       var date = $('#date').val();
                       var status = $('#Status').val();

                       $.ajax({
                         type: "POST",
                         url: 'submit.php',
                         data: {func:'verify_log_Teacher_Attendance',teacher_id:id,date:date,status:status},
                         success: function(data){

                             if(data=="1"){
                               $.ajax({
                                   type: "POST",
                                   url: 'submit.php',
                                   data: {func:'submit_log_Teacher_Attendance',teacher_id:id,date:date,status:status},
                                   success: function(data){

                                       if(data==1){
                                         alert("Attendance added Successfully.");
                                         location.reload();
                                       }
                                       else{
                                         alert("Failed");
                                         location.reload();
                                       }
                                   }
                               });
                             }
                             else{
                               alert(data);
                             }
                         }
                       })
                   });
               });
    </script>

  </body>
</html>
