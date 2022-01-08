<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include 'css_jslinks.php' ?>
    <title>Teacher info</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
<style>
#reset {
background: blue;
color: white;
margin-right: 8px; }
#reset:hover {
background: red;
color: white; }

#submit {
background: blue;
color: white; }
#submit:hover {
background-color: red; }
.submit {
width: 140px;
height: 40px;
display: inline-block;
font-family: 'Poppins';
font-weight: 400;
font-size: 13px;
padding: 10px;
border: none;
cursor: pointer; }
.form-submit {
text-align: right;
padding-top: 27px; }



body {
font-size: 16px;
line-height: 1.8;
color: white;
font-weight: 400;
background: #29a8a6;
padding: 90px 0; }

.container {
color:black;
position: relative;
padding-bottom: 50px;
padding-right: 50px;
margin: 0 auto;
background: #fff;
border-radius:40px;
box-shadow:  5px 5px 13px #238f8d,
         -5px -5px 13px #2fc1bf;
}
.register-form {
padding: 50px 100px 50px 70px; }

h2 {
line-height: 1.66;
margin: 0;
padding: 0;
font-weight: 700;
color: #222;
font-family: 'Montserrat';
font-size: xx-large;
text-transform: uppercase;
margin-bottom: 32px; }
.image_show{
  margin-top: 150px;
  height:200px;
  width:150px;
  border: 2px solid black;
}
.image_show img{
  height:100%;
  width: 100%;
}
.d{
  margin-left: 50% !important;
  width:100%;
}
</style>

</head>
<body>


<div class="container">


            <div class="form_contain" id="updateteacher">
            <form method="POST" class="register-form" id="register-form" enctype="multipart/form-data" >
            <div class="row">


<div class="col-lg-10">
<?php  $id=$_GET['id'];?>

<h2 class="text-center">Teacher details updation</h2>
<?php
include 'db.php';

$sql= "SELECT * FROM teacher where Id='".$id."'";
$row1=mysqli_query($conn,$sql);
while ($result = mysqli_fetch_array ($row1)){?>


                    <div class="form-group">
                        <label for="name">Name :</label>
                        <input type="text" name="name" id="name" value="<?php echo $result['Name']; ?>" class="form-control" required/>
                    </div>

<div class="form-group">
                        <label for="father_name">Father Name :</label>
                        <input type="text" name="father_name" id="father_name" value="<?php echo $result['Fname']; ?>" class="form-control" required/>
                    </div>


                <div class="form-group">
                        <label for="mother_name">Mother Name :</label>
                        <input type="text" name="mother_name" id="mother_name" value="<?php echo $result['Mname']; ?>" class="form-control" required/>
                    </div>

                <div class="form-group">
                    <label for="email">Email ID :</label>
                    <input type="text" name="email" id="email" value="<?php echo $result['email']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="gender">Gender :</label>
                    <select class="form-control" name="gender" id="gender">
                      <option value="Female" <?php if($result['gender']=='Female'){ echo "selected";} ?>>Female</option>
                      <option value="Male" <?php if($result['gender']=='Male'){ echo "selected";} ?>>Male</option>
                    </select>
                </div>
                    <div class="form-group">
                    <label for="phone">Phone :</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $result['Phone']; ?>" class="form-control" required/>
                </div>

  <div class="form-group">
                          <label class"input-group-text" for="class_teacher">Class:</label>
                          <select class="form-control form-control-lg" name="class_teacher" id="class_teacher"  >

                            <?php
                             include 'db.php';
                               $sql="select * from class";
                               $res=mysqli_query($conn,$sql);
                               ?>
                               <option value="" >select</option>
                               <?php
                               while($row=mysqli_fetch_assoc($res)){
                                   if($result['ClassTeacher']==$row['Id']){
                                    ?>
<option value="<?php echo $row['Id'] ?>" selected><?php echo $row['Class']." - ".$row['Sec'] ?></option>
<?php
                                   }
                                   else{
                                    ?>

                                      <option value="<?php echo $row['Id'] ?>" ><?php echo $row['Class']." - ".$row['Sec'] ?></option>
                                     <?php
                                   }
                             ?>

                          <?php } ?>
                          </select>
                        </div>

                <div class="form-group">
                    <label for="address">Address :</label>
                    <input type="text" name="address" id="address" value="<?php echo $result['Address']; ?>" class="form-control" required/>
                </div>

                <div class="form-group">
                <?php

$date = str_replace('/', '-', $result['DOB']);
$Date = date("Y-m-d", strtotime($date));

?>
                    <label for="birth_date">DOB :</label>
                    <input type="date" name="birth_date" id="birth_date" value="<?php echo $Date; ?>" class="form-control">
                </div>
                <input type="hidden"  name="Id" id="Id" value="<?php echo $result['Id'] ?>">

<?php }?>

