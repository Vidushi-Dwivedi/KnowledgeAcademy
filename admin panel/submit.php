<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

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
              $sql="INSERT INTO `student`(`Id`,`Name`, `Fname`, `Mname`, `Phone`, `Address`, `ClassID`, `Photograph`, `Password`, `DOB`, `year`,`online`,`gender`,`email`,`admission_class`) VALUES ('".$id."','".$name."' , '".$father_name."' , '".$mother_name."' , '".$phone."' , '".$address."' , '".$class_id."', '".$destination."' , '".$password."' , '".$birth_date."' , '".$year."','0','".$gender."','".$email."','".$class_id."')";
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


// add exam
  if($_POST['func'] == 'add_exam'){
                  $name = $_POST['name'];
                  $year = $_POST['year'];
                  $marks=$_POST['marks'];
                  $con = mysqli_connect('localhost','root');

                  mysqli_select_db($con, 'kacademy');

                  $sql="select Name from exam1 where Name='".$name."'";
                  if(mysqli_num_rows(mysqli_query($con,$sql))==0){

                  $sql="select max(Id) as 'ID' from exam1";
                  $result=mysqli_query($con,$sql);
                  while($row=mysqli_fetch_array($result)){
                      $n=$row['ID'];
                    }
                    if($n==0){$id=900;}
                    else{$id=$n+1;}
                  $sql="INSERT INTO `exam1`(`Id`, `Name`,`year`,`max_marks`) VALUES ('".$id."' ,'".$name."','".$year."','".$marks."' )";

                  if (mysqli_query($con, $sql)) {
                           echo "Added Successfully.";
                       }
                   else {
                       echo  "Failed to add.";
                   }

          }
        else{
          echo "Exam already exists";
        }
}

// update exam
if($_POST['func'] == 'update_exam'){
$id = $_POST['id'];
$name = $_POST['name'];
$year = $_POST['year'];
$marks = $_POST['marks'];
$q = " UPDATE `exam1` SET `Name`='".$name."',`year`='".$year."', `max_marks`='".$marks."' WHERE `Id` = '".$id."' ";
$result = mysqli_query($con,$q);
if($result){
    echo "Update Successfully.";
}
else{
    echo "Failed to update.";
}
}

// find max marks for selected exam
if($_POST['func'] == 'find_max_marks'){
  $examid = $_POST['examid'];
  $sql="select max_marks from exam1 where Id='".$examid."'";
  $row= mysqli_fetch_assoc(mysqli_query($conn,$sql));
  echo json_encode($row);
}

// add marks
if($_POST['func'] == 'add_marks'){

$ClassID = $_POST['ClassID'];
$StudentID = $_POST['StudentID'];
$examid = $_POST['examid'];
$Year = $_POST['Year'];

$EngLang = $_POST['EngLang'];
$EngLit = $_POST['EngLit'];
$HindiLang = $_POST['HindiLang'];
$HindiLit = $_POST['HindiLit'];
$Maths = $_POST['Maths'];
$Science = $_POST['Science'];
$SocialScience = $_POST['SocialScience'];
$Computer = $_POST['Computer'];
$GeneralKnowledge = $_POST['GeneralKnowledge'];
$Art = $_POST['Art'];


$sql="select * from student where Id='".$StudentID."' and ClassID='".$ClassID."'";
if(mysqli_num_rows(mysqli_query($conn,$sql))==1){

      $sql="INSERT INTO `marks1`(`ClassID`, `StudentID`, `examid`, `Year`, `EngLang`, `EngLit`, `HindiLang`, `HindiLit`, `Maths`, `Science`, `SocialScience`, `Computer`, `GeneralKnowledge`, `Art`) VALUES ('".$ClassID."' , '".$StudentID."' , '".$examid."' , '".$Year."' , '".$EngLang."' , '".$EngLit."', '".$HindiLang."' , '".$HindiLit."' , '".$Maths."' , '".$Science."', '".$SocialScience."' , '".$Computer."' , '".$GeneralKnowledge."' , '".$Art."')";
      if (mysqli_query($conn, $sql)) {
               echo "Added Successfully.";
           }
       else {
           echo "Failed to add.";
       }

}
else{
  echo "Student does not exist!";
}
}

