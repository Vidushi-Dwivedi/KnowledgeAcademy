<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php
    if(!isset($_SESSION))
    {
     session_start();
   }
    $id=$_SESSION["id"];

     ?>
    <?php include 'css_jslinks.php'; ?>
    <?php include 'db.php'; ?>
    <link rel="stylesheet" href="css/head.css">
    <link rel="stylesheet" href="css/profile_bar.css">
    <link rel="stylesheet" href="css/consultancy.css">
    <title>KnowledgeAcademy-Consultancy</title>

  </head>
  <body>
    <?php include 'headbar.php' ?>

    <!-- body -->

   <?php

   $sql="select * from student where Id='".$id."'";
   $result= mysqli_query($conn,$sql);
   $row=mysqli_fetch_array($result);
   $sql="select * from class where Id='".$row['ClassID']."'";
   $result= mysqli_query($conn,$sql);
   $row1=mysqli_fetch_array($result);
    ?>
    <div class="row body_row">
    <div class="col-lg-3 first_col">
    <center> <img src="<?php echo '../images/'.$row['Id'].'.jpg' ?>" class="profile_img" alt="">
    <div class="name_tag "><?php echo $row['Name']; ?></div>
    <div class="class_tag "><?php echo $row1['Class']; ?>-<?php  echo $row1['Sec'];?></div>
    </center>
    <center>
    <div class="inner_profile_base text-center">
      <div class="head">
        <center>PROFILE</center>
      </div>
      <div class="body">
        <table>
          <tr>
            <td>Academic Year :</td>
            <td><?php echo $row['year']; ?></td>
          </tr>
          <tr>
            <td>Student ID :</td>
            <td><?php echo $row['Id']; ?></td>
          </tr>
          <tr>
            <td>Father's Name :</td>
            <td><?php echo $row['Fname']; ?></td>
          </tr>
          <tr>
            <td>Mother's Name :</td>
            <td><?php echo $row['Mname']; ?></td>
          </tr>
          <tr>
            <td>Contact No :</td>
            <td><?php echo $row['Phone']; ?></td>
          </tr>
          <tr>
            <td>Address :</td>
            <td><?php echo $row['Address']; ?></td>
          </tr>
          <tr>
            <td>Date Of Birth :</td>
            <td><?php echo $row['DOB']; ?></td>
          </tr>
          <tr>
            <td>Password :</td>
            <td><?php echo $row['Password']; ?></td>
          </tr>
        </table>
    </div>
    </div>
    </center>
    </div>

    <div class="col col-lg-6 middle_col">
        <div class="chat_box">
          <div class="selection_div">
            <select class="form-control form-control-lg " id="teacher_select">
              <option value="0">Select</option>
           </select>
          </div>
          <div class="receiver_chat">

          <div class="reciever_div">
            <img id="reciever_img" src="" alt="">
            <span id="reciever_name"></span>
          </div>
          <div class="messages_div" id="messages_div">

          </div>
          <div class="input d-flex">
            <input class="form-control-lg" type="text" id="message" name="" value="">
            <i class="fas fa-paper-plane " id="send"></i>
          </div>
        </div>

      </div>
    </div>

    <div class="col-lg-3 third_col">
      <center>
        <div class="row1 new text-center">
          <div class="head">
            <span class="text">New Messages</span>
          </div>
          <div class="body" id="new_msg">

          </div>

        </div>
      </center>
    </div>
    </div>

    <script type="text/javascript">
    var id= <?php echo $id ?>;
     var b=0;
     var date=0;
     var user= [];
   function option_teacher(){
     $.ajax({
       type: "POST",
       url: 'student_submit.php',
       data: {func:'fetch_teacher_for_option',student_id:id},
       success: function(data){
        data= JSON.parse(data);
        var i=data.length;
        while(i>0){
          teacher_select = document.getElementById('teacher_select');
          teacher_select.options[teacher_select.options.length] = new Option(data[i-1]["name"],data[i-1]["id"]);
          i--;
        }
       }
     });
   }

  option_teacher();
 find_new_msg_()
  // sort data in order
          function GetSortOrder(prop) {
           return function(a, b) {
          if (a[prop] > b[prop]) {
              return 1;
          } else if (a[prop] < b[prop]) {
              return -1;
          }
          return 0;
         }
       }

      // format date
      function formatDate(date) {
       var d = new Date(date),
           month = '' + (d.getMonth() + 1),
           day = '' + d.getDate(),
           year = d.getFullYear();

       if (month.length < 2) month = '0' + month;
       if (day.length < 2) day = '0' + day;

       return [day, month, year].join('-');
   }

     function formatTime(date){
      var d = new Date(date);
      var add="";
      var min="";
      var hr="";
      if(d.getHours()>=12){
        add="pm";
      }
      else{
        add="am";
      }
      if(d.getMinutes()<10){
        min="0"+d.getMinutes();
      }
      else{  min=d.getMinutes();}
      if(d.getHours()>12){
        hr=d.getHours()-12;
      }
      else if(d.getHours()==0){
        hr="12";
      }
      else{hr=d.getHours();}
      if(hr<10){
        hr="0"+hr;
      }
      return hr+":"+min+" "+add;
     }

  // chat msgs
  function chat_msgs(t_id){
    $.ajax({
      type: "POST",
      url: 'student_submit.php',
      data: {func:'fetch_chat_msgs',student_id:id,teacher_id:t_id},
      success: function(data){
      data=JSON.parse(data);
      // console.log(data);
  // get sorted data in accordance with time stamp
      data.sort(GetSortOrder("timestamp"));
      var i=data.length;
      var l=0;
      while(l!=i){
       var date2= formatDate(data[l]["timestamp"].substring(0,10));

       var date1= new Date(data[l]["timestamp"].substring(0,10));
       date1.setHours(0,0,0,0);

       var time=formatTime(data[l]["timestamp"]);

       if(date==""){
         $(".messages_div").append("<div class='date'><span class='msg_wrap'>"+date2+"</span></div>");
         date=date1;
         date= new Date(date);
         date.setHours(0,0,0,0);
       }
       else if(date.valueOf()<date1.valueOf()){
         $(".messages_div").append("<div class='date'><span class='msg_wrap'>"+date2+"</span></div>");
         date=date1;

       }

       if(data[l]["sender_userid"]==id){
          $(".messages_div").append("<div class='sender'><span class='msg_wrap'>"+data[l]["message"]+" <span class='time'>"+time+"</span></span></div>");
       }
       else{
           $(".messages_div").append("<div class='reciever'><span class='msg_wrap'><span class='time'>"+time+"</span>"+data[l]["message"]+" </span></div>");
       }
       l=l+1;
     }

}
});
}

