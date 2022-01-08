<?php
if(!isset($_SESSION))
{
 session_start();
 }
 $t= time();
 $sql="update teacher set last_session= FROM_UNIXTIME('".$t."') where Id='".$id."'";
 $result= mysqli_query($conn,$sql);
 session_unset();
session_destroy();

// header("location:home.php");
header('location:../login.php');

 ?>
