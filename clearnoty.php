<?php 
include 'config/dbconfig.php';
 $obj->connect();
session_start();
if($_SESSION['aid'] != '')
{
   $ar = $_SESSION['aid'];
    $tmp= $obj->selectwhere("user","id='$ar'");
   // $pass=0;
  //  $id = '';
  $row = mysql_fetch_array($tmp);
 // $chat =$obj->select("chat");
  $where = "uemail='$row[3]'";
    $mails= $obj->deleteData("noty",$where);
    
    header("location:index.php");
}

else
{
    header("location:login.php");
}