// update marks
if($_POST['func'] == 'update_marks'){

  $ClassID = $_POST['ClassID'];
  $StudentID = $_POST['StudentID'];
  $examid = $_POST['examid'];
  $Year = $_POST['Year'];

      $EngLang = $_POST['EngLang'];
      $EngLit = $_POST['EngLit'];
      $HindiLang = $_POST['HindiLang'];
      $HindiLit = $_POST['HindiLit'];
      $Maths = $_POST['Maths'];
      $Science = $_POST['Science'];
      $SocialScience = $_POST['SocialScience'];
      $Computer = $_POST['Computer'];
      $GeneralKnowledge = $_POST['GeneralKnowledge'];
      $Art = $_POST['Art'];





      $con = mysqli_connect('localhost','root');
      echo "abc";
      mysqli_select_db($con, 'kacademy');
      $sql="UPDATE `marks1` SET `EngLang`='".$EngLang."',`EngLit`='".$EngLit."',`HindiLang`='".$HindiLang."',`HindiLit`='".$HindiLit."',`Maths`='".$Maths."',`Science`='".$Science."',`SocialScience`='".$SocialScience."',`Computer`='".$Computer."',`GeneralKnowledge`='".$GeneralKnowledge."',`Art`='".$Art."' WHERE `ClassID`='".$ClassID."' && `StudentID`='".$StudentID."' && `examid`='".$examid."' && `Year`='".$Year."'";
      if (mysqli_query($con, $sql)) {
          echo  "Updated Successfully.";
      }
      else {
          echo "Failed to update.";
      }
  }


  // add admin;
  if($_POST['func'] == 'addadmin'){

        // echo "Hello";
        $files = $_FILES['file']['tmp_name'];
        $file_name= $_FILES['file']['name'];

  $name = $_POST['name'];
  $role = $_POST['role'];

  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $father_name = $_POST['fname'];
  $mother_name = $_POST['mname'];
  $email=$_POST['email'];
  $gender= $_POST['gender'];
  $birth_date = $_POST['dob'];
  $joining=date('Y-m-d H:i:s');

  $sql="select * from Admin where Name='".$name."' and Fname='".$father_name."'and Mname='".$mother_name."' and phone='".$phone."' and DOB='".$birth_date."'";
  if(mysqli_num_rows(mysqli_query($conn,$sql))==0){

      $extension=pathinfo($file_name, PATHINFO_EXTENSION);

         if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
             echo "You file extension must be .jpg, .jpeg or .png";
         } elseif ($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte

             echo "File too large!";
         } else {
          include 'db1.php';
           $sql="select max(Id) as 'ID' from Admin";
           $result=mysqli_query($con,$sql);
           while($row=mysqli_fetch_array($result)){
             $n=$row['ID'];
           }
           if($n==0){$id=200001;}
           else{$id=$n+1;}
           $destination="../images/".$id.".".$extension;

           if(move_uploaded_file($files, $destination)){
              $password = "Adm".$id;
       $sql="INSERT INTO `Admin`(`Id`,`Role`,`Name`,`Fname`,`Mname`,`gender`,`DOB`,`email`, `Phone`, `Address`, `Photograph`, `Password`,`joining`) VALUES ('".$id."','".$role."','".$name."' ,'".$father_name."','".$mother_name."','".$gender."','".$birth_date."','".$email."' ,'".$phone."' , '".$address."' , '".$destination."' , '".$password."', '".$joining."' )";
        if (mysqli_query($con, $sql)) {
                       echo "File Upload Successfully.";
                   }
               else {
                   echo "Failed to upload file.";
               }
}

      }
      }
      else{
        echo "Admin already exists!";
      }


    }

    // update admin;
    if($_POST['func'] == 'updateadmin'){


  //echo "abc";
      include 'db1.php';

  $id = $_POST['id'];
  $name = $_POST['name'];
  $father_name = $_POST['fname'];
  $mother_name = $_POST['mname'];
  $email=$_POST['email'];
  $role = $_POST['role'];


  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $gender= $_POST['gender'];
  $birth_date = $_POST['dob'];

  if(!array_key_exists("file",$_FILES)){
    $q = " UPDATE `Admin` SET `Role`='".$role."',`Name`='".$name."',`Fname`='".$father_name."',`Mname`='".$mother_name."',`email`='".$email."',`gender`='".$gender."',`DOB`='".$birth_date."',`Phone`='".$phone."',`Address`='".$address."' WHERE `ID` = '".$id."' ";

  if(mysqli_query($con,$q)){
    echo "File Upload Successfully.";
  }
  else{
    echo "Failed to upload file.";
  }
  }
  else{
    //echo "abc";
    $files = $_FILES['file']['tmp_name'];
  $file_name= $_FILES['file']['name'];
  $extension=pathinfo($file_name, PATHINFO_EXTENSION);
  $file_to_delete = "../images/".$id.".jpg";
  unlink($file_to_delete);
  $destination="../images/".$id.".".$extension;
  if(move_uploaded_file($files,$destination)){

    $q = " UPDATE `Admin` SET `Role`='".$role."',`Name`='".$name."',`Fname`='".$father_name."',`Mname`='".$mother_name."',`email`='".$email."',`gender`='".$gender."',`DOB`='".$birth_date."',`Phone`='".$phone."',`Address`='".$address."',`Photograph`='".$destination."' WHERE `ID` = '".$id."' ";

  if(mysqli_query($con,$q)){
    echo "File Upload Successfully.";
  }
  else{
    echo "Failed to upload file.";
  }
  }
  }


    }


  // add teacher
  if($_POST['func'] == 'addteacher'){
  $files = $_FILES['file']['tmp_name'];
              $file_name= $_FILES['file']['name'];
              $name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['add'];
$class_teacher = $_POST['class_teacher'];
$father_name = $_POST['fname'];
$mother_name = $_POST['mname'];
$email=$_POST['email'];
$gender= $_POST['gender'];
$birth_date = $_POST['dob'];
$joining=date('Y-m-d H:i:s');
//if($class_teacher=="0"){
 // $class_teacher="";
//}
$sql="select * from teacher where Name='".$name."' and Fname='".$father_name."'and Mname='".$mother_name."' and phone='".$phone."' and DOB='".$birth_date."'";
if(mysqli_num_rows(mysqli_query($conn,$sql))==0){
            $extension=pathinfo($file_name, PATHINFO_EXTENSION);
               if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                   echo "You file extension must be .jpg, .jpeg or .png";
               } elseif ($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte

                   echo "File too large!";
               } else {
                include('db1.php');
                $sql="select max(Id) as 'ID' from teacher";
                $result=mysqli_query($con,$sql);
                while($row=mysqli_fetch_array($result)){
                    $n=$row['ID'];
                  }
                  if($n==0){$id=100001;}
                  else{$id=$n+1;}
                  $destination="../images/".$id.".".$extension;
                   if (move_uploaded_file($files, $destination)) {
                    include('db1.php');
                    $password = "Teacher".$id;
              $sql="INSERT INTO `teacher`(`Id`,`Name`, `Fname`,`Mname`,`gender`,`DOB`,`email`, `Phone`, `Address`, `Photograph`, `Password`, `ClassTeacher`,`joining`) VALUES ('".$id."','".$name."','".$father_name."','".$mother_name."','".$gender."' ,'".$birth_date."','".$email."', '".$phone."' , '".$address."' , '".$destination."' , '".$password."' , '".$class_teacher."','".$joining."')";
              if (mysqli_query($con, $sql)) {
                             echo  "File Upload Successfully.";
                             if($gender=='Female'){
                               $sql="insert into leave_count(TeacherId) values('".$id."')";
                             }
                             else{
                               $sql="insert into leave_count(TeacherId,MaternityLeave) values('".$id."','0')";
                             }
                             mysqli_query($conn,$sql);
                         }
                     else {
                         echo "Failed to upload file.";
                     }

            }
            }
          }

else{
  echo "Teacher already exists!";
}
 }

 //update teacher
  include('db1.php');
  if($_POST['func'] == 'updateteacher'){

  $id = $_POST['id'];
  $name = $_POST['name'];
  $father_name = $_POST['fname'];
  $mother_name = $_POST['mname'];
  $email=$_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['add'];
  $class_teacher = $_POST['class_teacher'];
  $gender= $_POST['gender'];
  $birth_date = $_POST['dob'];


    if(!array_key_exists("file",$_FILES)){
      $q = " UPDATE `teacher` SET `Name`='".$name."',`Fname`='".$father_name."',`Mname`='".$mother_name."',`Phone`='".$phone."',`Address`='".$address."',`ClassTeacher`='".$class_teacher."', `gender`='".$gender."',`email`='".$email."',`DOB`='".$birth_date."' WHERE `ID` = '".$id."' ";
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

  $q = " UPDATE `teacher` SET `Name`='".$name."',`Fname`='".$father_name."',`Mname`='".$mother_name."',`Phone`='".$phone."',`Address`='".$address."',`ClassTeacher`='".$class_teacher."',`Photograph`='".$destination."', `gender`='".$gender."',`email`='".$email."',`DOB`='".$birth_date."' WHERE `ID` = '".$id."' ";
  if(mysqli_query($con,$q)){

  echo  "1";
  }
  else{
  echo "0";
  }
    }
  }


