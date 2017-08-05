<?php 
include 'config/dbconfig.php';
 $obj->connect();
session_start();
if($_SESSION['aid'] != '')
{
   $ar = $_SESSION['aid'];
    $tmp= $obj->selectwhere("user","id ='$ar'");
    $pass=0;
    $id = '';
  $row = mysql_fetch_array($tmp);
  $chat =$obj->select("chat");
  $finaluemail2 =explode("@",$row[3]);
   $noty= $obj->selectwhere("mail","status='unread' AND uemail = '$finaluemail2[0]'");

  

  $chat =$obj->select("chat");
  $count = 0;
  $alrt="";
  while ($row1 = mysql_fetch_array($noty)) {
      if($count <5)
      {
          $alrt.=" <a style='color: black;text-decoration: none;'> <div> <strong style='padding-left:05%'>".$row1[8]."</strong><span style='padding-right:10%;' class='pull-right text-muted small'>".$row1[5]."</span><span style='font-size:12px'; > <br><span style='padding-left:05%'>".$row1[2]."</span> </span> </div></a></li> <li class='divider'></li>";                               
          
          
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
