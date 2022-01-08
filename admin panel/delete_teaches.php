<?php

include 'db.php';
   $c = $_GET['c'];
   $t = $_GET['t'];
$i=0;
$sql="delete from teaches where ClassId='".$c."' and TeacherId='".$t."'";
$result=mysqli_query($conn,$sql);
if($result==true){
  $i=1;
}
else{
  $i=2;
}
$url="show_assigned_subjects.php?i=".$i;
header('Location: '.$url);

 ?>
