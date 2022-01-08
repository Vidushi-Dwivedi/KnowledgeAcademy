<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
echo "kjhkj";
  if(isset($_POST['func'])) {

    include 'db.php';

   // verify Teacher Attendance verification func
     if($_POST['func'] == 'verify_log_Teacher_Attendance'){
      $teacher_id=$_POST['teacher_id'];
      $date=$_POST['date'];
      $sql="select * from teacher where id='".$teacher_id."'";
      $result=mysqli_query($conn,$sql);
      $num= mysqli_num_rows($result);
      if($num!=0){

        $sql="select * from teacher_attendance where teacher_id='".$teacher_id."'and attendance_date='".$date."'";
        $result=mysqli_query($conn,$sql);
        $num= mysqli_num_rows($result);
        if($num==0){
          echo 1;
        }
        else{
          echo "Attendance already logged";
        }
      }
      else{
        echo "Invalid Teached ID.";
      }
  }

// log Teacher Attendance submit func
    if($_POST['func'] == 'submit_log_Teacher_Attendance'){

      $teacher_id=$_POST['teacher_id'];
      $date=$_POST['date'];
      $status=$_POST['status'];
      $sql= "select max(attendance_id) as ID from teacher_attendance";
      $result= mysqli_query($conn,$sql);
      $n=0;
      while($row=mysqli_fetch_array($result)){
        $n=$row['ID'];
      }
      if($n==0){$id=10001;}
      else{$id=$n+1;}

      $sql="insert into teacher_attendance(attendance_id, teacher_id, status,attendance_date) values ('".$id."','".$teacher_id."','".$status."','".$date."')";
      if(mysqli_query($conn,$sql)){
        echo 1;
      }
      else {
        echo 0;
      }
    }

 // edit log teacher func
    if($_POST['func'] == 'edit_log_Teacher_Attendance'){
     $status=$_POST['status'];
     $id=$_POST['attendance_id'];
     $sql="update teacher_attendance set Status='".$status."' where attendance_id='".$id."'";
     if(mysqli_query($conn,$sql)){
       echo "Edit Successfull";
     }
     else{
       echo "Edit Failed";
     }
    }

// delete teacher attendance
    if($_POST['func'] == 'delete_teacher_attendance'){
     $id=$_POST['attendance_id'];
     $sql="delete from teacher_attendance where attendance_id='".$id."'";
     if(mysqli_query($conn,$sql)){
       echo 1;
     }
     else{
       echo 0;
     }
    }

// contact form reply
  if($_POST['func'] == 'contact_support_reply'){
     $id=$_POST['id'];
     $reply=$_POST['reply'];
     $subject=$_POST['subject'];
     $sql="select * from feedback where Id=".$id;
     $result=mysqli_query($conn,$sql);
     while($row=mysqli_fetch_array($result)){
       $name=$row['Name'];
       $email=$row['Email'];
     }
     $headers = 'From: Knowledge Academy';

     function sanitize_my_email($field) {
         $field = filter_var($field, FILTER_SANITIZE_EMAIL);
        if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
           return true;
        } else {
           return false;
        }
       }
       $secure_check = sanitize_my_email($email);
       if ($secure_check == false) {
         echo "Invalid email";
       }
       else { //send email
         $reply="Dear ".$name.",\n".$reply;
         mail($email, $subject, $reply, $headers);
         echo "Replied Successfully";
       }

       $status='Inactive';
       $reply="Subject: ".$subject."\nReply:".$reply;
       $sql= "update feedback set Reply='".$reply."', Status='".$status."' where Id='".$id."'";
       mysqli_query($conn,$sql);
  }
  // upload gallery form
    if($_POST['func'] == 'gallery upload'){
      var_dump($_POST);
      var_dump($_FILES);
      echo $_FILES['file']['name'];
    }

// change password admin
if($_POST['func'] == 'admin_pass_change'){
      $sql="update admin set Password='".$_POST['password']."' where Id='".$_POST['id']."'";
      if(mysqli_query($conn,$sql)){
        echo "Password changed successfully.";
      }
      else{
        echo "Password could not be changed.";
      }
}


  // add class info;
