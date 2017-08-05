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
    
    if(isset($_REQUEST['submit']))
  {
      $cname=$_REQUEST['campaign'];
      
       $user=$_REQUEST['user'];
        $title=$_REQUEST['title'];
        $description=$_REQUEST['description'];
        $ddate=$_REQUEST['ddate'];
        date_default_timezone_set('Asia/Kolkata');
       $date =date('d-m-Y H:i');
       
       $ins = "'','$cname','$row[1]','$user','$title','$description','$ddate','','','','$date',''";

      $usr= $obj->insert_user("todos",$ins);
      
        
      
         $campdata= $obj->selectwhere("tasking","id",$cname);
          $campdetail = mysql_fetch_array($campdata);
      
       $ctimeday= date('d-m-Y ');
        $notydatatodo ="'',' Added you to a : $title Todo <br> Campaign name : $campdetail[2]','unread','$ctimeday','$user',''";
         $usrnotytodo= $obj->insert_user("noty",$notydatatodo);
         
         
         $msgen1 = urlencode(encryptor('encrypt', "Add Todo Sucsessfuly"));  
      header("location:todos.php?msg=$msgen1");
     
      exit;
        
        
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
      <link href="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
     <link href="dist/css/table.css" rel="stylesheet">
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
    
      <script>
function userdata(val) {
    var x = val;
   
    $.ajax({
  type: "POST",
  url: "userdata.php",
  data: {id:val},
  success: function(data){
    
    document.getElementById("usr").innerHTML = data;

}
});
}
</script>
<script>
  $(function() {
    $( "#datepicker" ).datepicker({ minDate: 0 });
     
  });
  </script>
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
        <form action="todos.php" method="post" id="commentForm">
                            <!-- Modal -->
                            <div class="modal fade" id="todos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Create Todo's</h4>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                              
                                                <select class="form-control"  name="campaign" required="true" onchange="userdata(this.value)"  data-rule-required="true"  data-msg-required="Please Select Campaign ">            

                                                 <option value="">Select Campaign</option>
                                                    <?php
                                                    
                                                    while ($campdetail = mysql_fetch_array($camp)) {
                                                        ?><option value="<?php echo $campdetail['id']; ?>"><?php echo $campdetail['name']; ?></option> <?php
                                                    }
                                                    ?>


                                            </select>
                                                
                                                <select class="form-control" name="user" id="usr" required="true"  data-rule-required="true"  data-msg-required="Please Select User ">            
                                                <option value="">Select User</option>
                                                 
                                            </select>
                                                <input  class="form-control" type="text" name="title" placeholder="Enter Todo's title"  data-rule-required="true"  data-msg-required="Please Enter Todo Title">
                                                <textarea class="form-control" name="description" cols="22" placeholder="Enter Todo's Description "  data-rule-required="true"  data-msg-required="Please Enter Description"></textarea>
                                                 <input type="text" id="datepicker" class="form-control" name="ddate" placeholder="Enter Due Date "  data-rule-required="true"  data-msg-required="Please Enter Due Date"> 
                                                 
                                                 
                                                </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                            <input type="submit" class="btn btn-primary" name="submit" value="Add">
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                             </form>
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
                    <h1 class="page-header heading">ToDo's
                     <?php  
                            if($row[6] == "editor")
                            {
                               
                        ?>
                        <button class="btn btn-success  btn-circle btn-lg" title="Create New Todo" data-toggle='modal' data-target='#todos' type="button"><i class="fa  fa-edit"></i>
</button>
                       
                    <?php
                            } 
                            ?>
                    
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <!-- /.row -->
            
                
                        
                     
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ToDo's Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead >
                                        <tr >
                                           <th style="color: black">Campaign</th>
                                            <th style="color: black">Title</th>
                                            <th style="color: black">Description</th>
                                            <th style="color: black">Due Date</th>
                                             <th style="color: black">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         
                                        <?php 
                            
                
                            while ($tk = mysql_fetch_array($todos)) {
								 $campinfo =$obj->selectcamp("tasking","id='$tk[1]'");
  
						$campinformation = mysql_fetch_array($campinfo);
                               echo '<tr class="odd gradeX">';
                                 echo '<td>'.$campinformation[2]."</td>";
                                 echo '<td>'.$tk[4]."</td>";
                                 echo '<td>'.$tk[5]."</td>";
                                 echo '<td>'.$tk[6]."</td>";
                                  $idgen = urlencode(encryptor('encrypt', $tk[0]));  
                                echo "<td>  <a style='text-decoration: none' href='tododetail.php?id=".$idgen."'> <i class='fa  fa-folder-open  fa-x'></i> </a>"."</td>";
  
                                 echo '</tr>'; 
                                      } 
                                         
                                      
                                      ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                             
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
             
        </div>
     </div>
    
   
  <?php //  <script src="bower_components/jquery/dist/jquery.min.js"></script> ?>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>
  <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    
   
     <script src="dist/js/sb-admin-2.js"></script>
      <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
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
