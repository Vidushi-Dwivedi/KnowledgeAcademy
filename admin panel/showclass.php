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
    <title>Class show</title>

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

<div class="notice_head_wrap">
<div class="notice_head">
  <span class="iconify notice_icon" data-icon="octicon:note-16" data-inline="false"></span>
  <div class="notice_heading">CLASS</div>
</div>

<div class="Search">
  <div class="row">
    <div class="col-lg-4 col-md-6">
      <button type="button"  class="btn btn-light add_notice" >
       <i class="fa fa-plus-square fa-2x"></i>
       <a class="btn-text" href="addclass.php"> Add Class</a>
     </button>
    </div>
    <div class="col-lg-8 col-md-6">
      <form class="form-group" action="classsearch.php" method="post">
        <div class="row">
          <div class="col-md-8"><input class="notice_text" type="text" name="class_Search" placeholder="Enter Title"></div>
          <div class="col-md-4"><input class="btn btn-light add_notice" type="submit" id="btn_search" name="class_search_enter" value="Search" ></div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<hr />

    <div class = "container">
        <div class ="col-12">
        <h1 class="text-center text-white bg-dark"> Class list </h1>
        <br>
        <div class="table-responsive">
        <table class="table table-bordered table striped table-hover">
            <thread>
                <th> ID </th>
                <th> Class </th>
                <th> Sec </th>
                <th> NextClass </th>

                <th> Update </th>
                <th> Delete </th>
</thread>
<tbody>
<?php

$con = mysqli_connect('localhost','root');

mysqli_select_db($con, 'kacademy');

$query = "select * from `Class`";
$queryd = mysqli_query($con,$query);
//$row = mysqli_num_rows($queryd);
while($result = mysqli_fetch_array($queryd) ){
    ?>
    <tr>
        <td> <?php echo $result['Id']; ?> </td>
        <td> <?php echo $result['Class']; ?> </td>
        <td> <?php echo $result['Sec']; ?> </td>
        <?php
         if($result['Class_After']==0){
           ?>
             <td> Passout</td>
           <?php
         }
         else{
         ?>
        <td> <?php echo $result['Class_After']; ?> </td>
      <?php } ?>
        <td><a class="icon" href="updateclass.php?id=<?php echo $result['Id'] ?>"><i class="fa fa-edit "></i></a></td>
            <td><a class="icon delete" data-id='<?php echo $result['Id'] ?>' ><i class="fa fa-trash"></i></a></td>
</tr>
<?php
}

?>
</tbody>
</table>
</div>
</div>
</div>
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
      url: 'deleteclass.php',
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
