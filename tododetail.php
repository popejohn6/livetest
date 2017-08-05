<?php 
include '../config/dbconfig.php';
require_once 'config.php';
 $obj->connect();
session_start();
if($_SESSION['id'] != '')
{
   $ar = $_SESSION['id'];
    $tmp= $obj->selectwhere("admin","id='$ar'");
   // $pass=0;
  //  $id = '';
  $row = mysql_fetch_array($tmp);
 // $chat =$obj->select("chat");
  // $notification= $obj->selectwhere("noty","uemail='$row[3]'");
    //$todos= $obj->selectcamp("todos","assign_user_id='$row[3]'");
    $letter="";
    $where ="";
    $campid="";
    $todoid="";
     $nr="";
    if(isset($_REQUEST['id']))
    {
           
                                    
        if( isset($_GET['id']) && !empty( $_GET['id'] ) ){
            $id = urldecode($_GET['id']);
            $todoid = encryptor('decrypt', $id);




        }   
                        
                                      
       // $todoid =$_REQUEST['id'];
        $where ="id ='$todoid'";
         $tododata= $obj->selectwhere("todos",$where);
          $tododetail = mysql_fetch_array($tododata);
          $wherecamp ="id ='$tododetail[1]'";
            $campdata= $obj->selectwhere("tasking",$wherecamp);
          $campdetail = mysql_fetch_array($campdata);
            
    }
    if($tododetail[0]!="")
    {
 
   if(isset($_REQUEST['tododelete']))
  {    
      $ins = "id='$tododetail[0]'";

      $usr= $obj->deleteData("todos",$ins);
      $msg="Todo delete sucsessfuly";
          $msgen = urlencode(encryptor('encrypt', $msg));  
         
      header("location:viewtodo.php?msg=$msgen");
        exit;
  }
  
  

  
  if(isset($_REQUEST['todos']))
  {
      $tname=$_REQUEST['tname'];
       $tedate=$_REQUEST['tddate'];
        $tcomment=$_REQUEST['tcomment'];
        $tuser=$_REQUEST['tuser'];
        $creator =$row[2];
        date_default_timezone_set('Asia/Kolkata');
         $time=time();
        $ctime= date('d-m-Y ');
       
       
       $instodos = "'','$campdetail[0]','$row[1]','$tuser','$tname','$tcomment','$tedate','','','','$ctime',''";

      $usr= $obj->insert_user("todos",$instodos);
      $ctimeday= date('d-m-Y ');
        $notydatatodo ="'','Added you to a : $tname <br> Campaign name : $campdetail[2]','unread','$ctimeday','$tuser',''";
         $usrnotytodo= $obj->insert_noty("noty",$notydatatodo);
           
       
        
  }
  
  
   
?>
<html lang="en">

<head>
    <style>
 time.icon
{
  font-size: 1em; /* change icon size */
  display: inline-block;
  position: relative;
  width: 7em;
  height: 7em;
  background-color: #fff;
  border-radius: 0.6em;
  box-shadow: 0 1px 0 #bdbdbd, 0 2px 0 #fff, 0 3px 0 #bdbdbd, 0 4px 0 #fff, 0 5px 0 #bdbdbd, 0 0 0 1px #bdbdbd;
  overflow: hidden;
}
time.icon strong
{
  position: absolute;
  top: 0;
  padding: 0.4em 0;
  color: #fff;
  background-color: #fd9f1b;
  border-bottom: 1px dashed #f37302;
  box-shadow: 0 2px 0 #fd9f1b;
}
time.icon em
{
  position: absolute;
  bottom: 0.3em;
  color: #fd9f1b;
}
time.icon span
{
  font-size: 2.8em;
  letter-spacing: -0.05em;
  padding-top: 0.8em;
  color: #2f2f2f;
}
time.icon *
{
  display: block;
  width: 100%;
  font-size: 1em;
  font-weight: bold;
  font-style: normal;
  text-align: center;
}

#nav {
    line-height:30px;
    background-color:#eeeeee;
    height:350px;
    width:300px;
    float:right;
    padding:5px;	      
}
#nav2 {
    line-height:30px;
      background-color:#eeeeee;
    height:350px;
    width:300px;
    clear:both;
   float:right;
          
}
#nav3 {
    line-height:30px;
    
    height:10px;
    width:160px;
    clear:both;
   float:right;
          
}


 
</style>
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
        <script type="text/javascript" src="js/notification.js"> </script>
    <script type="text/javascript" src="js/campaign.js"> </script>
    <script type="text/javascript" src="js/counter.js"></script>
    
     <link rel="stylesheet" href="pqselect.dev.css" />    
        <script src = "pqselect.dev.js"></script>
        
    
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({ minDate: 0 });
  
  });
  </script>