// validate exam for promotion
if($_POST['func'] == 'validate_exam_for_promotion'){
  $classid = $_POST['classid'];
  $exam = $_POST['exam'];
  $k=0;
  $sql="select * from student where ClassID ='".$classid."'";
  $result=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($result)){
    $sql="select * from marks1 where ClassID='".$classid."' and StudentID='".$row['Id']."' and examid='".$exam."' and Year='".$row['year']."'";
    $res=mysqli_num_rows(mysqli_query($conn,$sql));
    if($res==0){
      echo "Marks of students in the selected class for the selected exam have not been entered.";
      $k=1;
      break;
    }
  }
  if($k==0){
    echo 0;
  }

}
// promote students
if($_POST['func'] == 'promote_student'){
  $classid = $_POST['classid'];
  $exam = $_POST['exam'];
  $yr=date("Y");
  $sql="select * from exam1 where Id='".$exam."'";
  $r=mysqli_fetch_assoc(mysqli_query($conn,$sql));
  $mm=$r['max_marks']*10;
  $error="";

 if($classid==1){
   $sql="select * from student";

 }
 else{
   $sql="select * from student where ClassID='".$classid."'";
 }
 $r=mysqli_query($conn,$sql);
 while($row=mysqli_fetch_assoc($r)){

   $sql="select * from marks1 where ClassID='".$row['ClassID']."' and StudentID='".$row['Id']."' and Year='".$row['year']."' and examid='".$exam."'";
   $r2=mysqli_fetch_assoc(mysqli_query($conn,$sql));
   $m=$r2['EngLit']+$r2['EngLang']+$r2['HindiLit']+$r2['HindiLang']+$r2['Maths']+$r2['Science']+$r2['SocialScience']+$r2['Computer']+$r2['GeneralKnowledge']+$r2['Art'];
   $m=($m/$mm)*100;

   if($m>=40){
     $sql="select * from class where Id='".$row['ClassID']."'";
     $r3=mysqli_fetch_array(mysqli_query($conn,$sql));

     if($r3['Class_After']!=0){
       $c=(int)($r3['Class_After']);
       $y=(string)($yr);

     $sql="update student set `ClassID` ='".$c."', `year`='".$y."' where `Id` ='".$row['Id']."'";
     if(mysqli_query($conn,$sql)==false){
       $error=$error."Student with ID=".$row['Id']." could not be promotted";
     }
   }
   else{
     $p="../images/".$row['Id'].".jpg";
     $year=date("Y");
     $sql="insert into alumini(StudentID,Name,Fname,Mname,Phone,Address,Photograph,DOB,Passout_year,gender,email,Admission_date,last_batch,admission_class,last_class) values('".$row['Id']."','".$row['Name']."','".$row['Fname']."','".$row['Mname']."','".$row['Phone']."','".$row['Address']."','".$p."','".$row['DOB']."','".$year."','".$row['gender']."','".$row['email']."','".$row['Admission_date']."','".$row['year']."','".$row['admission_class']."','".$row['ClassID']."')";
     if(mysqli_query($conn,$sql)==false){echo "Student promotion as alumini filed"; }
     else{
       $sql="delete from student where Id='".$row['Id']."'";
       mysqli_query($conn,$sql);
     }
   }
 }
 else{
   echo "Failed";
   // $p="C:/xampp/htdocs/kacademy/KnowledgeAcademy/text_files/Failures".$yr.".csv";
   // $sql="select s.`Id`, s.`Name`, s.`Fname`, s.`Mname`, s.`Phone`, s.`Address`, s.`ClassID`, s.`Password`, s.`DOB`, s.`year`, s.`gender`, s.`email`, s.`Admission_date`, s.`admission_class` ,m.`EngLang`, m.`EngLit`, m.`HindiLang`, m.`HindiLit`, m.`Maths`, m.`Science`, m.`SocialScience`, m.`Computer`, m.`GeneralKnowledge`, m.`Art` INTO OUTFILE '".$p."' FIELDS TERMINATED BY '|' from student s inner join marks1 m on m.StudentID=s.Id WHERE m.ClassID='".$row['ClassID']."' and m.StudentID='".$row['Id']."' and m.Year='".$row['year']."' and m.examid='".$exam."'";
   // mysqli_query($conn,$sql);
 }
 }
 echo $error;
}

// get data for next class
if($_POST['func'] == 'next_class'){

$sql="select * from class where Id not in (select Class_After from class)";
$result=mysqli_query($conn,$sql);
$data= array();
while($row=mysqli_fetch_array($result)){
      array_push($data,$row);
}
  echo json_encode($data);
}



if ($_POST['func'] == 'Notice_Upload')
        {
          $file = $_FILES['file']['tmp_name'];
          $title=$_POST['name'];
          $date=date('Y-m-d');


        $sql="select max(Id) as Id from notice";
        $row=mysqli_fetch_array(mysqli_query($conn,$sql));
        $id=$row['Id']+1;
        $file_name="Notice".$id.".pdf";

        $extension=pathinfo($file_name, PATHINFO_EXTENSION);
           if ($extension != "pdf") {
               echo ("Your file extension must be .pdf");
           }
           elseif ($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
               echo ("File too large!");
           }
           else {
             $destination= $_SERVER['DOCUMENT_ROOT']."/kacademy/KnowledgeAcademy/uploads/".$file_name;

               if (move_uploaded_file($file, $destination)) {

                 $sql="Select * from notice where Title='".$title."' and date='".$date."'";
                 $result=mysqli_query($conn, $sql);

                 if(mysqli_num_rows($result)==0){

                   $sql="INSERT INTO notice (Id,Title,Name,date) VALUES('".$id."','".$title."','".$file_name."','".$date."')";

                   if (mysqli_query($conn, $sql)) {
                                  echo ( "File Upload Successfully.");
                   }
                   else {
                              echo ( "Failed to upload file.");
                   }
                 }
                 else{
                   echo ("File already exists.");
                 }
        }
        }
        }


  if ($_POST['func'] == 'Notice_Edit')
 {
   $id=$_POST['id'];
   $title=$_POST['name'];
   $file_name="Notice".$id.".pdf";


   $value=$_POST['org_file'];
   $i=0;

   if(isset($_FILES['file'])){
     $file = $_FILES['file']['tmp_name'];
     $file_org=$_FILES['file']['name'];
     $extension=pathinfo($file_name, PATHINFO_EXTENSION);
        if ($extension != "pdf") {
            echo "Your file extension must be .pdf";
        }
        elseif ($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
            echo "File too large!";
        }
        else {
          $file_to_delete = "../uploads/".$value;
          unlink($file_to_delete);

          $destination= $_SERVER['DOCUMENT_ROOT']."/kacademy/KnowledgeAcademy/uploads/".$file_name;

            if (move_uploaded_file($file, $destination)) {

                $sql="update notice set Title='".$title."', Name='".$file_name."'  where Id='".$id."'";

                if (mysqli_query($conn, $sql)) {

                               echo "File Upload Successfully.";
                }
                else {
                           echo "Failed to upload file.";
                }

     }
     }
   }
   else{

     $sql="update notice set Title='".$title."'  where Id='".$id."'";


     if (mysqli_query($conn, $sql)) {
                    echo  "Record Updated Successfully.";
     }
     else {
              echo "Failed to update Record.";
     }
   }


   }
  //function to add Subjects
  if ($_POST['func'] == 'Add_Subject')
 {
   $a=$_POST['Name'];
   // $b=$_POST[1];
   // $c=$_POST[2];
   echo "$a";
  //  $sql="select * from subject_code where Name='".$_POST['Name']."'";
  //  $res=mysqli_query($conn,$sql);
  // if(mysqli_num_rows($res)==0){
  //   $sql="select * from subject_code";
  //   $i=mysqli_num_rows(mysqli_query($conn,$sql));
  //   $c='S'.$i;
  //   $i=count($_POST)-2;
  //   $n=$_POST['Name'];
  //   $p=0;
  //   $sql="insert into subject_code(Id,Name) values('".$c."','".$n."')";
  //   mysqli_query($conn,$sql);
  //     while($i>=0){
  //       $sql="insert into subject(ClassId,SubjectId) values('".$_POST[i]."','".$c."')";
  //       if(mysqli_query($conn,$sql)){
  //         $p=1;
  //       };
  //       $i=$i+1;
  //
  //   }
  //   echo $_POST;
  //   echo $p;
  //   if($p==0){
  //           echo("Subject added successfully");
  //   }
  //   else{
  //     echo "Error occured.Subject could not be added.";
  //   }
  // }
  // else{
  //   echo "Subject already exists.";
  // }
 }
   // function to get the data of subject teacher assignment
   function getassign($DBconnect)
   {
   // storing  request (ie, get/post) global array to a variable
       $requestData = $_REQUEST;
       $columns = array(
   // datatable column index  => database column name
           0 => 'ClassId',
           1 => 'TeacherId',
           2 => 'Eng Lit',
           3 => 'EngLang',
           4 => 'Hindi Lit',
           5 => 'Hindi Lang',
           6 => 'Maths',
           7 => 'Science',
           8 => 'SocialScience',
           9 => 'Computer',
           10 => 'General Knowledge',
           11 => 'Art',
           12 => 'Edit',
           13 => 'Delete'
       );
   // getting total number records without any search
       $sql = "SELECT *  ";
       $sql .= " FROM teaches";
       $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : teaches");
       $totalData = mysqli_num_rows($query);
       $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
       $sql = "SELECT * ";
       $sql .= " FROM teaches WHERE 1=1";
       if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
           $sql .= " AND ( ClassId LIKE '" . $requestData['search']['value'] . "%' ";
           $sql .= " OR TeacherId LIKE '" . $requestData['search']['value'] . "%' )";

       }
       $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get teaches");
       $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
       $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
       /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
       $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : teaches");
       $data = array();
       while ($row = mysqli_fetch_array($query)) {  // preparing an array

           $nestedData = array();
           $nestedData[] = $row["ClassId"];
           $nestedData[] = $row["TeacherId"];
           $nestedData[] = $row["EngLit"];
           $nestedData[] = $row["EngLang"];
           $nestedData[] = $row["HindiLit"];
           $nestedData[] = $row["HindiLang"];
           $nestedData[] = $row["Maths"];
           $nestedData[] = $row["Science"];
           $nestedData[] = $row["SocialScience"];
           $nestedData[] = $row["Computer"];
           $nestedData[] = $row["Generalknowledge"];
           $nestedData[] = $row["Art"];
           $nestedData[] ='<a class="icon" href="update_sub_Assign.php?c='.$row['ClassId'].'&t='.$row['TeacherId'].'"><i class="fa fa-edit "></i></a>';
           $nestedData[] = '<a class="icon" href="delete_teaches.php?c='.$row['ClassId'].'&t='.$row['TeacherId'].'"><i class="fa fa-trash"></i></a>';;

           $data[] = $nestedData;
       }
       $json_data = array(
           "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
           "recordsTotal" => intval($totalData),  // total number of records
           "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
           "data" => $data   // total data array
       );
       echo json_encode($json_data);  // send data as json format
   }



