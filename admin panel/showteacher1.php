<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

<title>KnowledgeAcademy-ShowTeacher</title>
<?php include 'css_jslinks.php' ?>
   <style media="screen">

    .notice_head_wrap{
  display: flex;
  justify-content: space-between;
}
  .notice_icon{
    color:green;
    text-align:left;
    margin-left: 3%;
    margin-right: 1%;
    width:15%;
    height: 15%;
  }
  .notice_head{
  font-family: 'Titillium Web', sans-serif;
display:inline-flex;
  width:30%;
  height:5%;
  }
  .notice_heading{
   padding-top: 2%;
   width:35%;
   font-size: 200%;
  }
  input {
    border: 6% black;
    border-style: inset;
    padding: 1% 1%;
    background: rgba(255,255,255,0.5);
    margin: 0 0 10px 0;
    width:50%;
}

.fa-plus-square{
color:black;
}
.add_notice{
  display: inline-flex;
  justify-content: space-around;
  width:200px;
  margin-right: 5%;
  font-family: 'Exo', sans-serif;
  font-size: 100%;
}
.btn-text{
  color:black;
}

  hr {
    height: 12px;
    border: 0;
    box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5);
}
.dataTables_info{
  text-align: left;
}
.dataTables_paginate{
  text-align: left;
}
.dataTables_paginate a {
display: inline-block;
padding: 10px;
color:black;
}
thead{
  font-family: 'Noto Sans JP', sans-serif;
  font-size: 0.8rem;
  text-align: center;
}
tbody{
  font-size: 0.8rem;
  text-align: center;
}
img{
  width:150px;
}
  .container{
  width: 100%;
  font-family: 'Noto Sans JP', sans-serif;
  margin-top: 5%;
  margin-left:3% !important;
  }
.notice_text{
  width:100%;
}
.container{
  margin: 0 !important;
}
</style>
</head>
<body>

<div class="notice_head_wrap">
<div class="notice_head">
  <span class="iconify notice_icon" data-icon="octicon:note-16" data-inline="false"></span>
  <div class="notice_heading">TEACHER</div>
</div>


  <div class="row">
    <div class="col-lg-4 col-md-6">
      <button type="button"  class="btn btn-light add_notice" >
       <i class="fa fa-plus-square fa-2x"></i>
       <a class="btn-text" href="addteacher.php"> Add Teacher</a>
     </button>
    </div>
</div>
</div>
<hr />

    <div class = "container">
     <center>

        <table class="table table-striped table-hover" id="teacher_paging">
            <thead>
                <th> ID </th>
                <th> Name </th>
                <th> Fathers Name </th>
                <th> Mothers Name </th>
                <th> Phone </th>
                <th> Email </th>
                <th> Gender </th>
                <th> Address </th>
                <th> Photo </th>
                <th> Password </th>
                <th> Class Teacher </th>
                <th> Date Of Birth </th>
                <th> Joining </th>
                <th> Update </th>
                <th> Delete </th>
</thead>

</table>

</center>
</div>
<script type="text/javascript">
$(document).ready(function () {
       var dataTable = $('#teacher_paging').DataTable({
           "responsive": true,
           "processing": true,
           "serverSide": true,
           "ajax": {
               url: "submit.php", // json datasource
               data: {func: 'pagination', page:'teacher_paging'}, // Set the POST variable  array and adds action: getEMP
               type: 'post',  // method  , by default get
           },
           error: function () {  // error handling
             alert("Error occured");
           }
       });
       var i=<?php echo $_GET['i']; ?>;
if(i==1){
  alert("Deleted.");
}
else if(i==2){
  alert("Deletion Failed.");
}
   });
</script>
</body>
</html>
