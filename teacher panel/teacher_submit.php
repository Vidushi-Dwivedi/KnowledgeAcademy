<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

  if(isset($_POST['func'])) {

    include 'db.php';

   // fetch class students
     if($_POST['func'] == 'fetch_class_students'){
       $class_id = $_POST['class_id'];
       $sql="select Id,Name from student where ClassID='".$class_id."'";
       $result=mysqli_query($conn,$sql);
       $data= array();
       while($row=mysqli_fetch_assoc($result)){
         array_push($data,$row);
       }
         echo json_encode($data);
       }

       // class name for option
       if($_POST['func'] == 'fetch_class_for_option'){
         $t_id=$_POST['teacher_id'];
          $sql="select ClassId from teaches where TeacherId='".$t_id."'";
          $result= mysqli_query($conn,$sql);
          $data = array();
          while($row = mysqli_fetch_assoc($result)){
            $sql="select * from Class where Id='".$row['ClassId']."'";
            $result1= mysqli_query($conn,$sql);
            $row1= mysqli_fetch_assoc($result1);
            array_push($data,$row1);
          }
          echo json_encode($data);
       }

       // student name for option
       if($_POST['func'] == 'fetch_student_for_option'){
         $class_id=$_POST['class_id'];
         $sql="select Id,Name from student where ClassId='".$class_id."'";
         $result= mysqli_query($conn,$sql);
         $data = array();
         while($row = mysqli_fetch_assoc($result)){
           array_push($data,$row);
         }
         echo json_encode($data);
      }

      //reciever Info
      if($_POST['func'] == 'reciever_info'){
        $s_id=$_POST['student_id'];
        $sql="select name from student where Id='".$s_id."'";
        $result= mysqli_query($conn,$sql);
        $data="";
        while($row = mysqli_fetch_assoc($result)){
          $data=$row['name'];
        }
        echo $data;
      }

      // fetch chat with teacher
      if($_POST['func'] == 'fetch_chat_msgs'){
        $id=$_POST['teacher_id'];
        $s_id=$_POST['student_id'];
         $sql1="select * from chat where sender_userid='".$id."' and reciever_userid='".$s_id."' and status_sender='1' ";
         $sql2="select * from chat where sender_userid='".$s_id."' and reciever_userid='".$id."' and status_reciever='1' and reciever_read='1'";
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
        $s_id=$_POST['student_id'];
        $id=$_POST['teacher_id'];
        $sql="select * from chat where sender_userid='".$id."' and reciever_userid='".$s_id."' and status_sender='1' and sender_read='0'";
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
       $s_id=$_POST['student_id'];
       $id=$_POST['teacher_id'];
       $sql="select * from chat where sender_userid='".$s_id."' and reciever_userid='".$id."' and status_sender='1' and reciever_read='0'";
       $result= mysqli_query($conn,$sql);
       $data = array();
       while($row = mysqli_fetch_assoc($result)){
         array_push($data,$row);
         $sql1="update chat set reciever_read='1' where chat_id='".$row['chat_id']."'";
         $result1= mysqli_query($conn,$sql1);
       }
       echo json_encode($data);
     }

     // send new msgs
     if($_POST['func'] == 'send_new_msg'){
       $s_id=$_POST['student_id'];
       $id=$_POST['teacher_id'];
       $msg=$_POST['msg'];
       $sql="insert into chat(sender_userid,reciever_userid,message,timestamp,status_sender,status_reciever,sender_read,reciever_read) values ('".$id."','".$s_id."','".$msg."',current_timestamp(),'1','1','0','0')";
       if(mysqli_query($conn,$sql)){
         echo 1;
       }
       else{
         echo 0;
       }
     }

     // fetch new messages
     if($_POST['func'] == 'fetch_new_messages'){
         $id=$_POST['teacher_id'];
         $sql="select sender_userid from chat where reciever_userid='".$id."' and reciever_read = '0'";
         $result= mysqli_query($conn,$sql);
         $data = array();
         while($row = mysqli_fetch_assoc($result)){
           array_push($data,$row);
         }
         $t= time();
         $sql="update teacher set last_session= FROM_UNIXTIME('".$t."') where Id='".$id."'";
         $result= mysqli_query($conn,$sql);
         echo json_encode($data);
     }

     //new msg info
     if($_POST['func'] == 'new_msg_info'){
       $s_id=$_POST['student_id'];
       $sql="select id,name from student where Id='".$s_id."'";
       $result= mysqli_query($conn,$sql);
       $data = array();
       while($row = mysqli_fetch_assoc($result)){
         array_push($data,$row);
       }
       echo json_encode($data);
     }

     //refresh new chats and chat_msgs
     if($_POST['func'] == 'refresh_new_messages'){
         $id=$_POST['teacher_id'];
         $sql="select last_session from teacher where Id='".$id."'";
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
         $sql="update teacher set last_session= FROM_UNIXTIME('".$t."') where Id='".$id."'";
         $result= mysqli_query($conn,$sql);
         echo json_encode($data);

       }

       //fetch_class_for_new_chat
       if($_POST['func'] == 'fetch_class_for_new_chat'){
         $id=$_POST['student_id'];
         $sql="select ClassID from student where Id='".$id."'";
         $result=mysqli_query($conn,$sql);
         $row=mysqli_fetch_assoc($result);
         $sql="select * from class where Id='".$row['ClassID']."'";
         $result=mysqli_query($conn,$sql);
         $row=mysqli_fetch_assoc($result);
         echo json_encode($row);
       }

       // change password student
       if($_POST['func'] == 'teacher_pass_change'){
             $sql="update teacher set Password='".$_POST['password']."' where Id='".$_POST['id']."'";
             if(mysqli_query($conn,$sql)){
               echo "Password changed successfully.";
             }
             else{
               echo "Password could not be changed.";
             }
       }



       // verify Teacher Attendance verification func
         if($_POST['func'] == 'verify_log_Student_Attendance'){
          $student_id=$_POST['student_id'];
          $teacher_id=$_POST['teacher_id'];
          $date=$_POST['date'];
          $sql="select * from student where id='".$student_id."'";
          $result=mysqli_query($conn,$sql);
          $row=mysqli_fetch_assoc($result);
          $num= mysqli_num_rows($result);
          if($num!=0){
            $sql="select * from student_attendance where student_id='".$student_id."'and teacher_id='".$teacher_id."' and class_id='".$row['ClassID']."' and attendance_date='".$date."'";
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
            echo "Invalid Student ID.";
          }
      }

      // log Student Attendance submit func
          if($_POST['func'] == 'submit_log_student_Attendance'){

            $student_id=$_POST['student_id'];
            $teacher_id=$_POST['teacher_id'];
            $date=$_POST['date'];
            $status=$_POST['status'];
            $sql= "select max(attendance_id) as ID from student_attendance";
            $result= mysqli_query($conn,$sql);
            $n=0;
            while($row=mysqli_fetch_array($result)){
              $n=$row['ID'];
            }
            if($n==0){$id=10001;}
            else{$id=$n+1;}
            $sql= "select ClassID from student where id='".$student_id."'";
            $row=mysqli_fetch_assoc(mysqli_query($conn,$sql));
            $sql="insert into student_attendance(attendance_id,student_id,class_id, teacher_id, status,attendance_date) values ('".$id."','".$student_id."','".$row['ClassID']."','".$teacher_id."','".$status."','".$date."')";
            if(mysqli_query($conn,$sql)){
              echo 1;
            }
            else {
              echo 0;
            }
          }

          // edit log teacher func
             if($_POST['func'] == 'edit_log_Student_Attendance'){
              $status=$_POST['status'];
              $id=$_POST['attendance_id'];
              $sql="update student_attendance set Status='".$status."' where attendance_id='".$id."'";
              if(mysqli_query($conn,$sql)){
                echo "Edit Successfull";
              }
              else{
                echo "Edit Failed";
              }
             }



                 // attendance monthly chart data
                   if($_POST['func'] == 'monthly_attendance_chart'){
                     $month = $_POST['i'];
                     $id=$_POST['teacher_id'];
                     $sql="select * from teacher_attendance where status='present' and teacher_id='".$id."' and EXTRACT(MONTH FROM attendance_date)='".$month."'";
                     $result1=mysqli_num_rows(mysqli_query($conn,$sql));
                     $sql="select * from teacher_attendance where status='absent' and teacher_id='".$id."' and EXTRACT(MONTH FROM attendance_date)='".$month."'";
                     $result2=mysqli_num_rows(mysqli_query($conn,$sql));
                     $sql="select * from teacher_attendance where status='late'and teacher_id='".$id."' and EXTRACT(MONTH FROM attendance_date)='".$month."'";
                     $result3=mysqli_num_rows(mysqli_query($conn,$sql));
                     $sql="select * from teacher_attendance where status='half_day' and teacher_id='".$id."' and EXTRACT(MONTH FROM attendance_date)='".$month."'";
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
                    $id=$_POST['teacher_id'];
                    $sql="select * from teacher_attendance where teacher_id='".$id."' and EXTRACT(MONTH FROM attendance_date)='".$month."'";
                    $result=mysqli_query($conn,$sql);
                    $data = array();
                    while($row = mysqli_fetch_assoc($result)){
                      array_push($data,$row);
                    }
                    echo json_encode($data);
                  }


                  // function to get the data of student_attendance
                  function getstudent_attendance($DBconnect)
                  {
                  // storing  request (ie, get/post) global array to a variable
                      $requestData = $_REQUEST;
                      $columns = array(
                  // datatable column index  => database column name
                          0 => 'Attendance ID',
                          1 => 'Student ID',
                          2 => 'Class ID',
                          3 => 'Teacher ID',
                          4 => 'Status',
                          5 => 'Attendance Date',
                          6 => 'Edit',
                          7 => 'Delete',
                      );
                  // getting total number records without any search
                      $sql = "SELECT *  ";
                      $sql .= " FROM student_attendance";
                      $query = mysqli_query($DBconnect, $sql) or die("Mysql1 Mysql Error in getting : get student attendance");
                      $totalData = mysqli_num_rows($query);
                      $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
                      $sql = "SELECT * ";
                      $sql .= " FROM student_attendance WHERE 1=1";
                      if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                          $sql .= " AND ( attendance_id LIKE '" . $requestData['search']['value'] . "%' ";
                          $sql .= " OR student_id LIKE '" . $requestData['search']['value'] . "%' ";
                          $sql .= " OR class_id LIKE '" . $requestData['search']['value'] . "%' ";
                          $sql .= " OR teacher_id LIKE '" . $requestData['search']['value'] . "%' ";
                          $sql .= " OR status LIKE '" . $requestData['search']['value'] . "%' ";
                          $sql .= " OR attendance_date LIKE '" . $requestData['search']['value'] . "%' )";
                      }
                      $query = mysqli_query($DBconnect, $sql) or die("Mysql2 Mysql Error in getting : get student attendance");
                      $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
                      // $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
                      /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
                      $query = mysqli_query($DBconnect, $sql) or die("Mysql3 Mysql Error in getting : get student attendance");
                      $data = array();
                      while ($row = mysqli_fetch_array($query)) {  // preparing an array
                          $nestedData = array();
                          $nestedData[] = $row["attendance_id"];
                          $nestedData[] = $row["student_id"];
                          $nestedData[] = $row["class_id"];
                          $nestedData[] = $row["teacher_id"];
                          $nestedData[] = $row["status"];
                          $nestedData[] = $row["attendance_date"];
                          $nestedData[] = '<a class="icon" href="student_attendance_edit.php?attend_id='. $row['attendance_id'] .'&id='.$row['student_id'].'"><i class="fa fa-edit "></i></a>';
                          $nestedData[] = '<a class="icon" href="student_attendance_delete.php?id='.$row['attendance_id'].'"><i class="fa fa-trash"></i></a>';

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

                  // classwise result
                  // function classwise_Result($DBconnect,$y,$e,$c,$t){
                  //   $year = $y;
                  //   $exam=$e;
                  //   $cid=$c;
                  //   $teacher=$t;
                  //
                  //
                  //
                  //
                  //   // storing  request (ie, get/post) global array to a variable
                  //       $requestData = $_REQUEST;
                  //       $columns = array(
                  //   // datatable column index  => database column name
                  //           0 => 'Class',
                  //           1 => 'Sec',
                  //           2 => 'StudentID',
                  //           3 => 'Rank_',
                  //           4 => 'Total',
                  //           5 => 'Eng Lit',
                  //           6 => 'EngLang',
                  //           7 => 'Hindi Lit',
                  //           8 => 'Hindi Lang',
                  //           9 => 'Maths',
                  //           10 => 'Science',
                  //           11 => 'SocialScience',
                  //           12 => 'Computer',
                  //           13=> 'General Knowledge',
                  //           14 => 'Art'
                  //       );
                  //   // getting total number records without any search
                  //       $sql = "SELECT *  ";
                  //       $sql .= " FROM marks1 where ClassID='".$cid."' and Year='".$y."'";
                  //       $query = mysqli_query($DBconnect, $sql) or die("Mysql1 Mysql Error in getting : teaches");
                  //       $totalData = mysqli_num_rows($query);
                  //       $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
                  //       $sql = " select c.Class,c.Sec,count(*),(t.EngLang+t.EngLit+t.HindiLang+t.HindiLit+t.Maths+t.Science+t.SocialScience+t.Computer+t.Generalknowledge+t.Art),t.EngLang,t.EngLit,t.HindiLang,t.HindiLit,t.Maths,t.Science,t.SocialScience,t.Computer,t.Generalknowledge,t.Art FROM `marks1` t inner join `class` c on t.ClassId=c.Id ";
                  //       $sql .= " WHERE t.ClassID='".$cid."' and examid='".$exam."' and Year='".$year."' and 1=1";
                  //       if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                  //         $sql .= " AND ( Class LIKE '" . $requestData['search']['value'] . "%' ";
                  //         $sql .= " OR Sec LIKE '" . $requestData['search']['value'] . "%' ";
                  //         $sql .= " OR StudentID LIKE '" . $requestData['search']['value'] . "%' ";
                  //         $sql .= " OR Rank_ LIKE '" . $requestData['search']['value'] . "%' ";
                  //         $sql .= " OR Total LIKE '" . $requestData['search']['value'] . "%' ";
                  //         $sql .= " OR EngLang LIKE '" . $requestData['search']['value'] . "%' ";
                  //         $sql .= " OR EngLit LIKE '" . $requestData['search']['value'] . "%' ";
                  //         $sql .= " OR HindiLang LIKE '" . $requestData['search']['value'] . "%' ";
                  //         $sql .= " OR HindiLit LIKE '" . $requestData['search']['value'] . "%' ";
                  //         $sql .= " OR Maths LIKE '" . $requestData['search']['value'] . "%' ";
                  //         $sql .= " OR Science LIKE '" . $requestData['search']['value'] . "%' ";
                  //         $sql .= " OR SocialScience LIKE '" . $requestData['search']['value'] . "%' ";
                  //         $sql .= " OR Computer LIKE '" . $requestData['search']['value'] . "%' ";
                  //         $sql .= " OR GeneralKnowledge LIKE '" . $requestData['search']['value'] . "%' ";
                  //         $sql .= " OR Art LIKE '" . $requestData['search']['value'] . "%' )";
                  //
                  //       }
                  //       $query = mysqli_query($DBconnect, $sql) or die("Mysql2 Mysql Error in getting : get teaches");
                  //       $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
                  //       $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
                  //        // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
                  //       $query = mysqli_query($DBconnect, $sql) or die("Mysql3 Mysql Error in getting : teaches");
                  //       $data = array();
                  //       while ($row = mysqli_fetch_array($query)) {  // preparing an array
                  //
                  //           $nestedData = array();
                  //           $s="select * from class where Id='".$row['ClassId']."'";
                  //           $r=mysqli_fetch_assoc(mysqli_query($DBconnect,$s));
                  //           $nestedData[] = $r["Class"];
                  //           $nestedData[] = $r["Sec"];
                  //           $nestedData[] = $r["StudentID"];
                  //           $nestedData[] = $r["Rank"];
                  //           $nestedData[] = $r["Total"];
                  //           $nestedData[] = $row["EngLit"];
                  //           $nestedData[] = $row["EngLang"];
                  //           $nestedData[] = $row["HindiLit"];
                  //           $nestedData[] = $row["HindiLang"];
                  //           $nestedData[] = $row["Maths"];
                  //           $nestedData[] = $row["Science"];
                  //           $nestedData[] = $row["SocialScience"];
                  //           $nestedData[] = $row["Computer"];
                  //           $nestedData[] = $row["Generalknowledge"];
                  //           $nestedData[] = $row["Art"];
                  //
                  //           $data[] = $nestedData;
                  //       }
                  //       $json_data = array(
                  //           "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                  //           "recordsTotal" => intval($totalData),  // total number of records
                  //           "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
                  //           "data" => $data   // total data array
                  //       );
                  //       echo json_encode($json_data);  // send data as json format
                  // }

                  // function to get the data of subject teacher assignment
                  function getteaches($DBconnect,$teacher)
                  {
                  // storing  request (ie, get/post) global array to a variable
                      $requestData = $_REQUEST;
                      $columns = array(
                  // datatable column index  => database column name
                          0 => 'Class',
                          1 => 'Sec',
                          2 => 'Eng Lit',
                          3 => 'EngLang',
                          4 => 'Hindi Lit',
                          5 => 'Hindi Lang',
                          6 => 'Maths',
                          7 => 'Science',
                          8 => 'SocialScience',
                          9 => 'Computer',
                          10=> 'General Knowledge',
                          11 => 'Art'
                      );
                  // getting total number records without any search
                      $sql = "SELECT *  ";
                      $sql .= " FROM teaches where TeacherId='".$teacher."'";
                      $query = mysqli_query($DBconnect, $sql) or die("Mysql1 Mysql Error in getting : teaches");
                      $totalData = mysqli_num_rows($query);
                      $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
                      $sql = " select c.Class,c.Sec,t.ClassId,t.EngLang,t.EngLit,t.HindiLang,t.HindiLit,t.Maths,t.Science,t.SocialScience,t.Computer,t.Generalknowledge,t.Art FROM `teaches` t inner join `class` c on t.ClassId=c.Id ";
                      $sql .= " WHERE t.TeacherId='".$teacher."' and 1=1";
                      if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                          $sql .= " AND ( Class LIKE '" . $requestData['search']['value'] . "%' ";
                          $sql .= " OR Sec LIKE '" . $requestData['search']['value'] . "%' )";

                      }
                      $query = mysqli_query($DBconnect, $sql) or die("Mysql2 Mysql Error in getting : get teaches");
                      $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
                      // $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
                      /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
                      $query = mysqli_query($DBconnect, $sql) or die("Mysql3 Mysql Error in getting : teaches");
                      $data = array();
                      while ($row = mysqli_fetch_array($query)) {  // preparing an array

                          $nestedData = array();
                          $s="select * from class where Id='".$row['ClassId']."'";
                          $r=mysqli_fetch_assoc(mysqli_query($DBconnect,$s));
                          $nestedData[] = $r["Class"];
                          $nestedData[] = $r["Sec"];
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
                          case 'student_attendance' :
                              getstudent_attendance($conn);
                              break;
                          case 'teaches' :
                              getteaches($conn,$_POST['teacher']);
                              break;
                          // case 'class_result' :
                          //     classwise_Result($conn,$_POST['year'],$_POST['exam'],$_POST['class'],$_POST['TeacherId']);
                          //     break;
                      }
                  }

                 //leave application format
                 if ($_POST['func']=="apply_leave") {

                   $teacher=$_POST['teacher_id'];
                   $from=$_POST['from'];
                   $to=$_POST['to'];
                   $type=$_POST['type'];
                   $reason=$_POST['reason'];
                    $p="Pending";

                   $sql="select * from teacher_leave where TeacherId='".$teacher."' and FromDate='".$from."' and ToDate='".$to."'";
                   if(mysqli_num_rows(mysqli_query($conn,$sql))!=0){
                     echo "Leave for the given period is already applied.";
                   }
                   else{

                     $sql="select max(Id) as Id from teacher_leave";
                     $row=mysqli_fetch_array(mysqli_query($conn,$sql));
                     $id=$row['Id']+1;

                     if (empty($_FILES['file']['name'])) {

                       $sql="insert into teacher_leave(Id,TeacherId,FromDate,ToDate,Type,Reason,Approval) values('".$id."','".$teacher."','".$from."','".$to."','".$type."','".$reason."','".$p."')";
                       if(mysqli_query($conn,$sql)){
                       echo "Leave applied successfully1.";
                       }
                       else{
                         echo "Leave could not be applied.";
                       }
                     }
                     else{
                       $files = $_FILES['file']['tmp_name'];
                       $file_name1= $_FILES['file']['name'];
                       $extension=pathinfo($file_name1, PATHINFO_EXTENSION);

                       if (!in_array($extension, ['pdf', 'zip', 'docx'])) {
                           echo "You file extension must be .zip, .pdf or .docx";
                       }
                       elseif ($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte

                           echo "File too large!";
                       }
                       else{
                          $file_name=$id."Leave".$teacher.".".$extension;
                          $destination="../uploads/".$file_name;

                          if (move_uploaded_file($files, $destination) ) {
                                 $sql="INSERT INTO `teacher_leave`(`Id`,`TeacherId`, `FromDate`, `ToDate`, `Type`, `Approval`, `Reason`,`Filename` ) VALUES ('".$id."', '".$teacher."' , '".$from."', '".$to."','".$type."','".$p."','".$reason."','".$destination."' )";

                                 if (mysqli_query($conn, $sql)) {
                                    echo  "Leave Applied Successfully2.";
                                }
                            else {
                                echo "Leave could not be applied.1";
                            }
                         }
                         else{
                                echo "Leave could not be applied.2";
                         }
                    }
                   }
                 }
               }
               // attendance monthly table datasets
               if($_POST['func'] == 'search_result'){
                 $year = $_POST['year'];
                 $id=$_POST['student_id'];
                 $exam=$_POST['exam'];
                 $cid="";
                 $c=0;
                 $z= array();
                 $y= array();

                 $sql="select * from marks1 where StudentID='".$id."'and Year='".$year."'and examid='".$exam."'";
                 $result=mysqli_query($conn,$sql);
                 $data = array();
                 if(mysqli_num_rows($result)!=0){
                 while($row = mysqli_fetch_assoc($result)){
                   $cid=$row['ClassID'];
                   array_push($data,$row);
                 }

                 $sql="select * from marks1 where ClassID='".$cid."' and examid='".$exam."' and Year='".$year."'";
                 $r1=mysqli_query($conn,$sql);
                 if(mysqli_num_rows($r1)!=0){
                 while($rows = mysqli_fetch_assoc($r1)){
                   $total=$rows['EngLang']+$rows['EngLit']+$rows['HindiLang']+$rows['HindiLit']+$rows['Maths']+$rows['Science']+$rows['SocialScience']+$rows['Computer']+$rows['GeneralKnowledge']+$rows['Art'];
                   array_push($z,array($rows['StudentID'],$total));
                 }
                 }
                 function sortArr($a, $b) {
                    return $a[1] < $b[1];
                 }
                 usort($z, 'sortArr');
                 $key = array_search($id, array_column($z, '0'))+1;
                 array_push($data,$key);
                 $sql="select Name from student where Id='".$id."'";
                 $r=mysqli_query($conn,$sql);
                 if(mysqli_num_rows($r)==0){
                   $sql="select Name from alumini where StudentID='".$id."'";
                   $r=mysqli_query($conn,$sql);
                   if(mysqli_num_rows($r)==0){
                     $sql="select Name from student_dropout where StudentID='".$id."'";
                     $r=mysqli_query($conn,$sql);
                     if(mysqli_num_rows($r)==0){
                       echo 2;
                       $c=1;
                     }
                     else{
                       $result=mysqli_fetch_array($r);
                       array_push($data,$result['Name']);
                     }
                   }
                   else{
                     $result=mysqli_fetch_array($r );
                     array_push($data,$result['Name']);
                   }
                 }
                 else{
                   $result=mysqli_fetch_array($r);
                   array_push($data,$result['Name']);
                 }

                 $sql="select Class,Sec from class where Id='".$cid."'";
                 $result=mysqli_query($conn,$sql);
                 while($row = mysqli_fetch_assoc($result)){
                   array_push($data,$row['Class']."-".$row['Sec']);
                 }
                 $sql="select Name from exam1 where Id='".$exam."'";
                 $result=mysqli_fetch_array( mysqli_query($conn,$sql));
                 array_push($data,$result['Name']);


                 if($c==0){
                   // print_r($c);
                   echo json_encode($data);
                 }
               }
               else{
                 echo 1;
               }
               }

}}
 ?>