// function to get the data of alumini
function getalumini($DBconnect)
{
// storing  request (ie, get/post) global array to a variable
    $requestData = $_REQUEST;
    $columns = array(
// datatable column index  => database column name
        0 => 'Name',
        1 => 'Father Name',
        2 => 'Mother Name',
        3 => 'Phone',
        4 => 'Address',
        5 => 'Photograph',
        6 => 'DOB',
        7 => 'Passout Year',
        8 => 'Gender',
        9 => 'Email',
        10 => 'Admission Date',
        11 => 'Admission Class',
        12 => 'Last Batch',
        13 => 'Last Class',
        14 => 'StudentID',
    );
// getting total number records without any search
    $sql = "SELECT *  ";
    $sql .= " FROM alumini";
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get alumini");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
    $sql = "SELECT * ";
    $sql .= " FROM alumini WHERE 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( Name LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Fname LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Mname LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Phone LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  DOB LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Address LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR email LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR gender LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Passout_year LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  admission_class LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  last_batch LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  last_class LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  StudentID LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Admission_date LIKE '" . $requestData['search']['value'] . "%' )";

    }
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get alumini");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get alumini");
    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array

        $nestedData = array();
        $nestedData[] = $row["Name"];
        $nestedData[] = $row["Fname"];
        $nestedData[] = $row["Mname"];
        $nestedData[] = $row["Phone"];
        $nestedData[] = $row["Address"];
        $nestedData[] = '<img src="'.$row["Photograph"].'" />';
        $nestedData[] = $row["DOB"];
        $nestedData[] = $row["Passout_year"];
        $nestedData[] = $row["gender"];
        $nestedData[] = $row["email"];
        $nestedData[] = $row["Admission_date"];
        $nestedData[] = $row["admission_class"];
        $nestedData[] = $row["last_batch"];
        $nestedData[] = $row["last_class"];
        $nestedData[] = $row["StudentID"];

        $data[] = $nestedData;
    }
    $json_data = array(
        "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );
    echo json_encode($json_data);  // send data as json format
}

// function to get the data of dropout_student
function getstudentdropoout($DBconnect)
{
// storing  request (ie, get/post) global array to a variable
    $requestData = $_REQUEST;
    $columns = array(
// datatable column index  => database column name
        0 => 'Name',
        1 => 'Father Name',
        2 => 'Mother Name',
        3 => 'Phone',
        4 => 'Address',
        5 => 'Photograph',
        6 => 'DOB',
        7 => 'Passout Year',
        8 => 'Gender',
        9 => 'Email',
        10 => 'Admission Date',
        11 => 'Admission Class',
        12 => 'Last Batch',
        13 => 'Last Class',
        14 => 'StudentID',
        15 => 'Reason'
    );
// getting total number records without any search
    $sql = "SELECT *  ";
    $sql .= " FROM student_dropout";
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : student_dropout");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
    $sql = "SELECT * ";
    $sql .= " FROM student_dropout WHERE 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( Name LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Fname LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Mname LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Phone LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  DOB LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Address LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR email LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR gender LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Dropout_year LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  admission_class LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  last_batch LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  last_class LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  StudentID LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Reason LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Admission_date LIKE '" . $requestData['search']['value'] . "%' )";

    }
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get student_dropout");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : student_dropout");
    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array

        $nestedData = array();
        $nestedData[] = $row["Name"];
        $nestedData[] = $row["Fname"];
        $nestedData[] = $row["Mname"];
        $nestedData[] = $row["Phone"];
        $nestedData[] = $row["Address"];
        $nestedData[] = '<img src="'.$row["Photograph"].'" />';
        $nestedData[] = $row["DOB"];
        $nestedData[] = $row["Dropout_year"];
        $nestedData[] = $row["gender"];
        $nestedData[] = $row["email"];
        $nestedData[] = $row["Admission_date"];
        $nestedData[] = $row["admission_class"];
        $nestedData[] = $row["last_batch"];
        $nestedData[] = $row["last_class"];
        $nestedData[] = $row["StudentID"];
        $nestedData[] = $row["Reason"];

        $data[] = $nestedData;
    }
    $json_data = array(
        "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );
    echo json_encode($json_data);  // send data as json format
}


// function to get the data of dropout_staff
function getstaffdropoout($DBconnect)
{
// storing  request (ie, get/post) global array to a variable
    $requestData = $_REQUEST;
    $columns = array(
// datatable column index  => database column name
        0 => 'Name',
        1 => 'Father Name',
        2 => 'Mother Name',
        3 => 'Phone',
        4 => 'Address',
        5 => 'Photograph',
        6 => 'DOB',
        7 => 'Gender',
        8 => 'Email',
        9 => 'Joining',
        10 => 'Dropout',
        11 => 'Last Class Teacher',
        12 => 'AssignedID',
        13 => 'Role',
        14 => 'Reason'
    );
// getting total number records without any search
    $sql = "SELECT *  ";
    $sql .= " FROM staff_dropout";
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : staff_dropout");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
    $sql = "SELECT * ";
    $sql .= " FROM staff_dropout WHERE 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( Name LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Fname LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Mname LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Phone LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  DOB LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Address LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR email LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR gender LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR dropout LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  joining LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  last_ClassTeacher LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Role LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  AssignedID LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Reason LIKE '" . $requestData['search']['value'] . "%' )";

    }
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get staff_dropout");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : staff_dropout");
    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array

        $nestedData = array();
        $nestedData[] = $row["Name"];
        $nestedData[] = $row["Fname"];
        $nestedData[] = $row["Mname"];
        $nestedData[] = $row["Phone"];
        $nestedData[] = $row["Address"];
        $nestedData[] = '<img src="'.$row["Photograph"].'" />';
        $nestedData[] = $row["DOB"];
        $nestedData[] = $row["gender"];
        $nestedData[] = $row["email"];
        $nestedData[] = $row["joining"];
        $nestedData[] = $row["dropout"];
        $nestedData[] = $row["Last_ClassTeacher"];
        $nestedData[] = $row["Role"];
        $nestedData[] = $row["AssignedID"];
        $nestedData[] = $row["Reason"];

        $data[] = $nestedData;
    }
    $json_data = array(
        "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );
    echo json_encode($json_data);  // send data as json format
}



