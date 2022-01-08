<?php
include 'db.php';
$id=$_GET['id'];
$sid=$_GET['sid'];
$sql="update teacher_leave set Approval='Denied' , ActionBy='".$sid."'where Id='".$id."'";
if(mysqli_query($conn,$sql))
{
   echo '<script>
alert("Leave Denied.");
window.location.href="LeaveRequest.php";
</script>';
 }
 else{
   echo '<script>
alert("Leave could not be denied.");
window.location.href="LeaveRequest.php";
</script>';
 }


 ?>
