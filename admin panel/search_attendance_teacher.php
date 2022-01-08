<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-SearchTeacherAttendance</title>
    <?php include 'css_jslinks.php' ?>

    <style media="screen">

      /* headbar */
      .fa-clipboard-check{
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
      -webkit-box-shadow: 0 12px 12px -12px black;
        -moz-box-shadow: 0 8px 6px -6px black;
             box-shadow: 0 12px 12px -12px black;
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
     .icon{
       color:black;
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
      <div class="row d-flex justify-content-end">
        <a class=" d-flex justify-content-end btn btn-light add_event" href="log_Teacher_Attendance.php"> <i class="fa fa-plus-square fa-2x"><span class="align-self-center icon_text"> Log Attendance</span></i> </a>
      </div>
      <div class="form1 d-flex justify-content-end">
          <form class="col-lg-3 d-flex" action="search_attendance_teacher.php" method="post">
            <input class="form-control me-2 notice_text" type="text" name="Teacher_attendance_Search_ID" placeholder="Enter Teacher ID" aria-label="Search">
            <button class="btn btn-outline-success add_attendance" type="submit" id="btn_search" name="submit" value="attendance_search_id" >Search</button>
          </form>

          <form class="col-lg-3 d-flex" action="search_attendance_teacher.php" method="post">
            <input class="form-control me-2 notice_text" type="date" name="Teacher_attendance_Search_Date" aria-label="Search">
            <button class="btn btn-outline-success add_attendance" type="submit" id="btn_search" name="submit" value="attendance_search_date">Search</button>
          </form>
      </div>
</nav>

<!-- php for writing search -->
<?php
if(isset($_POST["submit"])){
  $i=0;
  switch($_POST["submit"]) {
    case 'attendance_search_id':
           $val=$_POST['Teacher_attendance_Search_ID'];
           if($val!=""){
             $sql="select * from teacher_attendance where teacher_id='".$val."'";
             $i=1;
          }
    break;
    case 'attendance_search_date':
           $val=$_POST['Teacher_attendance_Search_Date'];
            if($val!=""){
             $sql="select * from teacher_attendance where attendance_date='".$val."'";
             $i=1;
          }
    break;
  }
  if($i==1){
    include 'db.php';
  $result=mysqli_query($conn,$sql);

  if(mysqli_num_rows($result)>0){?>
    <center>
  <div class="container" style="overflow:scroll; height:800px; margin-top: 4%">

    <table class="table table-striped table-hover">
  <thead>
      <th>Attendance ID</th>
      <th>Teacher ID</th>
      <th>Status</th>
      <th>Attendance Date</th>
      <th>Edit</th>
      <th>Delete</th>
  </thead>
  <tbody>
    <?php    foreach ($result as $file): ?>
        <tr>
          <td><?php echo $file['attendance_id']; ?></td>
          <td><?php echo $file['teacher_id']; ?></td>
          <td><?php echo $file['status']; ?></td>
          <td><?php echo $file['attendance_date']; ?></td>
          <td><a class="icon" href="teacher_attendance_edit.php?attend_id=<?php echo $file['attendance_id'] ?>&id=<?php echo $file['teacher_id']?>"><i class="fa fa-edit "></i></a></td>
          <td><a class="icon delete" data-id='<?php echo $file['attendance_id'] ?>'   ><i class="fa fa-trash"></i></a></td>
        </tr>
      <?php endforeach;?>
    </tbody>
    </table>

    </div>

    </center>
<?php
  }
  else{
    ?>
    <center>
      <p class="res">No record found.</p>
    </center>
    <?php
  }
}
else{
  header("Location:Teacher_Attendance_Portal.php");
}
}

 ?>
 <script type="text/javascript">

 $(document).ready(function(){

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
        // console.log(response);
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
<?php ob_end_flush(); ?>