// function to get the data of notices
function getnotice($DBconnect)
{
// storing  request (ie, get/post) global array to a variable
    $requestData = $_REQUEST;
    $columns = array(
// datatable column index  => database column name
        0 => 'Id',
        1 => 'FileName',
        2 => 'Upload Date',
        3 => 'Action',
        4 => 'Edit',
        5 => 'Delete',
    );
// getting total number records without any search
    $sql = "SELECT *  ";
    $sql .= " FROM notice";
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get notice");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
    $sql = "SELECT * ";
    $sql .= " FROM notice WHERE 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( Title LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR `Date` LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Id LIKE '" . $requestData['search']['value'] . "%' )";
    }
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get notice");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get notice");
    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $nestedData = array();
        $nestedData[] = $row["Id"];
        $nestedData[] = $row["Title"];
        $nestedData[] = $row["Date"];
        $nestedData[] = '<a href="Downloads.php?name='. $row['Name'].'">Download</a>';
        $nestedData[] = '<a class="icon" href="notice_edit.php?id='.$row['Id'].'"><i class="fa fa-edit "></i></a>';
        $nestedData[] = '<a class="icon" href="notice_delete.php?id='.$row['Id'].'&name='.$row['Name'].'"><i class="fa fa-trash"></i></a>';

        $data[] = $nestedData;
    }
    $json_data = array(
        "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );
    echo json_encode($json_data);  // send data as json format
}


// function to get the data of pending leave requests
function getpendingrequests($DBconnect,$s_id)
{
// storing  request (ie, get/post) global array to a variable
    $requestData = $_REQUEST;
    $columns = array(
// datatable column index  => database column name
        0 => 'TeacherId',
        1=>'Teacher Name',
        2 => 'From Date',
        3 => 'To Date',
        4 => 'Type',
        5 => 'Document',
        6 => 'Reason',
        7 => 'Action'
    );
// getting total number records without any search
    $sql = "SELECT t.Id,t.TeacherId, n.Name, t.FromDate,t.ToDate, t.Type, t.Reason, t.Filename";
    $sql .= " FROM teacher_leave t inner join teacher n where t.TeacherId=n.Id and t.Approval='Pending'";
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get products");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
    $sql = "SELECT t.Id,t.TeacherId, n.Name, t.FromDate,t.ToDate, t.Type, t.Reason, t.Filename ";
    $sql .= " FROM teacher_leave t inner join teacher n where t.TeacherId=n.Id and t.Approval='Pending' and 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( TeacherId LIKE '" . $requestData['search']['value'] . "%' ";
          $sql .= " OR Name LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR FromDate LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR ToDate LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Type LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Reason LIKE '" . $requestData['search']['value'] . "%' )";
    }
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get products");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get products");
    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $i=0;
        $nestedData = array();
        $nestedData[] = $row["TeacherId"];
        $nestedData[] = $row["Name"];
        $nestedData[] = $row["FromDate"];
        $nestedData[] = $row["ToDate"];
        $nestedData[] = $row["Type"];
        $nestedData[] = $row["Reason"];
        if($row['Filename']==NULL){
          $nestedData[]="";
        }
        else{
          $nestedData[] = '<a href="Downloads.php?name='. $row['Filename'].'">Download</a>';
        }
        $nestedData[] = $row["Reason"];
        $d1 = strtotime($row["FromDate"]); // or your date as well
        $d2 = strtotime($row["ToDate"]);
        $datediff = $d2 - $d1;
        $d= round($datediff / (60 * 60 * 24))+1;
        $nestedData[] = '<a class="icon reply text-center" href="approve_teacher_leave.php?id= '.$row["Id"].'&type='.$row['Type'].'&day='.$d.'&t='.$row['TeacherId'].'&sid='.$s_id.'" style="text-align:center" ><i class="fas fa-check"></i></a>                <a class="icon reply text-center" href="deny_teacher_leave.php?id= '.$row["Id"].'&sid='.$s_id.'" style="text-align:center" ><i class="fas fa-times"></i></a>';
        $data[] = $nestedData;
    }
    $json_data = array(
        "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );
    echo json_encode($json_data);  // send data as json format
}


// function to get the data of deniedleave requests
function getdeniedrequests($DBconnect,$s_id)
{
// storing  request (ie, get/post) global array to a variable
    $requestData = $_REQUEST;
    $columns = array(
// datatable column index  => database column name
        0 => 'TeacherId',
        1=>'Teacher Name',
        2 => 'From Date',
        3 => 'To Date',
        4 => 'Type',
        5 => 'Document',
        6 => 'Reason',
        7 => 'Action'
    );
// getting total number records without any search
    $sql = "SELECT t.Id,t.TeacherId, n.Name, t.FromDate,t.ToDate, t.Type, t.Reason, t.Filename, t.Approval";
    $sql .= " FROM teacher_leave t inner join teacher n where t.TeacherId=n.Id and t.Approval='Denied' and t.ActionBy='".$s_id."'";
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get products");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
    $sql = "SELECT t.Id,t.TeacherId, n.Name, t.FromDate,t.ToDate, t.Type, t.Reason, t.Filename, t.Approval ";
    $sql .= " FROM teacher_leave t inner join teacher n where t.TeacherId=n.Id and t.Approval='Denied' and t.ActionBy='".$s_id."' and 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( TeacherId LIKE '" . $requestData['search']['value'] . "%' ";
          $sql .= " OR Name LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR FromDate LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR ToDate LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Type LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Reason LIKE '" . $requestData['search']['value'] . "%' )";
    }
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get products");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get products");
    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $i=0;
        $nestedData = array();
        $nestedData[] = $row["TeacherId"];
        $nestedData[] = $row["Name"];
        $nestedData[] = $row["FromDate"];
        $nestedData[] = $row["ToDate"];
        $nestedData[] = $row["Type"];

        if($row['Filename']==NULL){
          $nestedData[]="";
        }
        else{
          $nestedData[] = '<a href="Downloads.php?name='. $row['Filename'].'">Download</a>';
        }
        $nestedData[] = $row["Reason"];
        $nestedData[] = $row['Approval'];
        $data[] = $nestedData;
    }
    $json_data = array(
        "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );
    echo json_encode($json_data);  // send data as json format
}



// function to get the data of approvedleave requests
function getapprovedrequests($DBconnect,$s_id)
{
// storing  request (ie, get/post) global array to a variable
    $requestData = $_REQUEST;
    $columns = array(
// datatable column index  => database column name
        0 => 'TeacherId',
        1=>'Teacher Name',
        2 => 'From Date',
        3 => 'To Date',
        4 => 'Type',
        5 => 'Document',
        6 => 'Reason',
        7 => 'Action'
    );
// getting total number records without any search
    $sql = "SELECT t.Id,t.TeacherId, n.Name, t.FromDate,t.ToDate, t.Type, t.Reason, t.Filename, t.Approval";
    $sql .= " FROM teacher_leave t inner join teacher n where t.TeacherId=n.Id and t.Approval='Approved' and t.ActionBy='".$s_id."'";
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get products");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
    $sql = "SELECT t.Id,t.TeacherId, n.Name, t.FromDate,t.ToDate, t.Type, t.Reason, t.Filename, t.Approval ";
    $sql .= " FROM teacher_leave t inner join teacher n where t.TeacherId=n.Id and t.Approval='Approved' and t.ActionBy='".$s_id."' and 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( TeacherId LIKE '" . $requestData['search']['value'] . "%' ";
          $sql .= " OR Name LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR FromDate LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR ToDate LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Type LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Reason LIKE '" . $requestData['search']['value'] . "%' )";
    }
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get products");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get products");
    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $i=0;
        $nestedData = array();
        $nestedData[] = $row["TeacherId"];
        $nestedData[] = $row["Name"];
        $nestedData[] = $row["FromDate"];
        $nestedData[] = $row["ToDate"];
        $nestedData[] = $row["Type"];

        if($row['Filename']==NULL){
          $nestedData[]="";
        }
        else{
          $nestedData[] = '<a href="Downloads.php?name='. $row['Filename'].'">Download</a>';
        }
        $nestedData[] = $row["Reason"];
        $nestedData[] = $row['Approval'];
        $data[] = $nestedData;
    }
    $json_data = array(
        "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );
    echo json_encode($json_data);  // send data as json format
}


