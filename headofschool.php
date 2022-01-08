<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'css_jslinks.php' ?>

      <link rel="stylesheet" href="header.css">
      <link rel="stylesheet" href="footer.css">
    <title>Head of School</title>
    <style>
      .HOS{
        max-width: 100%;
        width:100%;
        height: 400px;
        margin-top: 30px;

      }
      .heading{
        color: rgb(94, 22, 189);
        font-weight: bold;
        text-align: center;
      }
      .img{
        display:block;
        margin-left:auto;
        margin-right:auto;
        width:35px;
        height: 300px;
        border:3px solid  #1c2645;
box-shadow:  5px 5px 11px #0b0f1c;
      }
    </style>
</head>
<body>
  <?php
   include 'header.html';
   ?>
  <img src="images/hos1.jpg" class="HOS">
  <!--<h1 class="heading">Head of School</h1>
        <p>abcd</p>
        <img src="D:\sw\HOS2.jpg" class="center">-->


    <div class="container">
      <div class="row">
          <br><br>
      </div>
      <div class="row">
        <div class="col-sm-8">

        <h1 class="heading">Head of School</h1>
        <p>Spring of 2020 has challenged staff and students to find a new normal for learning, connected us in new ways, and required our champions to champion from afar. What I have most learned through this process is how much I appreciate the expertise our teachers bring to Knowledge Academy, the ways in which our students continue to work hard to grow and overall, appreciation for the little things in life - giving students a high five, a hug or being able to laugh out loud with many people around.</p>
        </div>
        <div class="col-sm-4 p-3">
          <img src="images/principal.jpg" style="width:350px" class="img">

        </div>
      </div>
    </div>
        <!-- Right-aligned media object
        <div class="media">
          <div class="media-body">
            <h4 class="media-heading">Right-aligned</h4>
            <p>abcd</p>
          </div>
          <div class="media-right">
            <img src="D:\sw\HOS2.jpg" class="media-object" style="width:60px">
          </div>
        </div>
      </div>
    -->
    <?php
     include 'footer.php';
     ?>
</body>
</html>
