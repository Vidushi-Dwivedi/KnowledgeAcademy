<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

  if(isset($_POST['func'])) {

    include 'db.php';

   // contact form submission
     if($_POST['func'] == 'contact'){
       $name=$_POST['name'];
       $email= $_POST['email'];
       $phone= $_POST['phone'];
       $feedback= $_POST['feedback'];
       $status='active';
        date_default_timezone_set("Asia/Kolkata");
       $date=date("Y-m-d H-i-s");

       $sql="insert into feedback(Name,Contact_no,Email,Message,Status,Date) values ('".$name."','".$phone."','".$email."','".$feedback."','".$status."','".$date."')";

       if(mysqli_query($conn,$sql)){

         function sanitize_my_email($field) {
             $field = filter_var($field, FILTER_SANITIZE_EMAIL);
            if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
               return true;
            } else {
               return false;
            }
           }
            $subject = 'Suggestion/Query Submission Confirmation';
            $message = 'Your Suggestion/query has been submitted succesfully.Our team support will contact you soon.';
            $headers = 'From: Knowledge Academy';
            //check if the email address is invalid $secure_check
            $secure_check = sanitize_my_email($email);
            if ($secure_check == false) {
              echo "Invalid email";
            }
            else { //send email
              $reply="Dear ".$name.",\n".$message;
              mail($email, $subject, $reply, $headers);
            }
             echo "Submitted Successfully.";
       }
       else{
         echo "Failed to Submit.";
       }
     }
   }
 }
 ?>
