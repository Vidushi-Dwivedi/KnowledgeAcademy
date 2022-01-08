<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include 'css_jslinks.php' ?>
    <title>Exam info</title>

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

    <div class="main">
        <div class="container">



                    <form method="POST" class="register-form" id="register-form" enctype="multipart/form-data">
                        <h2 class="text-center">Exam form</h2>


                            <div class="form-group">
                                <label for="name">Name :</label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg" required/>
                            </div>



                            <div class="form-group">
                                <label for="year">Year :</label>
                                <input type="text" name="year" id="year" class="form-control form-control-lg" required/>
                            </div>


                            <div class="form-group">
                                <label for="marks">Max Marks :</label>
                                <input type="text" name="marks" id="marks" class="form-control form-control-lg" required/>
                            </div>
                      
                        <div class="form-submit">
                        <a href="showexam.php"><input type="button" value="SHOW ALL" class="submit" name="update" id="update" class="btn btn-success" /> </a> </td>

                            <input type="submit" value="Submit Form" class="submit" name="submit" id="submit" class="btn btn-success"/>
                        </div>
                    </form>

        </div>

    </div>
<script type="text/javascript">

  function checkt(){
    var m=document.getElementById('marks').value;
    if(m<=0 || m>100){

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
            var n =document.getElementById('name').value;
            var y=document.getElementById('year').value;
            var m=document.getElementById('marks').value;
            $.ajax({
              type: "POST",
              url: 'submit.php',
              data:{func:'add_exam',name:n,year:y,marks:m},
              success: function(data){
                alert(data);
              }
          });
  }
  else{
    alert("Marks should range between 0 and 100");
  }
});
});
</script>

</body>
</html>
