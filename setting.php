<?php 
include 'config/dbconfig.php';
 require_once 'config.php';
 $obj->connect();
session_start();
if($_SESSION['id'] != '')
{
   $ar = $_SESSION['id'];
    $tmp= $obj->selectwhere("admin","id",$ar);
    $pass=0;
    $id = '';
  $row = mysql_fetch_array($tmp);
  $chat =$obj->select("chat");
  
   
  
  
   
?>
<html lang="en" class="no-js">

<head>
    <link rel="stylesheet" type="text/css" href="dist/css/component.css" />
		
		<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
               
		
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script type="text/javascript" src="js/notification.js"> </script>
    <script type="text/javascript" src="js/counter.js"></script>
   
</head>

<body>
  
<div id='dd'> </div>
    <div id="morris-area-chart" hidden="true"></div>
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
                <a class="navbar-brand" href="index.php" style="font-family: fantasy;font-size: 50px;color: #0075b0">Helix</a>
				
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
                    <h1 class="page-header">Setting</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           
            <!-- /.row -->
          
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <snan>Edit Profile</snan>
                            
                        </div>
                     

<center style='background-color: honeydew'> 
    <br>
                            <hr>
                            <h1>Change Profile</h1>
                            <hr>
                            <br>
                            <form action="changesetting.php" method="post" enctype="multipart/form-data" id="fm">
                             
                             <table>
                                  
                                
                                 <tr>
                                    
                                     <td>   <input type="text" class="form-control" name="name" title="Name" placeholder="Enter your Name " data-rule-required="true"  data-msg-required="Please Enter Name"> </td>
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
                        
                        
                        
                        
                        <center style='background-color: honeydew'> <br>
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
                      
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                        <!-- /.panel-heading -->
                       
                                <!-- /.col-lg-4 (nested) -->
                               
                                <div id="morris-bar-chart" hidden="true"></div>
                               
                         
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    
                    <!-- /.panel -->
                   
                            <div id="morris-donut-chart" hidden="true"></div>
                           
                      
                    <!-- /.panel -->
                    
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="dist/js/custom-file-input.js"></script>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="bower_components/raphael/raphael-min.js"></script>
    <script src="bower_components/morrisjs/morris.min.js"></script>
    <script src="js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    	<script src="../dist/jquery.validate.js"></script>
		<script>
			$(document).ready(function() {
				$("#fm").validate();
                                $("#fm1").validate();
				 
			});
			</script>
			

</body>

</html>

<?php

}
else
{
    header("location:login.php");
}
?>
