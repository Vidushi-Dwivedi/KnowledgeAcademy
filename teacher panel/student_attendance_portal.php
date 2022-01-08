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
    <title>KnowledgeAcademy-StudentAttendance</title>
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
       overflow-x: auto !important;
       overflow-y: auto !important;
       height:auto !important;
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


      <!-- <div class="form1 d-flex justify-content-end">
          <form class="col-lg-4 d-flex" action="search_student_attendance.php" method="post">
            <input class="form-control me-2 notice_text" type="text" name="Student_attendance_Search_ID" placeholder="Enter Student ID" aria-label="Search">
            <button class="btn btn-outline-success add_attendance" type="submit" id="btn_search" name="submit" value="attendance_search_id" >Search</button>
          </form>
          <form class="col-lg-4 d-flex" action="search_student_attendance.php" method="post">
            <input class="form-control me-2 notice_text" type="text" name="Student_attendance_Search_Class" placeholder="Enter Class" aria-label="Search">
            <button class="btn btn-outline-success add_attendance" type="submit" id="btn_search" name="submit" value="attendance_search_class">Search</button>
          </form>
          <form class="col-lg-4 d-flex" action="search_attendance_student.php" method="post">
            <input class="form-control me-2 notice_text" type="date" name="Student_attendance_Search_Date" placeholder="Enter Date" aria-label="Search">
            <button class="btn btn-outline-success add_attendance" type="submit" id="btn_search" name="submit" value="attendance_search_date">Search</button>
          </form>
      </div> -->



<!-- table attendance -->
<center>
<div class="container" style="overflow:scroll; height:800px;">

  <table class="table table-striped table-hover" id="student_attendance">
<thead>
    <th>Attendance ID</th>
    <th>Student ID</th>
    <th>Class ID</th>
    <th>Teacher ID</th>
    <th>Status</th>
    <th>Attendance Date</th>
    <th>Edit</th>
    <th>Delete</th>
</thead>

</table>

</div>

</center>
</div>
</div>
</div>

<script type="text/javascript">

$(document).ready(function () {
     var dataTable = $('#student_attendance').DataTable({
         "responsive": true,
         "processing": true,
         "serverSide": true,
         "ajax": {
             url: "teacher_submit.php", // json datasource
             data: {func: 'pagination', page:'student_attendance'}, // Set the POST variable  array and adds action: getEMP
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
</html>
