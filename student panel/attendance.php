<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php
    if(!isset($_SESSION))
    {
     session_start();
   }
    $id=$_SESSION["id"];

     ?>
     <script type="text/javascript">
       var i= <?php echo date('m') ?>;
       const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];
const weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];


     </script>
    <title>KnowledgeAcademy-StudentAttendanceView</title>
    <?php include 'css_jslinks.php'; ?>
    <?php include 'db.php'; ?>
    <link rel="stylesheet" href="css/head.css">
    <link rel="stylesheet" href="css/profile_bar.css">

    <style media="screen">
    .body_row{
      height:600px;
      }
    .first_col{
      background-color: #2d8074;
    }
    .body_col{
      background-color: #fde8cd;
      padding:5%;
    }

    /* attendance chart */
    .attendance_chart_container{
      background-color: white;
      padding:5% 2% 5% 2% ;
      border: 3px solid #1c2645;
    }
    .attendance_chart_container .header{
      margin-left: 5%;
    }

    .std_attendance_chart_details{
    margin-top: 310px;
    margin-left: 10%;
    font-weight: 600;
    color:#7a7a7a;
    }
    .std_attendance_chart_details .outer{
      width:50%;
    }
    .std_attendance_chart_details .txt_info{
      padding-right: 0 !important;
      margin-left: 8%;
      font-size: large;

    }
    .std_attendance_chart_details .first, .std_attendance_chart_details .second,.std_attendance_chart_details .third, .std_attendance_chart_details .fourth{
      width:20px;
      height:20px;
      border: 2px solid white;
      border-radius: 50%;
    box-shadow:  1px 1px 4px #666666,
                 -1px -1px 4px #ffffff;
    }
    .std_attendance_chart_details .first{
        background-color: green;
    }
    .std_attendance_chart_details .second{
      background-color: red !important;
    }
    .std_attendance_chart_details .third{
        background-color: yellow;
    }
    .std_attendance_chart_details .fourth{
        background-color: blue;
    }
    .header{
      font-size: x-large;
      font-weight: bold;
      font-family: 'Titillium Web', sans-serif;
      color:#1c2645;
    }
    /* button row */
     .button{
       display: flex;
       justify-content: space-between;
       margin-top: 10px;
     }
     #prev,#next{
         font-family: 'Titillium Web', sans-serif;
         font-weight: 600 ;
         font-size: large;
         text-decoration: underline;
     }
    /* table row */
    .table_row{
          display: inline;
    }
    #attendance_table{
      background-color: white;
      display: flex;
      justify-content: center;
      margin-bottom: 0;
      padding-bottom: 0;
    }
   .attendance_table_month{
     align-self: center;
   }
   .attendance_table_month th,td{
     border: 3px solid #1c2645;
   }
    </style>
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

    <div class="col-lg-9 body_col">
      <div class="row">
      <div class="col-md-6 attendance_chart_container">
       <div class="header">Yearly Attendance</div>
      <div id="yearly_attendance">

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
    <div class="col-md-6 attendance_chart_container">
      <div class="header">Monthly Attendance : <span id="month_attendance"></span> </div>
      <div id="current_month_attendance">

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
      <?php
        $sql="select * from student_attendance where status='present' and student_id='".$id."'";
        $result1=mysqli_num_rows(mysqli_query($conn,$sql));
        $sql="select * from student_attendance where status='absent' and student_id='".$id."'";
        $result2=mysqli_num_rows(mysqli_query($conn,$sql));
        $sql="select * from student_attendance where status='late' and student_id='".$id."'";
        $result3=mysqli_num_rows(mysqli_query($conn,$sql));
        $sql="select * from student_attendance where status='half_day' and student_id='".$id."'";
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
     var chart = new CanvasJS.Chart("yearly_attendance", {
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

    <div class="row button">
      <a id="prev">Previous Month</a>
      <a id="next">Next Month</a>
    </div>
      <center>
    <div class="row table_row">

         <div id="attendance_table">

         </div>

    </div>
    </center>
    </div>
  </div>

  <!-- chart script -->
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <script type="text/javascript">

$(document).ready(function(){
       call_for_chart();
       call_for_table();
     });
        $("#prev").click(function(e){
            //Stop the form from submitting itself to the server.
            e.preventDefault();
            i=i-1;
            call_for_chart();
            call_for_table();
        });

    $("#next").click(function(e){
        //Stop the form from submitting itself to the server.
        e.preventDefault();
        i=i+1;
        call_for_chart();
        call_for_table();
      });



             function call_for_chart(){
               var id= <?php echo $id ?>;
               $.ajax({
                 type: "POST",
                 url: 'student_submit.php',
                 data: {func:'monthly_attendance_chart',student_id:id,i:i},
                 success: function(datapoints1){
                      // datapoints1=json.parse(data);
                     datapoints1=JSON.parse(datapoints1);
                      // monthly attendance chart
                          CanvasJS.addColorSet("Shades",
                                         [//colorSet Array

                                         "#24ff2b",
                                         "#f90b23",
                                         "yellow",
                                         "#0702f7"
                                         ]);
                        var chart = new CanvasJS.Chart("current_month_attendance", {
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
                          dataPoints: datapoints1
                        }]
                        });
                        chart.render();
                 }
               })

               document.getElementById("month_attendance").textContent=monthNames[i-1];
             }

      function call_for_table(){
        var id= <?php echo $id ?>;
        $.ajax({
          type: "POST",
          url: 'student_submit.php',
          data: {func:'monthly_attendance_table',student_id:id,i:i},
          success: function(dataresult){
            data=JSON.parse(dataresult);
            if(data.length>0){
            var col = ["S No", "Date", "Day","Status"];
            // CREATE DYNAMIC TABLE.
            var table = document.createElement("table");
            table.setAttribute("class","table table-striped table-hover attendance_table_month");
            var tr = table.insertRow(0);                   // TABLE ROW.

            for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
            }

            // ADD JSON DATA TO THE TABLE AS ROWS.
            for (var i = 0; i < data.length; i++) {
              tr = table.insertRow(i+1);

              for (var j = 0; j < col.length; j++) {
                  var tabCell = tr.insertCell(j);
                  if(j==0){
                      tabCell.innerHTML = i+1;
                  }
                  if(j==1){
                    tabCell.innerHTML = data[i]["attendance_date"];
                  }
                  if(j==2){
                    var d= new Date(data[i]['attendance_date']);
                    tabCell.innerHTML = weekday[d.getDay()];
                  }
                  if(j==3){
                    tabCell.innerHTML = data[i]['status'];
                  }
              }
            }

            // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
             var divContainer = document.getElementById("attendance_table");
             divContainer.innerHTML = "";
             divContainer.appendChild(table);
          }
          else{
            var divContainer = document.getElementById("attendance_table");
            divContainer.innerHTML = "<i>No attendance has been logged for the month.</i>";
          }
        }
      });
    }
    </script>
  </body>
</html>
