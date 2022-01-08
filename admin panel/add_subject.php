<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include 'css_jslinks.php' ?>
    <?php include 'db.php' ?>
     <title>AddSubject</title>

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
        <h2 class="text-center">Add Subject Form</h2>
        <div class="form-group">
          <label class"input-group-text" for="subject">Subject Name:</label>
          <input type="text" class="form-control form-control-lg" id="subject" name="subject" placeholder="Subject Name" required>
        </div>

         <div class="form-group">
           <label class="form-check-label" for="">Class Assigned :</label>
           <?php
             $i=0;
             $sql="select * from class";
             $res=mysqli_query($conn,$sql);
             while($row=mysqli_fetch_assoc($res)){
             if($i%4==0){
            ?>
           <div class="row">
           <?php } ?>
             <div class="col  col-md-3 col-sm-6">
               <input class="form-check-input" type="checkbox" id="<?php echo $row['Id'] ?>" value="<?php echo $row['Id'] ?>">
               <label class="form-check-label" for="<?php echo $row['Id'] ?>"><?php echo $row['Class'] ?>-<?php echo $row['Sec'] ?></label>
             </div>
             <?php
             $i=$i+1;
             if($i%4==0){ ?>
           </div>
         <?php } } ?>
         </div>


          <div class="form-group">
              <input type="submit" value="Submit Form"  name="submit" id="submit" class="btn btn-success">
              <a href="subjects.php?i=0"> <button type="button" class="btn btn-outline-info" name="button">Show Subjects</button>  </a>
          </div>

        </form>
        </div>
<script type="text/javascript">
$('#register-form').on('submit', function(e){

    var c=document.getElementById('subject').value;
    var fd = new FormData();
    fd.append('func','Add_Subject');
    fd.append('Name',c);
//     for (var key of fd.keys()) {
//   console.log(key);
// }
    i=0;
    <?php
    $sql="select * from class";
    $res=mysqli_query($conn,$sql);
     while($row=mysqli_fetch_assoc($res)){
     ?>
     if($("#<?php echo $row['Id'] ?>").is(":checked"))
     {
       fd.append(i,<?php echo $row['Id'] ?>);
       i=i+1;
     }
     <?php
     }
     ?>
     for(var pair of fd.entries()) {
   console.log(pair[0]+ ', '+ pair[1]);
}
    $.ajax({
      type: "POST",
      url: 'submit.php',
      processData:false,
      contentType: false,
      data: fd,
      success: function(data){
        alert(data);
        // location.reload();
      }
    });

})

</script>
  </body>
</html>
