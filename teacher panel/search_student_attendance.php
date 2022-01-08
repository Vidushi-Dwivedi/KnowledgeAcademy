<?php ob_start(); ?>
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
    <title>KnowledgeAcademy-SearchStudentAttendance</title>
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
     @media only screen and (max-width: 400px) {
      .search{
        width:100% !important;
        margin: 20px !important;
      }
     }
     /* .form1{
       margin-bottom: 40px;
     } */
     .container{
       padding:40px 10px 10px 10px;
       background-color: white;
       border-radius: 20px;
       margin: 20px;
       margin-right: 40px !important;
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
    <center>
      <div class="container-fluid nav">
        <div class="brand">
          <i class="fas fa-clipboard-check"></i><span class="heading">STUDENT ATTENDANCE</span>
        </div>
      </div>
    </center>


      <div class="form1 d-flex justify-content-end">
          <form class="col-md-4 search d-flex" action="search_student_attendance.php" method="post">
            <input class="form-control me-2 notice_text" type="text" name="Student_attendance_Search_ID" placeholder="Enter Student ID" aria-label="Search">
            <button class="btn btn-outline-success add_attendance" type="submit" id="btn_search" name="submit" value="attendance_search_id" >Search</button>
          </form>
          <form class="col-md-4 search d-flex" action="search_student_attendance.php" method="post">
            <input class="form-control me-2 notice_text" type="text" name="Student_attendance_Search_Class" placeholder="Enter Class" aria-label="Search">
            <button class="btn btn-outline-success add_attendance" type="submit" id="btn_search" name="submit" value="attendance_search_class">Search</button>
          </form>
          <form class="col-md-4 search d-flex" action="search_student_attendance.php" method="post">
            <input class="form-control me-2 notice_text" type="date" name="Student_attendance_Search_Date" placeholder="Enter Date" aria-label="Search">
            <button class="btn btn-outline-success add_attendance" type="submit" id="btn_search" name="submit" value="attendance_search_date">Search</button>
          </form>
      </div>

      <!-- php for writing search -->
      <?php
      if(isset($_POST["submit"])){
        $i=0;
        switch($_POST["submit"]) {
          case 'attendance_search_id':
                 $val=$_POST['Student_attendance_Search_ID'];
                 if($val!=""){
                   $sql="select * from student_attendance where student_id='".$val."'";
                   $i=1;
                }
          break;
          case 'attendance_search_date':
                 $val=$_POST['Student_attendance_Search_Date'];
                  if($val!=""){
                   $sql="select * from student_attendance where attendance_date='".$val."'";
                   $i=1;
                }
          break;
          case 'attendance_search_class':
                 $val=$_POST['Student_attendance_Search_Class'];
                  if($val!=""){
                   $sql="select * from student_attendance where class_id='".$val."'";
                   $i=1;

                }
          break;
        }
        if($i==1){
          include 'db.php';
        $result=mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)>0){?>
          <center>
        <div class="container" style="overflow:scroll; height:800px; margin-top: 4%">

          <table class="table table-striped table-hover">
        <thead>
          <th>Attendance ID</th>
          <th>Student ID</th>
          <th>Class</th>
          <th>Sec</th>
          <th>Teacher ID</th>
          <th>Status</th>
          <th>Attendance Date</th>
          <th>Edit</th>
          <th>Delete</th>
        </thead>
        <tbody>
          <?php    foreach ($result as $file):
            $sql1="select * from class where Id='".$file['class_id']."'";
            $result1=mysqli_query($conn,$sql1);
            $row=mysqli_fetch_assoc($result1);
            ?>

              <tr>
                <td><?php echo $file['attendance_id']; ?></td>
                <td><?php echo $file['student_id']; ?></td>
                <td><?php echo $row['Class']; ?></td>
                <td><?php echo $row['Sec']; ?></td>
                <td><?php echo $file['teacher_id']; ?></td>
                <td><?php echo $file['status']; ?></td>
                <td><?php echo $file['attendance_date']; ?></td>
                <td><a class="icon" href="student_attendance_edit.php?attend_id=<?php echo $file['attendance_id'] ?>&id=<?php echo $file['student_id'];?>"><i class="fa fa-edit "></i></a></td>
                <td><a class="icon delete" data-id='<?php echo $file['attendance_id'] ?>'   ><i class="fa fa-trash"></i></a></td>
              </tr>
            <?php endforeach;?>
          </tbody>
          </table>

          </div>

          </center>
      <?php
        }
        else{
          ?>
          <center>
            <p class="res">No record found.</p>
          </center>
          <?php
        }
      }
      else{
        header("Location:Teacher_Attendance_Portal.php");
      }
      }

       ?>
       <script type="text/javascript">

       $(document).ready(function(){

       // Delete
       $('.delete').click(function(){
        var el = this;

        // Delete id
        var deleteid = $(this).data('id');

        var confirmalert = confirm("Are you sure?");
        if (confirmalert == true) {
           // AJAX Request
           $.ajax({
             url: 'teacher_submit.php',
             type: 'POST',
             data: { func:"delete_student_attendance",attendance_id: deleteid },
             success: function(response){
              // console.log(response);
               if(response == 1){
           // Remove row from HTML Table
           $(el).closest('tr').children('td, th').css('background','#dd8d8d');
           $(el).closest('tr').children('td, th').fadeOut(800,function(){
              $(this).remove();
           });

               }else{
           alert('Invalid ID.');

               }

             }
           });
        }

       });

       });

       </script>
  </div>
</div>
  </body>
</html>
