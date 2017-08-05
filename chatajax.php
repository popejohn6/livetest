<?php 
include 'config/dbconfig.php';
 $obj->connect();
session_start();
if($_SESSION['aid'] != '')
{
   $ar = $_SESSION['aid'];
    $tmp= $obj->selectwhere("user","id='$ar'");
    $pass=0;
    $id = '';
  $row = mysql_fetch_array($tmp);
  $chat =$obj->select("chat");

   $noty= $obj->selectwhere("noty","status='unread' AND uemail='$row[3]'");

   
   
   
  
  date_default_timezone_set('Asia/Kolkata');
  

  $chat =$obj->select("chat");
  $count = 0;
  $alrt="";
  while ($row1 = mysql_fetch_array($noty)) {
      if($count <5)
      {
          $alrt.=" <li ><a style='color: black;text-decoration: none;'> <div><span style='font-size:12px'; > <span style='margin:1%;'>".$row1[1]."</span> </span><span style='padding-right:10%;' class='pull-right text-muted small'>".$row1[3]."</span> </div></a></li> <li class='divider'></li>";                               
          $count = $count + 1;
          
      }
      
     
      
  }
  
  // $alrt.="uday</ul>";
  
   
     echo $alrt;
  
//echo json_encode(array("uday", $t));


   
   
   
       
}
else
{
    header("location:login.php");
}
?>