// function to get the data of teacher_attendance
function getteacherattendance($DBconnect)
{
// storing  request (ie, get/post) global array to a variable
    $requestData = $_REQUEST;
    $columns = array(
// datatable column index  => database column name
        0 => 'Attendance Id',
        1 => 'TeacherId',
        2=>'Teacher Name',
        3 => 'Status',
        4 => 'Attendance Date',
        5 => 'Edit',
        6 => 'Delete'
    );
// getting total number records without any search
    $sql = "SELECT t.attendance_id,t.teacher_id, n.Name, t.status,t.attendance_date";
    $sql .= " FROM teacher_attendance t inner join teacher n where t.teacher_id=n.Id ";
    $query = mysqli_query($DBconnect, $sql) or die("Mysql1 Mysql Error in getting : get products");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
    $sql = "SELECT t.attendance_id,t.teacher_id, n.Name, t.status,t.attendance_date ";
    $sql .= " FROM teacher_attendance t inner join teacher n where t.teacher_id=n.Id and 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( attendance_id LIKE '" . $requestData['search']['value'] . "%' ";
          $sql .= " OR Name LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR teacher_id LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR status LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR attendance_date LIKE '" . $requestData['search']['value'] . "%' )";
    }
    $query = mysqli_query($DBconnect, $sql) or die("Mysql2 Mysql Error in getting : get products");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
    // $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
    $query = mysqli_query($DBconnect, $sql) or die("Mysql3 Mysql Error in getting : get products");
    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $i=0;
        $nestedData = array();
        $nestedData[] = $row["attendance_id"];
        $nestedData[] = $row["teacher_id"];
        $nestedData[] = $row["Name"];
        $nestedData[] = $row["status"];
        $nestedData[] = $row["attendance_date"];
        $nestedData[] = '<a class="icon" href="teacher_attendance_edit.php?attend_id='.$row['attendance_id'].'&id='.$row['teacher_id'].'"><i class="fa fa-edit "></i></a>';
        $nestedData[] = '<a class="icon" href="delete_teacher_attendance.php?attend_id='.$row['attendance_id'].'&id='.$row['teacher_id'].'"><i class="fa fa-trash"></i></a>';
        $data[] = $nestedData;
    }
    $json_data = array(
        "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );
    echo json_encode($json_data);  // send data as json format
}


// function to get the data of feedback
function getfeedback($DBconnect)
{
// storing  request (ie, get/post) global array to a variable
    $requestData = $_REQUEST;
    $columns = array(
// datatable column index  => database column name
        0 => 'Id',
        1 => 'Name',
        2 => 'Contact_No',
        3 => 'Email',
        4 => 'Message',
        5 => 'Status',
        6 => 'Date',
        7 => 'Reply',
        8 => 'Action'
    );
// getting total number records without any search
    $sql = "SELECT *  ";
    $sql .= " FROM feedback";
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get products");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
    $sql = "SELECT * ";
    $sql .= " FROM feedback WHERE 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( Name LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Email LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR `Date` LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Status LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Contact_No LIKE '" . $requestData['search']['value'] . "%' )";
    }
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get products");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get products");
    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $i=0;
        $nestedData = array();
        $nestedData[] = $row["Id"];
        $nestedData[] = $row["Name"];
        $nestedData[] = $row["Contact_No"];
        $nestedData[] = $row["Email"];
        $nestedData[] = $row["Message"];
        $nestedData[] = $row["Status"];
        $nestedData[] = $row["Date"];
        if($row["Reply"]==""){
          $nestedData[]="No Reply";
        }
        else{
          $nestedData[] = $row["Reply"];
          $i=1;
        }
        if($i==0){
           $nestedData[]=  '<a class="icon reply text-center" href="contact_support_reply.php?id= '.$row["Id"].' &i='.$i.'" style="text-align:center" ><i class="fas fa-reply"></i></a>';
         }
         else{
           $nestedData[]= '<a class="icon reply text-center" href="contact_support_reply.php?id= '. $row["Id"] .' &i= '.$i.'" >View</a>';
         }
        $data[] = $nestedData;
    }
    $json_data = array(
        "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );
    echo json_encode($json_data);  // send data as json format
}

// function to get the data of admin
function getadmin($DBconnect)
{
// storing  request (ie, get/post) global array to a variable
    $requestData = $_REQUEST;
    $columns = array(
// datatable column index  => database column name
        0 => 'ID',
        1 => 'Role',
        2 => 'Name',
        3 => 'Fathers Name',
        4 => 'Mothers Name',
        5 => 'Phone',
        6 => 'Address',

        7 => 'Email',

        8 => 'Gender',
        9 => 'Photo',
        10 => 'Password',
        11 => 'Date of Birth',

        12 => 'Joining',

        13 => 'Update',
        14 => 'Delete',
    );
// getting total number records without any search
    $sql = "SELECT *  ";
    $sql .= " FROM admin";
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get admin");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
    $sql = "SELECT * ";
    $sql .= " FROM admin WHERE 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( Id LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Role LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Name LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Fname LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Mname LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR gender LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR DOB LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  email LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Phone LIKE '" . $requestData['search']['value'] . "%' ";

        $sql .= " OR  Address LIKE '" . $requestData['search']['value'] . "%' ";

        $sql .= " OR Password LIKE '" . $requestData['search']['value'] . "%' )";

    }
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get admin");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get admin");
    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array

        $nestedData = array();
        $nestedData[] = $row["Id"];
        $nestedData[] = $row["Role"];
        $nestedData[] = $row["Name"];
        $nestedData[] = $row["Fname"];
        $nestedData[] = $row["Mname"];
        $nestedData[] = $row["Phone"];
        $nestedData[] = $row["Address"];

        $nestedData[] = $row["email"];
        $nestedData[] = $row["gender"];
        $nestedData[] = '<img src="../images/'.$row['Id'].'.jpg" />';
        $nestedData[] = $row["Password"];
        $nestedData[] = $row["DOB"];
        $nestedData[] = $row["joining"];

        $nestedData[] ='<a class="icon" href="updateadmin.php?id='.$row['Id'].'"><i class="fa fa-edit "></i></a>';
        $nestedData[] = '<a class="icon" href="deleteadmin.php?id='.$row['Id'].'"><i class="fa fa-trash"></i></a>';;

        $data[] = $nestedData;
    }
    $json_data = array(
        "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );
    echo json_encode($json_data);  // send data as json format
}

