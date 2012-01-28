<?PHP

//add_action('admin_init', 'xerteonlinewordpress_register');
//add_action('admin_head', 'xerteonlinewordpress_postform');

add_action("save_post", "xerteonlinewordpress_create");
add_action("before_delete_post", "xerteonlinewordpress_delete"); 

function xerteonlinewordpress_create($post_id)
{

	$data = get_post($post_id);
	
	if($data->post_type=="xerte_online"){

		$wp_dir = wp_upload_dir();
		
		if(!file_exists($wp_dir['basedir'] . "/xerte-online/")){
		
			mkdir($wp_dir['basedir'] . "/xerte-online/");
			chmod($wp_dir['basedir'] . "/xerte-online/",0755);
			
		}
		
		if(!file_exists($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/" )){
		
			mkdir($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/");
			mkdir($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/media/");

			chmod($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/",0755);
			chmod($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/media/",0755);
		
			copy ( plugin_dir_path(__FILE__)  . "xertefiles/data.xml" , $wp_dir['basedir'] . "/xerte-online/" . $post_id . "/data.xml");
			copy ( plugin_dir_path(__FILE__)  . "xertefiles/data.xml" , $wp_dir['basedir'] . "/xerte-online/" . $post_id . "/preview.xml");

			chmod($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/data.xml",0755);
			chmod($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/preview.xml",0755);
			
		}
	
	}

}


function xerteonlinewordpress_delete($post_id){

	$data = get_post($post_id);
	
	if($data->post_type=="xerte_online"){

		$wp_dir = wp_upload_dir();
	
		if(file_exists($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/" )){
		
			$dir = opendir($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/");
			while($file = readdir($dir)){
			
				if($file!="."&&$file!=".."){
				
					if(!is_dir($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/" . $file)){
				
						unlink($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/" . $file);
					
					}
				
				}
			
			}
			
			
			$dir = opendir($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/media/");

			while($file = readdir($dir)){
			
				if($file!="."&&$file!=".."){
				
					if(!is_dir($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/media/" . $file)){
				
						unlink($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/media/" . $file);
					
					}
				
				}
			
			}
			
			rmdir($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/media/");
			rmdir($wp_dir['basedir'] . "/xerte-online/" . $post_id . "/");
			
		}
	
	}

}

?>