<?php

/**
@ Step-2 for newrow Virtual board-Tutoring 
2 Step to complete intervetion if 
Default board - newrow .
]

***/
/////////////////////////////////


$step_2_tutoring_url='create_session_2.php';


/////////////////////////////////////
$tab_sessions='int_schools_x_sessions_log'; # intervenetion and homework_help
$tab_ses_stuents='int_slots_x_student_teacher'; # student list in  intervention
$tab_ses_quiz_answer='students_x_quiz'; # sesion student quiz answer
$client_id='Intervene123456';
 define("TUTOR_BOARD","groupworld");


$district_wise_school_list="SELECT s.district_id, count( s.SchoolId ) AS totsc, d.id, d.district_name
FROM `schools` s
LEFT JOIN loc_district d ON s.district_id = d.id
WHERE s.district_id >0
GROUP BY s.district_id
ORDER BY d.district_name";


$error = '';
$author = 1;
$datetm = date('Y-m-d H:i:s');
$today = date("Y-m-d H:i:s"); // 
$msg=array();
$msg_error=array();
$curr_board=TUTOR_BOARD;  ## braincert 


include("header.php");
include('libraries/newrow.functions.php');
// warning message
$warning_msg=[];
$success_msg=[];





///////////////////////////////////////////
 
if ($_SESSION['login_role'] != 0) { //not admin
    header('Location: folder.php');
    exit;
}
/////////////////////////////////////////
  ////GetNewrow token 
// if(isset($_GET['ac'])&&$_GET['ac']=='all'){ // clear admin token 
// 	unset($_SESSION['ses_admin_token']);

// }elseif(!isset($_SESSION['ses_admin_token'])){

// echo 'new NewrowToken for admin Creeated!, Reload page again! '; 
//   $getToken=_get_token(); 
// $_SESSION['ses_admin_token']=$getToken;

// echo $_SESSION['ses_admin_token'];die; 
// }
////////////////////////////



// print_r($_SESSION); die; 

if(isset($_SESSION['ses_admin_token'])&&!empty($_SESSION['ses_admin_token'])){
  $demo='test';
	//echo 'TOKEN>>', $_SESSION['ses_admin_token']; die; 
}

//////////////////////////////

# 1:: 
// $room_id=_create_new_room(); print_r($room_id); die; 
 
 ///////////////////////////////////
 if(!isset($_GET['id'])){
 	exit('Enter session ID!, ?id=232424');
 }
//////////////////////////


 $getToken=_get_token(); 
$_SESSION['ses_admin_token']=$getToken;




 /////////////////////////

 ### $Tutoring_students_arr=array('13500','13501');

        $Tutoring_id=$_GET['id'];// Student_list
 $arr_students=[];
 $res_students=mysql_query("SELECT * FROM int_slots_x_student_teacher WHERE slot_id = '$Tutoring_id' ");
  while ($line=mysql_fetch_assoc($res_students)) {
    $arr_students[]=$line['student_id'];
    # code...
  }


if(empty($arr_students)){
  exit('No student in session');
}



