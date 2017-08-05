<?php 
include 'admin/config/dbconfig.php';
require_once 'config.php';

 $obj->connect();
session_start();
if($_SESSION['aid'] != '')
{
   $ar = $_SESSION['aid'];
    $tmp= $obj->test("user","id",$ar);
    $pass=0;
    $id = '';
	$lname="";
  $row = mysql_fetch_array($tmp);
  
   if(isset($_REQUEST['profile']))
  {
         

      $name=$_REQUEST['name'];
	   $lname=$_REQUEST['lname'];
      $cpass=$_REQUEST['password'];
      
      $msg="";
       $file="";
	   
           if($row['password']==$cpass)
           { 
                if($_FILES['img']["name"]!="")
                {
                        $target_dir = "admin/upload/"; 
                     $target_file = $target_dir . basename($_FILES["img"]["name"]);
                       $file =basename($_FILES["img"]["name"]);
                         if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {

                         } else {

                         }
                }
                else
                {
                    $file=$row['image'];
                }
            
               $ins = "fname='$name',lname='$lname',image='$file' where id='$ar'";
                $usr= $obj->updatecamp("user",$ins);
                $msg="profile change sucsessfuly";
              $msgen = urlencode(encryptor('encrypt', $msg));  
               header("location:profile.php?msg=$msgen");
               exit;
               
           }
           else
           {
               $msg="Password not match please try again";
              $msgen = urlencode(encryptor('encrypt', $msg));  
               header("location:profile.php?msg=$msgen");
           }
        
       
     
        
       
  
  
  }
       
}
else
{
    header("location:login.php");
}
?>
