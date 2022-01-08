<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if(!isset($_SESSION))
    {
     session_start();
   }
    $id=$_SESSION["id"];

     ?>
    <?php include 'css_jslinks.php';
    include 'db.php'; ?>
    <link rel="stylesheet" href="css/head.css">
    <link rel="stylesheet" href="css/profile_bar.css">
    <title>KnowledgeAcademy-LeaveApplicationForm</title>


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
    .text-head{
      margin-top: 50px;
      background-color: #26335a !important;
      color: white;
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
    .ab,.col-4{
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
            <i class="fas fa-clipboard-check"></i><span class="heading">LeaveApplicationForm</span>
          </div>
        </div>



    <!-- form -->
    <div class="form_contain" id="leave_application_form">
       <form  method="POST" accept-charset="utf-8" enctype="multipart/form-data">
         <div class="row">
              <?php $d=date('Y-m-d'); ?>
              <div class="ab formgroup container-fluid col-lg-6">
                <label class=" col-form-label" for="from">From Date*</label>
                <input class=" form-control form-control-lg" min="<?php echo $d ?>" type="date" name="from" id="from" required/>
             </div>
             <div class="ab formgroup container-fluid col col-lg-6">
               <label class="col-form-label" for="attendance_date">To Date*</label>
               <input class=" form-control form-control-lg" type="date" min="<?php echo $d ?>" name="to" id="to" required/>
            </div>

          </div>
             <div class="form-group container-fluid">
             <label class="col-2 col-form-label" for="Status">Leave Type*</label>
             <select class="form-control form-control-lg" id="leave" name="leave" required>
               <option value="CasualLeave">Casual Leave</option>
               <option value="MedicalLeave">Medical Leave</option>
               <?php
                 if($row['gender']=='Female'){
                ?>
                    <option value="MaternityLeave">Maternity Leave</option>
                <?php
                 }
                ?>
               <option value="ChildCareLeave">Child Care Leave</option>
             </select>
             </div>
             <div class="formgroup container-fluid">
               <div class="custom-file">
                 <input type="file" class="custom-file-input" id="file" name="file">
                 <label class="custom-file-label form-control-lg" for="file">Choose file</label>
               </div>
             </div>
             <div class="form-group container-fluid">
               <label class="col-2 col-form-label" for="Status">Reason*</label>
               <textarea name="reason" id="reason" rows="8" cols="80" class="form-control form-control-lg" placeholder="Type the reaon for leave" required></textarea>
             </div>
           <div class="formgroup container-fluid">
               <input class="btn btn-outline-success btn-lg" type="submit" name="submit_button" required/>
           </div>
       </form>
     </div>
    </div>
    </div>
    <script type="text/javascript">
    var id=<?php echo $id; ?>;
    function check(){
      var d1= new Date($('#from').val());
      var d2= new Date($('#to').val());
      var status = $('#leave').val();
      var files = $('#file')[0].files;
      if(d2<d1){
        alert("Invalid dates entered. ToDate should be greater than FromDate!");
        return false;
      }
      if(status=='CasualLeave'){
        var Difference_In_Time = d2.getTime() - d1.getTime();
        var Days = Difference_In_Time / (1000 * 3600 * 24);
        if(Days>2){
          alert("Casual leave cannot exceed 2 days.");
          return false;
        }
        alert(Days);
      }
      else{
        if ($('#file')[0].files.length === 0) {
          alert("Please upload your medical certificate first");S
        }
      }
      return true;
    }

    // the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    
              $(document).ready(function(){
                  $('#leave_application_form').on('submit', function(e){
                      //Stop the form from submitting itself to the server.
                      e.preventDefault();
                      if(check()){
                        var from = $('#from').val();
                        var to = $('#to').val();
                        var status = $('#leave').val();
                        var reason = $('#reason').val();
                        var files = $('#file')[0].files;
                        var fd = new FormData();
                        fd.append('file',files[0]);
                        fd.append('teacher_id',id);
                        fd.append('from',from);
                        fd.append('to',to);
                        fd.append('type',status);
                        fd.append('reason',reason);
                        fd.append('func',"apply_leave")
                        $.ajax({
                          type: "POST",
                          url: 'teacher_submit.php',
                          processData:false,
                          contentType: false,
                          data: fd,
                          success: function(data){
                            alert(data);
                            location.reload();
                          }
                        })
                      }

                  });
              });
    </script>
  </body>
</html>
