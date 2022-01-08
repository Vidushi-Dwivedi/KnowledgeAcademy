<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <?php include 'db.php' ?>
    <title>Marks info</title>


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
                        <h2 class="text-center">Marks form</h2>
                        <div class="form-row">
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
                                <label for="StudentID">StudentID :</label>
                                <input type="text" name="StudentID" id="StudentID" class="form-control" required/>
                            </div>

                        </div>
                        <div class="form-group">
                          <label class"input-group-text" for="exam">Exam:</label>
                          <select class="form-control form-control-lg" name="exam" id="exam"  required/>
                            <?php
                               $sql="select * from exam1";
                               $res=mysqli_query($conn,$sql);
                               while($row=mysqli_fetch_assoc($res)){
                             ?>
                            <option  value="<?php echo $row['Id'] ?>"><?php echo $row['Name']?></option>
                          <?php } ?>
                          </select>
                            </div>
                            <div class="form-group">
                              <label class"input-group-text" for="year">Year:</label>
                              <select class="form-control form-control-lg" name="year" id="year"  required/>
                            <?php
                            $data=array();
                            $sql="select * from exam1";
                            $res=mysqli_query($conn,$sql);
                              while($row=mysqli_fetch_assoc($res)){
                                if(!in_array($row['year'],$data)){
                                  array_push($data,$row['year']);
                             ?>

                             <option value="<?php echo $row['year'] ?>"><?php echo $row['year']?></option>
                           <?php } }?>
                           </select>
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

<script type="text/javascript">
  var m=0;
function checkt(){
  var englang=document.getElementById('EngLang').value;
  var englit=document.getElementById('EngLit').value;
  var hindilang=document.getElementById('HindiLang').value;
  var hindilit=document.getElementById('HindiLit').value;
  var maths=document.getElementById('Maths').value;
  var science=document.getElementById('Science').value;
  var socialscience=document.getElementById('SocialScience').value;
  var comp=document.getElementById('Computer').value;
  var gk=document.getElementById('GeneralKnowledge').value;
  var art=document.getElementById('Art').value;
  var exam=document.getElementById('exam').value;

  $.ajax({
    type: "POST",
    url: 'submit.php',
    data:{func:'find_max_marks',examid:exam},
    success: function(data){
      data=JSON.parse(data);
      m=parseInt(data["max_marks"]);
      console.log(m);
    }
  });
  if(englang<=0 || englang>m || englit<=0 || englit>m || hindilit<=0 || hindilit>m || maths<=0 || maths>m ||hindilang<=0 || hindilang>m ||science<=0 || science>m ||socialscience<=0 || socialscience>m ||comp<=0 || comp>m ||gk<=0 || gk>m ||art<=0 || art>m){
   alert("Marks should range between 0 and "+m);
    return false;
  }
  else{

    return true;
  }
}
  $(document).ready(function(){

      $('#register-form').on('submit', function(e){
        e.preventDefault();

        if(checkt()){
          var class_id=document.getElementById('classid').value;
          var s_id=document.getElementById('StudentID').value;
          var exam=document.getElementById('exam').value;
          var year=document.getElementById('year').value;
          var englang=document.getElementById('EngLang').value;
          var englit=document.getElementById('EngLit').value;
          var hindilang=document.getElementById('HindiLang').value;
          var hindilit=document.getElementById('HindiLit').value;
          var maths=document.getElementById('Maths').value;
          var science=document.getElementById('Science').value;
          var socialscience=document.getElementById('SocialScience').value;
          var comp=document.getElementById('Computer').value;
          var gk=document.getElementById('GeneralKnowledge').value;
          var art=document.getElementById('Art').value;
          $.ajax({
            type: "POST",
            url: 'submit.php',
            data:{func:'add_marks',ClassID:class_id,examid:exam,StudentID:s_id,Year:year,EngLang:englang,EngLit:englit,HindiLang:hindilang,HindiLit:hindilit,Maths:maths,Science:science,SocialScience:socialscience,Computer:comp,GeneralKnowledge:gk,Art:art},
            success: function(data){
              alert(data);
            }
        });
}

});
});
</script>
</body>
</html>
