<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

  if(isset($_POST['func'])) {

    include 'db.php';

   // contact form submission
     if($_POST['func'] == 'otp'){
       $role=$_POST['role'];
       $user= $_POST['user'];

       $sql="select email from ".$role." where Name='".$user."'";
       $result=mysqli_query($conn,$sql);
       if(mysqli_num_rows($result)){
         $row=mysqli_fetch_array($result);
         $email=$row['email'];
         function sanitize_my_email($field) {
             $field = filter_var($field, FILTER_SANITIZE_EMAIL);
            if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
               return true;
            } else {
               return false;
            }
           }

            $subject = 'OTP for Forget Password.';
            $o=rand(100000,1000000);
            $message = 'Your OTP is '.$o.' Do not share it with anyone.';
            $headers = 'From: Knowledge Academy';

            //check if the email address is invalid $secure_check
            $secure_check = sanitize_my_email($email);
            if ($secure_check == false) {
              echo "Invalid email";
            }
            else { //send email
              $reply="Dear ".$user.",\n".$message;
              mail($email, $subject, $reply, $headers);
            }
             echo $o;
       }
       else{
         echo 0;
       }
     }
   }
 }
 ?>
