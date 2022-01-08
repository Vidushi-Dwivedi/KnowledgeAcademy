<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'css_jslinks.php' ?>
   <?php include 'db.php' ?>

    <title>Admin info</title>


<style>
#reset {
background: blue;
color: white;
margin-right: 8px;
}
#reset:hover {
background: red;
color: white;
}

#submit {
background: blue;
color: white;
}
#submit:hover {
background-color: red;
}
.submit {
width: 140px;
height: 40px;
display: inline-block;
font-family: 'Poppins';
font-weight: 400;
font-size: 13px;
padding: 10px;
border: none;
cursor: pointer;
}
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
.form-row{
  width:100% !important;
}
</style>

</head>
<body>



        <div class="container">


                    <div class="col-lg-12">
                        <div class="form_contain" id="addadmin">
                    <form method="POST" class="register-form" id="register-form" enctype="multipart/form-data" >
                        <h2 class="text-center">Admin registration form</h2>

                            <div class="form-group">
                                <label for="name">Name :</label>
                                <input type="text" name="name" id="name" class="form-control" required/>

                            <div class="form-group">
                <label for="role">Role</label>
                                <select class="form-control form-control-lg" id="role" name="role" required>
                                  <option value="Superadmin">SuperAdmin</option>
                                  <option value="Admin">Admin</option>
                                </select>
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
                            <label for="birth_date">DOB :</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control form-control-lg">
                        </div>
                            <div class="form-group">
                            <label for="file">Image :</label>
                            <input type="file" name="file" id="file" class="form-control" required/>
                        </div>
                            <div class="form-group">
                            <label for="phone">Phone :</label>
                            <input type="text" name="phone" id="phone" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="address">Address :</label>
                            <input type="text" name="address" id="address" class="form-control" required/>
                        </div>




                        <div class="form-submit">
                        <a href="dashboard.php"><input type="button" value="Dashboard" class="submit" name="update" id="update" class="btn btn-success" /> </a> </td>

                            <input type="submit" value="Submit Form" class="submit" name="submit" id="submit" class="btn btn-success"/>
                        </div>
                    </form>
        </div>
  </div>
                </div>

    <script>
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


       // file ajax submission
                 $(document).ready(function(){
                     $('#addadmin').on('submit', function(e){
                         //Stop the form from submitting itself to the server.
                         e.preventDefault();
                         if(checkt()){
                         var name = $('#name').val();
                         var role = $('#role').val();
                         var phone = $('#phone').val();
                         var address = $('#address').val();
                         var fname=$('#father_name').val();
        var mname=$('#mother_name').val();
        var email=$('#email').val();
        var dob= document.getElementById("birth_date").value;
        var gender=$('#gender').val();

                         // var file_data = $('#img').prop('files')[0];
                         // // // create form data and append the file
                         // var formData = new FormData();
                         // formData.append("image", file_data);

                         var fd = new FormData();
                         fd.append('func','addadmin');
                         fd.append('name',name);
                         fd.append('role',role);
                         fd.append('phone',phone);
                         fd.append('address',address);
                         fd.append('fname',fname);
       fd.append('mname',mname);
       fd.append('email',email);
       fd.append('gender',gender);
       fd.append('dob',dob);

                         var files = $('#file')[0].files;
                         fd.append('file',files[0]);
                         $.ajax({
                           type: "POST",
                           url: 'submit.php',
                           processData:false,
                           contentType: false,
                           data: fd,
                           success: function(data){
                                 alert(data);
                                 location.reload();
                           }
                         });
                         }
                     });
                 });
      </script>
</body>
</html>
