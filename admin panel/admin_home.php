<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include 'css_jslinks.php' ?>
    <style media="screen">
    .inform_div{
      height: 80%;
      width: 90%;
      padding:5%;
      margin:5%;
      background-color: white;
      box-shadow:  5px 5px 10px #64635c,
                 -5px -5px 10px #ffffff;
    }
    .info{
      font-size: 150%;
      font-family: 'Source Sans Pro', sans-serif;
    }

    </style>
  </head>
  <body>
    <?php include 'db.php' ?>
    <?php include '../visitors.php'; ?>
    <?php include 'dashboard.php'; ?>
    <div class="content_area" id="content_area">
      <!-- information bar -->
      <div class="row">
        <div class="col-lg-3 col-md-6">
         <div class="inform_div d-flex justify-content-between align-items-center">
            <div class="icon1" style="color:#1b2679;">
              <i class="fas fa-user-graduate fa-4x"></i>
            </div>
            <?php
            $sql= "select count(*) as num from student";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($result)){
            ?>
            <center>
            <div class="info">
              <div>Total Student</div>
              <div class=""> <?php echo $row['num'];} ?></div>
            </div>
            </center>
         </div>
        </div>
        <div class="col-lg-3  col-md-6">
          <div class="inform_div d-flex justify-content-between align-items-center">
            <div class="icon1" style="color:#2d8b30;">
              <i class="fas fa-chalkboard-teacher fa-4x" ></i>
            </div>
            <?php
            $sql= "select count(*) as num from teacher";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($result)){
            ?>
            <center>
            <div class="info">
              <div>Total Teacher</div>
              <div class=""> <?php echo $row['num'];} ?></div>
            </div>
          </center>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="inform_div d-flex justify-content-between align-items-center">
            <div class="icon1" style="color:#bf0d0d;">
              <i class="fas fa-book-reader fa-4x"></i>
            </div>
            <?php
            $sql= "select count(*) as num from class";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($result)){
            ?>
            <center>
            <div class="info">
              <div>Total Classes</div>
              <div class=""> <?php echo $row['num'];} ?></div>
            </div>
          </center>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="inform_div d-flex justify-content-between align-items-center">
            <div class="icon1" style="color:#bf870d;">
              <i class="fas fa-users-cog fa-4x"></i>
            </div>
            <?php
            $sql= "select count(*) as num from student";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($result)){
            ?>
            <center>
            <div class="info">
              <div>Total Admins</div>
              <div class=""> <?php echo $row['num'];} ?></div>
            </div>
          </center>
          </div>
        </div>
      </div>

      <!-- section-2 visitors -->
      <?php

      // To Get Total Online Visitors
      $total_online_visitors=total_online();
      // To Get Total Visitors
      $total_visitors = mysqli_query($conn,"SELECT * FROM total_visitors");
      $total_visitors = mysqli_num_rows($total_visitors);
      ?>
      <?php

      $dataPoints1 = array(
        array("label" => "Website Visitors",  "y" => $total_visitors ),
      );
      $dataPoints2 = array(
        array("label" => "",  "y" => $total_online_visitors ),
      );

      ?>
      <script>
      window.onload = function() {

      var chart = new CanvasJS.Chart("visitorContainer", {
        animationEnabled: true,
        animationDuration: 2000,
        dataPointWidth: 20,
        toolTip: {
          shared: true
        },
        axisX:{
          interval:0
        },
        axisY: {
          interval:100
        },
        colorSet:  "ColorSet2",
        height:50,
        data: [{
          type: "stackedBar100",
          name: "Total Visitors",
          yValueFormatString: "#",
          dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
        },{
          type: "stackedBar100",
          yValueFormatString: "#",
          name: "Online Visitors",
          dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart.render();

      }
      </script>

      <!-- section 2 row -->
      <div class="row">
        <div class="col-md-6">
          <!-- visitor div -->
          <div id="visitorContainer" >

          </div>
          <div class="col-md-6">

          </div>
        </div>
      </div>



      <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>



    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  </body>
</html>
