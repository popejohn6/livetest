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
<script src='dist/js/fullcalendar.min.js'></script>

<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({
                        
			theme: true,
                        height: 450,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			
			
			eventLimit: true, // allow "more" link when too many events
			events: "calendardata.php",  
                        eventColor: '#378006'
		});
		
	});
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
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
                <div class="col-lg-12">
                    <h1 class="page-header heading">Report 
					 <button class="btn btn-success  btn-circle btn-lg" title="Print"  onclick="printDiv('printableArea')" type="button"><i class="fa fa-print"></i>
					</h1>
				</div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <!-- /.row -->
            <div id="printableArea">
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
