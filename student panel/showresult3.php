<?php
$connect = mysqli_connect("localhost", "root", "", "kacademy");
$tab_query = "select * from Exam1";
$tab_result = mysqli_query($connect, $tab_query);
$tab_menu = '';
$tab_content = '';
$i = 0;
while($row = mysqli_fetch_array($tab_result))
{
 if($i == 0)
 {
  $tab_menu .= '
   <li class="active"><a href="#'.$row["Id"].'" data-toggle="tab">'.$row["Name"].'</a></li>
  ';
  $tab_content .= '
   <div id="'.$row["Id"].'" class="tab-pane fade in active">
  ';
 }
 else
 {
  $tab_menu .= '
   <li><a href="#'.$row["Id"].'" data-toggle="tab">'.$row["Name"].'</a></li>
  ';
  $tab_content .= '
   <div id="'.$row["Id"].'" class="tab-pane fade">
  ';
 }

if(!isset($_SESSION)){
  session_start();
}
$id=$_SESSION['id'];
$query1 = "select `ClassID` from `Student` where `Id`='".$id."'";
$queryd1 = mysqli_query($connect,$query1);
$queryd2=mysqli_fetch_array($queryd1);
 $product_query = "SELECT * FROM Marks1 WHERE examid = '".$row["Id"]."' && ClassID = '".$queryd2["ClassID"]."' && StudentID = '".$id."'";
 $product_result = mysqli_query($connect, $product_query);
 $exam = "select `max_marks`as mm from `exam1` where `Id`='".$row["Id"]."'";
 $exam1 = mysqli_query($connect, $exam);
 $exam2=mysqli_fetch_array($exam1);
 $rank = "SELECT * FROM Marks1 WHERE examid = '".$row["Id"]."' && ClassID = '".$queryd2["ClassID"]."' ";
 $rank1 = mysqli_query($connect, $rank);
 $max1 = $exam2['mm'];
 $max = $max1 * 10;
 $z = array();
 $y = array();
 while($mark = mysqli_fetch_array($rank1))
 {
   $total=0;
  $eg1 = $mark['EngLang'];
  $el1 = $mark['EngLit'];
  $hg1 = $mark['HindiLang'];
  $hl1 = $mark['HindiLit'];
  $m1= $mark['Maths'];
  $sci1 = $mark['Science'];
  $ss1 = $mark['SocialScience'];
  $c1 = $mark['Computer'];
  $gk1 = $mark['GeneralKnowledge'];
  $si = $mark['StudentID'];
  $a1 = $mark['Art'];
   $total= $eg1 + $el1 + $hg1 + $hl1 + $m1 + $sci1 + $ss1 + $c1 + $gk1 + $a1 ;
   $y=array($si,$total);
   // print_r($y);
   array_push($z,$y);
 }

 $keys = array_column($z, 1);
array_multisort($keys, SORT_DESC, $z);

 // print_r($z);

 // print_r(sort($z));
 // $k=json_encode($z);
 // print_r($k);
 // print($z);
 // echo "<script>var k=JSON.parse($k)</script>";

 while($sub_row = mysqli_fetch_array($product_result))
 {
  $eg = $sub_row['EngLang'];
  $el = $sub_row['EngLit'];
  $hg = $sub_row['HindiLang'];
  $hl = $sub_row['HindiLit'];
  $m = $sub_row['Maths'];
  $sci = $sub_row['Science'];
  $ss = $sub_row['SocialScience'];
  $c = $sub_row['Computer'];
  $gk = $sub_row['GeneralKnowledge'];
  $a = $sub_row['Art'];
  $t = $eg + $el + $hg + $hl + $m + $sci + $ss + $c + $gk + $a ;
  $per = ($t/$max)*100;
  $na = 100 - $per;
  $tab_content .= '
  <div class="table-responsive">
  <table class="table table-bordered table striped table-hover">
      <tr>
          <th> Class ID </th>
          <th> Student ID </th>
          <th> Exam ID </th>
          <th> Year </th>
          <th> English Language </th>
          <th> English Literature </th>
          <th> Hindi Language </th>
          <th> Hindi Literature </th>
          <th> Maths </th>
          <th> Science </th>
          <th> Social Science </th>
          <th> Computer </th>
          <th> General Knowledge </th>
          <th> Art </th>
        </tr>
        <tr>
        <td> '.$sub_row['ClassID'].' </td>
        <td> '.$sub_row['StudentID'].' </td>
        <td> '.$sub_row['examid'].' </td>
        <td> '.$sub_row['Year'].' </td>
        <td> '.$sub_row['EngLang'].' </td>
        <td> '.$sub_row['EngLit'].' </td>
        <td> '.$sub_row['HindiLang'].' </td>

        <td> '.$sub_row['HindiLit'].' </td>
        <td> '.$sub_row['Maths'].' </td>
        <td> '.$sub_row['Science'].' </td>
        <td> '.$sub_row['SocialScience'].' </td>
        <td> '.$sub_row['Computer'].' </td>
        <td> '.$sub_row['GeneralKnowledge'].' </td>
        <td> '.$sub_row['Art'].' </td>
        </tr>


</table>
</div>
<canvas id="myChart" style="width:100%;max-width:700px"></canvas>
<canvas id="myChart1" style="width:100%;max-width:700px"></canvas>

<script>
var xValues = ["EngLang", "EngLit", "HindiLang", "HindiLit", "Maths", "Science", "SocialScience", "Computer", "GeneralKnowledge","Art"];
var yValues = ['.$sub_row['EngLang'].','.$sub_row['EngLit'].','.$sub_row['HindiLang'].','.$sub_row['HindiLit'].','.$sub_row['Maths'].','.$sub_row['Science'].','.$sub_row['SocialScience'].','.$sub_row['Computer'].','.$sub_row['GeneralKnowledge'].','.$sub_row['Art'].'];
var barColors = ["red", "green","blue","orange","brown","purple","pink","yellow","lavendar","grey"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    max: 100,
    legend: {display: false},
    title: {
      display: true,
      text: "Marks"
    }
  }
});

