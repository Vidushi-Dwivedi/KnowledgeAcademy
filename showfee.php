<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'css_jslinks.php' ?>
    <title>FEES show</title>

    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
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
  <?php
   include 'header.html';
   ?>
<div class="notice_head_wrap">
<div class="notice_head">
  <span class="iconify notice_icon" data-icon="octicon:note-16" data-inline="false"></span>
  <div class="notice_heading">FEES</div>
</div>

</div>
</div>
<hr />

    <div class = "container">
        <div class ="col-12">
        <h1 class="text-center text-white bg-dark"> Fees </h1>
        <br>
        <div class="table-responsive">
        <table class="table table-bordered table striped table-hover">
            <thread>
                <th> ID </th>

                <th> Title </th>
                <th> Action </th>

                <th> Date </th>


</thread>
<tbody>
<?php
include 'result_query.php';
$con = mysqli_connect('localhost','root');

mysqli_select_db($con, 'kacademy');
$query = "select * from `Fees`";
$queryd = mysqli_query($con,$query);
//$row = mysqli_num_rows($queryd);
while($result = mysqli_fetch_array($queryd) ){
    ?>
    <tr>
        <td> <?php echo $result['Id']; ?> </td>

        <td> <?php echo $result['Text']; ?> </td>
        <td>
        <a href="Downloads.php?name=<?php echo $result['Title'] ?> ">Download</a>

        </td>
        <td> <?php echo $result['Date']; ?> </td>
</tr>
<?php
}

?>
</tbody>
</table>
</div>
</div>
</div>
<?php
 include 'footer.php';
 ?>
</body>
</html>
