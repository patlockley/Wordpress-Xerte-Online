<?PHP

	add_filter('query_vars', 'xerte_online_export' );

	function xerte_online_export( $qvars ) {
	  $qvars[] = 'xerte_export';
	  $qvars[] = 'xerte_id';
	  return $qvars;
	}

	add_action('init', 'xerte_online_export_script');

	function xerte_online_export_script() {
	
		if(isset($_REQUEST['xerte_export'])){
		
			if(isset($_REQUEST['xerte_id'])){
			
				$post = get_post($_REQUEST['xerte_id']);
				
				$user = wp_get_current_user();
				
				if($user->data->ID==$post->post_author){
			
					$dir = wp_upload_dir();

					// create object
					$zip = new ZipArchive();

					// open archive 
					if ($zip->open('xerte_publish.zip', ZIPARCHIVE::CREATE) !== TRUE) {
						die ("Could not open archive");
					}

					// initialize an iterator
					// pass it the directory to be processed
					$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir['basedir'] . "/xerte-online/" . $_REQUEST['xerte_id']));

					$root = $dir['basedir'] . "/xerte-online/" . $_REQUEST['xerte_id'];

					// iterate over the directory
					// add each file found to the archive
					foreach ($iterator as $key=>$value) {
						$zip->addFromString(substr(str_replace($root, "", $key),1), file_get_contents($key)) or die ("ERROR: Could not add file: $key");
					}
					
					// close and save archive
					$zip->close();
					
					header('Content-Type: application/zip');
					header('Content-Length: ' . filesize("xerte_publish.zip"));
					header('Content-Disposition: attachment; filename="xerte_publish.zip"');
					readfile("xerte_publish.zip");
					unlink("xerte_publish.zip"); 			

				}
		
			}		

		}
	
	}
	
?>