<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

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
    <title>Scheme show</title>


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
    <div class = "container">
        <div class ="col-12">
        <h1 class="text-center text-head text-white bg-dark"> Scheme list </h1>
        <br>
        <div class="table-responsive">
        <table class="table table-bordered table striped table-hover">
            <thread>
                <th> Class ID </th>

                <th> Scheme </th>


</thread>
<tbody>
<?php
include 'result_query.php';
include 'db1.php';
$query = "select `ClassId`,`Scheme` from `ClassInfo1`";
$queryd = mysqli_query($con,$query);
//$row = mysqli_num_rows($queryd);
while($result = mysqli_fetch_array($queryd) ){
    ?>
    <tr>
        <td> <?php echo $result['ClassId']; ?> </td>
        <td>
        <a href="Downloads.php?name=<?php echo $result['Scheme'] ?> ">Download</a>

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
