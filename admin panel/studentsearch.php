<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-StudentSearch</title>
    <!-- google font stylesheets -->

  <?php include 'css_jslinks.php'; ?>

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
     width: 100%;
     margin-left:0;
     margin-right: 0;
     padding-left: 0;
padding-right: 0;
overflow-x: scroll;
     font-family: 'Noto Sans JP', sans-serif;
   }
   .icon{
     color: black;
     margin:30px;
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
    <!-- head bar -->
    <div class="notice_head_wrap">
    <div class="notice_head">
      <span class="iconify notice_icon" data-icon="octicon:note-16" data-inline="false"></span>
      <div class="notice_heading">STUDENT</div>
    </div>

    <div class="Search">
      <div class="row">
        <div class="col-4">
          <button type="button"  class="btn btn-light add_notice" >
           <i class="fa fa-plus-square fa-2x"></i>
           <a class="btn-text" href="student2.php"> Add Student</a>
         </button>
        </div>
        <div class="col-8">
        <form class="form-group" action="studentsearch.php" method="post">
        <div class="row">
          <div class="col-md-8"><input class="notice_text" type="text" name="student_Search" placeholder="Enter Title"></div>
          <div class="col-md-4"><input class="btn btn-light add_notice" type="submit" id="btn_search" name="student_search_enter" value="Search" ></div>
        </div>
          </form>
        </div>
      </div>
    </div>
    </div>
    <hr />

    <!-- php for writing search -->
    <?php
      if(isset($_POST['student_search_enter'])){
        $name=$_POST['student_Search'];
        if($name!=""){
          include('db.php');
          $sql="select * from `student` where `ID` = '".$name."'";
          $result=mysqli_query($conn,$sql);
          if(mysqli_num_rows($result)>0){
          ?>
          <center>
        <div class="container">

          <table class="table table-striped table-hover">
        <thead>
        <th> ID </th>
                <th> Name </th>
                <th> Fathers Name </th>
                <th> Mothers Name </th>
                <th> Phone </th>
                <th> Address </th>
                <th> Class </th>
                <th> Email </th>
                <th> Gender </th>
                <th> Photo </th>
                <th> Password </th>
                <th> Date Of Birth </th>
                <th> Year </th>
                <th> Update </th>
                <th> Delete </th>
        </thead>
        <tbody>
          <?php
         while($results = mysqli_fetch_array($result) ){
           $sql="select * from class where Id='".$results['ClassID']."'";
           $row= mysqli_fetch_assoc(mysqli_query($conn,$sql));
            ?>
            <tr>
                <td> <?php echo $results['Id']; ?> </td>
                <td> <?php echo $results['Name']; ?> </td>
                <td> <?php echo $results['Fname']; ?> </td>
                <td> <?php echo $results['Mname']; ?> </td>
                <td> <?php echo $results['Phone']; ?> </td>
                <td> <?php echo $results['Address']; ?> </td>
                <td> <?php echo $row['Class']." - ".$row['Sec']; ?> </td>
                <td> <?php echo $results['email']; ?> </td>
                <td> <?php echo $results['gender']; ?> </td>
                <td>
           <img src=<?php echo "../images/".$results['Id'].".jpg" ?> width="100" height="100" />
        </td>
                <td> <?php echo $results['Password']; ?> </td>
                <td> <?php echo $results['DOB']; ?> </td>
                <td> <?php echo $results['year']; ?> </td>
                <td><a class="icon" href="updatestudent.php?id=<?php echo $results['Id'] ?>"><i class="fa fa-edit "></i></a></td>

                <td><a class="icon delete" data-id='<?php echo $results['Id'] ?>' ><i class="fa fa-trash"></i></a></td>
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
      url: 'deletestudent.php',
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
