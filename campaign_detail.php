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
    $letter="";
    $where ="";
    $campid="";
    $campdetail="";
    if(isset($_REQUEST['id']))
    {
        if( isset($_GET['id']) && !empty( $_GET['id'] ) ){
        $ids = urldecode($_GET['id']);
        $campid = encryptor('decrypt', $ids);
        }

       
        $where ="id ='$campid'";
         $campdata= $obj->selectwhere("tasking",$where);
          $campdetail = mysql_fetch_array($campdata);
        
    }
    
   if($campdetail)
   {
    $username="";
    $campdata ="blank";
     $user = $obj->select("user");
     $chanel = $obj->select("chanel");
     $band = $obj->select("brand");
     $audience = $obj->select("audience");
     $letter ="";
   
 if(isset($_REQUEST['submit_comment']))
 {
     $comment =$_REQUEST['comment'];
     
     
       date_default_timezone_set('Asia/Kolkata');
        $time=time();
        $ctimecomment= date('H:i d-m-Y ');
        $qrycomment ="'','$row[3]','$comment','$campid','$ctimecomment',''";
                
       
              $usercamp = explode(',', $campdetail['uid']);
        $usr= $obj->inserts("comment",$qrycomment);
         foreach ($usercamp as $values) {
            $userinfo = $obj->selectwhere("user","email='$values'");
            $userinforow = mysql_fetch_array($userinfo);
           
             
                      
           $notydata ="'',' $row[3] Commented on : $campdetail[2] Campaign','unread','$ctimecomment','$userinforow[3]',''";
         $usrnoty= $obj->insert_noty("noty",$notydata);
     
            
         }
       
            
           
        
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
        $ctime= date('d-m-Y');
       
       
       $instodos = "'','$campdetail[0]','$row[1]','$tuser','$tname','$tcomment','$tedate','','','','$ctime',''";

      $usr= $obj->insert_user("todos",$instodos);
      $ctimeday= date('d-m-Y ');
        $notydatatodo ="'','Added you to a : $tname Todo <br> Campaign name : $campdetail[2]','unread','$ctimeday','$tuser',''";
         $usrnotytodo= $obj->insert_noty("noty",$notydatatodo);
        
         $msg="Add Todo sucsessfuly";
          $msgen = urlencode(encryptor('encrypt', $msg));  
         $cid = urlencode(encryptor('encrypt', $campdetail[0]));  
      header("location:campaign_detail.php?id=$cid&msg=$msgen");
        exit;   
       
        
  }
   if(isset($_REQUEST['campdelete']))
  {    
      $ins = "id='$campdetail[0]'";

      $usr= $obj->deleteData("tasking",$ins);
      $wheretodo ="cid='$campdetail[0]'";
       $tododelete= $obj->deleteData("todos",$wheretodo);
      $msg="Campaign delete sucsessfuly";
          $msgen = urlencode(encryptor('encrypt', $msg));  
         
      header("location:campaign.php?msg=$msgen");
        exit;
  }
   $camptodo= $obj->selectwhere("todos","cid='$campdetail[0]' and is_completed=''");
   $camptodocompleted= $obj->selectwhere("todos","cid='$campdetail[0]' and is_completed='yes'");
   
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
    
     <link rel="stylesheet" href="pqselect.dev.css" />    
        <script src = "pqselect.dev.js"></script>
        
    <script type="text/javascript">
            $(function() {
                
                //initialize the pqSelect widget.
                $("#select3").pqSelect({
                    multiplePlaceholder: 'Audience',
                    checkbox: true //adds checkbox to options    
                }).on("change", function(evt) {
                    var val = $(this).val();
                   //alert(val);
                });
                 $("#select4").pqSelect({
                    multiplePlaceholder: 'Channels',
                    checkbox: true //adds checkbox to options    
                }).on("change", function(evt) {
                    var val = $(this).val();
                   //alert(val);
                });
                 $("#select5").pqSelect({
                    multiplePlaceholder: 'Band',
                    checkbox: true //adds checkbox to options    
                }).on("change", function(evt) {
                    var val = $(this).val();
                   //alert(val);
                });
                 $("#select6").pqSelect({
                    multiplePlaceholder: 'User',
                    
                    checkbox: true //adds checkbox to options    
                }).on("change", function(evt) {
                    var val = $(this).val();
                   //alert(val);
                });
            });
        </script> 
    <script>
  $(function() {
  $("#datepicker").datepicker({
        
        minDate: 0,
        onSelect: function (date) {
            var date2 = $('#datepicker').datepicker('getDate');
            date2.setDate(date2.getDate() + 1);
            $('#datepicker2').datepicker('setDate', date2);
            //sets minDate to dt1 date + 1
            $('#datepicker2').datepicker('option', 'minDate', date2);
        }
    });
    $('#datepicker2').datepicker({
        
        onClose: function () {
            var dt1 = $('#datepicker').datepicker('getDate');
            var dt2 = $('#datepicker2').datepicker('getDate');
            //check to prevent a user from entering a date below date of dt1
            if (dt2 <= dt1) {
                var minDate = $('#datepicker2').datepicker('option', 'minDate');
                $('#datepicker2').datepicker('setDate', minDate);
            }
        }
    });
    $( "#datepicker3" ).datepicker({ minDate: 0 });
  });
  </script>
  <script>
var btns = "";
var all="All";
var letters = "abcdefghijklmnopqrstuvwxyz";
var letterArray = letters.split("");
for(var i = 0; i < 26; i++){
    var letter = letterArray.shift();
    btns += '<button class="btn btn-outline btn-success" onclick="alphabetSearch(\''+letter+'\');">'+letter+'</button>';
}
 btns += '<button class="btn btn-outline btn-success" onclick="alphabetSearch(\''+all+'\');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+all+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>';
function alphabetSearch(let){
    window.location = "campaign.php?letter="+let;
}
</script>

 
<script src="dist/jquery.validate.js"></script>
<script>
	$(document).ready(function() {
		$("#commentForm").validate();
                $("#commentForm1").validate();
                 $("#commentForm2").validate();
		 
	});
	</script>
</head>
<body>


      <form action="campaign_detail.php?id=<?php echo $_GET['id']?>" method="post">
                            <!-- Modal -->
                            <div class="modal fade" id="campdelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Delete Campaign</h4>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                              
                                                <div> Are You sure you want to delete ?</div></td>
                                                 
                                                </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                            <input type="submit" class="btn btn-primary" name="campdelete" value="Delete">
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                             </form>
    
    <form action="campaign_detail.php?id=<?php echo$_GET['id']?>" method="post" id="commentForm2">
                            <!-- Modal -->
                            <div class="modal fade" id="todos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Add Todo's</h4>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                              
                                               <div> <input type="text" name="tname" class="form-control"  placeholder="Enter Todo's Title " data-rule-required="true"  data-msg-required="Please Enter Todo Title " style="margin: 10px;"></div></td>
                                                <div> <input type="text" id="datepicker3"  class="form-control"  name="tddate" placeholder="Enter Due Date " readonly="true"  data-rule-required="true"  data-msg-required="Please Enter Due Date " style="margin: 05px;"></div></td>
                                           
                                                <div>   <select  class="form-control"   name="tuser" style="margin: 10px;" data-rule-required="true"  data-msg-required="Please Select User ">            
                                                        <option value="">Select User</option>
                                                    <?php
                                                     $usercamps = explode(',', $campdetail[1]);
        
                                                        foreach ($usercamps as $username) {
                                                             if($username !=  "")
                                                             {
                                                            $userdata.="<option value='".$username."'>".$username."</option>";
                                                        }}
                                                    echo $userdata; ?>
                                                   

                                               </select></div>
                                   
                                             
                                 
                                 
                                   <div > <textarea class="form-control"  name="tcomment" placeholder="Description " cols="22" data-rule-required="true"  data-msg-required="Please Enter Description"></textarea></div>
                                 
                                       
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
    
    
    
    
    
    
 

 
    <form action="updatecamp.php?id=<?php echo$campid?>" method="post" id="commentForm">
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Campaign</h4>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                              
                             
                                                <div> <input type="text" name="cname" class="form-control" value="<?php echo $campdetail['name'];?>"  placeholder="Enter Campaign Name " data-rule-required="true"  data-msg-required="Please Enter Campaign Name " style="margin: 10px;"></div></td>
                                           <div> <input type="text" id="datepicker" class="form-control"  value="<?php echo $campdetail['sdate'];?>" name="sdate" placeholder="Enter Start Date " readonly="true" required="true" style="margin: 10px;"></div></td>
                                           <div> <input type="text" id="datepicker2"  class="form-control" value="<?php echo $campdetail['edate'];?>" name="edate" placeholder="Enter End Date " readonly="true"  required="true" style="margin: 05px;"></div></td>
                                           
                                           <div  >  <select style="height: 90%" id="select3"    multiple=multiple name="audience[]" style="margin: 10px;width:200px;">            
                                                  
                                                  
                                                   
                                                   
                                                    <?php
                                                     $audiencesdata="";
                                                     $todoaudience = explode(',', $campdetail['audience']);
                                                      $sample="";
                                                        while ($audiences = mysql_fetch_array($audience)) {
                                                            foreach ($todoaudience as $todoaudiencedata) {
                                                                if($todoaudiencedata==$audiences[1])
                                                                {
                                                                $audiencesdata.="<option selected value='".$audiences[1]."'>".$audiences[1]."</option>";
                                                                 $sample=$todoaudiencedata;
                                                                  break;
                                                                 
                                                                }
                                                                
                                                               
                                                                
                                                            }
                                                              if($sample != $audiences[1])
                                                              {
                                                                  $audiencesdata.="<option value='".$audiences[1]."'>".$audiences[1]."</option>";
                                                              }
                                                            
                                                                     
                                                             }
                                                            
                                                      
                                                                
                                                    echo $audiencesdata; ?>


                                            </select>
                                         </div>
                                 
                                   
                                 <div> <select style="width: 20px;" id="select4" class="form-control"  multiple=multiple name="chanel[]" style="margin: 10px;width:200px;">            

                                               
                                         <?php
                                                     $chaneldata="";
                                                     $todochanel = explode(',', $campdetail['channels']);
                                                      $sample="";
                                                        while ($chanels = mysql_fetch_array($chanel)) {
                                                            foreach ($todochanel as $todochaneldata) {
                                                                if($todochaneldata==$chanels[1])
                                                                {
                                                                $chaneldata.="<option selected value='".$chanels[1]."'>".$chanels[1]."</option>";
                                                                 $sample=$todochaneldata;
                                                                  break;
                                                                 
                                                                }
                                                                
                                                               
                                                                
                                                            }
                                                              if($sample != $chanels[1])
                                                              {
                                                                  $chaneldata.="<option value='".$chanels[1]."'>".$chanels[1]."</option>";
                                                              }
                                                            
                                                                     
                                                             }
                                                            
                                                      
                                                                
                                                    echo $chaneldata; ?>


                                            </select>
                                         </div>
                                 
                                           <div>   <select id="select5" class="form-control"  multiple=multiple name="band[]" style="margin: 10px;width:200px;">            

                                                 
                                                       <?php
                                                     $banddata="";
                                                     $todoband = explode(',', $campdetail['band']);
                                                      $sample="";
                                                        while ($bands = mysql_fetch_array($band)) {
                                                            foreach ($todoband as $todobanddata) {
                                                                if($todobanddata==$bands[1])
                                                                {
                                                                 $banddata.="<option selected value='".$bands[1]."'>".$bands[1]."</option>";
                                                                 $sample=$todobanddata;
                                                                  break;
                                                                 
                                                                }
                                                                
                                                               
                                                                
                                                            }
                                                              if($sample != $bands[1])
                                                              {
                                                                  $banddata.="<option value='".$bands[1]."'>".$bands[1]."</option>";
                                                              }
                                                            
                                                                     
                                                             }
                                                            
                                                      
                                                                
                                                    echo $banddata; ?>
                                                   
                                                   


                                            </select>
                                         </div>
                                 
                                           <div>   <select id="select6" class="form-control"  multiple=multiple name="user[]" style="margin: 10px;width:200px;">            

                                                    
                                                   <?php
                                                     $userdata="";
                                                     $todouser = explode(',', $campdetail['uid']);
                                                      $sample1="";
                                                        while ($users = mysql_fetch_array($user)) {
                                                            foreach ($todouser as $tusers) {
                                                                if($tusers==$users[3])
                                                                {
                                                                 $userdata.="<option selected value='".$users[3]."'>".$users[3]."</option>";
                                                                 $sample=$tusers;
                                                                  break;
                                                                 
                                                                }
                                                                
                                                               
                                                                
                                                            }
                                                              if($sample != $users[3])
                                                              {
                                                                  $userdata.="<option value='".$users[3]."'>".$users[3]."</option>";
                                                              }
                                                            
                                                                     
                                                             }
                                                            
                                                              
                                                       
                                                        
                                                      
                                                                
                                                    echo $userdata; ?>
                                                   

                                               </select></div>
                                   
                                            <div><select class="form-control"   name="priority" style="margin: 05px;width:559px;" data-rule-required="true"  data-msg-required="Please Select Priority ">            
                                                   <option value="">Select Priority</option>
                                                     <?php if($campdetail['priority'] =="High")
                                                   {
                                                        echo '<option selected>High</option><option>Medium</option> <option>Low</option>';
                                                   }
                                                   elseif($campdetail['priority'] =="Medium")
                                                   {
                                                        echo '<option>High</option> <option selected>Medium</option><option>Low</option>';
                                                   }
                                                   elseif($campdetail['priority'] =="Low")
                                                   {
                                                        echo '<option>High</option><option selected>Low</option><option>Medium</option> ';
                                                   }
                                                       ?>

                                                
                                                   
                                                    


                                            </select>
                                         </div> 
                                 
                                 
                                            <div > <textarea class="form-control"  name="detail" placeholder="Description " cols="22" data-rule-required="true"  data-msg-required="Please Enter  Description"><?php echo $campdetail['description']; ?></textarea></div>
                                 
                                        <div style="color: #0088cc">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input  type="radio" name="private" value="private" hidden="" >  &nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="private" value="" checked="checked" hidden=""> </div>
                                         
                                     
                                
                                  
                                 
                       
                                  
                        
                                            </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                            <input type="submit" class="btn btn-primary" name="submit" value="Update">
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                             </form>
    
    
    
    <form action="campaign_detail.php?id=<?php echo$_GET['id']?>" method="post" id="commentForm1">
                            <!-- Modal -->
                            <div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Comment</h4>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                              
                                   <div > <textarea class="form-control"  name="comment" placeholder="Comment.. " cols="22" data-rule-required="true"  data-msg-required="Please Enter Comment"></textarea></div>
                                 
                                       
                        
                                            </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                            <input type="submit" class="btn btn-primary" name="submit_comment" value="Send">
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
                    <h1 class="page-header heading"><?php echo $campdetail[2];?> 
                        <?php  
                            if($row[6] == "editor")
                            {
                               
                        ?>
                        <button class="btn btn-success  btn-circle btn-lg" data-toggle='modal' data-target='#myModal' type="button"><i class="fa  fa-edit"></i>
</button>
                        <button class="btn btn-success  btn-circle btn-lg" title="Delete" data-toggle='modal' data-target='#campdelete' type="button"><i class="fa  fa-trash-o"></i></button>
                     
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
                
               
             <div >
                 
           
 
    <div  id="nav2" class="panel panel-green">
                        <div class="panel-heading">
                          Users
                        </div>
        <div class="panel-body" style="overflow: scroll;height: 290px;">
            <?php
              $usercamp = explode(',', $campdetail['uid']);
        
         foreach ($usercamp as $values) {
            $userinfo = $obj->selectwhere("user","email='$values'");
            $userinforow = mysql_fetch_array($userinfo);
            if($userinforow['image'] != "")
            {
            ?>
            <div style="padding-bottom: 10px;">
            <img alt="<?php echo $userinforow['fname']?>" src="admin/upload/<?php echo $userinforow['image']?> " height="40px" width="40px"/>
            <?php
            echo $userinforow[1]." ".$userinforow[2]."</div>";
            }
         }
       
            ?>
           

</div>
    </div>
        
 <div id="nav3"> <BR></div>
 <div  id="nav2" class="panel panel-green">
                        <div class="panel-heading">
                           Todo's
                           
                           <?php  
                            if($row[6] == "editor")
                            {
                               
                        ?>
                           <button class="btn btn-primary btn-circle" type="button" data-target="#todos" data-toggle="modal">
<i class="fa fa-plus-square"></i>
</button>
                           
                            <?php } ?>
                        </div>
        <div class="panel-body" style="overflow: scroll;height: 290px;">
            
            <?php
            while ($todosdetail = mysql_fetch_array($camptodo)) {
                
                ?>
            <div>
                <?php  $todoidgen = urlencode(encryptor('encrypt',$todosdetail[0]));  ?>
                <span  style="font-size: 15px;color: grey; font-family: sans-serif;padding-bottom: 10px;"> <?php echo "<a style='text-decoration:none' title='$todosdetail[3]' href='tododetail.php?id=$todoidgen'>".$todosdetail[4]."</a>";?></span>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="pull-right text-muted small">   </span>
              
            </div>
            <?php
            }
            ?>

</div>
    </div>
  
                         
                          
  <div id="nav3"> <BR></div>
 <div  id="nav2" class="panel panel-green">
                        <div class="panel-heading">
                          Completed Todo's
                           
                          
                        </div>
        <div class="panel-body" style="overflow: scroll;height: 290px;">
            
            <?php
            while ($todosdetails = mysql_fetch_array($camptodocompleted)) {
                
                ?>
            <center>
                <div><span  style="font-size: 15px;color: grey; font-family: sans-serif;padding-bottom: 10px;"><button class="btn btn-default" data-content="<?php echo "Detail : ".$todosdetails[5];?>" data-placement="top" data-toggle="popover" data-container="body" type="button" data-original-title="" title="" aria-describedby="popover393317"> <?php echo $todosdetails[4]; ?> 
               
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <?php echo $todosdetails[3];?>  </button></span>
              
                </div><br>
            </center>
            <?php
            }
            ?>

</div>
    </div>
   
</div>
                 
<?php 
$clr ="";
                                 if($campdetail['priority']=="High")
                                 {
                                     $clr = "<b><span style='color: red'>".$campdetail['priority']."</span></b>";
                                 }
                                 if($campdetail['priority'] == "Medium")
                                 {
                                     $clr = "<b><span style='color:  #ffcccc'>".$campdetail['priority']."</span></b>";
                                 }
                                 if($campdetail['priority'] == "Low")
                                 {
                                     $clr = "<b> <span style='color:blue'>".$campdetail['priority']."</span></b>";
                                 }
?>
                 <div style="text-align: center">

    <div style="font-size: 20px;color: grey; font-family: sans-serif;padding-bottom: 10px"> Name : <?php echo $campdetail['name'];?></div>
    <div> 
   
    <time   class="icon">
  <em>
   <?php 
    $tempDate = $campdetail['sdate'];;
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
    $tempDate = $campdetail['edate'];;
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
    
    <div style="font-size: 20px;color: grey; font-family: sans-serif;padding-bottom: 10px;padding-top: 10px;"> Channel : 
        
        <?php
        
        echo substr_replace($campdetail['channels'], "", -1);
                if($campdetail['channels']=="")
                {
                    echo "No Channels";
                }
                ?></div>
     <div style="font-size: 20px;color: grey; font-family: sans-serif;padding-bottom: 10px;"> Audience : 
        
        <?php
        
        echo substr_replace($campdetail['audience'], "", -1) ;
                if($campdetail['audience']=="")
                {
                    echo "No Audience";
                }
                ?>
     
     </div>
    
     <div style="font-size: 20px;color: grey; font-family: sans-serif;padding-bottom: 10px;"> Band : 
        
        <?php
        
        echo substr_replace($campdetail['band'], "", -1);
         if($campdetail['band']=="")
                {
                    echo "No Band";
                }
        
        ?></div>
       
       <div style="font-size: 20px;color: grey; font-family: sans-serif;padding-bottom: 10px;"> Priority : <?php echo $clr;?></div>
                <div style="font-size: 20px;color: grey; font-family: sans-serif;padding-bottom: 10px;"> Description : <?php echo $campdetail['description'];?></div>
          <div style="font-size: 20px;color: grey; font-family: sans-serif;padding-bottom: 10px;"> Create By : <?php echo $campdetail['creator'];?></div>
          <div style="font-size: 20px;color: grey; font-family: sans-serif;padding-bottom: 10px;"> Status :
          <?php if($campdetail['complate'] == 'no'){ ?>
          <?php echo "Incomplate"; }
          else
          {
     echo 'Complate';
          }?></div>
         
       
</div>
                 <hr>
                 <h1 class="page-header heading">Comment
                 <button class="btn btn-success btn-circle btn-lg" type="button" data-target="#comment" data-toggle="modal">
<i class="fa fa-plus-square"></i>
</button>
                 </h1>
                 <div class="panel panel-default" style="width: 700px">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Comment
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="overflow: scroll;height: 590px;">
                            <ul class="timeline">
                                <?php 
                                     $campcomment= $obj->selectwhere("comment","campaign_id='$campid'");
                                     while ($campinfo = mysql_fetch_array($campcomment)) {
                                         $usercomment= $obj->selectwhere("user","email='$campinfo[1]'");
                                          $userComent = mysql_fetch_array($usercomment);
                                         ?>
                                     
                                         
                                         
                              
                                <li>
                                    <div class="timeline-badge"><img style="border-radius: 50% 50% 50% 50%;"height="50px" width="50px" title="<?php echo $row['fname']?>" src="admin/upload/<?php echo $userComent['image']?>"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title"><?php echo $userComent[1]." ".$userComent[2]; ?></h4>
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $campinfo[4]; ?></small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p><?php echo $campinfo[2]; ?></p>
                                        </div>
                                    </div>
                                </li>
                                
                                   <?php
                                          }
                                ?>
                                 
                            </ul>
                        </div>
                        <!-- /.panel-body -->
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
      <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
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
    echo '404 page not found';
}

}
else
{
    header("location:login.php");
}
?>
    