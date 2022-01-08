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
    <title>KnowledgeAcademy-TeacherSubjects</title>
    <?php include 'css_jslinks.php'; ?>
    <?php include 'db.php'; ?>
    <link rel="stylesheet" href="css/head.css">
    <link rel="stylesheet" href="css/profile_bar.css">

    <style media="screen">
    .body_row{
      height:600px;
      }
    .first_col{
      background-color: #2d8074;
    }
    .body_col{
      background-color: #fde8cd;
      padding:5%;
    }
    </style>

  </head>
  <body>
    <!-- headbar -->
    <?php include 'headbar.php' ?>

    <!-- body -->
   <?php
   $sql="select * from class";
   $result=mysqli_query($conn,$sql);
   while($row=mysqli_fetch_assoc($result)){
       $sql1="select * from teaches where TeacherId='".$id."' and ClassId='".$row['Id']."'";
       $result1=mysqli_query($conn,$sql);
       while($row1=mysqli_fetch_assoc($result1)){
    ?>
       
  <?php }} ?>
  </body>
</html>