</head>
<body>

    <form action="tododetail.php?id=<?php echo $_GET['id']?>" method="post">
                            <!-- Modal -->
                            <div class="modal fade" id="tododelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Delete Todo's</h4>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                              
                                                <div> Are you sure you want to delete ?</div></td>
                                                 
                                                </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                            <input type="submit" class="btn btn-primary" name="tododelete" value="Delete">
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                             </form>
    
    
    <form action="updatetodo.php?id=<?php echo $id?>" method="post" id="fm">
                            <!-- Modal -->
                            <div class="modal fade" id="todos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Todo's</h4>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                              
                                                <div> <input type="text" name="tname" class="form-control" value="<?php echo $tododetail['todo_title'] ;?>" placeholder="Enter Todo's Title " data-rule-required="true"  data-msg-required="Please Enter Todo Title" style="margin: 10px;"></div></td>
                                                <div> <input type="text" id="datepicker"  class="form-control" value="<?php echo $tododetail['todo_due_date'] ;?>"  name="tddate" placeholder="Enter Due Date "   data-rule-required="true"  data-msg-required="Please Enter Due Date" style="margin: 05px;"></div></td>
                                           
                                                <div>   <select  class="form-control"   name="tuser" style="margin: 10px;" data-rule-required="true"  data-msg-required="Please Select User">            
                                                        <option value="">Select User</option>
                                                    <?php
                                                     $usercamps = explode(',', $campdetail[1]);
        
                                                        foreach ($usercamps as $username) {
                                                             if($username !=  "")
                                                             {
                                                                 if($username == $tododetail['assign_user_id'])
                                                                 {
                                                                     $userdata.="<option selected value='".$username."'>".$username."</option>";
                                                                 }
                                                                else {
                                                                    $userdata.="<option value='".$username."'>".$username."</option>";
                                                                }
                                                            
                                                        }}
                                                    echo $userdata; ?>
                                                   

                                               </select></div>
                                   
                                             
                                 
                                 
                                   <div > <textarea class="form-control"  name="tcomment"   placeholder="Description " cols="22" data-rule-required="true"  data-msg-required="Please Enter Description"><?php echo $tododetail['todo_description'] ;?></textarea></div>
                                 
                                       
                                            </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                            <input type="submit" class="btn btn-primary" name="todos" value="Add">
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                             </form>
    
    
    
   
    
    
   
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
                    <h1 class="page-header heading"><?php echo $tododetail["todo_title"];?> 
                        
                        <button class="btn btn-success  btn-circle btn-lg" data-toggle='modal' title="Edit" data-target='#todos' type="button"><i class="fa  fa-edit"></i>
</button>
                        <button class="btn btn-success  btn-circle btn-lg" data-toggle='modal' title="Delete" data-target='#tododelete' type="button"><i class="fa  fa-trash-o"></i>
</button>
                     
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <!-- /.row -->
            
                
                        
                     
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
               
             <div >
                 
           
 
     
                 <div style="text-align: center">
                       
                        <div style="font-size: 20px;color: grey; font-family: sans-serif;padding-bottom: 10px">  Campaign Name : <?php echo $campdetail['name'];?></div>
    <div style="font-size: 20px;color: grey; font-family: sans-serif;padding-bottom: 10px"> Name : <?php echo $tododetail['todo_title'];?></div>
    <div> 
   
    <time   class="icon">
  <em>
   <?php 
    $tempDate =tododetail['created_at'];
     echo "<b style='color: black;'>".date('d', strtotime( $tempDate))."</b>";
    echo date('l', strtotime( $tempDate))."<br>";
    echo date('M', strtotime( $tempDate))."-".date('Y', strtotime( $tempDate));
    ?>
  </em>
  <strong><?php 
   
    echo "Start Date";
    ?></strong>
        
        
 
    </time>&nbsp;&nbsp;&nbsp;&nbsp;
        
            <time   class="icon">
  <em>
   <?php 
    $tempDate = $tododetail['todo_due_date'];;
     echo "<b style='color: black;'>".date('d', strtotime( $tempDate))."</b>";
    echo date('l', strtotime( $tempDate))."<br>";
    echo date('M', strtotime( $tempDate))."-".date('Y', strtotime( $tempDate));
    ?>
  </em>
  <strong><?php 
     
    echo "End Date";
    ?></strong>
        
        
 
</time>
        </div>
    
    <div style="font-size: 20px;color: grey; font-family: sans-serif;padding-bottom: 10px;padding-top: 10px;"> Assign User : <?php echo $tododetail['assign_user_id'];?></div>
    <div style="font-size: 20px;color: grey; font-family: sans-serif;padding-bottom: 10px;padding-top: 10px;"> Detail : <?php echo $tododetail['todo_description'];?></div>
   <div style="font-size: 20px;color: grey; font-family: sans-serif;padding-bottom: 10px;padding-top: 10px;"> Create By : <?php echo $tododetail['created_user_id'];?></div>
 <div style="font-size: 20px;color: grey; font-family: sans-serif;padding-bottom: 10px;padding-top: 10px;"> Status  : <?php  if($tododetail['is_completed']=="yes"){ echo "close";}else {echo "open";};?></div>

</div>
                 <hr>
                
                
                 
            </div>
             
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
      <script src="../dist/jquery.validate.js"></script>
      <script>
    $(document).ready(function() {
        $("#fm").validate();
    });
    

    </script>
     <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
        .popover()
    </script>
</body>

</html>

<?php
}
else
{
    echo "404 page not found";
}
}
else
{
    header("location:login.php");
}
?>
    