<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

  if(isset($_POST['func'])) {

    include 'db.php';

   // attendance monthly chart data
     if($_POST['func'] == 'monthly_attendance_chart'){
       $month = $_POST['i'];
       $id=$_POST['student_id'];
       $sql="select * from student_attendance where status='present' and student_id='".$id."' and EXTRACT(MONTH FROM attendance_date)='".$month."'";
       $result1=mysqli_num_rows(mysqli_query($conn,$sql));
       $sql="select * from student_attendance where status='absent' and student_id='".$id."' and EXTRACT(MONTH FROM attendance_date)='".$month."'";
       $result2=mysqli_num_rows(mysqli_query($conn,$sql));
       $sql="select * from student_attendance where status='late'and student_id='".$id."' and EXTRACT(MONTH FROM attendance_date)='".$month."'";
       $result3=mysqli_num_rows(mysqli_query($conn,$sql));
       $sql="select * from student_attendance where status='half_day' and student_id='".$id."' and EXTRACT(MONTH FROM attendance_date)='".$month."'";
       $result4=mysqli_num_rows(mysqli_query($conn,$sql));
       $dataPoints1 = array(
        array("label"=>"Present", "symbol" => "P","y"=>$result1),
        array("label"=>"Absent", "symbol" => "Ab","y"=>$result2),
        array("label"=>"Late", "symbol" => "L","y"=>$result3),
        array("label"=>"Half Day", "symbol" => "HL","y"=>$result4),
      );
    echo json_encode($dataPoints1, JSON_NUMERIC_CHECK);
    }


    // attendance monthly table datasets
    if($_POST['func'] == 'monthly_attendance_table'){
      $month = $_POST['i'];
      $id=$_POST['student_id'];
      $sql="select * from student_attendance where student_id='".$id."' and EXTRACT(MONTH FROM attendance_date)='".$month."'";
      $result=mysqli_query($conn,$sql);
      $data = array();
      while($row = mysqli_fetch_assoc($result)){
        array_push($data,$row);
      }
      echo json_encode($data);
    }

    // change password student
    if($_POST['func'] == 'student_pass_change'){
          $sql="update student set Password='".$_POST['password']."' where Id='".$_POST['id']."'";
          if(mysqli_query($conn,$sql)){
            echo "Password changed successfully.";
          }
          else{
            echo "Password could not be changed.";
          }
    }

    // fetch new messages
    if($_POST['func'] == 'fetch_new_messages'){
        $id=$_POST['student_id'];
        $sql="select sender_userid from chat where reciever_userid='".$id."' and reciever_read = '0'";
        $result= mysqli_query($conn,$sql);
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
          array_push($data,$row);
        }
        $t= time();
        $sql="update student set last_session= FROM_UNIXTIME('".$t."') where Id='".$id."'";
        $result= mysqli_query($conn,$sql);
        echo json_encode($data);
    }

    //refresh new chats and chat_msgs
    if($_POST['func'] == 'refresh_new_messages'){
        $id=$_POST['student_id'];
        $sql="select last_session from student where Id='".$id."'";
        $result=mysqli_query($conn,$sql);
        foreach($result as $row):
        $sess= $row['last_session'];
        endforeach;
        $sql="select * from chat where reciever_userid='".$id."' and reciever_read = '0' and timestamp > '".$sess."'";
        $result= mysqli_query($conn,$sql);
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
          array_push($data,$row);
        }
        $t= time();
        $sql="update student set last_session= FROM_UNIXTIME('".$t."') where Id='".$id."'";
        $result= mysqli_query($conn,$sql);
        echo json_encode($data);

      }
    // teacher name for option
    if($_POST['func'] == 'fetch_teacher_for_option'){
       $sql="select id, name from teacher";
       $result= mysqli_query($conn,$sql);
       $data = array();
       while($row = mysqli_fetch_assoc($result)){
         array_push($data,$row);
       }
       echo json_encode($data);
    }

    // fetch chat with teacher
    if($_POST['func'] == 'fetch_chat_msgs'){
      $id=$_POST['student_id'];
      $t_id=$_POST['teacher_id'];
       $sql1="select * from chat where sender_userid='".$id."' and reciever_userid='".$t_id."' and status_sender='1' ";
       $sql2="select * from chat where sender_userid='".$t_id."' and reciever_userid='".$id."' and status_reciever='1' and reciever_read='1'";
       $result1= mysqli_query($conn,$sql1);
       $data = array();
       $result2= mysqli_query($conn,$sql2);
       $data = array();
       while($row = mysqli_fetch_assoc($result1)){
         array_push($data,$row);
       }
       while($row = mysqli_fetch_assoc($result2)){
         array_push($data,$row);
       }
       echo json_encode($data);
    }

 //refresh sender chat chat_msgs
 if($_POST['func'] == 'refresh_sender_chat_msgs'){
   $id=$_POST['student_id'];
   $t_id=$_POST['teacher_id'];
   $sql="select * from chat where sender_userid='".$id."' and reciever_userid='".$t_id."' and status_sender='1' and sender_read='0'";
   $result= mysqli_query($conn,$sql);
   $data = array();
   while($row = mysqli_fetch_assoc($result)){
     array_push($data,$row);
     $sql1="update chat set sender_read='1' where chat_id='".$row['chat_id']."'";
     $result1= mysqli_query($conn,$sql1);
   }

   echo json_encode($data);
}

