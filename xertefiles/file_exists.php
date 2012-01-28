<?php
	
	$dir = getcwd();
	
	if(strpos($dir,"plugins/xerte-online/xertefiles")!==FALSE){

		$prepared_dir = str_replace("plugins/xerte-online/xertefiles","",$dir);
			
	}else if(strpos($dir,"plugins\\xerte-online\\xertefiles")!==FALSE){
		
		$prepared_dir = str_replace("plugins\\xerte-online\\xertefiles","",$dir);
		
	}
	
	$target_file =  $prepared_dir	. "/uploads/xerte-online/" . $_POST['wordpress_id'] . "/" . $_POST['wordpress_filename'];

	if(file_exists($target_file)){
	
		print("&return_value=true&wordpress=true");

	}else{
	
		print("&return_value=false");
	
	}

