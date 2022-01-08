<?php
include 'db.php';
$attend_id=$_GET['attend_id'];
$teacher_id=$_GET['id'];
 $sql="delete from teacher_attendance where attendance_id='".$attend_id."' and teacher_id='".$teacher_id."'";
 if(mysqli_query($conn,$sql)){
   echo '<script>
alert("Leave Deleted Successfully.");
window.location.href="Teacher_Attendance_Portal.php";
</script>';

 }
 else{
   echo '<script>
alert("Leave could not be Deleted.");
window.location.href="Teacher_Attendance_Portal.php";
</script>';
 }

 ?>
