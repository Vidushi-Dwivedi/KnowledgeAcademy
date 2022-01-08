<?php
session_start();
$con = mysqli_connect('localhost','root');
mysqli_select_db($con, 'kacademy');
$role = $_POST['role'];
$user = $_POST['user'];
$pass = $_POST['password'];

if($role=="Admin")
{
   $q = " select * from admin where Name = '".$user."' && Password = '".$pass."' ";
$result = mysqli_query($con,$q);

$row  = mysqli_fetch_array($result);
if(is_array($row)) {
  $_SESSION["id"] = $row['Id'];
  $_SESSION["name"] = $row['Name'];
  echo 1;
}
else{
   echo 0;
}
}
else if($role=="Student") {
$q = " select * from student where Name = '".$user."' && Password = '".$pass."' ";
$result = mysqli_query($con,$q);
$row  = mysqli_fetch_array($result);
if(is_array($row)){
  $_SESSION["id"] = $row['Id'];
  $_SESSION["name"] = $row['Name'];
  echo 2;
}
else{
   echo 0;
}
}
else if($role=="Teacher") {
$q = " select * from teacher where Name = '".$user."' && Password = '".$pass."' ";
$result = mysqli_query($con,$q);
$row  = mysqli_fetch_array($result);
if(is_array($row)){
  $_SESSION["id"] = $row['Id'];
  $_SESSION["name"] = $row['Name'];
  echo 3;
}
else{
   echo 0;
}
}

?>
