<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <?php include 'css_jslinks.php' ?>
   <?php include 'db.php' ?>
    <title>Student info</title>

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
</style>

</head>
<body>

    <div class="main">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <div class="col-lg-12">
                    <form method="POST" class="register-form" id="register-form" enctype="multipart/form-data" >
                        <h2 class="text-center">Student registration form</h2>

                            <div class="form-group">
                                <label for="name">Name :</label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg" required/>
                            </div>
                            <div class="form-group">
                                <label for="father_name">Father Name :</label>
                                <input type="text" name="father_name" id="father_name" class="form-control form-control-lg" required/>
                            </div>

                        <div class="form-group">
                                <label for="mother_name">Mother Name :</label>
                                <input type="text" name="mother_name" id="mother_name" class="form-control form-control-lg" required/>
                            </div>
                            <div class="form-group">
                            <label for="file">Image :</label>
                            <input type="file" name="file" id="file" class="form-control form-control-lg" required/>
                        </div>
                            <div class="form-group">
                            <label for="phone">Phone :</label>
                            <input type="text" name="phone" id="phone" class="form-control form-control-lg" required/>
                        </div>
                        <div class="form-group">
                            <label for="address">Address :</label>
                            <input type="text" name="address" id="address" class="form-control form-control-lg" required/>
                        </div>
                        <div class="form-group">
                            <label for="address">Email :</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg" required/>
                        </div>
                        <div class="form-group">
                            <label class"input-group-text" for="gender">Gender :</label>
                            <select class="form-control form-control-lg" name="gender" id="gender" required/>
                              <option value="Female" selected>Female</option>
                              <option value="Male">Male</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label class"input-group-text" for="class_id">Class:</label>
                          <select class="form-control form-control-lg" name="class" id="classid"  required/>
                            <?php
                               $sql="select * from class";
                               $res=mysqli_query($conn,$sql);
                               while($row=mysqli_fetch_assoc($res)){
                             ?>
                            <option value="<?php echo $row['Id'] ?>"><?php echo $row['Class']." - ".$row['Sec'] ?></option>
                          <?php } ?>
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="birth_date">DOB :</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control form-control-lg">
                        </div>
                        </div>

                        <div class="form-submit">
                        <a href="student_paging.php?i=0"><input type="button" value="SHOW ALL"  name="update" id="update" class="btn btn-primary" /> </a> </td>

                            <input type="submit" value="Submit Form"  name="submit" id="submit" class="btn btn-success">
                        </div>
                    </form>
  </div>
                </div>
            </div>
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
if(diff<1825)
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
    $('#register-form').on('submit', function(e){
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
        var classid=$('#classid').val();
        var dob= document.getElementById("birth_date").value;
       var files = $('#file')[0].files;
       var fd = new FormData();
       fd.append('file',files[0]);
       fd.append('name',name);
       fd.append('fname',fname);
       fd.append('mname',mname);
       fd.append('phone',phone);
       fd.append('add',add);
       fd.append('email',email);
       fd.append('gender',gender);
       fd.append('classid',classid);
       fd.append('dob',dob);
       fd.append('func','add_student');
       $.ajax({
         type: "POST",
         url: 'submit.php',
         processData:false,
         contentType: false,
         data: fd,
         success: function(data){
               alert(data);
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
