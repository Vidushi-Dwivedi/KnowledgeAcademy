<?php
include 'db.php';
$id=$_GET['id'];
$sql="delete from student_attendance where attendance_id='".$id."'";
$i=0;
if(mysqli_query($conn,$sql)){
  $i=1;
}
else{
  $i=2;
}
$url="student_attendance_portal.php?i=".$i;
header('Location: '.$url);

 ?>
