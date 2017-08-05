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
  
  $finaluemail =explode("@",$row[3]);
  
  $noty= $obj->selectwhere("mail","status='unread' AND uemail='$finaluemail[0]'");

  

  $chat =$obj->select("chat");
  $count = 0;
  $alrt="";
  while ($row1 = mysql_fetch_array($noty)) {
     
     
                $count = $count + 1;
          
  
    

     
      
  }
  
  // $alrt.="uday</ul>";
  if($count <=0)
  {
      $count='';
  }
   
     echo $count;
  
//echo json_encode(array("uday", $t));


   
   
   
       
}
else
{
    header("location:login.php");
}
?>
