<?php
 include 'db.php';
 session_start();
$_SESSION['session']=session_id();

 function total_online()
{
  include 'db.php';
 $current_time=time();
 $timeout = $current_time - (60);

 $session_exist = mysqli_query($conn,"SELECT session FROM total_visitors WHERE session='".$_SESSION['session']."'");
 $session_check = mysqli_num_rows($session_exist);

 if($session_check==0 && $_SESSION['session']!="")
 {
  mysqli_query($conn,"INSERT INTO total_visitors values ('','".$_SESSION['session']."','".$current_time."')");
 }
 else
 {
  $sql = mysqli_query($conn,"UPDATE total_visitors SET time='".time()."' WHERE session='".$_SESSION['session']."'");
 }

 $select_total = mysqli_query($conn,"SELECT * FROM total_visitors WHERE time>= '$timeout'");
 $total_online_visitors = mysqli_num_rows($select_total);
 return $total_online_visitors;
}

if(isset($_POST['get_online_visitor']))
{
 $total_online=total_online();
 echo $total_online;
 exit();
}
?>
