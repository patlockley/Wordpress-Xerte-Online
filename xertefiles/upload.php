<?php
/**
 * 
 * upload page, used by xerte to upload a file
 *
 * @author Patrick Lockley
 * @version 1.0
 * @copyright Copyright (c) 2008,2009 University of Nottingham
 * @package
 */ 
 
include "../../../../wp-admin/admin.php";
 
if(! wp_verify_nonce($_REQUEST['_wpnonce'],"xertesave")){
	
	die("NONCE FAIL");

} 
 
if(strpos($_FILES['Filedata']['name'],".php")!==FALSE){

	die();

} 

if(sanitize_file_name($_FILES['Filedata']['name'])!=$_FILES['Filedata']['name']){

	die();

}

$file_data = pathinfo($_FILES['Filedata']['name']);

switch($file_data['extension']){

	case "flv" :
	case "mp3" :
	case "jpg" :
	case "gif" :
	case "png" :
	case "jpeg" :
	case "swf" : break;
	default: die("Not valid file type"); break;

}

if(preg_match("/^[A-Za-z0-9\-\_\s,']+\.[A-Za-z][A-Za-z][A-Za-z]$/",$_FILES['Filedata']['name'])){

	$dir = getcwd();
	
	if(strpos($dir,"/wp-content/plugins/xerte-online/xertefiles")!==FALSE){

		$prepared_dir = str_replace("/wp-content/plugins/xerte-online/xertefiles","",$dir);
		
	}else if(strpos($dir,"\\wp-content\\plugins\\xerte-online\\xertefiles")!==FALSE){
	
		$prepared_dir = str_replace("\\wp-content\\plugins\\xerte-online\\xertefiles","",$dir);
	
	}		

	$target_dir = $prepared_dir . "/" . str_replace("path=","",str_replace("../","",str_replace("&_wpnonce=" . $_REQUEST['_wpnonce'],"",$_SERVER['QUERY_STRING'])));

	if(strpos($target_dir,"media/")!==FALSE){
	
		$target_dir = str_replace("media/","",$target_dir);
	
	}
	
	if(is_uploaded_file($_FILES['Filedata']['tmp_name'])){

		if(move_uploaded_file($_FILES['Filedata']['tmp_name'], $target_dir . "/media/" . sanitize_file_name($_FILES['Filedata']['name']))){

			chmod($target_dir . "/media/" . sanitize_file_name($_FILES['Filedata']['name']),0644);

		}else{
		
		}
	
	}
		
}