if($_POST['func'] == 'addclassinfo'){


    $files = $_FILES['file']['tmp_name'];
    $file_name= $_FILES['file']['name'];
    $files1 = $_FILES['file1']['tmp_name'];
    $file_name1= $_FILES['file1']['name'];
    $files2 = $_FILES['file2']['tmp_name'];
    $file_name2= $_FILES['file2']['name'];
$classid = $_POST['classid'];

  $extension=pathinfo($file_name, PATHINFO_EXTENSION);
  $extension1=pathinfo($file_name1, PATHINFO_EXTENSION);
  $extension2=pathinfo($file_name2, PATHINFO_EXTENSION);

     if ((!in_array($extension, ['pdf', 'zip', 'docx'])) || (!in_array($extension1, ['pdf', 'zip', 'docx'])) || (!in_array($extension2, ['pdf', 'zip', 'docx']))) {
         echo "You file extension must be .zip, .pdf or .docx";
     } elseif (($_FILES['file']['size'] > 1000000) || ($_FILES['file1']['size'] > 1000000) || ($_FILES['file2']['size'] > 1000000)) { // file shouldn't be larger than 1Megabyte

         echo "File too large!";
     } else {
       $con = mysqli_connect('localhost','root');

       mysqli_select_db($con, 'kacademy');

       $destination="../uploads/timetable".$classid.".".$extension;
       $destination1="../uploads/syllabus".$classid.".".$extension1;
       $destination2="../uploads/scheme".$classid.".".$extension2;
       $destinationfile="timetable".$classid.".".$extension;
       $destinationfile1="syllabus".$classid.".".$extension1;
       $destinationfile2="scheme".$classid.".".$extension2;

         if ((move_uploaded_file($files, $destination)) && (move_uploaded_file($files1, $destination1)) && (move_uploaded_file($files2, $destination2))) {
                $sql="INSERT INTO `ClassInfo1`(`ClassId`,`TimeTable`, `Syllabus`, `Scheme`) VALUES ('".$classid."', '".$destinationfile."' , '".$destinationfile1."', '".$destinationfile2."' )";

                if (mysqli_query($con, $sql)) {
                   echo  "File Upload Successfully.";
               }
           else {
               echo "Failed to upload file.";
           }

  }
  }
  }

// add Student
if($_POST['func'] == 'add_student'){

$files = $_FILES['file']['tmp_name'];
$file_name= $_FILES['file']['name'];

$name = $_POST['name'];
$father_name = $_POST['fname'];
$mother_name = $_POST['mname'];
$email=$_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['add'];
$class_id = $_POST['classid'];
$gender= $_POST['gender'];
$birth_date = $_POST['dob'];
$year = date("Y");
//echo $year;
$sql="select * from student where Name='".$name."' and Fname='".$father_name."'and Mname='".$mother_name."' and phone='".$phone."' and DOB='".$birth_date."'";
if(mysqli_num_rows(mysqli_query($conn,$sql))==0){

  $extension=pathinfo($file_name, PATHINFO_EXTENSION);

   if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
       echo "You file extension must be .jpg, .jpeg or .png";
   } elseif ($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte

       echo ("File too large!");
   } else {

     $sql="select max(Id) as 'ID' from student";
     $result=mysqli_query($conn,$sql);
     while($row=mysqli_fetch_array($result)){
       $n=$row['ID'];
     }
     if($n==0){$id=100001;}
     else{$id=$n+1;}
     $destination="../images/".$id.".".$extension;

       if (move_uploaded_file($files, $destination)) {
        $password = "Stu".$id;
              $sql="INSERT INTO `student`(`Id`,`Name`, `Fname`, `Mname`, `Phone`, `Address`, `ClassID`, `Photograph`, `Password`, `DOB`, `year`,`online`,`gender`,`email`) VALUES ('".$id."','".$name."' , '".$father_name."' , '".$mother_name."' , '".$phone."' , '".$address."' , '".$class_id."', '".$destination."' , '".$password."' , '".$birth_date."' , '".$year."','0','".$gender."','".$email."')";
  if (mysqli_query($conn, $sql)) {
                 echo ( "File Upload Successfully.");
             }
         else {
             echo ( "Failed to upload file.");
         }

  }
  }
}
else{
  echo "Student already exists!";
}
}

// update student

include('db1.php');
if($_POST['func'] == 'update_student'){

$id = $_POST['id'];
$name = $_POST['name'];
$father_name = $_POST['fname'];
$mother_name = $_POST['mname'];
$email=$_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['add'];
$class_id = $_POST['classid'];
$gender= $_POST['gender'];
$birth_date = $_POST['dob'];


  if(!array_key_exists("file",$_FILES)){
    $q = " UPDATE `student` SET `Name`='".$name."',`Fname`='".$father_name."',`Mname`='".$mother_name."',`Phone`='".$phone."',`Address`='".$address."',`ClassID`='".$class_id."', `gender`='".$gender."',`email`='".$email."',`DOB`='".$birth_date."' WHERE `ID` = '".$id."' ";
    if(mysqli_query($con,$q)){

        echo "1";
    }
    else{
        echo  "0";
    }
  }
  else{
    $files = $_FILES['file']['tmp_name'];
      $file_name= $_FILES['file']['name'];
  $extension=pathinfo($file_name, PATHINFO_EXTENSION);
  $file_to_delete = "../images/".$id.".jpg";
  unlink($file_to_delete);
  $destination="../images/".$id.".".$extension;
  move_uploaded_file($files, $destination);

$q = " UPDATE `student` SET `Name`='".$name."',`Fname`='".$father_name."',`Mname`='".$mother_name."',`Phone`='".$phone."',`Address`='".$address."',`ClassID`='".$class_id."',`Photograph`='".$destination."', `gender`='".$gender."',`email`='".$email."',`DOB`='".$birth_date."' WHERE `ID` = '".$id."' ";
if(mysqli_query($con,$q)){

echo  "1";
}
else{
echo "0";
}
  }
}



}
}
 ?>