///////////////////Validate///////////////////////

 if(isset($_GET['id'])){
 	////////////////////

 

 $Intervention_id=$_GET['id'];
////////////////////////////////
     $Intervention_id=$_GET['id'];
     $room_row=_create_room($Intervention_id);
     //print_r($room_row); die; 
    

    
    if($room_row->status=='error'){ // 
      unset($isCreate);
      $warning_msg[]='Room already exist in your company! ';# [code] => 11001
      ///Get nwewrow rooom id fron intervene db if room aleardy created 
      // get_newrow_room_id

    }elseif($room_row->status=='success'){
      $isCreate=1;
    $NewrowRoomId=$room_row->data->id;
    $get_newrow_room_id=$NewrowRoomId; //NewroomId
    $roomName='Intervention_room'.$Intervention_id;

    }


     if($isCreate){ // Saver room ID to intervene system 

    $sql="INSERT INTO newrow_rooms SET newrow_room_id='$get_newrow_room_id',
    ses_tutoring_id='$Intervention_id',name='$roomName',description='$roomName',
    tp_id='$Intervention_id',created_at='$today' ";
    $Save=mysql_query($sql)or die($sql);
    if($Save){
      $success_msg[]='newrow_room created successuflly! Id--'.$get_newrow_room_id;
    }
    }

    //Step2:Student Regsiter at- Newrow 
    /**
    @ Get-Student List: from session OR POST Form select students ID 
    @ int_slots_x_student_teacher

    **/
  
      
  // echo 'Students::';
  // print_r($arr_students); die; 

  $Tutoring_students_arr=$arr_students; // All students Newrow ids. 
    $arr_student_nid=[];
     foreach ($Tutoring_students_arr as $studentId) {
      // echo 'Testing===';
       //print_r($studentId); die; 
       $temp_student_id=$studentId;

   



    ///////////////////////////////////////////
       # code...
      $Student=mysql_fetch_assoc(mysql_query("SELECT * FROM newrow_students WHERE stu_intervene_id= '$studentId' ")); 
      $Student['newrow_ref_id']=trim($Student['newrow_ref_id']);

     // print_r($Student); die;
     //var_export($Student['newrow_ref_id']); die; 
      
      
      if($Student['newrow_ref_id']!=''){ //GetOldNewrowIDFor --interveneSystem
       $Tutoring_newrow_users[]=$Student['newrow_ref_id'];
       $newrow_user_id=$Student['newrow_ref_id'];

      }else{ //CreateNewrowIDForStudent--API

   $Student2=mysql_fetch_assoc(mysql_query("SELECT * FROM students WHERE id= '$studentId' "));
   $StudentEmail='Student_'.$Student2['id'].'@intervene.io';
   $StudentUsername='Student_'.$Student2['id'].'';

      $user_arr=array('email'=>$StudentEmail,
                  'user_name'=>$StudentUsername, // UNQ
                  'first_name' =>$Student2['first_name'],
                  'last_name' =>'Student', // Student| Tutor
                  'role_type' =>'Student', // Instructor | Student
                   );

    
      $User_ob=_create_user($role_type='student',$user_arr);# 13497.
     // echo 'kkk=====';
     //  print_r($User_ob); die; 
       $newrGeneratedId=$User_ob->data->user_id;
       $newrow_user_id=$newrGeneratedId;
       //New NewrowID
       $Tutoring_newrow_users[]= $newrow_user_id;
       
       


      ///////////////////////
     

         $Res=dbc_add_user($studentId,$newrow_user_id);
         unset($user_arr);
         //print_r($Res); 
     
    
  

    

      }
      //////////////////////

      # Add student Newrow IDS
      // Students NID
       $arr_student_nid[$temp_student_id]=$newrow_user_id;


       





     } // Endforeeach


 }
 /////////////////////////////////
  //print_r($Tutoring_newrow_users);
    //echo 'arr_student_nid';
   // print_r($arr_student_nid);
   // echo 'Newor student list ==<br/>';
   
   
   $newrow_students_add=array_values($arr_student_nid);

   

   // print_r($newrow_students_add);

   // die; 

 
