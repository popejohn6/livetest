<?php
include 'config/dbconfig.php';
 $obj->connect();
session_start();
if($_SESSION['aid'] != '')
{
   $msg = $_REQUEST["data1"];
   $ar = $_SESSION['aid'];
    $tmp= $obj->selectwhere("user","id",$ar);
    $pass=0;
    $id = '';
  $row = mysql_fetch_array($tmp);
  date_default_timezone_set('Asia/Kolkata');
  

  $chat =$obj->insert_data("chat",$row["email"],date('d-m-Y H:i'),$msg,$row['image']);

$t = $chat;

echo $t;
}

else
{
    header("location:login.php");
}
?>