<?php 
include 'config/dbconfig.php';
require_once 'config.php';

 $obj->connect();
session_start();
if($_SESSION['aid'] != '')
{
    
        $tododetail=$_REQUEST['id'];
      $tname=$_REQUEST['tname'];
       $tddate=$_REQUEST['tddate'];
       
        $user=$_REQUEST['tuser'];
        $tcomment=$_REQUEST['tcomment'];
        
       
        $tmp= $obj->selectwhere("todos","id='$tododetail'");
    
  $row = mysql_fetch_array($tmp);
  
   $tmp1= $obj->selectwhere("tasking","id='$row[1]'");
    
  $row1 = mysql_fetch_array($tmp1);
   
       
   
       
         
    date_default_timezone_set('Asia/Kolkata');
  $time=time();
  $ctime= date('d-m-Y ');
       $ins = "assign_user_id='$user',todo_title='$tname',todo_due_date='$tddate',todo_description='$tcomment',updated_at='$ctime' where id='$tododetail'";

      $usr= $obj->updatecamp("todos",$ins);
      
     
            
            $notydata ="'',' Todos Update : $row[4] <br> Campiagn Name : $row1[2]','unread','$ctime','$user',''";
         $usrnoty= $obj->insert_noty("noty",$notydata);
           
    
         $idgen = urlencode(encryptor('encrypt', $tododetail)); 
            $msg="Todo Edit sucsessfuly";
          $msgen = urlencode(encryptor('encrypt', $msg));  
        
          header("location:tododetail.php?id=$idgen&msg=$msgen");
          exit;
}
else
{
    header("location:index.php");
}
  ?>