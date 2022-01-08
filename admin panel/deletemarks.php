<?php
  include 'db.php';
  if(isset($_POST['id'])){
     $id = mysqli_real_escape_string($conn,$_POST['id']);
     $sid = mysqli_real_escape_string($conn,$_POST['sid']);
     $eid = mysqli_real_escape_string($conn,$_POST['eid']);
     $year = mysqli_real_escape_string($conn,$_POST['year']);
  }
  $sql="delete from marks1 where ClassID='".$id."' && StudentID='".$sid."' && examid='".$eid."' && Year='".$year."'";
  $result=mysqli_query($conn,$sql);
  if($result==true){
    echo 1;
  }
  else{
    echo 0;
  }

  ?>