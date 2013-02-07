<?PHP

	add_filter('query_vars', 'xerte_online_queryvars' );

	function xerte_online_queryvars( $qvars ) {
	  $qvars[] = 'xerte_upload_script';
	  return $qvars;
	}

	add_action('init', 'xerte_online_upload');

	function xerte_online_upload() {
	
		if(isset($_REQUEST['xerte_upload_script'])){
	
			if(!wp_verify_nonce($_REQUEST['_wpnonce'],"xertesave")){
		
				die("NONCE FAIL");

			}
			
			if(!is_numeric($_REQUEST['template_id'])){
			
				die("NOT VALID ID");
			
			}
			
			$upload_dir = wp_upload_dir();
			
			$savepath = $upload_dir['basedir'] . "/xerte-online/" . $_REQUEST['template_id'] . "/media/";
		
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
				
				if(is_uploaded_file($_FILES['Filedata']['tmp_name'])){

					if(move_uploaded_file($_FILES['Filedata']['tmp_name'], $savepath . sanitize_file_name($_FILES['Filedata']['name']))){

						chmod($savepath . sanitize_file_name($_FILES['Filedata']['name']),0644);

					}else{
					
					}
				
				}
					
			}

		}
	
	}

?>