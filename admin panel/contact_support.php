<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-Contact Support</title>
    <?php include 'css_jslinks.php'; ?>

    <style >
    /* head bar */

    .navbar-brand{
      font-family: 'Titillium Web', sans-serif;
      height:20%;
    }
    .navbar-brand .fa-comments{
      padding-right: 3%;
      font-size: 450%;
      color:#ff8838;
    }
    .feedback_heading{
      font-size:250%;
    }
    .head{
      padding-top: 5%;
      -webkit-box-shadow: 0 12px 12px -12px black;
         -moz-box-shadow: 0 8px 6px -6px black;
              box-shadow: 0 12px 12px -12px black;
    }
    /* table styling */

    .container{
      width: 100%;
      font-family: 'Noto Sans JP', sans-serif;
      margin-top: 5%;
    }
    .icon{
      color: black;
    }

    thead{
        font-family: 'Noto Sans JP', sans-serif;
        font-size: 1.2rem;
      }
      .active{
        background-color: #52f207;
        text-shadow: 0px 0px 1px  #2f3031;
        padding: 10% 10%;
        border-radius: 10px;
      }
      .inactive{
        background-color: #ff0000;
        color: white;
        text-shadow: 0px 0px 1px  white;
        padding: 10% 10%;
        border-radius: 10px;
      }
    </style>
  </head>
  <body>

    <!-- contact head -->

    <nav class="navbar navbar-light bg-light">
    <div class="container-fluid head">
      <a class="navbar-brand">
        <i class="fas fa-comments"></i></i><span class="feedback_heading">CONTACT SUPPORT</span>
      </a>
    </div>
  </nav>

  <!-- table contact support -->
    <center>
  <div class="container">

    <table class="table table-striped table-hover" id="feedback">
  <thead>
      <th>ID</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Message</th>
      <th>Status</th>
      <th>Date</th>
      <th>Reply</th>
      <th>Action</th>
  </thead>
  <tbody>

  </table>

  </div>

  </center>
  <script type="text/javascript">

     $(document).ready(function () {
          var dataTable = $('#feedback').DataTable({
              "responsive": true,
              "processing": true,
              "serverSide": true,
              "ajax": {
                  url: "submit.php", // json datasource
                  data: {func: 'pagination',page:"feedback"}, // Set the POST variable  array and adds action: getEMP
                  type: 'post',  // method  , by default get
              },
              error: function () {  // error handling
                alert("Error occured");
              }
          });
      });
  </script>

  </body>
</html>
