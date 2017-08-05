<?php 
include 'config/dbconfig.php';
 require_once 'config.php';

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
   $notification= $obj->selectwhere("noty","uemail='$row[3]'");
    $todos= $obj->selectcamp("todos","assign_user_id='$row[3]'");
    
  
    $camp= $obj->select("tasking");
 
    $username="";
    $campdata ="";
     while ($tk = mysql_fetch_array($camp)) {
         
         $username =$tk[1];
         $myArray = explode(',', $username);
        
         foreach ($myArray as $value) {
             
             if($value == $row[3])
             {
                 
                  $ttamp=0;
                           
                             if($ttamp < 5)
                             { 
                                 $pr =$tk[8];
                                 $clr ="";
                                 if($pr=="High")
                                 {
                                     $clr = "<b><span style='color: red'>".$pr."</span></b>";
                                 }
                                 if($pr == "Medium")
                                 {
                                     $clr = "<b><span style='color:  #ffcccc'>".$pr."</span></b>";
                                 }
                                 if($pr == "Low")
                                 {
                                     $clr = "<b> <span style='color:blue'>".$pr."</span></b>";
                                 }
                                 
                                 $ttamp=$ttamp+1; 
                              $campdata.=" <a style='text-decoration: none' href='campaign.php'/> <i class='fa  fa-folder-open  fa-2x'></i>";
                                $campdata.="<br>Create by : ".$tk[13]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br> Task Name  : <span style=color:maroon>". $tk[2]."<br>   </span> Priority : ". $clr."<br> Creator : <span style=color:maroon>". $tk[12]."</span><br><br> </a> <hr style='display: block;height: 1px;border: 0;border-top: 1px solid #ccc;margin: 1em 0; padding: 0;'>"; 
                               }
                                else
                                {
                                    
                                }
                                
                 
                 
             }
         }
         
     
     }
	 
	 if(isset($_REQUEST['pass']))
  {
      $cpass=$_REQUEST['pass1'];
      $pass2=$_REQUEST['pass2'];
      $pass1=$_REQUEST['pass3'];
      $msg="";
       if($pass2 == $pass1)
       {
           if($row['password']==$cpass)
           { 
               $ins = "password='$pass2' where id='$ar'";
                $usr= $obj->updatecamp("user",$ins);
				
                $msg="Password change sucsessfuly";
              $msgen = urlencode(encryptor('encrypt', $msg));  
               header("location:profile.php?msg=$msgen");
			   exit;	
               
           }
           else
           {
               $msg="Password not match please try again";
              $msgen = urlencode(encryptor('encrypt', $msg));  
               header("location:profile.php?msg=$msgen");
               exit;
           }
       }
       else
       {
             $msg="Please enter same password";
              $msgen = urlencode(encryptor('encrypt', $msg));  
               header("location:profile.php?msg=$msgen");
               exit;
       }
     
        
       
  
  
  }
   
   
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>OTM</title>
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
     <link href="dist/css/timeline.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
     <link href="bower_components/morrisjs/morris.css" rel="stylesheet">
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <script src="dist/js/jslib.js"></script>
    <script type="text/javascript" src="js/notification.js">
 
</script>
   
 
<?php // <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> ?>

<link rel="stylesheet" href="dist/css/jquery-ui.css" />   
    <script src="js/jquery-ui.js"></script>
 
        <!--pqSelect dependencies-->
          <script type="text/javascript" src="js/notification_1.js"> </script>
    <script type="text/javascript" src="js/counter.js"></script>
    <script type="text/javascript" src="js/counternoty.js"></script>
    <link rel='stylesheet' href='lib/cupertino/jquery-ui.min.css' />
<link href='dist/css/fullcalendar.css' rel='stylesheet' />
<link href='dist/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='lib/moment.min.js'></script>
<script src='lib/jquery.1.11.min.js'></script>
 
    <script src="dist/jquery.validate.js"></script>
<script>
	$(document).ready(function() {
		$("#fm").validate();
		$("#fm1").validate();
		 
	});
	</script>
</head>

