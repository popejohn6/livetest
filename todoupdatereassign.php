<?php 
include 'config/dbconfig.php';
require_once 'config.php';

 $obj->connect();
session_start();
if($_SESSION['aid'] != '')
{
    
        $tododetail=$_REQUEST['id'];
        
      
        $user=$_REQUEST['tuser'];
        
       
        $tmp= $obj->selectwhere("todos","id='$tododetail'");
    
  $row = mysql_fetch_array($tmp);
  
   $tmp1= $obj->selectwhere("tasking","id='$row[1]'");
    
  $row1 = mysql_fetch_array($tmp1);
   
       
   
       
         
    date_default_timezone_set('Asia/Kolkata');
  $time=time();
  $ctime= date('d-m-Y ');
       $ins = "assign_user_id='$user',reassign_by='$row[3]' where id='$tododetail'";

      $usr= $obj->updatecamp("todos",$ins);
	 
     
     $notydata ="'',' Reassign  Todo : $row[4] <br> campaign name : $row1[2] <br> assign by :$row[3]','unread','$ctime','$user',''";
         $usrnoty= $obj->insert_noty("noty",$notydata);
           
       
   $msgen = urlencode(encryptor('encrypt',"Reassign sucsessfully"));      
  header("location:todos.php?msg=$msgen");
  exit;
}
else
{
    header("location:index.php");
}
  ?>