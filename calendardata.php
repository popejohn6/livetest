<?php
include 'config/dbconfig.php';
 $obj->connect();
session_start();
if($_SESSION['aid'] != '')
{
   $ar = $_SESSION['aid'];
    $tmp= $obj->selectwhere("user","id='$ar'");
  
  $row = mysql_fetch_array($tmp);
  
   $notification= $obj->selectwhere("noty","uemail='$row[3]'");
    $todos= $obj->selectcamp("todos","assign_user_id='$row[3]' and is_completed=''");
 
$events = array();
$day ="";
$month = "";
 $year = "";
$datedata="";
$dataednd="";
$eday ="";
$emonth = "";
$eyear = "";
$sdates="";
$edates="";
while ($row = mysql_fetch_array($todos)) {
    
    
    
     $datedata = explode('/',$row[6]);

    $day =$datedata[1];
    $day=$day+1;
    $month=$datedata[0];
     $year=$datedata[2];
     $sdates = $year."-".$month."-".$day;
     
     $dataednd=explode('-',$row[10]);
 $eday =$dataednd[0];
$emonth =$dataednd[1];
$eyear =$dataednd[2];

$edates=$eyear;
     $edates= substr($edates, 0, -6 );
    
    $edatesyear =$edates."-".$emonth."-".$eday;
    $start =$edatesyear;
    $end =$sdates;
    $title = $row[4];
    
   
    $eventsArray['title'] = $title;
    $eventsArray['start'] = $start;
    $eventsArray['end'] = $end;
    $eventsArray['description']=$row[5];
    $events[] = $eventsArray;
}
echo json_encode($events);
}
 else {
    header("location:index.php");
}
?>
