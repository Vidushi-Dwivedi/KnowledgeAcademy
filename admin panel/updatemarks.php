<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <title>Marks info</title>

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

              $ClassID = $_POST['ClassID'];
    $StudentID = $_POST['StudentID'];
    $examid = $_POST['examid'];
    $Year = $_POST['Year'];

    $EngLang = $_POST['EngLang'];
    $EngLit = $_POST['EngLit'];
    $HindiLang = $_POST['HindiLang'];
    $HindiLit = $_POST['HindiLit'];
    $Maths = $_POST['Maths'];
    $Science = $_POST['Science'];
    $SocialScience = $_POST['SocialScience'];
    $Computer = $_POST['Computer'];
    $GeneralKnowledge = $_POST['GeneralKnowledge'];
    $Art = $_POST['Art'];





                    $con = mysqli_connect('localhost','root');

                    mysqli_select_db($con, 'kacademy');
              $sql="UPDATE `marks1` SET `Year`='".$Year."',`EngLang`='".$EngLang."',`EngLit`='".$EngLit."',`HindiLang`='".$HindiLang."',`HindiLit`='".$HindiLit."',`Maths`='".$Maths."',`Science`='".$Science."',`SocialScience`='".$SocialScience."',`Computer`='".$Computer."',`GeneralKnowledge`='".$GeneralKnowledge."',`Art`='".$Art."' WHERE `ClassID`='".$ClassID."' && `StudentID`='".$StudentID."' && `examid`='".$examid."'";
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
                    <form method="POST" class="register-form" id="register-form" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <h2 class="text-center">Update Marks form</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="ClassID">ClassID :</label>
                                <input type="text" name="ClassID" id="ClassID" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label for="StudentID">StudentID :</label>
                                <input type="text" name="StudentID" id="StudentID" class="form-control" required/>
                            </div>

                        </div>
                        <div class="form-group">
                                <label for="examid">Exam ID :</label>
                                <input type="text" name="examid" id="examid" class="form-control" required/>
                            </div>
                            <div class="form-group">
                            <label for="Year">Year :</label>
                            <input type="Year" name="Year" id="Year" class="form-control" required/>
                        </div>
                            <div class="form-group">
                            <label for="EngLang">EngLang :</label>
                            <input type="text" name="EngLang" id="EngLang" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="EngLit">EngLit :</label>
                            <input type="text" name="EngLit" id="EngLit" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="HindiLang">HindiLang :</label>
                            <input type="text" name="HindiLang" id="HindiLang" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="HindiLit">HindiLit :</label>
                            <input type="text" name="HindiLit" id="HindiLit" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Maths">Maths :</label>
                            <input type="text" name="Maths" id="Maths" class="form-control">
                        </div>

                        <div class="form-row">
                            <label for="Science">Science :</label>
                            <input type="text" name="Science" id="Science" class="form-control"/>
                        </div>
                        <div class="form-row">
                            <label for="SocialScience">SocialScience :</label>
                            <input type="text" name="SocialScience" id="SocialScience" class="form-control"/>
                        </div>
                        <div class="form-row">
                            <label for="Computer">Computer :</label>
                            <input type="text" name="Computer" id="Computer" class="form-control"/>
                        </div>
                        <div class="form-row">
                            <label for="GeneralKnowledge">GeneralKnowledge :</label>
                            <input type="text" name="GeneralKnowledge" id="GeneralKnowledge" class="form-control"/>
                        </div>
                        <div class="form-row">
                            <label for="Art">Art :</label>
                            <input type="text" name="Art" id="Art" class="form-control"/>
                        </div>
                        <div class="form-submit">
                        <a href="showmarks.php"><input type="button" value="SHOW ALL" class="submit" name="update" id="update" class="btn btn-success" /> </a> </td>

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
