<?php
  include 'db.php';
  if(isset($_POST['id'])){
     $id = mysqli_real_escape_string($conn,$_POST['id']);
  }
  $sql="delete from ClassInfo1 where ClassId='".$id."'";
  $result=mysqli_query($conn,$sql);
  if($result==true){
    $file_to_delete = "../uploads/timetable".$id.".pdf";
    $file_to_delete1 = "../uploads/syllabus".$id.".pdf";
    $file_to_delete2 = "../uploads/scheme".$id.".pdf";
    unlink($file_to_delete);
    unlink($file_to_delete1);
    unlink($file_to_delete2);
    echo 1;
  }
  else{
    echo 0;
  }

  ?>
