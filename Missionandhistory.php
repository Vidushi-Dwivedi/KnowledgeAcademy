<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'css_jslinks.php' ?>

      <link rel="stylesheet" href="header.css">
      <link rel="stylesheet" href="footer.css">
    <title>Mission and History</title>
    <style>
      .MAH{
        max-width: 100%;
        width:100%;
        height:400px;
        margin-top: 30px;
      }
      .heading1{
        color: white;
        font-weight: bold;

      }
      .heading2{
        color:rgb(94, 22, 189);
        font-weight: bold;

      }
      #block1{
        background: url("D:\sw\MAH1.jpg");
        background-color:rgb(94, 22, 189) ;
        padding-top: 50px;
      }
      #block2{
        background-color:rgb(221, 217, 217) ;
        padding-top: 50px;
      }
      .p1{
        color:white;
      }

    </style>
</head>
<body>
  <?php
   include 'header.html';
   ?>
    <img src="images/mission1.jpg" class="MAH">
    <div class="container-fluid">
        <div class="row" id="block1">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
              <h1 class="heading1">Mission</h1>
              <p class="p1">The New Orleans Charter Science and Mathematics High School is an open-admission public charter school that prepares all students for college admissions and successful careers. Sci High provides a rigorous high school curriculum with an emphasis in science and mathematics in a supportive environment of learning and respect that prepares students to make informed choices about post-secondary pursuits.</p>
          </div>
          <div class="col-sm-2">
          </div>
        </div>
        <div class="row" id="block2">
          <div class="col-sm-2">
          </div>
          <div class="col-sm-8">

            <h1 class="heading2">History</h1>
            <p>Founded in 1993 the New Orleans Center for Science & Math (SciHigh) operated as a half day program within the Orleans Parish School System offering specialized instruction in science, math, and technology, and providing an open door to any interested New Orleans high school student. Students attended partner schools for their other graduation requirements. The guiding principle: that students with a broad range of scholastic aptitudes can master science and mathematics concepts and information at a high level given the proper culture, faculty and school leader.</p>
            <p>Sci High students proved us right, consistently doing as well or better than students in the selective Orleans Parish magnet schools, even though we were not selective in our admissions. They gave us evidence that even those students with weak academic preparation and a broad range of scholastic aptitudes can master science and mathematics concepts, given a culture of high expectations and a respect for work and one another.</p>
            </div>
            <div class="col-sm-2">
            </div>


          </div>
        </div>
  <?php include 'footer.php' ?>
</body>
</html>
