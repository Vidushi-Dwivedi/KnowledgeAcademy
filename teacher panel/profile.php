<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include 'css_jslinks.php'; ?>
    <?php include 'db.php'; ?>
    <?php   if(!isset($_SESSION))
      {
       session_start();
     }
      $id=$_SESSION["id"]; ?>
    <link rel="stylesheet" href="css/head.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/profile_bar.css">
    <title>Teacher Profile</title>
  </head>
  <body>
    <!-- headbar -->
    <?php include 'headbar.php' ?>

    <!-- body -->
    <?php


   $sql="select * from teacher where Id='".$id."'";
   $result= mysqli_query($conn,$sql);
   $row=mysqli_fetch_array($result);
   $g=$row['gender'];
   $class_teacher="";
   if($row['ClassTeacher']=="")
   {
     $class_teacher="-";
   }
   else{$class_teacher=$row['ClassTeacher'];}
    ?>
    <div class="row body_row">
    <div class="col-lg-3 first_col">
    <center> <img src="<?php echo '../images/'.$row['Id'].'.jpg' ?>" class="profile_img" alt="">
    <div class="name_tag "><?php echo $row['Name']; ?></div>
    <div class="class_tag ">Class Teacher : <?php echo $class_teacher; ?></div>
    </center>
    <center>
    <div class="inner_profile_base text-center">
      <div class="head">
        <center>PROFILE</center>
      </div>
      <div class="body">
        <table>
          <tr>
            <td>Teacher ID :</td>
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
            <td>Gender :</td>
            <td><?php echo $row['gender']; ?></td>
          </tr>
          <tr>
            <td>Email :</td>
            <td><?php echo $row['email']; ?></td>
          </tr>
          <tr>
            <td>DOB :</td>
            <td><?php echo $row['DOB']; ?></td>
          </tr>
          <tr>
            <td>Joining :</td>
            <td><?php echo $row['joining']; ?></td>
          </tr>
          <tr>
            <td>Class Teacher :</td>
            <td><?php echo $row['ClassTeacher']; ?></td>
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
   <!-- middle_col -->
    <div class="col col-lg-6 middle_col">

     <div class="row ">
       <div class="col-md-6  one ">
         <!-- attendance chart div -->
         <div class="attendance_chart_container">
          <div class="header">Attendance</div>
           <div id="std_attendance_chart">
           </div>
         <div class="std_attendance_chart_details">
             <div class="d-flex justify-content-between">
               <div class="outer d-flex">
                 <div class="first"></div>
                 <div class="txt_info">Present</div>
               </div>
               <div class="outer d-flex">
                 <div class="second"></div>
                 <div class="txt_info">Absent</div>
               </div>
             </div>
             <div class="d-flex justify-content-between">
               <div class="outer d-flex">
                 <div class="third"></div>
                 <div class="txt_info">Late</div>
               </div>
               <div class="outer d-flex">
                 <div class="fourth"></div>
                 <div class="txt_info">Half Day</div>
               </div>
             </div>
         </div>
         </div>
       </div>
         <!-- event div -->
         <div class="col-md-6 one ">
           <div class="card-event">
             <div class="event_head">
             <div class="header">Events</div>
             <p class="subhead">Total Events</p>
             <?php
               $sql="select * from events";
               $result=mysqli_query($conn,$sql);
               $total=mysqli_num_rows($result);
              ?>
             <p id="total_events"><?php echo $total; ?></p>
             </div>
            <div class="events_table">
             <center>
             <table>
            <?php
              $sql=" select Title, start_date, end_date from events";
              $result=mysqli_query($conn,$sql);
              $i=1;
              while($row= mysqli_fetch_array($result)){
              ?>
              <tr>
                <td>
                  <div class="outer">
                    <div class="date<?php echo $i  ?> d-flex justify-content-between">
                      <div class="date<?php echo $i  ?>"> <?php echo $row['start_date'] ?></div>
                      <div class="date<?php echo $i  ?>"> <?php echo $row['end_date'] ?></div>
                    </div>
                    <div class="title">
                      <?php echo $row['Title'] ?>
                    </div>
                  </div>
                </td>
              </tr>
            <?php
             $i++;
             if($i==4){$i=1;}} ?>

             </table>
             </center>
           </div>
           </div>
         </div>



       </div>
       <div class="row second_chart">

            <div class="AttendanceTypeUsed">
              <center>
              <div class="head">
                <span>Attendance Balance</span>
              </div>
              <center>
              <div class="body" id="AttendanceTypeUsed">

              </div>
            </center>
              </center>
            </div>

         </div>
     </div>
    <div class="col-lg-3 third_col">
      <center>
        <div class="row1 text-center">
          <div class="head">
            <center>Students</center>
          </div>
          <div class="body form-group">
            <select class="form-control form-control-sm" id="sel1">
                <?php
                  $sql="select ClassId from teaches where TeacherId='".$id."'";
                  $res=mysqli_query($conn,$sql);
                  while($row2=mysqli_fetch_array($res)){
                    $sql="select * from class where Id='".$row2['ClassId']."'";
                    $res2=mysqli_query($conn,$sql);
                    $row5=mysqli_fetch_array($res2);
                 ?>
                <option value="<?php echo $row2['ClassId'] ?>"><?php echo $row5['Class']."-".$row5['Sec'] ?></option>
              <?php } ?>
           </select>
           <div class="teacher_display">
             <div class="row img_row" id="img_row">

           </div>
           </div>
          </div>
        </div>
      </center>
    </div>
    </div>
    <?php
      $sql="select * from teacher_attendance where status='present'";
      $result1=mysqli_num_rows(mysqli_query($conn,$sql));
      $sql="select * from teacher_attendance where status='absent'";
      $result2=mysqli_num_rows(mysqli_query($conn,$sql));
      $sql="select * from teacher_attendance where status='late'";
      $result3=mysqli_num_rows(mysqli_query($conn,$sql));
      $sql="select * from teacher_attendance where status='half_day'";
      $result4=mysqli_num_rows(mysqli_query($conn,$sql));
      $dataPoints = array(
       array("label"=>"Present", "symbol" => "P","y"=>$result1),
       array("label"=>"Absent", "symbol" => "Ab","y"=>$result2),
       array("label"=>"Late", "symbol" => "L","y"=>$result3),
       array("label"=>"Half Day", "symbol" => "HL","y"=>$result4),
     );

      $sql="select * from leave_count where TeacherId='".$id."'";
      $result5=mysqli_fetch_assoc(mysqli_query($conn,$sql));
        if($g=='Female'){
          $dataPoints1 = array(
          array("label"=>"Casual Leave","y" => $result5['CasualLeave']),
          array("label"=>"Medical Leave","y" => $result5['MedicalLeave']),
          array("label"=>"Child Care Leave","y" => $result5['ChildCareLeave']),
            array("label"=>"Maternity Leave","y" => $result5['MaternityLeave'])
            );
          }
          else{
            $dataPoints1 = array(
            array("label"=>"Casual Leave","y" => $result5['CasualLeave']),
            array("label"=>"Medical Leave","y" => $result5['MedicalLeave']),
            array("label"=>"Child Care Leave","y" => $result5['ChildCareLeave']),
              );
          }
     ?>
     <script>
       window.onload = function() {
     CanvasJS.addColorSet("Shades",
                    [//colorSet Array

                    "#24ff2b",
                    "#f90b23",
                    "yellow",
                    "#0702f7"
                    ]);
   var chart = new CanvasJS.Chart("std_attendance_chart", {
   colorSet: "Shades",
   animationEnabled: true,
   height:300,
   data: [{
     type: "doughnut",
     startAngle: 60,
     innerRadius: 60,
     indexLabelFontSize: 17,
     indexLabel: "{label}",
     toolTipContent: "{label}",
     dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>

   }]
   });
   chart.render();

   var chart = new CanvasJS.Chart("AttendanceTypeUsed", {
   colorSet: "Shades",
   animationEnabled: true,
   height:300,
   width:500,
   data: [{
     type: "doughnut",
     startAngle: 60,
     innerRadius: 60,
     indexLabelFontSize: 17,
     indexLabel: "{label} - #percent%",
     toolTipContent: "<b>{label}:</b> {y} (#percent%)",
     dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>

   }]
   });
   chart.render();
     }
     </script>
  <!-- chart script -->
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <script type="text/javascript">
      $('#sel1').change(function(e){
        e.preventDefault();
        $('#img_row').empty();
        var c_id= document.getElementById('sel1').value;
        $.ajax({
          type: "POST",
          url: 'teacher_submit.php',
          data: {func:'fetch_class_students',class_id:c_id},
          success: function(data){
          data=JSON.parse(data);
          for(x=0;x<data.length;x++){
          $('#img_row').append('<div class="col-4 cell"><img class="display_img" src="..\\images\\'+data[x]["Id"]+'.jpg" alt=""><div class="name_student">'+data[x]["Name"]+'</div></div>');
        }
      }
      });
      });
      $('#sel1').trigger('change');
    </script>
  </body>
</html>
