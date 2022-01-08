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
    <title>KnowledgeAcademy-StudentLog</title>
    <?php include 'css_jslinks.php';
    include 'db.php'; ?>
    <link rel="stylesheet" href="css/head.css">
    <link rel="stylesheet" href="css/profile_bar.css">
    <style media="screen">

    /* head style */
    .first_col{
      background-color: #2d8074;
    }
    .third_col{
        background-color: #fde8cd;
    }
    .container-fluid{
      margin-bottom: 30px;
      margin-top: 15px;
    }
    .icon{
      color:black !important;
    }
    .brand{
      font-size: xx-large;
      font-weight:bold;
      color:#1c2645 !important;
      margin-left:20px;
    }


    .form_contain{
      padding:40px 10px 10px 10px;
      background-color: white;
      border-radius: 20px;
      margin: 20px;
      margin-right: 40px !important;
      border: 2px solid #1c2645;
    }
    .col-2,.col-4{
        font-family: 'Noto Sans JP', sans-serif;
        font-size: 1.35rem;
    }

    </style>
  </head>
  <body>
    <?php include 'headbar.php' ?>

    <?php


   $sql="select * from teacher where Id='".$id."'";
   $result= mysqli_query($conn,$sql);
   $row=mysqli_fetch_array($result);
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
  <div class="col col-lg-9 third_col">
    <!-- head bar -->

      <div class="container-fluid ">
        <div class="brand">
          <i class="fas fa-clipboard-check"></i><span class="heading">Student Attendance</span>
        </div>
      </div>



  <!-- form -->
  <div class="form_contain" id="student_attendance_form">
     <form  method="POST" accept-charset="utf-8" enctype="multipart/form-data">
         <div class="formgroup container-fluid">
             <label class="col-4 col-form-label" for="student_id">Student-ID* </label>
               <input class=" form-control form-control-lg" type="text" name="student_id" id="student_id" placeholder="Enter Student ID" required/>
        </div>
            <div class="formgroup container-fluid">
              <label class="col-2 col-form-label" for="attendance_date">Date*</label>
              <input class=" form-control form-control-lg" type="date" name="attendance_date" id="date" required/>
           </div>
           <div class="form-group container-fluid">
           <label class="col-2 col-form-label" for="Status">Status*</label>
           <select class="form-control form-control-lg" id="Status" name="status" required>
             <option value="1">Present</option>
             <option value="2">Absent</option>
             <option value="3">Late</option>
             <option value="4">Half Day</option>
           </select>
           </div>
         <div class="formgroup container-fluid">
             <input class="btn btn-outline-success btn-lg" type="submit" name="submit_button" required/>
         </div>
     </form>
   </div>

  </div>

  <script>
  var id=<?php echo $id; ?>;
            $(document).ready(function(){
                $('#student_attendance_form').on('submit', function(e){
                    //Stop the form from submitting itself to the server.
                    e.preventDefault();
                    var s_id = $('#student_id').val();
                    var date = $('#date').val();
                    var status = $('#Status').val();
                    $.ajax({
                      type: "POST",
                      url: 'teacher_submit.php',
                      data: {func:'verify_log_Student_Attendance',teacher_id:id,student_id:s_id,date:date},
                      success: function(data){

                          if(data=="1"){
                            $.ajax({
                                type: "POST",
                                url: 'teacher_submit.php',
                                data: {func:'submit_log_student_Attendance',teacher_id:id,student_id:s_id,date:date,status:status},
                                success: function(data1){
                                    if(data1==1){
                                      alert("Attendance added Successfully.");
                                      location.reload();
                                    }
                                    else{
                                      alert("Failed");
                                      location.reload();
                                    }
                                }
                            });
                          }
                          else{
                            alert(data);
                          }
                      }
                    })
                });
            });
 </script>

  </body>
</html>
