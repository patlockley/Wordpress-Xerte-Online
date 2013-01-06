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

if(preg_match("/^[A-Za-z0-9\-\_\s,']+\.[A-Za-z][A-Za-z][A-Za-z]$/",$_FILES['Filedata']['name'])){

	$dir = getcwd();
	
	if(strpos($dir,"/wp-content/plugins/xerte-online/xertefiles")!==FALSE){

		$prepared_dir = str_replace("/wp-content/plugins/xerte-online/xertefiles","",$dir);
		
	}else if(strpos($dir,"\\wp-content\\plugins\\xerte-online\\xertefiles")!==FALSE){
	
		$prepared_dir = str_replace("\\wp-content\\plugins\\xerte-online\\xertefiles","",$dir);
	
	}		

	$target_dir = $prepared_dir . "/" . str_replace("path=","",str_replace("../","",str_replace("&_wpnonce=1028c4c5b2","",$_SERVER['QUERY_STRING'])));

	if(strpos($target_dir,"media/")!==FALSE){
	
		$target_dir = str_replace("media/","",$target_dir);
	
	}
	
	if(is_uploaded_file($_FILES['Filedata']['tmp_name'])){

		if(move_uploaded_file($_FILES['Filedata']['tmp_name'], $target_dir . "/media/" . sanitize_file_name($_FILES['Filedata']['name']))){

			chmod($target_dir . "/media/" . sanitize_file_name($_FILES['Filedata']['name']),0755);

		}else{
		
		}
	
	}
		
}
			
