<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
    if(!isset($_SESSION))
    {
     session_start();
   }
    $id=$_SESSION["id"];

     ?>
    <?php include 'css_jslinks.php'; ?>
    <?php include 'db.php'; ?>
    <link rel="stylesheet" href="css/head.css">
    <link rel="stylesheet" href="css/profile_bar.css">
    <link rel="stylesheet" href="css/consultancy.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Syllabus show</title>

    <!-- Font Icon -->
    <!-- <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css"> -->
    <style media="screen">
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

  $sql="select * from student where Id='".$id."'";
  $result= mysqli_query($conn,$sql);
  $row=mysqli_fetch_array($result);
  $sql="select * from class where Id='".$row['ClassID']."'";
  $result= mysqli_query($conn,$sql);
  $row1=mysqli_fetch_array($result);
   ?>
   <div class="row body_row">
   <div class="col-lg-3 first_col">
   <center> <img src="<?php echo '../images/'.$row['Id'].'.jpg' ?>" class="profile_img" alt="">
   <div class="name_tag "><?php echo $row['Name']; ?></div>
   <div class="class_tag "><?php echo $row1['Class']; ?>-<?php  echo $row1['Sec'];?></div>
   </center>
   <center>
   <div class="inner_profile_base text-center">
     <div class="head">
       <center>PROFILE</center>
     </div>
     <div class="body">
       <table>
         <tr>
           <td>Academic Year :</td>
           <td><?php echo $row['year']; ?></td>
         </tr>
         <tr>
           <td>Student ID :</td>
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
           <td>Date Of Birth :</td>
           <td><?php echo $row['DOB']; ?></td>
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

   <div class="col-lg-9 middle_col">


    <div class = "">
        <div class ="col-12">
        <h1 class="text-center text-head text-white bg-dark"> Syllabus list </h1>
        <br>
        <div class="table-responsive container">
        <table class="table table-bordered table striped table-hover">
            <thread>
                <th> Class ID </th>

                <th> Syllabus </th>


</thread>
<tbody>
<?php
include 'result_query.php';
$con = mysqli_connect('localhost','root');

mysqli_select_db($con, 'kacademy');

$query = "select `ClassId`,`Syllabus` from `ClassInfo1`";
$queryd = mysqli_query($con,$query);
//$row = mysqli_num_rows($queryd);
while($result = mysqli_fetch_array($queryd) ){
    ?>
    <tr>
        <td> <?php echo $result['ClassId']; ?> </td>


        <td>
        <a href="Downloads.php?name=<?php echo $result['Syllabus'] ?> ">Download</a>
        </td>


</tr>
<?php
}

?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
