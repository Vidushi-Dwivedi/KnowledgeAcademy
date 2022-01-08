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
    <title>Student Profile</title>
  </head>
  <body>
    <!-- headbar -->
    <?php include 'headbar.php' ?>

    <!-- body -->
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
         <?php
           $sql="select * from student_attendance where status='present'";
           $result1=mysqli_num_rows(mysqli_query($conn,$sql));
           $sql="select * from student_attendance where status='absent'";
           $result2=mysqli_num_rows(mysqli_query($conn,$sql));
           $sql="select * from student_attendance where status='late'";
           $result3=mysqli_num_rows(mysqli_query($conn,$sql));
           $sql="select * from student_attendance where status='half_day'";
           $result4=mysqli_num_rows(mysqli_query($conn,$sql));
           $dataPoints = array(
            array("label"=>"Present", "symbol" => "P","y"=>$result1),
            array("label"=>"Absent", "symbol" => "Ab","y"=>$result2),
            array("label"=>"Late", "symbol" => "L","y"=>$result3),
            array("label"=>"Half Day", "symbol" => "HL","y"=>$result4),
          );

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
          indexLabel: "{label} - #percent%",
          toolTipContent: "<b>{label}:</b> {y} (#percent%)",
          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>

        }]
        });
        chart.render();
          }
          </script>


       </div>
       <div class="row">

       </div>
     </div>
    <div class="col-lg-3 third_col">
      <center>
        <div class="row1 text-center">
          <div class="head">
            <center>TEACHERS</center>
          </div>
          <div class="body form-group">
            <select class="form-control form-control-sm" id="teacher_select">
              <option value="none">Select</option>
                <option value="classteacher">Class Teacher</option>
                <option value="teacher">All Teachers</option>
           </select>
           <div class="teacher_display">
             <div class="row img_row" id="img_row">


           </div>
           </div>
          </div>
        </div>
        <div class="row1 text-center">
          <div class="head">
            <center>MY CLASSMATES</center>
          </div>
          <div class="body">
           <div class="student_display">
             <div class="row img_row">
            <?php
              $sql="select * from Student ";
              $result=mysqli_query($conn,$sql);
              $i=mysqli_num_rows($result);
             while($row2=mysqli_fetch_array($result)){
             ?>
             <div class="col-4 cell">
               <img class="display_img" src="<?php echo '../images/'.$row2['Id'].'.jpg' ?>" alt="">
               <div class="name_student"><?php echo $row2['Name']; ?>
               </div>
             </div>
           <?php } ?>
            </div>
           </div>
          </div>
        </div>
      </center>
    </div>
    </div>
<script type="text/javascript">
  $('#teacher_select').change(function(){
    $('#img_row').empty();
    var role= document.getElementById('teacher_select').value;
    if(role=='classteacher'){
      <?php
        $s="select * FROM teacher where ClassTeacher = (select ClassID from student where id='".$id."')";
        $r1=mysqli_fetch_assoc(mysqli_query($conn,$s));
       ?>
        var add="<?php echo '../images/'.$r1['Id'].'.jpg' ?>";
        var name="<?php echo $r1['Name']; ?>";

       $('#img_row').append("<div class='col-4'><img class='display_img' src='"+add+"' alt=''><div class='name_teacher'>"+name+"</div></div>");

    }
    else if(role=='teacher'){
      var id=<?php echo $id ?>;
      $.ajax({
        type: "POST",
        url: 'student_submit.php',
        data: {func:'teacher',student_id:id},
        success: function(data){
          data=JSON.parse(data);
          // console.log(data);
          for(x=0;x<data.length;x++){
          add="../images/"+data[x]['Id']+".jpg";
          name=data[x]['Name'];
            $('#img_row').append("<div class='col-4'><img class='display_img' src='"+add+"' alt=''><div class='name_teacher'>"+name+"</div></div>");
        }
}


    });
  }

  });
</script>
<!-- chart script -->
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  </body>
</html>
