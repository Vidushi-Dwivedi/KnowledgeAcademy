<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <title>Class info</title>

    <!-- Font Icon -->
    <!-- <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css"> -->
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

  input, select {
  display: block;
  width: 100%;
  border: 1px solid #ebebeb;
  padding: 11px 20px;
  box-sizing: border-box;
  font-family: 'Montserrat';
  font-weight: 500;
  font-size: 13px; }
  input:focus, select:focus {
    border: 1px solid #ff6801; }

label {
  font-size: 14px;
  font-weight: bold;
  font-family: 'Montserrat';
  margin-bottom: 2px;
  display: block; }

  body {
  font-size: 13px;
  line-height: 1.8;
  color: white;
  font-weight: 400;
  background: rgb(94, 22, 189);
  padding: 90px 0; }

.container {
 color:black;
  position: relative;
  margin: 0 auto;
  background: #fff;
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
  font-size: 20px;
  text-transform: uppercase;
  margin-bottom: 32px; }
</style>

</head>
<body>


    
        <div class="container">
            
                    <div class="col-lg-12">
                    <div class="form_contain" id="updateclassinfo">
                    <form class="register-form" id="register-form" enctype="multipart/form-data" >
                        <h2 class="text-center">Class info updation form</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="classid">Class Id :</label>
                                <input type="text" name="classid" id="classid" class="form-control" required/>
                            </div>

                            <div class="form-group">
                            <label for="file">Time Table :</label>
                            <input type="file" name="file" id="file" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="file1">Syllabus :</label>
                            <input type="file" name="file1" id="file1" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="file2">Scheme :</label>
                            <input type="file" name="file2" id="file2" class="form-control" required/>
                        </div>
                        <div class="form-submit">
                        <a href="showclassinfo.php"><input type="button" value="SHOW ALL" class="submit" name="update" id="update" class="btn btn-success" /> </a>

                        <input type="submit"  class="submit" name="submit" id="submit" class="btn btn-success"/>
                        </div>
                    </form>
        </div>
  </div>
                </div>
         

    <script>



       // file ajax submission
                 $(document).ready(function(){
                   //alert("kkk");
                     $('#updateclassinfo').on('submit', function(e){
                         //Stop the form from submitting itself to the server.
                         e.preventDefault();
                         console.log("him");
                          var fd = new FormData();
                         var classid = $('#classid').val();
                         var files = $('#file')[0].files;
                         fd.append('file',files[0]);
                         var files = $('#file1')[0].files;
                         fd.append('file1',files[0]);
                         var files = $('#file2')[0].files;
                         fd.append('file2',files[0]);
                         // var file_data = $('#img').prop('files')[0];
                         // // // create form data and append the file
                         // var formData = new FormData();
                         // formData.append("image", file_data);


                         fd.append('func','updateclassinfo');
                         fd.append('classid',classid);
                         console.log(fd);


                         $.ajax({
                           type: "POST",
                           url: 'submit.php',
                           processData:false,
                           contentType: false,
                           data: fd,
                           success: function(data){
                                 console.log(data);
                                 location.reload();
                                 alert("kk");
                           }
                         })
                     });
                 });
      </script>
</body>
</html>