// function to get the data of student
function getstudentpaging($DBconnect)
{
// storing  request (ie, get/post) global array to a variable
    $requestData = $_REQUEST;
    $columns = array(
// datatable column index  => database column name
        0 => 'ID',
        1 => 'Name',
        2 => 'Fathers Name',
        3 => 'Mothers Name',
        4 => 'Phone',
        5 => 'Address',
        6 => 'Class',
        7 => 'Email',

        8 => 'Gender',
        9 => 'Photo',
        10 => 'Password',
        11 => 'Date of Birth',
        12 => 'Year',
        13 => 'Admission Date',
        14 => 'admission_class',

        15 => 'Update',
        16 => 'Delete',
    );
// getting total number records without any search
    $sql = "SELECT *  ";
    $sql .= " FROM student";
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get student");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
    $sql = "SELECT * ";
    $sql .= " FROM student WHERE 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( Id LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Name LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Fname LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Mname LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Phone LIKE '" . $requestData['search']['value'] . "%' ";

        $sql .= " OR  Address LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  ClassID LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Password LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR DOB LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR year LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR gender LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  email LIKE '" . $requestData['search']['value'] . "%' ";

        $sql .= " OR  Admission_date LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR admission_class LIKE '" . $requestData['search']['value'] . "%' )";

    }
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get student");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get student");
    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array

        $nestedData = array();
        $nestedData[] = $row["Id"];
        $nestedData[] = $row["Name"];
        $nestedData[] = $row["Fname"];
        $nestedData[] = $row["Mname"];
        $nestedData[] = $row["Phone"];
        $nestedData[] = $row["Address"];
        $nestedData[] = $row["ClassID"];
        $nestedData[] = $row["email"];
        $nestedData[] = $row["gender"];
        $nestedData[] = '<img src="../images/'.$row['Id'].'.jpg" />';
        $nestedData[] = $row["Password"];
        $nestedData[] = $row["DOB"];
        $nestedData[] = $row["year"];


        $nestedData[] = $row["Admission_date"];
        $nestedData[] = $row["admission_class"];
        $nestedData[] ='<a class="icon" href="updatestudent.php?id='.$row['Id'].'"><i class="fa fa-edit "></i></a>';
        $nestedData[] = '<a class="icon" href="deletestudent.php?id='.$row['Id'].'"><i class="fa fa-trash"></i></a>';;

        $data[] = $nestedData;
    }
    $json_data = array(
        "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );
    echo json_encode($json_data);  // send data as json format
}

// function to get the data of teacher
function getteacher($DBconnect)
{

// storing  request (ie, get/post) global array to a variable
    $requestData = $_REQUEST;
    $columns = array(
// datatable column index  => database column name
        0 => 'ID',
        1 => 'Name',
        2 => 'Fathers Name',
        3 => 'Mothers Name',
        4 => 'Phone',
        5 => 'Email',
        6 => 'Gender',
        7 => 'Address',

        8 => 'Photo',
        9 => 'Password',
        10 => 'Class Teacher',
        11 => 'Date of Birth',

        12 => 'Joining',
        13 => 'Update',
        14 => 'Delete',
    );
// getting total number records without any search
    $sql = "SELECT *  ";
    $sql .= " FROM teacher";
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get teacher");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
    $sql = "SELECT * ";
    $sql .= " FROM teacher WHERE 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( Id LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Name LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Fname LIKE '" . $requestData['search']['value'] . "%' ";

        $sql .= " OR  Mname LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Phone LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  email LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR gender LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Address LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR  Password LIKE '" . $requestData['search']['value'] . "%' ";


        $sql .= " OR DOB LIKE '" . $requestData['search']['value'] . "%' ";

        $sql .= " OR ClassTeacher LIKE '" . $requestData['search']['value'] . "%' )";

    }
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get teacher");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get teacher");
    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array

        $nestedData = array();
        $nestedData[] = $row["Id"];
        $nestedData[] = $row["Name"];
        $nestedData[] = $row["Fname"];
        $nestedData[] = $row["Mname"];
        $nestedData[] = $row["Phone"];

        $nestedData[] = $row["email"];
        $nestedData[] = $row["gender"];
        $nestedData[] = $row["Address"];

        $nestedData[] = '<img src="../images/'.$row['Id'].'.jpg" />';
        $nestedData[] = $row["Password"];
        if($row["ClassTeacher"]=="0"){
          $nestedData[]="-";
        }
        else{
          $nestedData[] = $row["ClassTeacher"];
        }

        $nestedData[] = $row["DOB"];
        $nestedData[] = $row["joining"];
        $nestedData[] ='<a class="icon" href="updateteacher.php?id='.$row['Id'].'"><i class="fa fa-edit "></i></a>';
        $nestedData[] = '<a class="icon" href="deleteteacher.php?id='.$row['Id'].'"><i class="fa fa-trash"></i></a>';;

        $data[] = $nestedData;
    }
    $json_data = array(
        "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );
    echo json_encode($json_data);  // send data as json format
}

// function to get the subject list
function getsubjectlist($DBconnect)
{

// storing  request (ie, get/post) global array to a variable
    $requestData = $_REQUEST;
    $columns = array(
// datatable column index  => database column name
        0 => 'ID',
        1 => 'Name',
        2 => 'Update',
        3 => 'Delete',
    );
// getting total number records without any search
    $sql = "SELECT *  ";
    $sql .= " FROM subject_code";
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get subjectlist");
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
    $sql = "SELECT * ";
    $sql .= " FROM subject_code WHERE 1=1";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( Id LIKE '" . $requestData['search']['value'] . "%' ";
        $sql .= " OR Name LIKE '" . $requestData['search']['value'] . "%' )";
    }
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get subjectlist");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
    // $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
    $query = mysqli_query($DBconnect, $sql) or die("Mysql Mysql Error in getting : get subjectlist");
    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array

        $nestedData = array();
        $nestedData[] = $row["Id"];
        $nestedData[] = $row["Name"];
        $nestedData[] ='<a class="icon" href="updateteacher.php?id='.$row['Id'].'"><i class="fa fa-edit "></i></a>';
        $nestedData[] = '<a class="icon" href="deleteteacher.php?id='.$row['Id'].'"><i class="fa fa-trash"></i></a>';;

        $data[] = $nestedData;
    }
    $json_data = array(
        "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );
    echo json_encode($json_data);  // send data as json format
}

// call for pagination
if ($_POST['func']=="pagination") {
  $action = $_POST['page'];
    switch ($action) {
        case 'feedback' :
            getfeedback($conn);
            break;
        case 'alumini' :
            getalumini($conn);
            break;
        case 'student_dropout' :
            getstudentdropoout($conn);
            break;
       case 'staff_dropout' :
           getstaffdropoout($conn);
           break;
       case 'notices' :
           getnotice($conn);
           break;
       case 'teaches' :
           getassign($conn);
           break;
       case 'teacher_attendance' :
           getteacherattendance($conn);
           break;
       case 'leave_requests' :
           getpendingrequests($conn,$_POST['s_id']);
           break;
       case 'approved_leave_requests' :
           getapprovedrequests($conn,$_POST['s_id']);
           break;
       case 'denied_leave_requests' :
           getdeniedrequests($conn,$_POST['s_id']);
           break;
       case 'teacher_paging' :
           getteacher($conn);
           break;
       case 'student_paging' :
         getstudentpaging($conn);
         break;
       case 'admin_paging' :
               getadmin($conn);
               break;
       case 'subjectlist' :
         getsubjectlist($conn);
         break;
    }
}


