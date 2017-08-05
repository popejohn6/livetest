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
    $todos= $obj->selectcamp("todos","assign_user_id='$row[3]' and is_completed=''");
    
  
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
                                   $cid = urlencode(encryptor('encrypt', $tk[0]));  
                              $campdata.=" <a style='text-decoration: none' href='campaign_detail.php?id=$cid'/> <i class='fa  fa-folder-open  fa-2x'></i>";
                                $campdata.="<br>Create by : ".$tk[13]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br> Campaign Name  : <span style=color:maroon>". $tk[2]."<br>   </span> Priority : ". $clr."<br> Detail : <span style=color:maroon>". $tk[12]."</span><br><br> </a> <hr style='display: block;height: 1px;border: 0;border-top: 1px solid #ccc;margin: 1em 0; padding: 0;'>"; 
                               }
                                else
                                {
                                    
                                }
                                
                 
                 
             }
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
                <div class="col-lg-12">
                    <h1 class="page-header heading">Recent</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4" >
                    <div class="panel panel-green">
                        <div class="panel-heading">
                           Todo's 
                        </div>
                        <div class="panel-body" style="overflow: scroll;height: 480px;">
                             <?php 
                            $tdtamp11=0;
                            
                            while ($tds = mysql_fetch_array($todos)) {
                             
                              if($tdtamp11 <5)
                                {
                                   
                                  
                                 /*  $day ="";
                                   $month = "";
                                   $year = "";
                                    $datedata = explode('/',$tds[6]);
                                    
                                        $day =$datedata[0];
                                        $month=$datedata[1];
                                         $year=$datedata[2];
                                         echo date("Y");
                                         echo date("m");
                                          echo date("d");
                                   $clr1 ="";
                                 if(date("Y") == $year)
                                 {
                                     $clr1 = "<b><span style='color: red'>".$pr."</span></b>";
                                 }
                                 if($pr == "Medium")
                                 {
                                     $clr1 = "<b><span style='color:  #ffcccc'>".$pr."</span></b>";
                                 }
                                 if($pr == "Low")
                                 {
                                     $clr1 = "<b> <span style='color:blue'>".$pr."</span></b>";
                                 }*/
                                 
                                  $tdtamp11=$tdtamp11+1;
                                  $cids = urlencode(encryptor('encrypt', $tds[0])); 
                                   echo " <a style='text-decoration: none' href='tododetail.php?id=$cids'/> <i class='fa  fa-folder-open  fa-2x'></i>";
                                echo "<br>Create by : ".$tds[2]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br> Title  : <span style=color:maroon>". $tds[4]."<br>   </span> 	Todo Due Date : ". $tds[6]."<br> <br> </a>"; 

                                ?> 
                                  <hr style="display: block;height: 1px;border: 0;border-top: 1px solid #ccc;margin: 1em 0; padding: 0;">
                                  <?php }
                                else
                                {
                                    
                                }
                             ?>
                                 <?php } ?>
                        </div>
                        <div class="panel-footer">
                            Todo's
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
                <div class="col-lg-4" >
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            Notification <span style="text-align:center"><a style="color: white;padding-left: 150px;" href="clearnoty.php">Clear All</a></span>
                        </div>
                        <div class="panel-body" style="overflow: scroll;height: 480px;">
                            <?php 
                             $ntamp=0;
                            while ($dt = mysql_fetch_array($notification)) {
                              
                                  $ntamp=$ntamp+1;
                             echo $dt[1]."<br><span style=color:grey;padding-left:140px> Date :". $dt[3]."</span><br>"; ?> 
                            <hr style="display: block;height: 1px;border: 0;border-top: 1px solid #ccc;margin: 1em 0; padding: 0;">
                            
                             <?php } ?>
                        </div>
                        <div class="panel-footer">
                           Notification
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            Campaign
                        </div>
                        <div class="panel-body" style="overflow: scroll;height: 480px;">
                            <p > <?php 
                                 echo $campdata;
                             ?></p>
                        </div>
                        <div class="panel-footer">
                           Campaign
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
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
