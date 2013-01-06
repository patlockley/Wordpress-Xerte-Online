<?php
/**
 * 
 * Save page, used by xerte to update its XML files
 *
 * @author Patrick Lockley
 * @version 1.0
 * @copyright Copyright (c) 2008,2009 University of Nottingham
 * @package
 */
 
include "../../../../wp-admin/admin.php";
 
if(! wp_verify_nonce($_POST['wpnonce'],"xertesave")){
	
	die("NONCE FAIL");

}

 if(!isset($_POST['filename'])&&!isset($_POST['filedata'])&&!isset($_POST['filesize'])&&!isset($_POST['fileupdate'])){
 
	die("Invalid upload");
 
 }
 
 if(strpos($_POST['filename'],".php")!==FALSE){
 
	die("No PHP");
 
 }
 
 if(sanitize_file_name(substr($_POST['filename'], strlen($_POST['filename'])-11,12))!=="preview.xml"){
 
	die("Not preview.xml");
 
 }
 
 $dir = getcwd();
 
 if(strpos($dir,"/wp-content/plugins/xerte-online/xertefiles")!==FALSE){

	$prepared_dir = str_replace("/wp-content/plugins/xerte-online/xertefiles","",$dir);
			
}else if(strpos($dir,"\\wp-content\\plugins\\xerte-online\\xertefiles")!==FALSE){
		
	$prepared_dir = str_replace("\\wp-content\\plugins\\xerte-online\\xertefiles","",$dir);
		
}	

$savepath = $prepared_dir . str_replace("../","/",$_POST['filename']);

/**
 * The XML length is not equal to the expected file length so don't save
 */

if(strlen($_POST['filedata'])!=strlen($_POST['filesize'])){

    echo "file has been corrupted<BR>";
   
}

if(file_exists($savepath)){

/**
 * Save and play do slightly different things. Save sends an extra variable so we update data.xml as well as preview.xml
 */

	if($_POST['fileupdate']=="true"){

		$file_handle = fopen(str_replace("preview","data",$savepath),'w');

		fwrite($file_handle, stripslashes($_POST['filedata']));

		fclose($file_handle);

	}

	/**
	 * Update preview.xml
	 */

	$file_handle = fopen($savepath,'w');

	fwrite($file_handle, stripslashes($_POST['filedata']));

	fclose($file_handle);

	print("&returnvalue=preview.xml");

}

?>

