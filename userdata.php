<?php 
include 'config/dbconfig.php';
 $obj->connect();
session_start();
if($_SESSION['aid'] != '')
{
   $ar = $_SESSION['aid'];
    $tmp= $obj->selectwhere("user","id",$ar);
    $pass=0;
    $id = $_REQUEST['id'];
  $row = mysql_fetch_array($tmp);
  
  $where ="id ='$id'";
$campdata= $obj->selectwhere("tasking",$where);
$campdetail = mysql_fetch_array($campdata);
  $userdata="<option value=''>Select User</option>";
  $usercamps = explode(',', $campdetail[1]);

                  foreach ($usercamps as $username) {
                       if($username !=  "")
                       {
                      $userdata.="<option value='".$username."'>".$username."</option>";
                  }}
              echo $userdata;  
   
       
}
else
{
    header("location:login.php");
}
?>
