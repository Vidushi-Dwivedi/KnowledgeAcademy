<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Leave Balance</title>


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
    <div class ="col-12">
    <h1 class="text-center text-head text-white bg-dark"> <i class="fas fa-clipboard-check"></i><span class="heading">Leave Balance</span></h1>
    <br>
    <div class="table-responsive">
    <table class="table table-bordered table striped table-hover">
      <thead>
        <tr class="table-info">
          <th>Type</th>
          <th>Total</th>
          <th>Left</th>
          <th>Used</th>
        </tr>
      </thead>
      <tbody>
        <?php
           $sql="select * from leave_count where TeacherId='".$id."'";
           $row=mysqli_fetch_assoc(mysqli_query($conn,$sql));
         ?>
         <tr>
           <td>CasualLeave</td>
           <td>14</td>
           <td><?php echo $row['CasualLeave'] ?></td>
           <td><?php echo  14-$row['CasualLeave'] ?></td>
         </tr>
         <tr>
           <td>MedicalLeave</td>
           <td>365</td>
           <td><?php echo $row['MedicalLeave'] ?></td>
           <td><?php echo  365-$row['MedicalLeave'] ?></td>
         </tr>
         <tr>
           <td>ChildCareLeave</td>
           <td>730</td>
           <td><?php echo $row['ChildCareLeave'] ?></td>
           <td><?php echo  730-$row['ChildCareLeave'] ?></td>
         </tr>
         <?php
           $sql= "select gender from teacher where Id='".$id."'";
           $row1=mysqli_fetch_assoc(mysqli_query($conn,$sql));
           if($row1['gender']=="Female"){
          ?>
         <tr>
           <td>MaternityLeave</td>
           <td>180</td>
           <td><?php echo $row['MaternityLeave'] ?></td>
           <td><?php echo  180-$row['MaternityLeave'] ?></td>
         </tr>
       <?php } ?>
      </tbody>
    </table>
  </div>
</div>
  </body>
</html>
