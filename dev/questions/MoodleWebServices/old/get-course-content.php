<?php

$token = '02104727338432bcc247cce5338abb18';
$domainname = 'https://ellpractice.com/intervene/moodle';
$functionname = 'core_course_get_contents';
require_once('cur-moodlel.php');
$curl = new curl;
$restformat = 'json'; 

$params = array('courseid' =>$couserID,);

$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;

$restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';

$resp = $curl->post($serverurl . $restformat, $params);

$respons = json_decode($resp,true);
$i=1;

$Qustion=[];

foreach ($respons as  $subaaray) {


	foreach ($subaaray['modules'] as $value) {


   		$Qustion[$i]= $value['id'];
   		$instance[$value['id']] = $value['instance'];


   		$i++;
   		
   	}
   
   }  
 ?>   

