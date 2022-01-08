<?php
  include 'db.php';
  if(isset($_POST['id'])){
     $id = mysqli_real_escape_string($conn,$_POST['id']);
    
  }
  $sql="delete from exam1 where Id='".$id."'";
  $result=mysqli_query($conn,$sql);
  if($result==true){
    echo 1;
  }
  else{
    echo 0;
  }

  ?>