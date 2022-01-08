<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-Notices</title>
    <!-- css link -->
    <?php include 'css_jslinks.php' ?>
    <link rel="stylesheet" href="notice_page.css">
    <link rel="stylesheet" href="header.css">
  </head>
  <body>
    <?php
    include('header.html');
    include('db.php');
    $sql="SELECT Title,Date FROM notice  order by str_to_date( Date, '%d/%m/%Y') desc ";

    $result = mysqli_query($conn,$sql);
     ?>
     <div class="layout">

       <?php foreach ($result as $row):?>

         <div class="notice_contain">
         <div class="notice_head">
           <h5><u><?php echo $row['Title']?></u></h5>
         </div>
         <div class= "notice_flex">
         <div class="notice_date">
           <?php echo $row['Date']?>
         </div>
         <div class="d_link_notice">
           <a id="notice_link1" href="Downloads.php?name=<?php echo $row['Title']?>.pdf"   target="self" media_type="pdf" download>[Download]</a>
         </div>
         </div>

       </div>
       <hr / class="style-four">
       <?php endforeach ?>

   </div>
  </body>
</html>
