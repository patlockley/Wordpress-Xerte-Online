<?PHP

	/*
	Plugin Name: Xerte Online 
	Description: Xerte Online Toolkits based in a WordPress site
	Version: 0.1
	Author: pgogy
	Plugin URI: http://www.pgogy.com/code/xerte-online
	Author URI: http://www.pgogy.com
	License: GPL
	*/

	require_once("xerteonline_editor.php");
	require_once("xerteonline_display.php");
	require_once("xerteonline_shortcode.php");
	require_once("xerteonline_custompost.php");
	require_once("xerteonline_posthandling.php");
	require_once("xerteonline_management.php");
	require_once("xerteonline_feed.php");
	
	register_activation_hook( __FILE__, 'xerteonline_activate' );
	
	register_deactivation_hook( __FILE__ , 'xerteonline_deactivate');
	
	function xerteonline_activate(){
	
		// ADD DATABASE
		
		global $xerteonline_db_version, $wpdb;
		$xerteonline_db_version = "0.1";
		
		$table_name = $wpdb->prefix . "xerteonline_usage";
			  
		$sql = "CREATE TABLE " . $table_name . " (
			  id bigint(20) NOT NULL AUTO_INCREMENT,
			  post_id  bigint(20),
			  user_id  bigint(20),
			  date_accessed bigint(20),
			  UNIQUE KEY id(id)
			);";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		   
		add_option("xerteonline_db_version", $xerteonline_db_version);
		
		// DATABASE ADDED
	
		$dir = opendir(getcwd() . "/../");
		
		while($file = readdir($dir)){
		
			if($file==="languages"){
			
				if(!file_exists(getcwd() . "/../" . "languages/language-config.xml")){
			
					wp_die("This plugin cannot be installed due a 'languages' folder in the root directory. If you can delete this folder (or rename), please do so then refresh this page");
				
				}
			
			}
		
		}
		
		$dir_activation = plugin_dir_path(__FILE__) . "activation/";
		
		if(!@copy($dir_activation . "resources.swf","../resources.swf")){
		
			wp_die("Resources.swf did not copy");
		
		}
		
		if(!copy($dir_activation . "MainPreloader.swf","../MainPreloader.swf")){
		
			wp_die("MainPreloader.swf did not copy");
		
		}
		
		if(!@copy($dir_activation . "XMLEngine.swf","../XMLEngine.swf")){
		
			wp_die("XMLEngine.swf did not copy");
		
		}
		
		if(!@mkdir("../languages")){

			wp_die("MKDIR for the languages folder failed");
		
		}
		
		$dir = opendir(plugin_dir_path(__FILE__) . "activation/languages/");
		
		while($file = readdir($dir)){
		
			if($file!="."&&$file!=".."){
			
				if(!@copy(plugin_dir_path(__FILE__) . "activation/languages/" . $file, "../languages/" . $file)){
		
					wp_die($file . " did not copy");
		
				}
			
			}
		
		}
		
	
	}
	
	function xerteonline_deactivate(){
	
		$dir = opendir(getcwd() . "../../languages/");
		
		while($file = readdir($dir)){
		
			if($file!="."&&$file!=".."){
			
				@unlink("../languages/" . $file);
			
			}
		
		}
		
		@unlink("../resources.swf");
		
		@unlink("../MainPreloader.swf");
		
		@unlink("../XMLEngine.swf");
		
		@rmdir("../languages/");
	
	}

?>