// fetch new msg after reciever has sent it
function refresh_sender_chat_msgs(t_id){
  $.ajax({
    type: "POST",
    url: 'student_submit.php',
    data: {func:'refresh_sender_chat_msgs',student_id:id,teacher_id:t_id},
    success: function(data){
      data=JSON.parse(data);
   var i=data.length;
   var l=0;
   while(l!=i){
     var date2= formatDate(data[l]["timestamp"].substring(0,10));

     var date1= new Date(data[l]["timestamp"].substring(0,10));
     date1.setHours(0,0,0,0);

     var time=formatTime(data[l]["timestamp"]);

     if(date==""){
       $(".messages_div").append("<div class='date'>"+date2+"</div>");
       date=date1;
       date= new Date(date);
       date.setHours(0,0,0,0);
     }
     else if(date.valueOf()<date1.valueOf()){
       $(".messages_div").append("<div class='date'><span class='msg_wrap'>"+date2+"</span></div>");
       date=date1;

     }

        $(".messages_div").append("<div class='sender'><span class='msg_wrap'>"+data[l]["message"]+" <span class='time'>"+time+"</span></span></div>");
     l=l+1;
   }
}
});
}

// fetch new messages send by teacher
function refresh_reciever_chat_msgs(t_id){
    // console.log("HI");
  $.ajax({
    type: "POST",
    url: 'student_submit.php',
    data: {func:'refresh_reciever_chat_msgs',student_id:id,teacher_id:t_id},
    success: function(data){
      data=JSON.parse(data);
   var i=data.length;
   var l=0;
   while(l!=i){
     var date2= formatDate(data[l]["timestamp"].substring(0,10));

     var date1= new Date(data[l]["timestamp"].substring(0,10));
     date1.setHours(0,0,0,0);

     var time=formatTime(data[l]["timestamp"]);

     if(date==""){
       $(".messages_div").append("<div class='date'><span class='msg_wrap'>"+date2+"</span></div>");
       date=date1;
       date= new Date(date);
       date.setHours(0,0,0,0);
     }
     else if(date.valueOf()<date1.valueOf()){
       $(".messages_div").append("<div class='date'>"+date2+"</div>");
       date=date1;

     }

      $(".messages_div").append("<div class='reciever'><span class='msg_wrap'><span class='time'>"+time+"</span>"+data[l]["message"]+" </span></div>");
     l=l+1;
   }
}
});

}
setInterval(function(){
  x=document.getElementById("teacher_select").value;
  if(x!=='0')
  {
    refresh_reciever_chat_msgs(x);
  }
  else{}
}, 1000);

//set reciever info divContainer
function reciever_info(t_id){
  $.ajax({
    type: "POST",
    url: 'student_submit.php',
    data: {func:'reciever_info',teacher_id:t_id},
    success: function(data){
      document.getElementById('reciever_name').innerHTML=data;
      document.getElementById('reciever_img').src= "..\\images\\"+t_id+".jpg";
      document.getElementById('reciever_img').style.visibility="visible";
    }
  });
}
// open chat on teacher change
  $("#teacher_select").change(function(){
    var i=document.getElementById("teacher_select").value;
    if(i!=0){
    date="";

    reciever_info(i);
    document.getElementById("messages_div").innerHTML="";
    chat_msgs(i);
    }
    else{
      document.getElementById('reciever_img').style.visibility="hidden";
      document.getElementById('reciever_name').innerHTML="";
      document.getElementById("messages_div").innerHTML="";
    }
});

