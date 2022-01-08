<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-AdminDashboard</title>
    <!-- <title>Responsive Sidebar Menu</title> -->
    <link rel="stylesheet" href="css/dashboard.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'css_jslinks.php' ?>
    <?php include('db.php'); ?>
    <?php include('../visitors.php'); ?>

  </head>
  <body>
    <!-- sidebar -->
    <input type="checkbox" id="check">
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
      <header>Admin Panel</header>
      <a href="#" class="active">
        <i class="fas fa-qrcode"></i>
        <span>Dashboard</span>
      </a>
      <a href="student_paging.php?i=0">
        <i class="fas fa-user-graduate"></i>
        <span>Students</span>
      </a>
      <a href="promotion.php">
        <i class="fas fa-check-double"></i>
        <span>Promotion</span>
      </a>
      <a href="alumini.php">
        <i class="fas fa-graduation-cap"></i>
        <span>Alumni</span>
      </a>
      <a href="student_dropout.php">
        <i class="fas fa-sign-out-alt"></i>
        <span>Student Dropout</span>
      </a>
      <a href="StaffDropout.php">
        <i class="fas fa-sign-out-alt"></i>
        <span>Staff Dropout</span>
      </a>
      <a href="showteacher1.php?i=0">
        <i class="fas fa-chalkboard-teacher"></i>
        <span>Teachers</span>
      </a>
      <a href="showclass.php">
        <i class="fas fa-chalkboard"></i>
        <span>Classes</span>
      </a>
      <a href="showclassinfo.php">
        <i class="fas fa-info"></i>
        <span>ClassInfo</span>
      </a>
      <a href="show_assigned_subjects.php?i=0">
        <i class="fas fa-swatchbook"></i>
        <span>Assign Subjects</span>
      </a>
      <a href="event_portal.php">
         <i class="fas fa-calendar-alt"></i>
        <span>Events</span>
      </a>
      <a href="notice portal.php?i=0">
        <i class="fas fa-scroll"></i>
        <span>Notices</span>
      </a>
      <a href="showmarks.php">
        <i class="fas fa-poll"></i>
        <span>Marks</span>
      </a>
      <a href="showexam.php">
        <i class="fas fa-clipboard-list"></i>
        <span>Exam</span>
      </a>
      <a href="Teacher_Attendance_Portal.php">
        <i class="fas fa-tasks"></i>
        <span>Attendance</span>
      </a>
      <a href="photo_gallery_portal.php">
        <i class="fas fa-camera-retro"></i>
        <span>Photo Gallery</span>
      </a>
      <a class="admin_ref">
        <i class="fas fa-user-shield"></i>
        <span>Admin</span>
      </a>
      <a href="contact_support.php">
        <i class="fas fa-comments"></i>
        <span>Contact Support</span>
      </a>
    </div>

    <!-- content area -->
    <div class="content_container">

    <!-- navbar -->
    <?php
       if(!isset($_SESSION))
       {
        session_start();
        }
       $id=$_SESSION["id"];

       $sql="select * from admin where Id='".$id."'";
       $result= mysqli_query($conn,$sql);
       while($row= mysqli_fetch_array($result)){
    ?>
    <nav class="navbar navbar-light ">
      <div class="container-fluid d-flex justify-content-end ">
        <img  src=<?php echo "../images/".$row['Id'].".jpg" ?> alt=""  class="d-inline-block align-text-top profile_img">
        <div class="dropdown">
            <button class="btn btn-lg btn-admin dropdown-toggle " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="admin_name fs-2"><?php echo $row['Name'] ?></span>
            </button>
          <ul class="dropdown-menu fs-3" aria-labelledby="dropdownMenuButton1">

            <li><a class="dropdown-item" href="admin_profile.php"><i class="far ico fa-id-badge"></i>Profile</a></li>
            <li><a class="dropdown-item" href="admin_profile.php?i=1"><i class="fas ico fa-unlock-alt"></i>Change Password</a></li>
            <li><a class="dropdown-item" id="log_out"><i class="fas ico fa-sign-out-alt"></i>Logout</a></li>
          </ul>
        </div>

     </div>
   </nav>
<?php } ?>

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
        $sql= "select count(*) as num from admin";
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
  $dataPoints1 = array(
    array("label" => "Website Visitors",  "y" => $total_visitors ),
  );
  $dataPoints2 = array(
    array("label" => "",  "y" => $total_online_visitors ),
  );


 // spline chart for new admissions
  $y= date('Y');
  $dataPoints5=array();
  for($i=0;$i<5;$i++){
    $y=$y-$i;
    $sql="select count(*) as Num from student where Year(Admission_date)='".$y."'";
    $result=mysqli_fetch_array(mysqli_query($conn,$sql));
    $row=$result['Num'];
    $data=array('x'=> $y, 'y'=>$row);
    array_push($dataPoints5,$data);
  }
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
      color: "blue",
      yValueFormatString: "#",
      dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
    },{
      type: "stackedBar100",
      color: "yellow",
      yValueFormatString: "#",
      name: "Online Visitors",
      dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
    }]
  });
  chart.render();


  CanvasJS.addColorSet("Shades",
                 [//colorSet Array
                 "#ff243a",
                 ]);


