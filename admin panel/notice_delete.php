<?php
  include 'db.php';
  if(isset($_GET['id'])){
     $id = mysqli_real_escape_string($conn,$_GET['id']);
     $name = mysqli_real_escape_string($conn,$_GET['name']);
  }
$i=0;
  $sql="delete from notice where Id='".$id."'";
  $result=mysqli_query($conn,$sql);
  if($result==true){
    $file_to_delete = "../uploads/".$name;
    unlink($file_to_delete);
    $i=1;
  }
  else{
    $i=2;
  }
  $url="notice portal.php?i=".$i;
  header('Location: '.$url);
  ?>
