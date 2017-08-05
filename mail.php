<?php 
include 'config/dbconfig.php';
require_once 'config.php';

 $obj->connect();
session_start();
if($_SESSION['aid'] != '')
{
   $ar = $_SESSION['aid'];
    $tmp= $obj->selectwhere("user","id='$ar'");
    $userinfo= $obj->select("user");
     $admininfo= $obj->select("admin");
   // $pass=0;
  //  $id = '';
  $row = mysql_fetch_array($tmp);
 // $chat =$obj->select("chat");
   $notification= $obj->selectwhere("noty","uid='$ar'");
 $tmp=0;
   if (isset($_REQUEST['Sent']))
   {
	  
       $obj->connect();
       $uname = $_REQUEST['user'];
        $title = $_REQUEST['title'];
       $message = $_REQUEST['msg'];
       while ($row2 = mysql_fetch_row($userinfo)) {
		   $uimail =explode("@",$row2[3]);
           if($uimail[0]==$uname)
           {
               $tmp=1;
           }
       }
        while ($row3 = mysql_fetch_row($admininfo)) {
			$aimail =explode("@",$row3[1]);
           if($aimail[0]==$uname)
           {
               $tmp=1;
           }
       }
       if($tmp==1)
       {
       date_default_timezone_set('Asia/Kolkata');
       $ip ='';
       $file="";
       
        $target_dir = "admin/upload/"; 
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    
    $file =basename($_FILES["file"]["name"]);
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
       
    }  
     
      $a = $obj->insert_mail('mail',$uname,$title,$message,$file,date('d-m-Y H:i'),$ip,$row[3]);
     //  $obj->selectwhere("admin","id",$ar);
      
    $msg="Message Send Sucsessfuly";
          $msgen = urlencode(encryptor('encrypt', $msg));  
           header("location:mail.php?msg=$msgen");
           exit;
           
       }
       else
       {
            $msg="Email Address Not Found Please Try Again";
          $msgen = urlencode(encryptor('encrypt', $msg));  
           header("location:mail.php?msg=$msgen");
           exit;
       }
       
   }
   $finaluemail =explode("@",$row[3]);
        $mail= $obj->selectwhere("mail","uemail='$finaluemail[0]'");
         
        
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
 <script src="bower_components/jquery/dist/jquery.min.js"></script>
 
<?php // <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> ?>

<link rel="stylesheet" href="dist/css/jquery-ui.css" />   
    <script src="js/jquery-ui.js"></script>
 
        <!--pqSelect dependencies-->
          <script type="text/javascript" src="js/notification_1.js"> </script>
    <script type="text/javascript" src="js/counter.js"></script>
    <script type="text/javascript" src="js/counternoty.js"></script>
    
    <script src="dist/jquery.validate.js"></script>
<script>
	$(document).ready(function() {
		$("#commentForm").validate();
		 
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
                                        },2000);
                                        </script>
                                        <div id="mydiv" class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                               <?php echo $msg; ?>
                                         </div>
                                         <?php
                                    }   
                        
                                    ?>     
                <div class="col-lg-12">
                    
                    <h1 class="page-header heading">Mail  <button class="btn btn-success  btn-circle btn-lg" title="Delete" data-toggle='modal' data-target='#banddelete' type="button"><i class="fa  fa-send"></i>
</button></h1>
                </div>
                 
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <div style="padding-top: 01%" class="pull-right">
                 <a  href="maildel.php" style="color: white;"> DELETE ALL MAIL</a>
              </div>
        
            <!-- /.row -->
            <div class="row">
              
                   
                    <!-- /.panel -->
                  
                       
                       <div class="panel panel-primary">
                        <div class="panel-heading">
                            
                            <i class="fa fa-comments fa-fw"></i>
                           Inbox
                            <div class="btn-group pull-right">
                                
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body"style="overflow: scroll;height: 280px;">
                            
                           
                            <?php
                            while ($row1 = mysql_fetch_array($mail)) {
     ?>
       
          <a href='#' style='color: black;text-decoration: none;'> 
              <div title="<?php echo $row1[8];?>"> 
			   <?php $finaluemail4 =explode("@",$row1[8]); ?>
                  <span style="color: #0088cc"> <?php echo $finaluemail4[0]; ?></span>
                  <strong>
                      &nbsp; [ <?php echo $row1[2]; ?> ]
                  </strong>
                 
                  <span  class='pull-right text-muted small'>
                     <?php  echo $row1[5]; ?>
                      </span>
                  <span style='font-size:12px'>
                      <br>
                      <span style='padding-left:05%'><br>
                         <?php echo $row1[3];?> 
                          <?php if($row1[4] != "")
                          {
                              ?><br><br> 
                                <a href="download.php?filename=<?php echo $row1[4] ?>" target="_target">Attachment </a><?php
                          }
                              ?>
                             
                          <hr style="display: block;height: 1px;border: 0;border-top: 1px solid #ccc;margin: 1em 0; padding: 0;">
                      </span> 
                  </span> 
              </div>
          </a>
                            
        
                            <span class='divider'></span><br>                              
         <?php
          
     

     
      
  }
                            
                            
                            ?>
                           
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="table-responsive">
                                       
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                               
                                <div id="morris-bar-chart" hidden="true"></div>
                               
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                   
                    
                        
                        <!-- /.panel-heading -->
                   
                            <form action="mail.php" method="post" role="form" style="padding-left: 50px;" enctype="multipart/form-data" id="commentForm">

                            <!-- Modal -->
                            <div class="modal fade" id="banddelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Send Mail</h4>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                              
                                             <table>
                                    <tr>
                                    <td><br>
                                        <div class="form-group input-group">
                                         <span class="input-group-addon">@</span>
                                         <input type="text"  name="user" class="form-control" placeholder="Enter User Name" data-rule-required="true"  data-msg-required="Please Enter Sender User Name ">
                                     </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><br>
                                        <input type="text"  name="title" cols="120" class="form-control" placeholder="Enter Title" data-rule-required="true"  data-msg-required="Please Enter Title "></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><br>
                                         <textarea class="form-control" name="msg" rows="10" cols="120" placeholder="Enter Message ..."></textarea>
                                     
                                        <input class="form-control" style="color: #0088cc;" type="file" name="file" />
                                    </td>
                                </tr>
                                
                                
                                  </table>        
                                                 
                                                </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                            <input type="submit" class="btn btn-primary" name="Sent" value="Send">
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                             </form>
    
                                    
                        
                             
                       
                        
                        <!-- /.panel-body -->
                    
                   
            </div>
        </div>
    </div>
    
    
   

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
