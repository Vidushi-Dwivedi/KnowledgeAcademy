<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-AddEvent</title>
    <?php include 'css_jslinks.php' ?>
    <link rel="stylesheet" href="eventportal.css">

    <style media="screen">

      /* form style */
      .container{
        padding:5% 5%;
      }
      .form-group{
        font-family: 'Noto Sans JP', sans-serif;
        font-size: 1.35rem;
        padding-top: 3%;
      }
      .form-contain{
        padding: 0;
      }
      textarea{
        resize:none;
      }
      input[type=time]{
        width:100%;
        padding: 1% 2%;
      }
      .time{
        padding-top: 0;
      }

    </style>
  </head>
  <body>

    <!-- nav bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid head">
    <a class="navbar-brand" href="#">
    <i class="fas fa-calendar-alt"></i><span class="event_heading">EVENTS</span>
    </a>

  </div>
  </nav>

  <!-- php script to connect to database -->

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST")
       {
         include('db.php');
         include('result_query.php');

         $title=$_POST['Title'];
         $des=$_POST['Description'];
         $s_date=$_POST['start_date']." ".$_POST['start_time'];
         $e_date=$_POST['end_date']." ".$_POST['end_time'];
         $status=$_POST['status'];
         $id=$_GET['id'];

         if($_POST['start_date']<=$_POST['end_date']){
         $sql="update events set title='".$title."', description='".$des."', start_date='".$s_date."', end_date='".$e_date."', status='".$status."' where id='".$id."'";

         if(mysqli_query($conn,$sql)){
           echo showResult("Event updated Successfully","true");
         }
         else{
           echo showResult("Event could not be updated.","false");
         }
        }
       }
  ?>
    <!-- form -->

    <div class="container">
      <?php  $id=$_GET['id'];?>

      <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=".$id;?>" method="post">

        <?php
         include 'db.php';

         $sql= "SELECT * FROM events where id='".$id."'";
         $row=mysqli_query($conn,$sql);
         while ($result = mysqli_fetch_array ($row)){?>

           <div class="form-group">
             <label for="Enter Title" >Title*</label>
             <input type="text" class="form-control form-control-lg" id="Title" name="Title" placeholder="Enter Title" value="<?php echo $result['title'] ?>" required>
           </div>

           <div class="form-group">
            <label for="Description">Description</label>
            <textarea class="form-control form-control-lg" id="Description" name="Description" placeholder="Enter Description" value="<?php echo $result['description'] ?>" rows="3"></textarea>
          </div>
         <div class="form-row">

           <div class="col">
             <div class="form-group">
                  <?php $date= substr($result['start_date'],0,10) ?>
               <label  for="start_date">Start Date*</label>
               <input class=" form-control form-control-lg" id="date1" type="date" name="start_date" value="<?php echo $date ?>" required/>
             </div>
           </div>

           <div class="col">
             <div class="form-group ">
               <?php $date= substr($result['start_date'],11,19); ?>
               <label for="start_time">Start Time* </label>
               <input id="start_time" class=" form-control form-control-lg" type="time" name="start_time" value="<?php echo $date ?>" step="2" required>
             </div>
           </div>

         </div>

         <div class="form-row">

           <div class="col">
             <div class="form-group container-fluid form-contain">
               <?php $date= substr($result['end_date'],0,10);?>
               <label  for="end_date">End Date*</label>
               <input class=" form-control form-control-lg" id="date2" type="date" name="end_date" value="<?php echo $date ?>" required/>
             </div>
           </div>

           <div class="col">
             <div class="form-group time">
               <?php $date=substr($result['end_date'],11,19);?>
               <label for="end_time">End Time* </label>
               <input id="end_time" class="form-control form-control-lg" type="time" name="end_time" value="<?php echo $date ?>" step="2" required>
             </div>
           </div>

         </div>



          <div class="form-group">
          <label for="Status">Status*</label>
          <select class="form-control form-control-lg" id="Status" name="status" value="<?php echo $result['status'] ?>"required>
            <option>Active</option>
            <option>Block</option>
          </select>
          </div>

          <div class="form-group">
          <button class="btn btn-outline-success btn-lg add_notice" type="submit" id="add_btn" name="add_event_btn" value="Search" onclick="check()">Submit</button>
         </div>
         <?php }?>
         </form>

         <script type="text/javascript">

         function check(){

           d= document.getElementById('date1').value;
           var d1= new Date(d);
           d= document.getElementById('date2').value;
           var d2= new Date(d);
           if(d1<=d2){
             return true;
           }
           else{
             alert("Start Date can not exceed the End Date of the event.");
             return false;
           }
         }
         </script>
    </div>

  </body>
</html>