// send new message
$("#send").click(function(){
  var t_id=document.getElementById("teacher_select").value;
  if(t_id!=0){
     var msg=document.getElementById("message").value;
     if(msg!=""){
       $.ajax({
         type: "POST",
         url: 'student_submit.php',
         data: {func:'send_new_msg',student_id:id,teacher_id:t_id,msg:msg},
         success: function(data){
           if(data==1){
             refresh_sender_chat_msgs(t_id);
             document.getElementById("message").value="";
           }
         }
       });
     }
  }
});
function index_of_user(data,user){
  for(i=0;i<data.length;i++){
    if(data[i]['sender_userid']==user){
      return i;
    }
  }
  return -1;
}
function find_new_users(data){
  var users=[];
  var l=data.length;
  var k=user.length;
  var i=0;
  var set={};
  while(i<l){
    if(k==0){
      set['sender_userid']= data[i]['sender_userid'];
      set['count']= 1;
      users.push(set);
      set={};
    }
    else{
        var p=index_of_user(users,data[i]['sender_userid']);
        if (p!==-1){
          users[p]['count']=users[p]['count']+1;
        }

      else{
        set['sender_userid']= data[i]['sender_userid'];
        set['count']= 1;
        users.push(set);
        set={};
      }
    }
    k=k+1;
    i=i+1;
  }
  // console.log(users);
  return users;
}

    function find_new_msg_(){
    $.ajax({
      type: "POST",
      url: 'student_submit.php',
      data: {func:'fetch_new_messages',student_id:id},
      success: function(data){
        data= JSON.parse(data);
        if(data.length==0){
          document.getElementById("new_msg").innerHTML="<i class='no_msg'>No new messages.</i>";
          b=1;
        }
        else{
          user=find_new_users(data);
          for(x=0;x<user.length;x++){
          var t_id=user[x]['sender_userid'];
          var c= user[x]['count'];
          $("#new_msg").append("<div class='d-flex new_msg_user mb-3 ' id='new_div_"+t_id+"'><img src='..\\images\\"+t_id+".jpg' class='p-2' id= 'new_msg_user_img'/><span class=' p-2 new_msg_user_name' id='new_user_"+t_id+"'></span><span class='ms-auto p-2 count' id='new_"+t_id+"'>"+c+"</span></div>");
          $.ajax({
            type: "POST",
            url: 'student_submit.php',
            data: {func:'new_msg_info',teacher_id:t_id},
            success: function(result){
              result=JSON.parse(result);
               document.getElementById('new_user_'+result[0]['id']).innerHTML=result[0]['name'];
            }
          });
      }
      }
      }
    });
  }

 // refresh new chats and msgs
 function refresh_new_msg_(){
 $.ajax({
   type: "POST",
   url: 'student_submit.php',
   data: {func:'refresh_new_messages',student_id:id},
   success: function(data){
     data= JSON.parse(data);
     if(data.length>0){
       if(b==1){
         document.getElementById("new_msg").innerHTML="";
         b=0;
       }
       var users=[];
     users=find_new_users(data);
     for(x=0;x<users.length;x++){
       var z=0;
       for(y=0;y<user.length;y++){
         if(user[y]['sender_userid']==users[x]['sender_userid']){
           if(user[y]['count']!==users[x]['count']){
             var a=parseInt(document.getElementById('new_'+users[x]['sender_userid']).innerHTML);
             document.getElementById('new_'+users[x]['sender_userid']).innerHTML=a+users[x]['count'];
             z=1;
           }
       }
      }
      if(z==0){
        var t_id=users[x]['sender_userid'];
        var c= users[x]['count'];
         $("#new_msg").append("<div class='d-flex new_msg_user mb-3' id='new_div_"+t_id+"'><img src='..\\images\\"+t_id+".jpg' class='p-2' id= 'new_msg_user_img'/><span class=' p-2 new_msg_user_name' id='new_user_"+t_id+"'></span><span class='ms-auto p-2 count' id='new_"+t_id+"'>"+c+"</span></div>");
         $.ajax({
              type: "POST",
              url: 'student_submit.php',
              data: {func:'new_msg_info',teacher_id:t_id},
              success: function(result){
                result=JSON.parse(result);
                console.log(result);
                 document.getElementById('new_user_'+result[0]['id']).innerHTML=result[0]['name'];
              }
            });
      }
     }
     }
   }
});
}
// refresh_new_msg_();
setInterval(function(){refresh_new_msg_()}, 10000);
$(document).on('click', '.new_msg_user', function(){
    var id = $(this).attr("id").substring(8);
    $(this).remove();
    $("#teacher_select").val(id).trigger('change');
});

    </script>
  </body>
</html>
