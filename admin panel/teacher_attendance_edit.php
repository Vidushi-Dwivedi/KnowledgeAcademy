<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-AttendanceTeacherEdit</title>
    <?php include 'css_jslinks.php' ?>
    <style media="screen">

    /* head bar */

    .navbar-brand{
      font-family: 'Titillium Web', sans-serif;
      height:20%;
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
      -webkit-box-shadow: 0 12px 12px -12px black;
        -moz-box-shadow: 0 8px 6px -6px black;
             box-shadow: 0 12px 12px -12px black;
    }
    /* form style */

    .container{
      margin-top: 5%;
    }
    .form_contain{
      padding: 0 10% ;
    }
    .col-2{
        font-family: 'Noto Sans JP', sans-serif;
        font-size: 1.35rem;
    }
    .submit{
      margin-top: 1%;
    }

    </style>
  </head>
  <body>
    <!-- head bar -->
      <nav class="navbar navbar-light bg-light d-flex justify-content-between">
      <div class="container-fluid head">
        <a class="navbar-brand">
          <i class="fas fa-clipboard-check"></i><span class="notice_heading">Teacher Attendance</span>
        </a>
        <a href="Teacher_Attendance_Portal.php"> <button type="button" class="btn btn-outline-info" name="button">Teacher Attendance Portal</button> </a>
      </div>
    </nav>

    <!-- form -->
    <div class="container" id="edit_log_Teacher_Attendance_form">
      <?php  $id=$_GET['id'];?>

      <form  method="POST" accept-charset="utf-8" enctype="multipart/form-data">
       <?php
        include 'db.php';

        $sql= "SELECT * FROM teacher where Id='".$id."'";
        $row=mysqli_query($conn,$sql);
        while ($result = mysqli_fetch_array ($row)){?>

          <div class="formgroup container-fluid">
              <label class="col-2 col-form-label" for="id">Teacher ID</label>
               <input class=" form-control form-control-lg" type="text" name="id" value="<?php echo $id ?>" readonly/>
         </div>

         <div class="formgroup container-fluid">
             <label class="col-2 col-form-label" for="name">Teacher Name</label>
              <input class=" form-control form-control-lg" type="text" name="name" value="<?php echo $result["Name"] ?>" readonly/>
        </div>
     <?php
   }
   $sql= "SELECT * FROM teacher_attendance where attendance_id='".$_GET["attend_id"]."'";
   $row=mysqli_query($conn,$sql);
   while ($result = mysqli_fetch_array ($row)){
      ?>
        <div class="formgroup container-fluid">
            <label class="col-2 col-form-label" for="date">Date</label>
             <input class=" form-control form-control-lg" type="text" name="date" value="<?php echo  $result["attendance_date"] ?>" readonly/>
       </div>

        <div class="formgroup container-fluid">
          <label class="col-2 col-form-label" for="Status">Status*</label>
          <select class="form-control form-control-lg" id="Status" name="status" required>
            <option value="1">Present</option>
            <option value="2">Absent</option>
            <option value="3">Late</option>
            <option value="4">Half Day</option>
          </select>
        </div>

        <div class="formgroup container-fluid">
              <input class="btn btn-outline-success btn-lg submit"  type="submit" name="submit_button" required/>
        </div>
        <?php }?>
     </form>

    </div>

    <script type="text/javascript">

    $(document).ready(function(){
        $('#edit_log_Teacher_Attendance_form').on('submit', function(e){
            //Stop the form from submitting itself to the server.
            e.preventDefault();
            var id = <?php echo  $_GET['attend_id']?>;
            var status = $('#Status').val();

            $.ajax({
              type: "POST",
              url: 'submit.php',
              data: {func:'edit_log_Teacher_Attendance',attendance_id:id,status:status},
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