//refresh reciever  chat_msgs
if($_POST['func'] == 'refresh_reciever_chat_msgs'){
  $id=$_POST['student_id'];
  $t_id=$_POST['teacher_id'];
  $sql="select * from chat where sender_userid='".$t_id."' and reciever_userid='".$id."' and status_sender='1' and reciever_read='0'";
  $result= mysqli_query($conn,$sql);
  $data = array();
  while($row = mysqli_fetch_assoc($result)){
    array_push($data,$row);
    $sql1="update chat set reciever_read='1' where chat_id='".$row['chat_id']."'";
    $result1= mysqli_query($conn,$sql1);
  }
  echo json_encode($data);
}
//reciever Info
if($_POST['func'] == 'reciever_info'){
  $t_id=$_POST['teacher_id'];
  $sql="select name from teacher where Id='".$t_id."'";
  $result= mysqli_query($conn,$sql);
  $data="";
  while($row = mysqli_fetch_assoc($result)){
    $data=$row['name'];
  }
  echo $data;
}
//new msg info
if($_POST['func'] == 'new_msg_info'){
  $t_id=$_POST['teacher_id'];
  $sql="select id,name from teacher where Id='".$t_id."'";
  $result= mysqli_query($conn,$sql);
  $data = array();
  while($row = mysqli_fetch_assoc($result)){
    array_push($data,$row);
  }
  echo json_encode($data);
}
    // send new msgs
    if($_POST['func'] == 'send_new_msg'){
      $id=$_POST['student_id'];
      $t_id=$_POST['teacher_id'];
      $msg=$_POST['msg'];
      $sql="insert into chat(sender_userid,reciever_userid,message,timestamp,status_sender,status_reciever,sender_read,reciever_read) values ('".$id."','".$t_id."','".$msg."',current_timestamp(),'1','1','0','0')";
      if(mysqli_query($conn,$sql)){
        echo 1;
      }
      else{
        echo 0;
      }
    }

    // class teacher check
    if($_POST['func'] == 'classteacher'){
      $sql="select * from student where Id='".$id."'";
      $result= mysqli_query($conn,$sql);
      $row=mysqli_fetch_array($result);
        $sql="select * from teacher where ClassTeacher='".$row['ClassID']."'";
        $result=mysqli_query($conn,$sql);
        $i=mysqli_num_rows($result);
        $row2=mysqli_fetch_array($result);
    }
 // class teacher check
    if($_POST['func'] == 'teacher'){
      $id=$_POST['student_id'];
        $sql="select Id, Name from teacher where Id in (select TeacherId from teaches where ClassId=(select ClassId from student where Id='".$id."'))";
        $data=array();
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        echo json_encode($data);
      }
}}
 ?>
