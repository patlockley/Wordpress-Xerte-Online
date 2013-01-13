<?PHP

	add_action('wp_ajax_xerte_save', 'xerte_online_save');

	function xerte_online_save() {
		
		if(!wp_verify_nonce($_POST['wpnonce'],"xertesave")){
	
			die("NONCE FAIL");

		}
		
		if(!is_numeric($_POST['template_id'])){
		
			die("NOT VALID ID");
		
		}
		
		if(strlen(stripslashes($_POST['file_data']))!=$_POST['file_data_length']){

			die("file has been corrupted");
   
		}
		
		$upload_dir = wp_upload_dir();
		
		$savepath = $upload_dir['basedir'] . "/xerte-online/" . $_POST['template_id'] . "/preview.xml";
		
		if($_POST['fileupdate']=="true"){

			$file_handle = fopen(str_replace("preview","data",$savepath),'w');

			fwrite($file_handle, stripslashes($_POST['file_data']));

			fclose($file_handle);

		}

		/**
		 * Update preview.xml
		 */

		$file_handle = fopen($savepath,'w');

		fwrite($file_handle, stripslashes($_POST['file_data']));

		fclose($file_handle);

		die(); // this is required to return a proper result
		
	}

?>