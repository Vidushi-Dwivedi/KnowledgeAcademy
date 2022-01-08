<?php
  include 'db.php';
  if(isset($_GET['id'])){
     $id = mysqli_real_escape_string($conn,$_GET['id']);
  }
  $i=0;
  $sql="delete from Admin where Id='".$id."'";
  $result=mysqli_query($conn,$sql);
  if($result==true){
    $file_to_delete = "../images/".$id.".jpg";
    unlink($file_to_delete);
    $i=1;
  }
  else{
    $i=2;
  }
  $url="showadmin.php?i=".$i;
  header('Location: '.$url);
  ?>
