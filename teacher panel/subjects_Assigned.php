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
    <?php include 'css_jslinks.php';
    include 'db.php'; ?>
    <link rel="stylesheet" href="css/head.css">
    <link rel="stylesheet" href="css/profile_bar.css">
    <title>KnowledgeAcademy-SubjectsAssigned</title>
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
    .text-head{
      margin-top: 50px;
      background-color: #26335a !important;
      color: white;
    }
    .container{
      background-color: white;
      border-radius: 10px;
      margin-top:100px;
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
      <div class="container">
        <center>

        <table class="table table-striped table-hover" id="teaches">
        <thead>
          <th>Class</th>
          <th>Sec</th>
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


        </thead>

        </table>

      </center>
      </div>
    </div>
  </div>
<script type="text/javascript">
$(document).ready(function () {
  var t= <?php echo $row['Id'] ?>;
     var dataTable = $('#teaches').DataTable({
         "responsive": true,
         "processing": true,
         "serverSide": true,
         "ajax": {
             url: "teacher_submit.php", // json datasource
             data: {func: 'pagination', page:'teaches','teacher':t}, // Set the POST variable  array and adds action: getEMP
             type: 'post',  // method  , by default get
         },
         error: function () {  // error handling
           alert("Error occured");
         }
     });
   });
</script>
  </body>
</html>
