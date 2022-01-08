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
    padding: 50px;
    margin: 0 auto;
    background: #fff;
    border-radius:40px;
    box-shadow:  5px 5px 13px #238f8d,
               -5px -5px 13px #2fc1bf;
   }
</style>

</head>
<body>
<?php

include('result_query.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST")
            {


    $class = $_POST['class'];
    $sec = $_POST['sec'];
    $class_after=$_POST['nextclass'];


                    $con = mysqli_connect('localhost','root');

                    mysqli_select_db($con, 'kacademy');
                    $sql="select max(Id) as 'ID' from Class";
                    $result=mysqli_query($con,$sql);
                    while($row=mysqli_fetch_array($result)){
                        $n=$row['ID'];
                      }
                      if($n==0){$id=300;}
                      else{$id=$n+1;}
              $sql="INSERT INTO `Class`(`Id`, `Class`, `Sec`,`Class_After`) VALUES ('".$id."' , '".$class."' , '".$sec."','".$class_after."')";
              if (mysqli_query($con, $sql)) {
                             echo showResult( "Added Successfully.",true);
                         }
                     else {
                         echo showResult( "Failed to add.", false);
                     }

            }


    ?>

    <div class="main">
        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="images/signup-img.jpg" alt="">
                </div>
                <div class="signup-form">
                    <div class="col-lg-12">
                    <form method="POST" class="register-form" id="register-form" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <h2 class="text-center">Class form</h2>
                        <div class="form-row">

                            <div class="form-group">
                                <label for="class">Class :</label>
                                <input type="text" name="class" id="class" class="form-control" required/>
                            </div>

                        </div>
                        <div class="form-group">
                                <label for="sec">Sec :</label>
                                <input type="text" name="sec" id="sec" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                    <label for="sec">Next Class :</label>
                                    <select class="form-control form-control-lg" name="nextclass" id="nextclass"  required/>
                                      <option value="0">Passout</option>
                                    </select>
                            </div>

                        <div class="form-submit">
                        <a href="showclass.php"><input type="button" value="SHOW ALL" class="submit" name="update" id="update" class="btn btn-success" /> </a> </td>

                            <input type="submit" value="Submit Form" class="submit" name="submit" id="submit" class="btn btn-success"/>
                        </div>
                    </form>
  </div>
                </div>
            </div>
        </div>

    </div>

<script type="text/javascript">

    $(document).ready(function(){

           $.ajax({
             type: "POST",
             url: 'submit.php',
             data:{'func':'next_class'},
             success: function(data){
               console.log(data);
               data=JSON.parse(data);
               for(i=0;i<data.length;i++){
                 nextclass = document.getElementById('nextclass');
                 nextclass.options[nextclass.options.length] = new Option(data[i]["Class"]+"-"+data[i]["Sec"],data[i]["Id"]);
               }
             }

         });
  });
</script>
</body>
</html>
