<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <title>Class update</title>

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

  body {
  font-size: 13px;
  line-height: 1.8;
  color: rgb(94, 22, 189);
  font-weight: 400;
  background: rgb(94, 22, 189);
  padding: 90px 0; }

.container {

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
<?php

include('result_query.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST")
            {

                $id = $_GET['id'];
                $class = $_POST['class'];
                $sec = $_POST['sec'];

                    $con = mysqli_connect('localhost','root');

                    mysqli_select_db($con, 'kacademy');
              $sql="UPDATE `Class` SET `Id`='".$id."',`Class`='".$class."',`Sec`='".$sec."' WHERE `Id`='".$id."'";
              if (mysqli_query($con, $sql)) {
                             echo showResult( "Updated Successfully.",true);
                         }
                     else {
                         echo showResult( "Failed to update.", false);
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
                    <?php  $id=$_GET['id'];?>
                    <form method="POST" class="register-form" id="register-form" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=".$id;?>">
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
                            <input type="hidden"  name="Id" value="<?php echo $result['Id'] ?>">
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


</body>
</html>
