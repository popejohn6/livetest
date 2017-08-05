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
    
    if(isset($_REQUEST['priorityselect']))
    {
        $priorityselect =$_REQUEST['priorityselect'];
        $where ="where priority ='$priorityselect'";
    }
     if(isset($_REQUEST['letter']))
    {
        $letter="". $_REQUEST['letter'];
        $where ="where name like '$letter%'";
        if($letter == "All")
        {
            $letter="";
            $where ="where name like '$letter%'";
        }
        
    }
   
    $camp= $obj->selectlike("tasking",$where);
    
    $username="";
    $campdata ="blank";
     $user = $obj->select("user");
     $letter ="";
    $chanel = $obj->select("chanel");
     $band = $obj->select("brand");
     $audience = $obj->select("audience");
 
   
if(isset($_REQUEST['submit']))
  {
    
   /*  if(isset($_REQUEST['user'])=="")
      {
          $msg="Please Select user";
          $msgen = urlencode(encryptor('encrypt', $msg));  
           header("location:campaign.php?msg=$msgen");
           exit;
      }
      if(isset($_REQUEST['audience'])=="")
      {
          $msg="Please Select audience";
          $msgen = urlencode(encryptor('encrypt', $msg));  
           header("location:campaign.php?msg=$msgen");
           exit;
      }
      
     
       if(isset($_REQUEST['band'])=="")
      {
          $msg="Please Select band";
          $msgen = urlencode(encryptor('encrypt', $msg));  
           header("location:campaign.php?msg=$msgen");
           exit;
      }
       if(isset($_REQUEST['chanel'])=="")
      {
          $msg="Please Select channel";
          $msgen = urlencode(encryptor('encrypt', $msg));  
           header("location:campaign.php?msg=$msgen");
           exit;
      }*/
       $audience="No Audience";
      $band="No Band";
      $chanel="No Channel";
    
      $cname=$_REQUEST['cname'];
       $sdate=$_REQUEST['sdate'];
        $edate=$_REQUEST['edate'];
        $audience=$_REQUEST['audience'];
        $chanel=$_REQUEST['chanel'];
        $band=$_REQUEST['band'];
        $user=$_REQUEST['user'];
        $priority=$_REQUEST['priority'];
        $detail=$_REQUEST['detail'];
        $private="";
        $creator =$row[1];
       $audi="";
        foreach ($audience as $aud) {
          $audi.=$aud.",";  
                   }
        $cha="";
        foreach ($chanel as $aud1) {
          $cha.=$aud1.",";  
           
        }
        $ban="";
        foreach ($band as $aud2) {
          $ban.=$aud2.",";  
           
        }
        
         $usr="";
        foreach ($user as $aud3) {
          $usr.=$aud3.",";  
		  		    $headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: support@livetest.com" . "\r\n";
$message = '<html>
<body>

<div style=" background-color:black;color:white;text-align:center;padding:5px;">
<h1>New Campaign Create</h1>
</div>
<div style=" width:350px;float:left;padding:10px;">
<h2>Hello,</h2>
<p><b>Added you campaign '.$cname.'.</b></p>

</div>
<div style=" background-color:black;color:white;clear:both; text-align:center;padding:5px;">
Thank you
</div>
</body>
</html>
';

mail($aud3, 'New Campaign Create', $message,$headers);
           
        }
      
       
       
       $ins = "'','$usr','$cname','$sdate','$edate','$cha','$audi','$ban','$priority','$private','','','$detail','$creator','no','0'";

      $usr= $obj->insert_user("tasking",$ins);
      
      $msg="Campaign Add sucsessfuly";
          $msgen = urlencode(encryptor('encrypt', $msg));  
         
     
     
       date_default_timezone_set('Asia/Kolkata');
  $time=time();
  $ctime= date('d-m-Y ');
           foreach ($user as $aud34) {
            
            $notydata ="'','Added you to a campaign : $cname','unread','$ctime','$aud34',''";
         $usrnoty= $obj->insert_noty("noty",$notydata);
           
        }
         header("location:campaign.php?msg=$msgen");
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
    
     <link rel="stylesheet" href="pqselect.dev.css" />    
        <script src = "pqselect.dev.js"></script>
        
    <script type="text/javascript">
            $(function() {
                var val = "";
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
                  
                });
                 $("#select6").pqSelect({
                    multiplePlaceholder: 'User',
                    
                    checkbox: true //adds checkbox to options    
                }).on("change", function(evt) {
                    
                    val = $(this).val();
                   
                   
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
		 
	});
	</script>
</head>
<body>


 

 
                        <form action="campaign.php" id="commentForm" method="post">
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Campaign</h4>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                              
                             
                                                <div> <input id="email" type="text" name="cname" class="form-control"  placeholder="Enter Campaign Name "  style="margin: 10px;" data-rule-required="true"  data-msg-required="Please Enter Campaign Name "></div> 
                                               <div> <input type="text" id="datepicker" class="form-control"   name="sdate" placeholder="Enter Start Date " readonly="true"   style="margin: 10px;" data-rule-required="true"  data-msg-required="Please select starting date">  </div>
                                            <div><input type="text" id="datepicker2"  class="form-control"  name="edate" placeholder="Enter End Date " readonly="true"    style="margin: 05px;" data-rule-required="true"  data-msg-required="Please select ending date"></div> 
                                           
                                           <div  >  <select style="height: 90%" id="select3"    multiple=multiple name="audience[]" style="margin: 10px;width:200px;" >            

                                                  
                                                 <?php
                                                     $audiencesdata="";
                                                     $todoaudience = explode(',', $campdetail['audience']);
                                                      $sample="";
                                                        while ($audiences = mysql_fetch_array($audience)) {
                                                            
                                                                $audiencesdata.="<option value='".$audiences[1]."'>".$audiences[1]."</option>";
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
                                                            
                                                                 
                                                                $chaneldata.="<option value='".$chanels[1]."'>".$chanels[1]."</option>";
                                                                
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
                                                           
                                                                 $banddata.="<option value='".$bands[1]."'>".$bands[1]."</option>";
                                                                 
                                                                }
                                                                
                                                               
                                                                
                                                            
                                                                     
                                                           
                                                            
                                                      
                                                                
                                                    echo $banddata; ?>
                                                   
                                                   


                                            </select>
                                         </div>
                                 
                                            <div>   <select id="select6" class="form-control"  multiple=multiple name="user[]" style="margin: 10px;width:200px;" required="true" >            

                                                    <?php
                                                     $userdata="";
                                                        while ($users = mysql_fetch_array($user)) {

                                                            $userdata.="<option value='".$users[3]."'>".$users[3]."</option>";
                                                        }
                                                    echo $userdata; ?>
                                                   

                                               </select></div>
                                            
                                   
                                             <div><select class="form-control"   name="priority" style="margin: 05px;width:559px;" data-rule-required="true"  data-msg-required="Please Select Priority Name ">            

                                                 <option value="">Select Priority</option>
                                                   <option>High</option>
                                                    <option>Medium</option>
                                                    <option>Low</option>


                                            </select>
                                         </div> 
                                 
                                 
                                   <div > <textarea class="form-control"  name="detail" placeholder="Description " cols="22" data-rule-required="true"  data-msg-required="Please Enter Description"></textarea></div>
                                  
                                
                                  
                                 
                       
                                  
                        
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
                    <h1 class="page-header heading">Campaign 
                        <?php  
                            if($row[6] == "editor")
                            {
                               
                        ?>
                        <button class="btn btn-success  btn-circle btn-lg" data-toggle='modal' data-target='#myModal' type="button"><i class="fa fa-plus-square"></i>
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
                    <form>
                         <select style="width: 120px;"  class="form-control" name="priorityselect" onchange="this.form.submit()">
                             <option value="">Priority</option>
                        <option>High</option>
                        <option>Medium</option>
                        <option>Low</option>
                    </select>
                        
                    </form>
                   
                    <div class="panel panel-default">
                       
                       <script> document.write(btns); </script>
                        <div class="panel-heading">
                            Campaign Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead >
                                        <tr >
                                           
                                            <th style="color: black">Campaign</th>
                                            <th style="color: black">Start Date</th>
                                            <th style="color: black">End Date</th>
                                            
                                            <th style="color: black">Priority</th>
                                            <th style="color: black">Description</th>
                                            <th style="color: black">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         
                                        <?php 
                            
                $test="";
                            while ($tk = mysql_fetch_array($camp)) {
                                 $username =$tk[1];
         $myArray = explode(',', $username);
         if($row[6] == "user")
			{
         foreach ($myArray as $value) {
             
             if($value == $row[3])
             {
                 
                  $ttamp=0;
                  
                  
                 
                   if($letter == "")
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
                                 
                                
                             
                               echo '<tr class="odd gradeX">';
                                 echo '<td>'.$tk[2]."</td>";
                                 echo '<td>'.$tk[3]."</td>";
                                 echo '<td>'.$tk[4]."</td>";
                                
                                 echo '<td>'.$clr."</td>";
                                 echo '<td>'.$tk[12]."</td>";
                                  $idgen = urlencode(encryptor('encrypt', $tk[0]));  
                                  echo "<td>   <a  style='text-decoration: none' href='campaign_detail.php?id=$idgen' > <i class='fa  fa-folder-open  fa-x'></i> </a></td>";
                                
                                 echo '</tr>'; 
                                 ?>  <?php 
		  }}}}
		 
		 else
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
                                 
                                 
                             
                               echo '<tr class="odd gradeX">';
                                 echo '<td>'.$tk[2]."</td>";
                                 echo '<td>'.$tk[3]."</td>";
                                 echo '<td>'.$tk[4]."</td>";
                                
                                 echo '<td>'.$clr."</td>";
                                 echo '<td>'.$tk[12]."</td>";
                                  $idgen = urlencode(encryptor('encrypt', $tk[0]));  
                                  echo "<td>   <a  style='text-decoration: none' href='campaign_detail.php?id=$idgen' > <i class='fa  fa-folder-open  fa-x'></i> </a></td>";
                                
                                 echo '</tr>'; 
		 }
		 
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
    header("location:login.php");
}
?>
