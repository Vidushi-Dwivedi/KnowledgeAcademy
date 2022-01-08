<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include 'css_jslinks.php' ?>
    <?php include 'db.php' ?>
    <title>KnowledgeAcademy-Promotion</title>
    <style media="screen">
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
    <div class="container">
        <h2 class="text-center">Student Promotion</h2>
        <form id="register-form" >


      <div class="form-group">
        <label class"input-group-text" for="class_id">Class:</label>
        <select class="form-control form-control-lg" name="class" id="classid"  required/>
        <option value="0">select</option>
        <option value="1">All</option>
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
        <label class"input-group-text" for="exam">Basis :</label>
        <select class="form-control form-control-lg" name="exam" id="exam"  required/>
        <option value="0">select</option>
          <?php
             $sql="select * from exam1";
             $res=mysqli_query($conn,$sql);
             while($row=mysqli_fetch_assoc($res)){
           ?>
          <option value="<?php echo $row['Id'] ?>"><?php echo $row['Name'] ?></option>
        <?php } ?>
        </select>
      </div>
      <div class="formgroup container-fluid" style="text-align:right">
          <input class="btn btn-outline-success btn-lg" type="submit" name="submit_button" required/>
      </div>
          </form>
    </div>
    <script>
    function checkt(){
      var classid= $('#classid').val();
      var exam=$('#exam').val();
      if(classid==0||exam==0){
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
            var classid= $('#classid').val();
            var exam=$('#exam').val();
            $.ajax({
              type: "POST",
              url: 'submit.php',
              data: {func:'validate_exam_for_promotion',classid:classid,exam:exam},
              success: function(data){
                if(data==0){
                     $.ajax({
                       type: "POST",
                       url: 'submit.php',
                       data: {func:'promote_student',classid:classid,exam:exam},
                       success: function(data){
                             if(data!=""){
                               alert(data);
                             }
                             else {
                               alert("Students Promoted");
                             }
                             // location.reload();
                             // alert("kk");
                       }
                       });
                     }
                     else{
                       alert( data);
                     }
                     }
                     });
}
          });
          });
        </script>
  </body>
</html>
