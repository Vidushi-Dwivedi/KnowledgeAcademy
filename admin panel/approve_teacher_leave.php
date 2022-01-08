<?php
 include 'db.php';
 $id=$_GET['id'];
 $type=$_GET['type'];
 $day=$_GET['day'];
 $teacher_id=$_GET['t'];
 $sid=$_GET['sid'];
 $sql="update teacher_leave set Approval='Approved' , ActionBy='".$sid."'where Id='".$id."'";
 if(mysqli_query($conn,$sql))
 {
   $sql="select `".$type."` from leave_count where TeacherId='".$teacher_id."'";
   $row=mysqli_fetch_array(mysqli_query($conn,$sql));
   $c=$row[$type]-$day;
   $sql="update leave_count set `".$type."`= '".$c."' where TeacherId='".$teacher_id."'";
   if(mysqli_query($conn,$sql)){
     echo '<script>
  alert("Leave Approved.");
  window.location.href="LeaveRequest.php";
  </script>';

   }
   else{
     echo '<script>
  alert("Leave could not be approved.");
  window.location.href="LeaveRequest.php";
  </script>';
   }
 }
 else{
   echo '<script>
alert("Leave could not be approved.");
window.location.href="LeaveRequest.php";
</script>';
 }

 ?>
