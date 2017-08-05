<?php
include 'config/dbconfig.php';
 $obj->connect();
session_start();
if($_SESSION['aid'] != '')
{
  
   $ar = $_SESSION['aid'];
    $tmp= $obj->selectwhere("user","id",$ar);
    $pass=0;
    $id = '';
  $row = mysql_fetch_array($tmp);
  date_default_timezone_set('Asia/Kolkata');
  

  $chat =$obj->select("chat");
  $t = '';
  while ($row1 = mysql_fetch_array($chat)) {
           
     $lf="";
     if($row['email']==$row1['semail']){
         $lf="right";
         
     } else{
         $lf="left";
         
     }
      $t.= " <li class='$lf clearfix' >";
      $t.="<span class='chat-img pull-$lf'>";
      $t.=" <img src='$row1[4]'  style='width:40px;height:40px;' class=' img-circle'/>";
      $t.="</span>";
      $t.=" <div class='chat-body clearfix'>";
      $t.="<div class='header'>";
      $t.="<strong class='pull-$lf primary-font'>".$row1[1]."</strong>";
      $t.="  <small class=' text-muted'>";
      $t.="<i class='fa fa-clock-o fa-fw'></i>".$row1[2]."</small></div>";
      $t.= "<p>".$row1[3]."  </p></div></li>";
      
  }
     
  

echo $t;
}
?>