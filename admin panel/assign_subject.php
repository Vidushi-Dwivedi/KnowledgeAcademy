<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include 'css_jslinks.php' ?>
    <?php include 'db.php' ?>
     <title>AssignSubject</title>


 <style>

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
   label{
     color: #222;
     font-family: 'Montserrat';
     font-size: large;
     font-weight: bold;
   }
 </style>

  </head>
  <body>
    <div class="container">

      <form id="register-form" class="register-form"  method="post">
        <h2 class="text-center">Assign Subject Form</h2>
        <div class="form-group">
          <label class"input-group-text" for="class_id">Class:</label>
          <select class="form-control form-control-lg" name="class" id="class"  required/>
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
          <label class"input-group-text" for="teacher">Teacher:</label>
          <select class="form-control form-control-lg" name="teacher" id="teacher"  required/>
            <option value="0">select</option>
            <?php
               $sql="select * from teacher order by Name asc";
               $res=mysqli_query($conn,$sql);
               while($row=mysqli_fetch_assoc($res)){
             ?>
            <option value="<?php echo $row['Id'] ?>"><?php echo $row['Name']?></option>
          <?php } ?>
          </select>
        </div>
                  <label class="form-check-label" for="">Subject Assigned :</label>
        <div class="row">
          <div class="col col-md-3 col-sm-6">
            <div class="form-check form-check-inline">
             <input class="form-check-input" type="checkbox" id="EngLit" value="EngLit">
             <label class="form-check-label" for="EngLit">EngLit</label>
            </div>
          </div>
          <div class="col col-md-3 col-sm-6">
            <div class="form-check form-check-inline">
             <input class="form-check-input" type="checkbox" id="EngLang" value="EngLang">
             <label class="form-check-label" for="EngLang">EngLang</label>
            </div>
          </div>
          <div class="col col-md-3 col-sm-6">
            <div class="form-check form-check-inline">
             <input class="form-check-input" type="checkbox" id="HindiLit" value="HindiLit">
             <label class="form-check-label" for="HindiLit">HindiLit</label>
            </div>
          </div>
          <div class="col col-md-3 col-sm-6">
            <div class="form-check form-check-inline">
             <input class="form-check-input" type="checkbox" id="HindiLang" value="HindiLang">
             <label class="form-check-label" for="HindiLang">HindiLang</label>
            </div>
          </div>
          </div>
          <div class="row">
          <div class="col col-md-3 col-sm-6">
            <div class="form-check form-check-inline">
             <input class="form-check-input" type="checkbox" id="Maths" value="Maths">
             <label class="form-check-label" for="Maths">Maths</label>
            </div>
          </div>
          <div class="col col-md-3 col-sm-6">
            <div class="form-check form-check-inline">
             <input class="form-check-input" type="checkbox" id="Science" value="Science">
             <label class="form-check-label" for="Science">Science</label>
            </div>
          </div>
          <div class="col col-md-3 col-sm-6">
            <div class="form-check form-check-inline">
             <input class="form-check-input" type="checkbox" id="SocialScience" value="SocialScience">
             <label class="form-check-label" for="SocialScience">Social Science</label>
            </div>
          </div>
          <div class="col col-md-3 col-sm-6">
            <div class="form-check form-check-inline">
             <input class="form-check-input" type="checkbox" id="Computer" value="Computer">
             <label class="form-check-label" for="Computer">Computer</label>
            </div>
          </div>
          </div>
          <div class="row">
          <div class="col-6">
            <div class="form-check form-check-inline">
             <input class="form-check-input" type="checkbox" id="GeneralKnowledge" value="GeneralKnowledge">
             <label class="form-check-label" for="GeneralKnowledge">General Knowledge</label>
            </div>
          </div>
          <div class="col-6">
            <div class="form-check form-check-inline">
             <input class="form-check-input" type="checkbox" id="Art" value="Art">
             <label class="form-check-label" for="Art">Art</label>
            </div>
          </div>
          </div>
          <div class="form-group">
              <input type="submit" value="Submit Form"  name="submit" id="submit" class="btn btn-success">
              <a href="show_assigned_subjects.php?i=0"> <button type="button" class="btn btn-outline-info" name="button">Show Assginment</button>  </a>
          </div>
        </div>
      </form>
    </div>

    <script type="text/javascript">

      function disablecheck(){
        $("#EngLit").removeAttr("disabled");
        $("#EngLang").removeAttr("disabled");
        $("#HindiLit").removeAttr("disabled");
        $("#HindiLang").removeAttr("disabled");
        $("#Maths").removeAttr("disabled");
        $("#Science").removeAttr("disabled");
        $("#SocialScience").removeAttr("disabled");
        $("#Computer").removeAttr("disabled");
        $("#GeneralKnowledge").removeAttr("disabled");
        $("#Art").removeAttr("disabled");
      }

      function check(class_id){
        disablecheck();
        $.ajax({
          type: "POST",
          url: 'submit.php',
          data:{'func':'get_subject','class':class_id},
          success: function(data){
            // console.log(data);
            if(data!==0){
              data=JSON.parse(data);
              for(var i=0;i<data.length;i++){
                if(data[i]['EngLit']==1){
                  $("#EngLit").attr("disabled", true);
                }
                if(data[i]['EngLang']==1){
                  $("#EngLang").attr("disabled", true);
                }
                if(data[i]['HindiLit']==1){
                  $("#HindiLit").attr("disabled", true);
                }
                if(data[i]['HindiLang']==1){
                  $("#HindiLang").attr("disabled", true);
                }
                if(data[i]['Maths']==1){
                  $("#Maths").attr("disabled", true);
                }
                if(data[i]['Science']==1){
                  $("#Science").attr("disabled", true);
                }
                if(data[i]['SocialScience']==1){
                  $("#SocialScience").attr("disabled", true);
                }
                if(data[i]['Computer']==1){
                  $("#Computer").attr("disabled", true);
                }
                if(data[i]['Generalknowledge']==1){
                  $("#GeneralKnowledge").attr("disabled", true);
                }
                if(data[i]['Art']==1){
                  $("#Art").attr("disabled", true);
                }
              }
            }
          }

      });

      }

      $(document).ready(function(){
        $('#class').trigger('change');
      });
      $('#class').change(function(){
        var c=document.getElementById('class').value;
          check(c);
      })

      function validate(){
        var t=  document.getElementById('teacher').value;
        if(t==0){
          alert('Select teacher.');
          return false;
        }
        else{
            var et=$("#EngLit").is(":checked");
            var el=$("#EngLang").is(":checked");
            var ht=$("#HindiLit").is(":checked");
            var hl=$("#HindiLang").is(":checked");
            var m=$("#Maths").is(":checked");
            var s=$("#Science").is(":checked");
            var ss=$("#SocialScience").is(":checked");
            var comp=$("#Computer").is(":checked");
            var gk=$("#GeneralKnowledge").is(":checked");
            var art=$("#Art").is(":checked");

            if(et==false && el==false && ht==false && hl==false && m==false && s==false && ss==false && comp==false && gk==false && art==false ){
              alert('Select a subject to be assigned.');
              return false;
            }
        }
        return true;
      }


      $('#register-form').on('submit', function(e){
        if(validate()){
          var c=document.getElementById('class').value;
          var t=  document.getElementById('teacher').value;

          var et=0;
          var el=0;
          var ht=0;
          var hl=0;
          var m=0;
          var s=0;
          var ss=0;
          var comp=0;
          var gk=0;
          var art=0;

          if($("#EngLit").is(":checked"))
          {
            et=1;
          }
          if($("#EngLang").is(":checked"))
          {
            el=1;
          }
          if($("#HindiLit").is(":checked"))
          {
            ht=1;
          }
          if($("#HindiLang").is(":checked"))
          {
            hl=1;
          }
          if($("#Maths").is(":checked"))
          {
            m=1;
          }
          if($("#Science").is(":checked"))
          {
            s=1;
          }
          if($("#SocialScience").is(":checked"))
          {
            ss=1;
          }
          if($("#Computer").is(":checked"))
          {
            comp=1;
          }
          if($("#GeneralKnowledge").is(":checked"))
          {
            gk=1;
          }
          if($("#art").is(":checked"))
          {
            art=1;
          }

          $.ajax({
            type: "POST",
            url: 'submit.php',
            data:{'func':'assign_subject','class':c,'teacher':t,'EngLit':et,'EngLang':el,'HindiLit':ht,'HindiLang':hl,'Maths':m,'Science':s,'SocialScience':ss,'Computer':comp,'GeneralKnowledge':gk,'Art':art},
            success: function(data){
              alert(data);
            }
          });
        }
        else{
          $('#class').trigger('change');
        }
      })




    </script>
  </body>
</html>
