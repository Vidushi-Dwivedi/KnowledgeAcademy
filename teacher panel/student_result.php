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
    <?php include 'css_jslinks.php';
    include 'db.php'; ?>
    <link rel="stylesheet" href="css/head.css">
    <link rel="stylesheet" href="css/profile_bar.css">
    <title>KnowledgeAcademy-SubjectsAssigned</title>
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
    .container{
      background-color: white;
      border-radius: 10px;
      margin-top:100px;
    }

        .form_contain{
          padding:40px 10px 10px 10px;
          background-color: white;
          border-radius: 20px;
          margin: 20px;
          margin-right: 40px !important;
          border: 2px solid #1c2645;
          box-shadow:  3px 3px 6px #5a5a5a,
             -3px -3px 6px #5a5a5a;
        }
        .opt{
          color:black;
        }
        .la{
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 1.35rem;
        }
        .result_table_header{
           margin-top: 100px;
           text-align: left;
           font-size: xx-large;
           font-weight:bold;
           color:#1c2645 !important;
           margin-left:20px;
        }
        .result_table{
          background-color: white;
          box-shadow:  3px 3px 6px #5a5a5a,
             -3px -3px 6px #5a5a5a;
             width: 95%;
             overflow-x :auto;
             margin-top: 50px;
        }
        .result_table table{
          font-family: 'Noto Sans JP', sans-serif;
          font-size: 0.8rem;
          text-align: center;
          margin :15px 10px 15px 10px;
        }
        .result_table table td{
          border: 1px solid black;
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
      <div class="container-fluid ">
        <div class="brand">
          <i class="fas fa-search"></i><span class="heading">Search Student Result</span>
        </div>
      </div>
      <div class="container1 ">
       <center>
         <div class="form_contain" id="student_attendance_form">
            <form  id="search_result" >

                <div class="row">
                <div class="col formgroup container-fluid">
                    <label class="la col-form-label" for="student_id">Student-ID* </label>
                      <input class=" form-control form-control-lg" type="text" name="student_id" id="student_id" placeholder="Enter Student ID" required/>
                </div>
                <?php
                    $sql="select * from exam1";
                    $res=mysqli_query($conn,$sql);
                 ?>
                   <div class="col formgroup container-fluid">
                     <label class="la col-form-label" for="Exam">Exam*</label>
                     <select class=" form-control form-control-lg" id="Exam" name="Exam" required>
                       <?php
                         while($row1=mysqli_fetch_assoc($res)){
                        ?>
                        <option class="opt" value="<?php echo $row1['Id'] ?>"><?php echo $row1['Name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col form-group container-fluid">
                  <label class="la col-form-label" for="year">Exam Year*</label>
                  <select class=" form-control form-control-lg" id="year" name="year" required>
                    <?php
                    $sql="select distinct(Year) as year from marks1";
                    $res=mysqli_query($conn,$sql);
                      while($row1=mysqli_fetch_assoc($res)){
                     ?>
                     <option class="opt" value="<?php echo $row1['year'] ?>"><?php echo $row1['year'] ?></option>
                   <?php } ?>
                  </select>
                  </div>
                </div>
            </form>
            <div class="row">
              <div class="col  container-fluid d-flex r justify-content-between">
                  <button class="btn btn-outline-success btn-lg" id="submit"  name="submit_button">Submit</button>
              </div>
            </div>
          </div>
       </center>
       <center>
         <div class="result_table_header">

         </div>
         <div class="result_table">

         </div>
       </center>

      </div>
    </div>
  </div>
<script type="text/javascript">
   $('#submit').on('click',function(){

     $('.str_t').remove();
      $('.header_std').remove();

     var s_id = $('#student_id').val();
     var exam = $('#Exam').val();
     var year = $('#year').val();

     if(s_id==""){
       alert('Enter valid user id.');
     }
     else{
       $.ajax({
           type: "POST",
           url: 'teacher_submit.php',
           data: {func:'search_result',student_id:s_id,exam:exam,year:year},
           success: function(data1){
              console.log(data1);
              if(data1==1){
                alert('Result not found.');
              }
              else if (data1==2) {
                alert('Student not found');
              }
              else{
                data1=JSON.parse(data1);
                console.log(data1);
                var table = document.createElement('table');
                var tr = document.createElement('tr');

                for(var i=0;i<15;i++){
                  tr.appendChild( document.createElement('td') );
                }
                tr.cells[0].appendChild( document.createTextNode('Class') );
                tr.cells[1].appendChild( document.createTextNode('Name') );
                tr.cells[2].appendChild( document.createTextNode('Exam') );
                tr.cells[3].appendChild( document.createTextNode('Year') );
                tr.cells[4].appendChild( document.createTextNode('Rank') );
                tr.cells[5].appendChild( document.createTextNode('EngLang') );
                tr.cells[6].appendChild( document.createTextNode('EngLit') );
                tr.cells[7].appendChild( document.createTextNode('HindiLang') );
                tr.cells[8].appendChild( document.createTextNode('HindiLit') );
                tr.cells[9].appendChild( document.createTextNode('Maths') );
                tr.cells[10].appendChild( document.createTextNode('Science') );
                tr.cells[11].appendChild( document.createTextNode('SocialScience') );
                tr.cells[12].appendChild( document.createTextNode('Computer') );
                tr.cells[13].appendChild( document.createTextNode('GeneralKnowledge') );
                tr.cells[14].appendChild( document.createTextNode('Art') );

                table.appendChild(tr);

                var tr = document.createElement('tr');

                for(var i=0;i<15;i++){
                  tr.appendChild( document.createElement('td') );
                }
                tr.cells[0].appendChild( document.createTextNode(data1[3]) );
                tr.cells[1].appendChild( document.createTextNode(data1[2]) );
                tr.cells[2].appendChild( document.createTextNode(data1[4]) );
                tr.cells[3].appendChild( document.createTextNode(data1[0]['Year']) );
                tr.cells[4].appendChild( document.createTextNode(data1[1]) );
                tr.cells[5].appendChild( document.createTextNode(data1[0]['EngLang']) );
                tr.cells[6].appendChild( document.createTextNode(data1[0]['EngLit']) );
                tr.cells[7].appendChild( document.createTextNode(data1[0]['HindiLang']) );
                tr.cells[8].appendChild( document.createTextNode(data1[0]['HindiLit']) );
                tr.cells[9].appendChild( document.createTextNode(data1[0]['Maths']) );
                tr.cells[10].appendChild( document.createTextNode(data1[0]['Science']) );
                tr.cells[11].appendChild( document.createTextNode(data1[0]['SocialScience']) );
                tr.cells[12].appendChild( document.createTextNode(data1[0]['Computer']) );
                tr.cells[13].appendChild( document.createTextNode(data1[0]['GeneralKnowledge']) );
                tr.cells[14].appendChild( document.createTextNode(data1[0]['Art']) );


                table.appendChild(tr);
                  $('.result_table_header').append('<h2 class="header_std"><i class="fas fa-poll"></i> Student Result</h2>  ');
                  $('.result_table').append(table);
                  $(".result_table table").addClass('str_t table table-striped table-hover');
              }
           }
       });
     }
   });
</script>
  </body>
</html>
