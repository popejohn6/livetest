<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
	
function ob_clean_all ()
{
$ob_active = ob_get_length ()!== FALSE;
while($ob_active)
{
    ob_end_clean();
    $ob_active = ob_get_length ()!== FALSE;
}
return FALSE;
}
function forcedownload($fileName, $filePath, $fileSize, $fileExt)
{

if(ini_get('zlib.output_compression'))
ini_set('zlib.output_compression', 'Off');

switch($fileExt)
{
    case "pdf": $ctype="application/pdf"; break;
    case "exe": $ctype="application/octet-stream"; break;
    case "zip": $ctype="application/zip"; break;
    case "doc": $ctype="application/vnd.ms-word"; break;
    case "xls": $ctype="application/vnd.ms-excel"; break;
    case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
    case "gif": $ctype="image/gif"; break;
    case "png": $ctype="image/png"; break;
	case "jpg": $ctype="image/jpg"; break;
	 case "sql": $ctype="image/sql"; break;
	  case "mp4": $ctype="image/mp4"; break;
	   case "mp3": $ctype="image/mp3"; break;
	    case "avi": $ctype="image/avi"; break;
		 case "psd": $ctype="image/psd"; break;
    case "jpeg": $ctype = "image/jpeg";break;
    default: $ctype="application/force-download";
}
ob_clean_all();
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
header("Content-Type: $ctype");
header("Content-Disposition: attachment; filename=".$fileName.";" );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ". $fileSize);
///echo $filePath;exit;
readfile($filePath);
}
$filename = $_REQUEST['filename'];
 $path ="admin/upload/";
if($filename){
    $ext = pathinfo($path.$filename, PATHINFO_EXTENSION);
   // echo $filename.' '.$path
   forcedownload($filename,$path.$filename, filesize($path.$filename),$ext);
   // echo the file contentss
    exit();
}