<body>
  
 
    
     
   
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="font-family: fantasy;font-size: 50px;color: #0075b0"><img src="logo.png" width="160px" height="30px"></img></a>
				
            </div>
            <!-- /.navbar-header -->

            <?php include 'header.php'; ?>
            <!-- /.navbar-top-links -->

            <?php include 'menu.php'; ?>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
			  <?php 
                                     $msg="";
                                    if( isset($_GET['msg']) && !empty( $_GET['msg'] ) ){
                                        $msg = urldecode($_GET['msg']);
                                        $msg = encryptor('decrypt', $msg);
                                        ?>
                                          <script>
                                        setTimeout(function() {
                                        $('#mydiv').slideUp();
                                    }, 2000);
                                        </script>
                                        <div id="mydiv" class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                               <?php echo $msg; ?>
                                         </div>
                                         <?php
                                    }   
                        
                                    ?>  
                <div class="col-lg-12">
                    <h1 class="page-header heading">Profile</h1>
                </div>
                <!-- /.col-lg-12 -->
				
            
            <!-- /.row -->
            
<center> 
     
                            
                            <h1>Change Profile</h1>
                            <hr>
                            <br>
                            <form action="changesetting.php" method="post" enctype="multipart/form-data" id="fm">
                             
                             <table>
                                  
                                
                                 <tr>
                                    
                                     <td>   <input type="text" class="form-control" name="name" title="First Name" value="<?php echo $row['fname'];?>" placeholder="Enter your First Name " data-rule-required="true"  data-msg-required="Please Enter First Name"> </td>
                                 </tr>
								 <tr>
                                    
                                     <td>   <input type="text" class="form-control" name="lname" title="Last Name" value="<?php echo $row['lname'];?>" placeholder="Enter your Last Name " data-rule-required="true"  data-msg-required="Please Enter Last Name"> </td>
                                 </tr>
                                 <tr>
                                     
                                     <td>Select Profile Image :  <input type="file" class="form-control" accept="image/*" name="img" title="Image" > </td>
                                 </tr>
                                 <tr>
               
                                     <td> <input type="password" title="Password" class="form-control" name="password" placeholder="Enter Old Password " data-rule-required="true"  data-msg-required="Please Enter Old Password"></td>
                                 </tr>
                                 
                                  <tr>
                                      
                                     <td><input class="btn btn-primary" type="submit" name="profile" value="Change Profile">
                                      <input class="btn btn-primary" type="reset" name="reset" value="clear">
                                     </td>
                                 </tr>
                                  
                                 
                             </table>
                       
                                  
                         </form><br>
                         
                        </center>
                        
                        
                        
                        
                        <center> <br>
                            <hr>
                            <h1>Change Password</h1>
                            <hr>
                            <br>
                            
                            <form action="" method="post" id="fm1">
                             
                             <table>
                                  
                                
                                 <tr>
                                    
                                     <td>   <input type="password" title="Old Password" class="form-control" name="pass1" placeholder="Enter Old Password " data-rule-required="true"  data-msg-required="Please Enter Old Password"> </td>
                                 </tr>
                                 <tr>
                                     
                                     <td>  <input type="password" title=" New Password" class="form-control" name="pass2" placeholder="Enter New Password " data-rule-required="true"  data-msg-required="Please Enter New Password"> </td>
                                 </tr>
                                 <tr>
               
                                     <td> <input type="password" title="Conform Password" class="form-control" name="pass3" placeholder="Conform Password " data-rule-required="true"  data-msg-required="Please Enter Same Password As Above"></td>
                                 </tr>
                                 
                                  <tr>
                                      
                                     <td><input class="btn btn-primary" type="submit" name="pass" value="Change Password">
                                      <input class="btn btn-primary" type="reset" name="reset" value="clear">
                                     </td>
                                 </tr>
                                  
                                 
                             </table>
                       
                                  
                         </form><br>
                         
                        </center>
                        <!-- /.panel-heading -->

            <!-- /.row -->
            
            <div style="margin: 0 auto;" id='calendar'></div>
              
                        
                       
                     
           
             
        </div>
     </div>
    
   </div>
  <?php //  <script src="bower_components/jquery/dist/jquery.min.js"></script> ?>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="bower_components/raphael/raphael-min.js"></script>
    <script src="bower_components/morrisjs/morris.min.js"></script>
    <script src="js/morris-data.js"></script>
     <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>

<?php
}
else
{
    header("location:login.php");
}
?>
