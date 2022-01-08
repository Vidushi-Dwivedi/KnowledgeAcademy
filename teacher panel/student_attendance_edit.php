<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php
    if(!isset($_SESSION))
    {
     session_start();
   }
    $id=$_SESSION["id"];

     ?>
    <title>KnowledgeAcademy-AttendanceTeacherEdit</title>
    <?php include 'css_jslinks.php';
    include 'db.php'; ?>
    <link rel="stylesheet" href="css/head.css">
    <link rel="stylesheet" href="css/profile_bar.css">
    <style media="screen">
     /* head style */
     .first_col{
       background-color: #2d8074;
     }
     .third_col{
         background-color: #fde8cd;
     }
     .container-fluid{
       margin-bottom: 30px;
       margin-top: 15px;
     }
     .icon{
       color:black !important;
     }
     .brand{
       font-size: xx-large;
       font-weight:bold;
       color:#1c2645 !important;
       margin-left:20px;
     }
     /* .form1{
       margin-bottom: 40px;
     } */
     .container{
       padding:40px 10px 10px 10px;
       background-color: white;
       border-radius: 20px;
       margin: 20px;
       margin-right: 40px !important;
     }
     </style>
  </head>
  <body>
    <?php include 'headbar.php' ?>

    <?php


   $sql="select * from teacher where Id='".$id."'";
   $result= mysqli_query($conn,$sql);
   $row=mysqli_fetch_array($result);
   $class_teacher="";
   if($row['ClassTeacher']=="")
   {
     $class_teacher="-";
   }
   else{$class_teacher=$row['ClassTeacher'];}
    ?>
    <div class="row body_row">
    <div class="col-lg-3 first_col">
    <center> <img src="<?php echo '../images/'.$row['Id'].'.jpg' ?>" class="profile_img" alt="">
    <div class="name_tag "><?php echo $row['Name']; ?></div>
    <div class="class_tag ">Class Teacher : <?php echo $class_teacher; ?></div>
    </center>
    <center>
    <div class="inner_profile_base text-center">
      <div class="head">
        <center>PROFILE</center>
      </div>
      <div class="body">
        <table>
          <tr>
            <td>Teacher ID :</td>
            <td><?php echo $row['Id']; ?></td>
          </tr>
          <tr>
            <td>Father's Name :</td>
            <td><?php echo $row['Fname']; ?></td>
          </tr>
          <tr>
            <td>Mother's Name :</td>
            <td><?php echo $row['Mname']; ?></td>
          </tr>
          <tr>
            <td>Contact No :</td>
            <td><?php echo $row['Phone']; ?></td>
          </tr>
          <tr>
            <td>Address :</td>
            <td><?php echo $row['Address']; ?></td>
          </tr>
          <tr>
            <td>Gender :</td>
            <td><?php echo $row['gender']; ?></td>
          </tr>
          <tr>
            <td>Email :</td>
            <td><?php echo $row['email']; ?></td>
          </tr>
          <tr>
            <td>DOB :</td>
            <td><?php echo $row['DOB']; ?></td>
          </tr>
          <tr>
            <td>Joining :</td>
            <td><?php echo $row['joining']; ?></td>
          </tr>
          <tr>
            <td>Class Teacher :</td>
            <td><?php echo $row['ClassTeacher']; ?></td>
          </tr>
          <tr>
            <td>Password :</td>
            <td><?php echo $row['Password']; ?></td>
          </tr>
        </table>
    </div>
    </div>
  </center>
  </div>
  <div class="col col-lg-9 third_col">
    <!-- head bar -->
    <center>
      <div class="container-fluid nav">
        <div class="brand">
          <i class="fas fa-clipboard-check"></i><span class="heading">STUDENT ATTENDANCE</span>
        </div>
      </div>
    </center>

    <!-- form -->
    <div class="container" id="edit_log_Student_Attendance_form">
      <?php  $s_id=$_GET['id'];?>

      <form  method="POST" accept-charset="utf-8" enctype="multipart/form-data">
       <?php
        include 'db.php';

        $sql= "SELECT * FROM student where Id='".$s_id."'";
        $row=mysqli_query($conn,$sql);
        while ($result = mysqli_fetch_array ($row)){?>

          <div class="formgroup container-fluid">
              <label class="col-2 col-form-label" for="id">Student ID</label>
               <input class=" form-control form-control-lg" type="text" name="id" value="<?php echo $id ?>" readonly/>
         </div>

         <div class="formgroup container-fluid">
             <label class="col-2 col-form-label" for="name">Student Name</label>
              <input class=" form-control form-control-lg" type="text" name="name" value="<?php echo $result["Name"] ?>" readonly/>
        </div>
        <?php $sql1="select * from class where Id='".$result['ClassID']."'";
        $row1=mysqli_fetch_assoc(mysqli_query($conn,$sql1)); ?>
        <div class="formgroup container-fluid">
            <label class="col-2 col-form-label" for="name">Student Class</label>
             <input class=" form-control form-control-lg" type="text" name="name" value="<?php echo $row1["Class"]." - ".$row1["Sec"] ?>" readonly/>
       </div>
     <?php
   }
   $sql= "SELECT * FROM student_attendance where attendance_id='".$_GET["attend_id"]."'";
   $row=mysqli_query($conn,$sql);
   while ($result = mysqli_fetch_array ($row)){
     $sql1="select Name from teacher where Id='".$result['teacher_id']."'";
     $row1=mysqli_fetch_assoc(mysqli_query($conn,$sql1));
      ?>
      <div class="formgroup container-fluid">
          <label class="col-2 col-form-label" for="name">Teacher Name</label>
           <input class=" form-control form-control-lg" type="text" name="name" value="<?php echo $row1["Name"] ?>" readonly/>
     </div>
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

 </div>
</div>
<script type="text/javascript">

$(document).ready(function(){
    $('#edit_log_Student_Attendance_form').on('submit', function(e){
        //Stop the form from submitting itself to the server.
        e.preventDefault();
        var id = <?php echo  $_GET['attend_id']?>;
        var status = $('#Status').val();

        $.ajax({
          type: "POST",
          url: 'teacher_submit.php',
          data: {func:'edit_log_Student_Attendance',attendance_id:id,status:status},
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
