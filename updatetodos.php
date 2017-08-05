<?php 
include 'config/dbconfig.php';
require_once 'config.php';

 $obj->connect();
session_start();
if($_SESSION['aid'] != '')
{
     if(isset($_REQUEST['id']))
    {   $id =$_REQUEST['id'];
        $todocomplate = $obj->updatecamp("todos","is_completed='yes' Where id=$id");
        
        $msgen = urlencode(encryptor('encrypt',"Todo Complete sucsessfully "));      
  header("location:todos.php?msg=$msgen");
  exit;
    }
    
      
}
 else {
    header("location:login.php");   
}