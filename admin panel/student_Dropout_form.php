<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include 'css_jslinks.php' ?>
    <?php include 'db.php' ?>
    <title>KnowledgeAcademy-StudentDropoutForm</title>
    <style media="screen">
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
    <div class="container">
                <div class="col-lg-12">
                <form method="POST" class="register-form" id="register-form" enctype="multipart/form-data" >
                    <h2 class="text-center">Student Dropout Form</h2>

                        <div class="form-group">
                            <label for="id">Student Id :</label>
                            <input type="text" name="id" id="id" class="form-control form-control-lg" required/>
                        </div>
                        <div class="form-group">
                            <label for="reason">Reason :</label>
                            <textarea name="reason" id="reason" class="form-control form-control-lg" required></textarea>
                        </div>
                    <div class="form-group">
                        <input type="submit" value="Submit Form" name="submit" id="submit" class="btn btn-success">
                    </div>
                </form>
</div>
<script type="text/javascript">
  function checkt(){
    var i=0;
    var j=0;
    var id=document.getElementById("id").value;
    id=parseInt(id);
    var reason=document.getElementById("reason").value;
    var numbers = new RegExp("\\d{6}");
      if( numbers.test(id)){
        i=1;
      }
      else{
        document.getElementById("id").setCustomValidity("Invalid StudentID. It should be a 6 digit number.");
      }
    if(reason==""){
      document.getElementById("reason").setCustomValidity("Reason cannot be empty");
    }
    else{
      j=1;
    }
    if(i==1&&j==1){
      return true;
    }
    else{
      return false;
    }
  }

  $(document).ready(function(){
      $('#register-form').on('submit', function(e){
          //Stop the form from submitting itself to the server.
          e.preventDefault();
          if(checkt()){
            var id=document.getElementById("id").value;
            var reason=document.getElementById("reason").value;
            $.ajax({
              type: "POST",
              url: 'submit.php',
              data: {func:'dropout_student_form',student_id:id,reason:reason},
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