// student dropout form
if ($_POST['func']=="dropout_student_form") {
  $id = $_POST['student_id'];
  $reason = $_POST['reason'];
  $sql="select * from student where Id='".$id."'";
  $row=mysqli_fetch_assoc(mysqli_query($conn,$sql));
  if(mysqli_num_rows(mysqli_query($conn,$sql))!=0){
  $p="../images/".$row['Id'].".jpg";
  $year=date("Y");
  $sql="insert into student_dropout(StudentID,Name,Fname,Mname,Phone,Address,Photograph,DOB,Dropout_year,gender,email,Admission_date,last_batch,admission_class,last_class,Reason) values('".$row['Id']."','".$row['Name']."','".$row['Fname']."','".$row['Mname']."','".$row['Phone']."','".$row['Address']."','".$p."','".$row['DOB']."','".$year."','".$row['gender']."','".$row['email']."','".$row['Admission_date']."','".$row['year']."','".$row['admission_class']."','".$row['ClassID']."','".$reason."')";
  if(mysqli_query($conn,$sql)){
    $sql="delete from student where Id='".$id."'";
    if(mysqli_query($conn,$sql)){
      echo "Request Successful";
    }
    else{
      echo "Request Failed";
    }
  }
  else{
    echo "request failed";
  }
}
else{
    echo "Invalid Id";
}
}


// staff dropout form
if ($_POST['func']=="dropout_staff_form") {
  $id = $_POST['staff_id'];
  $reason = $_POST['reason'];
  $role = $_POST['role'];
  if($role=='Teacher'){
    $sql="select * from teacher where Id='".$id."'";
  }
  else if($role=='Admin'){
    $sql="select * from admin where Id='".$id."'";
  }
  else{
    echo "Invalid Role!";
  }

  $row=mysqli_fetch_assoc(mysqli_query($conn,$sql));
  if(mysqli_num_rows(mysqli_query($conn,$sql))!=0){
  $p="../images/".$row['Id'].".jpg";
  $year= date("Y-m-d H:i:s ") ;
  $q=0;
  if($role=='Teacher'){
    $q=$row['ClassTeacher'];
    $sql="insert into staff_dropout(AssignedID,Name,Fname,Mname,Phone,Address,Photograph,DOB,dropout,gender,email,joining,last_ClassTeacher,Role,Reason) values('".$row['Id']."','".$row['Name']."','".$row['Fname']."','".$row['Mname']."','".$row['Phone']."','".$row['Address']."','".$p."','".$row['DOB']."','".$year."','".$row['gender']."','".$row['email']."','".$row['joining']."','".$q."','".$role."','".$reason."')";
  }
  else if($role=='Admin'){
    $role=$row['Role'];
    $sql="insert into staff_dropout(AssignedID,Name,Fname,Mname,Phone,Address,Photograph,DOB,dropout,gender,email,joining,Role,Reason) values('".$row['Id']."','".$row['Name']."','".$row['Fname']."','".$row['Mname']."','".$row['Phone']."','".$row['Address']."','".$p."','".$row['DOB']."','".$year."','".$row['gender']."','".$row['email']."','".$row['joining']."','".$role."','".$reason."')";
  }

  if(mysqli_query($conn,$sql)){
    if($role=='Teacher'){
      $sql="delete from teacher where Id='".$id."'";
    }
    else {
      $sql="delete from admin where Id='".$id."'";
    }
  }
  else{
    echo "request failed";
  }
    if(mysqli_query($conn,$sql)){
      echo "Request Successful";
    }
    else{
      echo "Request Failed";
    }
}
else{
    echo "Invalid Id";
}
}


// get subject to set disable checkbox in subject_assign form
if ($_POST['func']=="get_subject") {
  $class_id = $_POST['class'];
  $data=array();
  $sql="select * from teaches where ClassId='".$class_id."'";
  $result=mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)==0){
    echo mysqli_num_rows($result);
  }
  else{
  while($row=mysqli_fetch_assoc($result)){
    array_push($data,$row);
  }
  echo json_encode($data);
}
}

// get subject to set disable checkbox in edit_subject_assign form
if ($_POST['func']=="get_subject_for_edit") {
  $class_id = $_POST['class'];
  $teacher_id = $_POST['teacher'];
  $sql="select * from teaches where ClassId='".$class_id."' and TeacherId='".$teacher_id."'";
  $result=mysqli_fetch_assoc(mysqli_query($conn,$sql));
   echo json_encode($result);
}


//assign subject to teacher
if ($_POST['func']=="assign_subject") {
   $class= $_POST['class'];
   $teacher=$_POST['teacher'];

   $sql="select * from teaches where ClassId='".$class."' and  TeacherId='".$teacher."'";
   $result=mysqli_query($conn,$sql);
   if(mysqli_num_rows($result)!=0){
     echo "Selected Teacher already has subjects assigned for the selecgted class. You can update the subjects assigned for the teacher but cannot freshly assign subjects again.";
   }
   else{

   $EngLit=$_POST['EngLit'];
   $EngLang=$_POST['EngLang'];
   $HindiLit=$_POST['HindiLit'];
   $HindiLang=$_POST['HindiLang'];
   $Maths=$_POST['Maths'];
   $Science=$_POST['Science'];
   $SocialScience=$_POST['SocialScience'];
   $Computer=$_POST['Computer'];
   $GeneralKnowledge=$_POST['GeneralKnowledge'];
   $Art=$_POST['Art'];

   $sql="insert into teaches values('".$class."','".$teacher."','".$EngLit."','".$EngLang."','".$HindiLit."','".$HindiLang."','".$Maths."','".$Science."','".$SocialScience."','".$Computer."','".$GeneralKnowledge."','".$Art."')";
   if(mysqli_query($conn,$sql)){
     echo "Subjects Assigned.";
   }
   else{
     echo "Could not Assign subjects.";
   }
 }
}

//function to disable check box in update sub assign
if ($_POST['func']=="get_subject_for_disable") {
  $class_id = $_POST['class'];
  $teacher=$_POST['teacher'];
  $data=array();
  $sql="select * from teaches where ClassId='".$class_id."' and NOT TeacherId ='".$teacher."'";
  $result=mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)==0){
    echo mysqli_num_rows($result);
  }
  else{
  while($row=mysqli_fetch_assoc($result)){
    array_push($data,$row);
  }
  echo json_encode($data);
}
}


//update assign subject to teacher
if ($_POST['func']=="update_assign_subject") {
   $class= $_POST['class'];
   $teacher=$_POST['teacher'];


   $EngLit=$_POST['EngLit'];
   $EngLang=$_POST['EngLang'];
   $HindiLit=$_POST['HindiLit'];
   $HindiLang=$_POST['HindiLang'];
   $Maths=$_POST['Maths'];
   $Science=$_POST['Science'];
   $SocialScience=$_POST['SocialScience'];
   $Computer=$_POST['Computer'];
   $GeneralKnowledge=$_POST['GeneralKnowledge'];
   $Art=$_POST['Art'];

   $sql="update teaches set EngLit='".$EngLit."', EngLang='".$EngLang."', HindiLit='".$HindiLit."', HindiLang='".$HindiLang."', Maths='".$Maths."', Science='".$Science."', SocialScience='".$SocialScience."', Computer='".$Computer."', Generalknowledge='".$GeneralKnowledge."', Art='".$Art."' where ClassId='".$class."' and TeacherId='".$teacher."'";
   if(mysqli_query($conn,$sql)){
     echo "Subjects Assigned Updated.";
   }
   else{
     echo "Could not Update subjects assigned.";
   }

}
//Reset casual leave on new Year
if ($_POST['func']=="ChangeLeaveYear") {
   $sql="update leave_count set CasualLeave=14";
   if(mysqli_query($conn,$sql)){
     echo "Casual Leaves have been Reset.";
   }
   else{
     echo "CasualLeaves not updated";
   }
}

}
}
 ?>
