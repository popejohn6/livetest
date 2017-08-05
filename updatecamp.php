<?php 
include 'config/dbconfig.php';
require_once 'config.php';

 $obj->connect();
session_start();
if($_SESSION['aid'] != '')
{
    $campdetail=$_REQUEST['id'];
    $idgen = urlencode(encryptor('encrypt', $campdetail));  
   /*  if(isset($_REQUEST['user'])=="")
      {
          $msg="Please Select user";
          $msgen = urlencode(encryptor('encrypt', $msg));  
            header("location:campaign_detail.php?id=$idgen&msg=$msgen");
           exit;
      }
       if(isset($_REQUEST['audience'])=="")
      {
          $msg="Please Select audience";
          $msgen = urlencode(encryptor('encrypt', $msg));  
            header("location:campaign_detail.php?id=$idgen&msg=$msgen");
           exit;
      }
      
     
       if(isset($_REQUEST['band'])=="")
      {
          $msg="Please Select band";
          $msgen = urlencode(encryptor('encrypt', $msg));  
           header("location:campaign_detail.php?id=$idgen&msg=$msgen");
           exit;
      }
       if(isset($_REQUEST['chanel'])=="")
      {
          $msg="Please Select channel";
          $msgen = urlencode(encryptor('encrypt', $msg));  
            header("location:campaign_detail.php?id=$idgen&msg=$msgen");
           exit;
      }*/
      $audience="No Audience,";
      $band="No Band,";
      $chanel="No Channel,";
    
        $campdetail=$_REQUEST['id'];
      $cname=$_REQUEST['cname'];
       $sdate=$_REQUEST['sdate'];
        $edate=$_REQUEST['edate'];
        $audience=$_REQUEST['audience'];
        $chanel=$_REQUEST['chanel'];
        $band=$_REQUEST['band'];
        $user=$_REQUEST['user'];
        $priority=$_REQUEST['priority'];
        $detail=$_REQUEST['detail'];
        $private=$_REQUEST['private'];
        $creator =$row[2];
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
           
        }
        $test ="";
         $tododetail= $obj->selectwhere("todos","cid='$campdetail'");
        
        
           
              
                                                     $audiencesdata="";
                                                     
                                                      $sample="";
                                                      
                                                        while ($audiences = mysql_fetch_array($tododetail)) {
                                                            foreach ($user as $todoaudiencedata) {
                                                                if($todoaudiencedata==$audiences[3])
                                                                {
                                                               
                                                                 $sample=$todoaudiencedata;
                                                                  break;
                                                                 
                                                                }
                                                                
                                                               
                                                                
                                                            }
                                                              if($sample != $audiences[3])
                                                              {
                                                                   $tododetail= $obj->deleteData("todos","assign_user_id='$audiences[3]'");
                                                                 
                                                              }
                                                            
                                                                     
                                                             }
                                                            
                                                      
                                                                
                                                   
  
         
         
         
       
                                                            
                                                      
                                                                
                                                    
         
         
         
         
         
         
         
         
         
         
         
         
         
         
        date_default_timezone_set('Asia/Kolkata');
  $time=time();
  $ctime= date('d-m-Y ');
       $ins = "uid='$usr',name='$cname',sdate='$sdate',edate='$edate',channels='$cha',audience='$audi',band='$ban',priority='$priority',description='$detail',updated_at='$ctime' where id='$campdetail'";

      $usr= $obj->updatecamp("tasking",$ins);
      
     
      
           foreach ($user as $aud34) {
            
            $notydata ="'',' Campiagn Update : $cname','unread','$ctime','$aud34',''";
         $usrnoty= $obj->insert_noty("noty",$notydata);
           
        }
         $msgen = urlencode(encryptor('encrypt', "Campaign Update sucsessfuly")); 
           $idgen = urlencode(encryptor('encrypt',$campdetail)); 
  header("location:campaign_detail.php?id=$idgen&msg=$msgen");
}
else
{
    header("location:index.php");
}
  ?>