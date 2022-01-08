<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

  if(isset($_POST['func'])) {

    include 'db.php';

   // contact form submission
     if($_POST['func'] == 'otp_change'){
       $np=$_POST['np'];
       $cp= $_POST['cp'];

     }
   }
 }
 ?>