var chart = new CanvasJS.Chart("std_Admission Chart", {
  colorSet: "Shades",
	animationEnabled: true,
	axisY: {
		title: "No of Admission"
	},
  axisX: {
		title: "Year",

  },
	data: [{
		xValueFormatString: "YYYY",
		type: "spline",
		dataPoints: <?php echo json_encode($dataPoints5, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
  </script>

  <!-- section 2 row -->
  <div class="row second">
    <div class="diff_col col-md-6">
      <!-- visitor div -->
      <div class="cardbody cardbody1">
        <p class="header">Website Visitors Information</p>
        <p class="subhead">Total Visitors</p>
        <p id="total_visitor"><?php echo $total_visitors; ?></p>
        <center><div id="visitorContainer" ></div></center>
        <center>
          <table class="visitor_table">
          <tr>
            <td><div class="color1"></div></td> <td>Total Visitors</td> <td><?php echo $total_visitors ?></td>
          </tr>
          <tr>
            <td><div class="color2"></div></td> <td>Online Visitors</td> <td><?php echo $total_online_visitors ?></td>
          </tr>
        </table>

      </center>

      </div>
    </div>



      <div class="diff_col col-md-6">
        <div class="cardbody cardbody1">
          <p class="header">Student Admissions Per Year</p>
          <div id="std_Admission Chart">

          </div>
        </div>
      </div>
    </div>

    <!-- row 3 -->
   <div class="row third">
     <!-- notice -->
     <div class="diff_col col-md-6">
       <div class="cardbody cardbody1 event_contain">
         <div class="header">Notices</div>
         <p class="subhead">Total Notices</p>
         <?php
           $sql="select * from notice";
           $result=mysqli_query($conn,$sql);
           $total=mysqli_num_rows($result);
          ?>
         <p id="total_notices"><?php echo $total; ?></p>
        <div class="notice_table">
         <center>
         <table>
        <?php
          $sql=" select Title, Date from notice";
          $result=mysqli_query($conn,$sql);
          $i=1;
          while($row= mysqli_fetch_array($result)){
          ?>
          <tr><td><?php echo $row['Title'] ?></td><td> <div class="date<?php echo $i  ?>"> <?php echo $row['Date'] ?></div></td></tr>
        <?php
         $i++;
         if($i==4){$i=1;}} ?>

         </table>
         </center>
       </div>
       </div>
     </div>

     <!-- event -->
     <div class="diff_col col-md-6">
       <div class="cardbody cardbody1 event_contain">
         <div class="header">Events</div>
         <p class="subhead">Total Events</p>
         <?php
           $sql="select * from events";
           $result=mysqli_query($conn,$sql);
           $total=mysqli_num_rows($result);
          ?>
         <p id="total_events"><?php echo $total; ?></p>
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
                <div class="dates d-flex justify-content-between">
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

  </div>



  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
 <script type="text/javascript">
 // logout
 $("#log_out").click(function(){
  window.location="logout.php";
 });
$(".admin_ref").click(function(){

  <?php
   $id=$_SESSION["id"];
   $sql="select Role from admin where Id='".$id."'";
   $res=mysqli_fetch_assoc(mysqli_query($conn,$sql));
   ?>
   var role="<?php echo $res['Role'] ?>";
   if(role=="Superadmin"){
     window.location="showadmin.php?i=0";
   }
   else{
     alert("Admin can only be accessed by SuperAdmin");
   }
})
 </script>

</div>

</div>

</body>
</html>