</div>
<div class="col-lg-2">
<center>
<div class="image_show">
<?php
include 'db.php';
$id=$_GET['id'];
$sql= "SELECT * FROM teacher where Id='".$id."'";
$row=mysqli_query($conn,$sql);
while ($result = mysqli_fetch_array ($row)){?>
<img src=<?php echo "../images/".$result['Id'].".jpg" ?> width="100" height="100" />
<?php }?>
</div>
<div class="form-group ">
<label for="file">Image :</label>
<input type="file" name="file" id="file" value="<?php echo $result['Photograph']; ?>" class="form-control" />
</div>
</center>
</div>
    </div>


                <div class="form-submit">
                <a href="showteacher1.php?i=0"><input type="button" value="SHOW ALL" class="submit" name="update1" id="update1" class="btn btn-success" /> </a> </td>

                    <input type="submit" value="Submit Form" class="submit" name="submit" id="submit" class="btn btn-success"/>
                </div>
            </form>

    </div>


</div>

    <script type="text/javascript">
function checkt(){
   // alert("abcd");
var t=document.getElementById("phone").value;
var dat=new Date(document.getElementById("birth_date").value);

var one=1000*60*60*24;
var today=new Date(Date.now());
var diff=((Math.abs((today.getTime()-dat.getTime()))/(one))).toFixed(0);

var em=document.getElementById("email").value;

var i=1;
var j=1;
var k=1;
if(diff<6570)
{
    alert("Enter correct date");
    i=1;
}
else{
    i=0;
}
var phoneno = /^[6-9]\d{9}$/;
if(t.match(phoneno)){
    j=0;
}
else{
    alert("Enter correct phone number");
    j=1;
}
var email = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
if(!email.test(em)){
  k=1;
}
else{
  k=0;
}
if((i==1) || (j==1) || (k==1)){
    return false;
}
else{
    return true;
}

}
$(document).ready(function(){

$('#updateteacher').on('submit', function(e){
    //Stop the form from submitting itself to the server.
    e.preventDefault();

    if(checkt()){

    var name= $('#name').val();
    var fname=$('#father_name').val();
    var mname=$('#mother_name').val();
    var phone=$('#phone').val();
    var add=$('#address').val();
    var email=$('#email').val();
    var gender=$('#gender').val();
    var class_teacher=$('#class_teacher').val();
    var dob= document.getElementById("birth_date").value;
   var files = $('#file')[0].files;
   var fd = new FormData();

   fd.append('id',$('#Id').val());
   fd.append('name',name);
   fd.append('fname',fname);
   fd.append('mname',mname);
   fd.append('phone',phone);
   fd.append('add',add);

   fd.append('email',email);
   fd.append('gender',gender);
   fd.append('class_teacher',class_teacher);
   fd.append('dob',dob);

   fd.append('file',files[0]);
   fd.append('func','updateteacher');

   $.ajax({
     type: "POST",
     url: 'submit.php',
     processData:false,
     contentType: false,
     data: fd,
     success: function(data){

           if(data!=="0"){
             alert("File saved successfully");
           }
           else{
             alert("Failed to update.");
           }
           location.reload();
           // alert("kk");
     }
   });
 }
  });
  });
    </script>
</body>
</html>