var xValues1 = ["Percentage","Not Achieved"];
var yValues1 = ['.$per.','.$na.'];
var barColors1 = [
  "#b91d47",
  "#00aba9"
];

new Chart("myChart1", {
  type: "pie",
  data: {
    labels: xValues1,
    datasets: [{
      backgroundColor: barColors,
      data: yValues1
    }]
  },
  options: {
    title: {
      display: true,
      text: "Percentage"
    }
  }
});
</script>
  ';
 }
 if(count($z)!=0){
 $tab_content .='  <table class="table table-bordered table striped table-hover">
 <thead>
 <tr>
    <th>Rank</th>
    <th>Name</th>
    <th>Marks</th>
    </tr>
 </thead>
 <tbody>

       ';
 for($i=0;$i<count($z);$i++){
   $n=$i+1;
   $tab_content .='
    <tr>
     <td>'.$n.'</td>
     <td>'.$z[$i][0].'</td>
     <td>'.$z[$i][1].'</td>
    </tr>
   ';
 }
 $tab_content .='</tbody></table>';
}
 $tab_content .= '<div style="clear:both"></div></div>';
 $i++;
}

$tab_content .='';
?>

<!DOCTYPE html>
<html>
 <head>
 <?php include 'css_jslinks.php'; ?>
 <?php include 'db.php'; ?>
 <link rel="stylesheet" href="css/head.css">
 <link rel="stylesheet" href="css/profile_bar.css">
 <link rel="stylesheet" href="css/consultancy.css">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style media="screen">
  .text-head{
    margin-top: 50px;
    background-color: #26335a !important;
    color: white;
  }
  .container{
    background-color: white;
    border-radius: 10px;
    width:90%;
    overflow-x:scroll;
  }
  .navbar{
    display: block;
    margin-bottom:0;
  }
  </style>
 </head>
 <body>
 <?php include 'headbar.php' ?>
 <?php

 $sql="select * from student where Id='".$id."'";
 $result= mysqli_query($conn,$sql);
 $row=mysqli_fetch_array($result);
 $sql="select * from class where Id='".$row['ClassID']."'";
 $result= mysqli_query($conn,$sql);
 $row1=mysqli_fetch_array($result);
  ?>
  <div class="row body_row">
  <div class="col-lg-3 first_col">
  <center> <img src="<?php echo '../images/'.$row['Id'].'.jpg' ?>" class="profile_img" alt="">
  <div class="name_tag "><?php echo $row['Name']; ?></div>
  <div class="class_tag "><?php echo $row1['Class']; ?>-<?php  echo $row1['Sec'];?></div>
  </center>
  <center>
  <div class="inner_profile_base text-center">
    <div class="head">
      <center>PROFILE</center>
    </div>
    <div class="body">
      <table>
        <tr>
          <td>Academic Year :</td>
          <td><?php echo $row['year']; ?></td>
        </tr>
        <tr>
          <td>Student ID :</td>
          <td><?php echo $row['Id']; ?></td>
        </tr>
        <tr>
          <td>Father's Name :</td>
          <td><?php echo $row['Fname']; ?></td>
        </tr>
        <tr>
          <td>Mother's Name :</td>
          <td><?php echo $row['Mname']; ?></td>
        </tr>
        <tr>
          <td>Contact No :</td>
          <td><?php echo $row['Phone']; ?></td>
        </tr>
        <tr>
          <td>Address :</td>
          <td><?php echo $row['Address']; ?></td>
        </tr>
        <tr>
          <td>Date Of Birth :</td>
          <td><?php echo $row['DOB']; ?></td>
        </tr>
        <tr>
          <td>Password :</td>
          <td><?php echo $row['Password']; ?></td>
        </tr>
      </table>
  </div>
  </div>
  </center>
  </div>

  <div class="col-lg-9 middle_col">


  <div class="text-head">
     <h2 align="center">Result</a></h2>
  </div>
   <div class="container">
   <br />
   <ul class="nav nav-tabs">
   <?php
   echo $tab_menu;
   ?>
   </ul>
   <div class="tab-content">
   <br />
   <?php
   echo $tab_content;
   ?>
   </div>
  </div>
  </div>
 </div>
 </body>
</html>
