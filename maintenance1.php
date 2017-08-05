<?php 
include 'config/dbconfig.php';
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
  
  if(isset($_REQUEST['maintenance']))
  {
      $_SESSION['aid']=$id;
     $maintenance=$_REQUEST['maintenancevl'];
       
        $ins = "maintenance='$maintenance'";
      $chanel= $obj->update_data_mail("maintenance","maintenance='$maintenance'","id='1'");
     
  }
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

            <?php include 'admin/pages/header.php'; ?>
            <!-- /.navbar-top-links -->

            <?php include 'admin/pages/menu.php'; ?>
            <!-- /.navbar-static-side -->
        </nav>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Maintenance  </h1>
                </div>
                
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
                                
       

            <!-- /.row -->
            <div class="row">
               
                <form action="maintenance.php">
                    <select name="maintenancevl">
                        <option value="">Select</option>
                        <option>ON</option>
                        <option>OFF</option>                        
                    </select>
                    <input type="submit" name="maintenance" value="Save">
                </form>
                                <div id="morris-bar-chart" hidden="true"></div>
                               
                         
               
              
                    
                    <!-- /.panel -->
                   
                            <div id="morris-donut-chart" hidden="true"></div>
                           
                      
                    <!-- /.panel -->
              
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

</body>

</html>

<?php

}
else
{
    header("location:login.php");
}
?>
