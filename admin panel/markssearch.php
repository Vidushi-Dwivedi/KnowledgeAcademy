<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Exo:wght@700&display=swap" rel="stylesheet">
 <!-- ocyify icon script -->
 <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

    <!-- bootstrap scripts -->
    <script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- bootstrap css -->
    <link rel="icon" href="../images/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
    <title>Marks info show</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <style media="screen">
    .notice_head_wrap{
  display: flex;
  justify-content: space-between;
}
  .notice_icon{
    color:green;
    text-align:left;
    margin-left: 3%;
    margin-right: 1%;
    width:15%;
    height: 15%;
  }
  .notice_head{
  font-family: 'Titillium Web', sans-serif;
display:inline-flex;
  width:30%;
  height:5%;
  }
  .add_event{
     width:100%;
   }
   .form1{
     width: 100%;
   }
   .add_attendance{
     margin-right: 1%;
     margin-bottom: 2%;
   }
  .nav{
    padding-top: 5%;
    -webkit-box-shadow: 0 12px 12px -12px black;
      -moz-box-shadow: 0 8px 6px -6px black;
           box-shadow: 0 12px 12px -12px black;
   }
   .row{
     width:20%;
   }
   @media only screen and (max-width: 810px) {
     .row{
       width:100%;
     }
}
  .navbar-brand{
     font-family: 'Titillium Web', sans-serif;
    height:20%;
    }
    .navbar-brand .fa-clipboard-check{
     padding-right: 3%;
     font-size: 450%;
    }
  .notice_heading{
   padding-top: 2%;
   width:35%;
   font-size: 200%;
  }
  input {
    border: 6% black;
    border-style: inset;
    padding: 1% 1%;
    background: rgba(255,255,255,0.5);
    margin: 0 0 10px 0;
    width:50%;
}
.fa-clipboard-check{
      color:#ff8838;
    }
.fa-plus-square{
color:black;
}
.add_notice{
  display: inline-flex;
  justify-content: space-around;
  width:100%;
  margin-right: 5%;
  font-family: 'Exo', sans-serif;
  font-size: 100%;
}
.btn-text{
  color:black;
}
  .Search{
    text-align: right;
    margin-right: 3%;
    padding-top: 1.5%;
    width:55%;
  }
  hr {
    height: 12px;
    border: 0;
    box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5);
}


.notice_text{
  width:100%;
}
</style>
</head>
<body>

<nav class="navbar navbar-light bg-light">
    <div class="container-fluid nav">
      <a class="navbar-brand">
        <i class="fas fa-clipboard-check"></i><span class="notice_heading">Marks</span>
      </a>
      <div class="row d-flex justify-content-end">
        <a class=" d-flex justify-content-end btn btn-light add_event" href="addmarks.php"> <i class="fa fa-plus-square fa-2x"><span class="align-self-center icon_text"> Add Marks</span></i> </a>
      </div>
      <div class="form1 d-flex justify-content-end">
          <form class="col-lg-3 d-flex" action="markssearch.php" method="post">
            <input class="form-control me-2 notice_text" type="text" name="marks_search_ClassID" placeholder="Enter Class ID" aria-label="Search">
            <button class="btn btn-outline-success add_attendance" type="submit" id="btn_search" name="submit" value="marks_search_classid" >Search</button>
          </form>
          <form class="col-lg-3 d-flex" action="markssearch.php" method="post">
            <input class="form-control me-2 notice_text" type="text" name="marks_search_StudentID" placeholder="Enter Student ID" aria-label="Search">
            <button class="btn btn-outline-success add_attendance" type="submit" id="btn_search" name="submit" value="marks_search_studentid">Search</button>
          </form>
          <form class="col-lg-3 d-flex" action="markssearch.php" method="post">
            <input class="form-control me-2 notice_text" type="text" name="marks_search_examID" placeholder="Enter Exam ID" aria-label="Search">
            <button class="btn btn-outline-success add_attendance" type="submit" id="btn_search" name="submit" value="marks_search_examid">Search</button>
          </form>
      </div>
</nav>
<hr />

<?php
if(isset($_POST["submit"])){
  $i=0;
  switch($_POST["submit"]) {
    case 'marks_search_classid':
           $val=$_POST['marks_search_ClassID'];
           if($val!=""){
             $sql="select * from `marks1` where `ClassID` = '".$val."'";
             $i=1;
          }
    break;
    case 'marks_search_studentid':
           $val=$_POST['marks_search_StudentID'];
            if($val!=""){
             $sql="select * from `marks1` where `StudentID` = '".$val."'";
             $i=1;
          }
    break;
    case 'marks_search_examid':
      $val=$_POST['marks_search_examID'];
       if($val!=""){
        $sql="select * from `marks1` where `examid` = '".$val."'";
        $i=1;
     }
break;
  }
  if($i==1){

            $conn = mysqli_connect('localhost','root');

             mysqli_select_db($conn, 'kacademy');

          $result=mysqli_query($conn,$sql);
          if(mysqli_num_rows($result)>0){
          ?>
          <center>
        <div class="container">

          <table class="table table-striped table-hover">
        <thead>
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
                <th> Update </th>
                <th> Delete </th>
        </thead>
        <tbody>
          <?php
         while($results = mysqli_fetch_array($result) ){
            ?>
            <tr>
            <td> <?php echo $results['ClassID']; ?> </td>
        <td> <?php echo $results['StudentID']; ?> </td>
        <td> <?php echo $results['examid']; ?> </td>
        <td> <?php echo $results['Year']; ?> </td>
        <td> <?php echo $results['EngLang']; ?> </td>
        <td> <?php echo $results['EngLit']; ?> </td>
        <td> <?php echo $results['HindiLang']; ?> </td>

        <td> <?php echo $results['HindiLit']; ?> </td>
        <td> <?php echo $results['Maths']; ?> </td>
        <td> <?php echo $results['Science']; ?> </td>
        <td> <?php echo $results['SocialScience']; ?> </td>
        <td> <?php echo $results['Computer']; ?> </td>
        <td> <?php echo $results['GeneralKnowledge']; ?> </td>
        <td> <?php echo $results['Art']; ?> </td>
        <td><a class="icon" href="updatemarks.php"><i class="fa fa-edit "></i></a>  </td>
        <td><a class="icon delete" data-id='<?php echo $results['ClassID'] ?>' data-sid='<?php echo $results['StudentID'] ?>' data-eid='<?php echo $results['examid'] ?>' data-year='<?php echo $results['Year'] ?>' ><i class="fa fa-trash"></i></a></td>
        <?php
        }
        ?>
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
          header("Location:showmarks.php");
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
 var deletesid = $(this).data('sid');
 var deleteeid = $(this).data('eid');
 var deleteyear = $(this).data('year');
 var confirmalert = confirm("Are you sure?");
 if (confirmalert == true) {
    // AJAX Request
    $.ajax({
      url: 'deletemarks.php',
      type: 'POST',
      data: { id: deleteid,sid: deletesid,eid: deleteeid,year: deleteyear  },
      success: function(response){
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
</body>
</html>
