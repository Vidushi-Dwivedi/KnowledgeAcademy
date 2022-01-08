<?php

$t_Date=date("d/m/Y");
$con = mysqli_connect('localhost','root');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}
else{

  mysqli_select_db($con,"kacademy");
  $sql="SELECT Title,Date FROM notice  order by str_to_date( Date, '%d/%m/%Y') desc";

  $result = mysqli_query($con,$sql);


  $i=0;
  $data = array();



  while($i<3&&$row = mysqli_fetch_assoc($result)){
    $i=$i+1;
  array_push($data,$row);
  }
  mysqli_close($con);
  echo json_encode($data);

  }
  // where str_to_date( Date, '%d/%m/%Y')>'$t_Date'
 ?>
