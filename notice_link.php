<?php
$con = mysqli_connect('localhost','root');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}
else{

  mysqli_select_db($con,"kacademy");
    $sql = "SELECT * FROM notice order by str_to_date( Date, '%d/%m/%Y') desc LIMIT 3";
    $result = mysqli_query($con,$sql);
$data=array();
while($row1=mysqli_fetch_assoc($result))
{
    $name=$row1['Title'];
    array_push($data,$name);
  }
    echo json_encode($data) ;


}
?>
