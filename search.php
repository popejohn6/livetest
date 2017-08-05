<?php 
include 'config/dbconfig.php';
require_once 'config.php';

 $obj->connect();
$userinfo= $obj->select("user");



$return_arr = array();
while ($row2 = mysql_fetch_row($userinfo)) {
		   $uimail =explode("@",$row2[3]);
		    $return_arr[] =  $uimail[0];
       }
	    echo json_encode($return_arr);