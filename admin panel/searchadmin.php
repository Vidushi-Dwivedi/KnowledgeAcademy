<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-AdminSearch</title>
    <!-- google font stylesheets -->

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

   <style media="screen">
   /* head styling */

  body{
    padding: 5% 2%;
  }
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

   .fa-plus-square{
   color:black;
   }
   .add_notice{
     display: inline-flex;
     justify-content: space-around;
     width:80%;
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
/* table styling */
   .container{
     width: 80%;
     font-family: 'Noto Sans JP', sans-serif;
   }
   .icon{
     color: black;
   }

   thead{
       font-family: 'Noto Sans JP', sans-serif;
       font-size: 1.2rem;
     }
/* result if none found */
  .res{
    font-family: 'Noto Sans JP', sans-serif;
    font-size: 1.2rem;
  }
   </style>

  </head>
  <body>
  <div class="notice_head_wrap">
<div class="notice_head">
  <span class="iconify notice_icon" data-icon="octicon:note-16" data-inline="false"></span>
  <div class="notice_heading">Admin</div>
</div>

<div class="Search">
  <div class="row">
    <div class="col-lg-4 col-md-6">
      <button type="button"  class="btn btn-light add_notice" >
       <i class="fa fa-plus-square fa-2x"></i>
       <a class="btn-text" href="addadmin.php"> Add Admin</a>
     </button>
    </div>
    <div class="col-lg-8 col-md-6">
      <form class="form-group" action="searchadmin.php" method="post">
        <div class="row">
          <div class="col-md-8"><input class="notice_text" type="text" name="admin_Search" placeholder="Enter Title"></div>
          <div class="col-md-4"><input class="btn btn-light add_notice" type="submit" id="btn_search" name="admin_search_enter" value="Search" ></div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<hr />
    <!-- php for writing search -->
    <?php
      if(isset($_POST['admin_search_enter'])){
        $name=$_POST['admin_Search'];
        if($name!=""){
          include 'db.php';
          $sql="select * from `Admin` where `Id` = '".$name."'";
          $result=mysqli_query($conn,$sql);
          if(mysqli_num_rows($result)>0){
          ?>
          <center>
        <div class="container">

          <table class="table table-striped table-hover">
        <thead>
        <th> ID </th>
                <th> Role </th>
                <th> Name </th>
                <th> Fathers Name </th>
                <th> Mothers Name </th>
                <th> Phone </th>
                <th> Address </th>
                <th> Email </th>
                <th> Gender </th>
                <th> Photo </th>
                <th> Password </th>
                <th> Date Of Birth </th>
                <th> Joining </th>
                <th> Update </th>
                <th> Delete </th>
        </thead>
        <tbody>
          <?php
         while($results = mysqli_fetch_array($result) ){
            ?>  
            <tr>
            <td> <?php echo $result['Id']; ?> </td>
        <td> <?php echo $result['Role']; ?> </td>
        <td> <?php echo $result['Name']; ?> </td>
        <td> <?php echo $result['Fname']; ?> </td>
        <td> <?php echo $result['Mname']; ?> </td>
        <td> <?php echo $result['Phone']; ?> </td>
        <td> <?php echo $result['Address']; ?> </td>
        <td> <?php echo $result['email']; ?> </td>
        <td> <?php echo $result['gender']; ?> </td>
        <td>
           <img src=<?php echo "../images/".$result['Id'].".jpg" ?> width="100" height="100" />
        </td>
        <td> <?php echo $result['Password']; ?> </td>
        <td> <?php echo $result['DOB']; ?> </td>
        <td> <?php echo $result['joining']; ?> </td>
        <td><a class="icon" href="updateadmin.php?id=<?php echo $result['Id'] ?>"><i class="fa fa-edit "></i></a></td>

       <td><a class="icon delete" data-id='<?php echo $result['Id'] ?>' ><i class="fa fa-trash"></i></a></td>
        </tr>
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
          header("Location:showstudent.php");
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
      url: 'deleteadmin.php',
      type: 'POST',
      data: { id: deleteid  },
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