//////////////////////////////
   $ses_tutoring_id=$_GET['id'];

   $Created_room_id=$get_newrow_room_id;
   // Check of Newroom aleaready created for Tutoring ID 
   $Room_row=mysql_fetch_assoc(mysql_query(" SELECT * FROM newrow_rooms 
    WHERE ses_tutoring_id= '$ses_tutoring_id'"));
   // If Already created : 
   $Created_room_id=(!empty($Room_row['newrow_room_id'])&&$Room_row['newrow_room_id']!='')?$Room_row['newrow_room_id']:$Created_room_id;



   //print_r($Room_row); die; 

  ////Save Student_id,newrow_id for room//
  // newrow_user_id , intervene_user_id user_type , ses_tutoring_id , newrow_room_id
  foreach ($arr_student_nid as $intervene_id=> $newrowid) {
    # code...// today , created_at
    //Delete old 
    $deletOld=mysql_query("DELETE FROM newrow_room_users WHERE user_type='student' AND ses_tutoring_id='$ses_tutoring_id' AND intervene_user_id='$intervene_id' ");

   

    //////////////////////////////////
  
  $sql="INSERT INTO newrow_room_users SET newrow_user_id='$newrowid',
  intervene_user_id='$intervene_id',
  user_type='student',
  ses_tutoring_id='$ses_tutoring_id', 
  created_at='$today', 
  tp_id='$ses_tutoring_id', 

  newrow_room_id='$Created_room_id' ";
       //echo $sql; die; 
       $Add=mysql_query($sql);

     }





///////////////////////////
 // Step4-Add user to room ///
 // isCreate
 if(isset($isCreate)&&isset($get_newrow_room_id)){  // get_newrow_room_id{New room ID }
 $success_msg[]='Newrow students ids added to room'.implode(',',$newrow_students_add) ;
  $var=$_GET['room'];$userArr=[];
  //$userArr=array('32284','32287');

  // $success_msg[]='2-Student are added to Room-ID:'.$get_newrow_room_id ;
  ###########

 

 $post = [
    'enroll_users' =>$newrow_students_add,  //array('32284','32287'),
    //'unenroll_users' =>'Custom room by api.',
    
];


//$Testing_room_id=23995;//Ses_room2240.
$token=$_SESSION['ses_admin_token'];
// $  $Testing_room_id=(isset($_GET['newrow_ref_room']))?$_GET['newrow_ref_room']:23995;
  $Testing_room_id=$get_newrow_room_id;

$RoomUrlLink='https://smart.newrow.com/backend/api/rooms/participants/'.$Testing_room_id;
$api_url='rooms/participants/<room_id>​';


   $ch = curl_init($RoomUrlLink); // Initialise cURL


       $post = json_encode($post); // Encode the data array into a JSON string
       $authorization = "Authorization: Bearer ".$token; // Prepare the authorisation token
       curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
       curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
       curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Set the posted fields


       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
       $result = curl_exec($ch); // Execute the cURL statement
       $user_row= json_decode($result); 
       curl_close($ch); // Close the cURL connection


         if(!$result) {
          echo 'No response!';die;
            //return false;
          }



        // print_r($result);exit();

       $success_msg[]='User added-'.$result;



      // return json_decode($result); // Return the received data









 }



// Step4-Add user to room ///



  ###############################################
     # >>> Add Users to Room . 
      $_SESSION['ses_newrow_ids']=$Tutoring_newrow_users;
     //////////////////

      // if(isset($_SESSION['ses_newrow_ids']))
      // print_r($_SESSION['ses_newrow_ids']); 
      ///////////Update user info /////



   




     # UpdateUserId 


  // print_r($user_arr); die; 


//////////////////////////////////////

 function dbc_add_user($studentId,$newrow_user_id){

   

   $Student=mysql_fetch_assoc(mysql_query("SELECT * FROM students WHERE id= '$studentId' ")); //TestStudent
    
   // print_r($Student); die; 

   $StudentEmail='Student_'.$Student['id'].'@intervene.io';
   $StudentUsername='Student_'.$Student['id'].'';

  // $user_arr=array('email'=>$StudentEmail,
  //                 'user_name'=>$StudentUsername, // UNQ
  //                 'first_name' =>$Student['first_name'],
  //                 'last_name' =>'Student', // Student| Tutor
  //                 'role_type' =>'Student', // Instructor | Student
  //                  );

  
    $StudentExist=mysql_fetch_assoc(mysql_query("SELECT * FROM newrow_students WHERE stu_intervene_id= '$studentId' ")); #
     
   // die; 

    if(!empty($StudentExist)){
     
     $msg=$studentId.'student,  UPDATED ssuccesfully, '.$newrow_user_id;
     
      $sql="UPDATE newrow_students SET  newrow_ref_id='$newrow_user_id',newrow_email='$StudentEmail',newrow_username='$StudentUsername' WHERE stu_intervene_id=".$studentId;
      // echo $sql; die; 
      $Add=mysql_query($sql);
      $res='Updated';

    }else{  // AddStudentTo{newrow_students}
       $sql="INSERT INTO newrow_students SET stu_intervene_id='$studentId',newrow_ref_id='$newrow_user_id',newrow_email='$StudentEmail',newrow_username='$StudentUsername'  ";
       //echo $sql; die; 
       $Add=mysql_query($sql);
      $msg= $studentId.'student,  added ssuccesfully, '.$newrow_user_id;

      $res='Added';   
     }

     return $res;

   }




 /***
 create_user($role_type='student'){
  $role_type :: student|tutor

 ***/
   function _create_user($role_type='student',$user_arr=array()){ // tutor| student
     $get_user_email=$_GET['email']='Rajk@gmail.com';

////////////////////////////////////
$userId=time();
 //echo $_SESSION['ses_admin_token']; die; 
 $post = [
    'user_name' =>$user_arr['user_name'], //'test_tutor_'.$userId,
    'user_email' =>$user_arr['email'], //'test11@gmail.com',
    'first_name' =>$user_arr['first_name'],
     'last_name' =>$role_type,
     'CompanyUser' =>$role_type, // Instructor | Student
    
    
    
    //'gender'   => 1,
];

   //print_r($post);  die; 

   ////////////////////////////


//print_r($return_data); die;  $_SESSION['ses_admin_token']
// $token="ba2fcb22904057f9bf5ec0a2e785e3cd";
$token=$_SESSION['ses_admin_token']; // 5fc8c417a486296fb3fc334293b2b54c



///////////////////////

$ch = curl_init('https://smart.newrow.com/backend/api/users'); // Initialise cURL
       $post = json_encode($post); // Encode the data array into a JSON string
       $authorization = "Authorization: Bearer ".$token; // Prepare the authorisation token
       curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
       curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Set the posted fields
       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
       $result = curl_exec($ch); // Execute the cURL statement
       $user_row= json_decode($result); 
       curl_close($ch); // Close the cURL connection

        //return $result='==='; 
        
        return $user_row; 

     //  print_r($user_row);exit();  //die;

      // return json_decode($result); // Return the received data





   }





$success_msg[]='Room created at newrow, students added to room , Click below- https://intervene.io/questions/intervention_list.php';
$success_msg[]='<a style="color: blue;
    text-decoration: underline;" href="https://intervene.io/questions/intervention_list.php">Intervention list</a>';

//////////////////////////////////
 if(!empty($warning_msg)){
 	//print_r($warning_msg); //die; 
   echo '<br/>Warning Mesage:<br/>';
  echo implode('<br/>',$warning_msg );
  echo '<br/>';
 }
 ///////////////////
 
 if(!empty($success_msg)){
  echo '<br/>Success Mesage:<br/>';
  echo implode('<br/>',$success_msg );
  exit;
 }

?>