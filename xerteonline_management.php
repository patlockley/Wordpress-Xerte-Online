<?PHP

add_action('admin_menu', 'xerteonline_menu_option');

	function xerteonline_menu_option(){

		add_menu_page( __('xerte_online','xerte online'), 'Xerte Online', edit_posts, 'xerte_online', 'xerteonline_menu_page');
		add_submenu_page( 'xerte_online', 'Usage Stats', 'Usage Stats', edit_posts, 'xerte_online_stats', 'xerteonline_usage_stats' );
		add_submenu_page( 'xerte_online', 'Guidance', 'Guidance', edit_posts, 'xerte_online_guidance', 'xerteonline_guidance' );

	}
	
	function xerteonline_menu_page(){
	
		?><h2>Xerte Online for WordPress</h2>
		<p>Xerte Online Toolkits is a server-based suite of tools for content authors. Elearning materials can be authored quickly and easily using browser-based tools, with no programming required. Xerte Online Toolkits is aimed at content authors, who will assemble content using simple wizards. Content authors can easily collaborate on projects. Xerte Online Toolktis can be extended by developers using Xerte.</p>
		<p>This plugin for WordPress is a subset of the main Xerte Online Toolkits functionality, but offers a simple to install and host solution within WordPress. More information on <a href="http://www.nottingham.ac.uk/xerte/toolkits.htm">Xerte Online Toolkits</a></p>
		<p>Xerte was developed by the University of Nottingham, and for more information please visit <a href="http://www.nottingham.ac.uk/xerte/">Xerte home page</a>. This plugin was not developed by the University, but by part of the <a href="http://www.nottingham.ac.uk/xerte/community.htm">Xerte Community</a></p>
		<h2>What this plugin does</h2>
		<p>This plugin brings in a slightly reduced subset of the pages available for a Xerte Online Toolkits example - <a href="http://www.nottingham.ac.uk/toolkits/play_560">this example shows all pages</a>. The plugin uses a WordPress feature to allow a Xerte learning object to be created in the same way you might make a <a href="post-new.php?post_type=xerte_online">WordPress post or page</a>. Information on how you can use the created learning objects is provided for you when you're creating a learning object.</p>
		<p>An RSS Feed is available for just your published Xerte Learning Objects - <a href="<?PHP echo site_url(); ?>/?feed=xofeed">Xerte RSS Feed</a>. You might want to submit this to <a href="http://www.nottingham.ac.uk/xpert">Xpert</a></p>		
		<p>For guidance on how to use make Xerte Learning Objects then please see the <a href="admin.php?page=xerte_online_guidance">Xerte training materials</a></p>
		<h2>Using Xerte Learning Objects in this blog</h2>
		<p>Each Xerte Learning Object created with this plugin will have its own URL which can be added manually to posts or sent out to people.</p>
		<p>Or one of the following is an option
			<ol>
				<li>Iframe code - available underneath each post when being editted</li>
				<li>WordPress Shortcode - available underneath each post when being editted</li>
			</ol> 
		</p>
		<?PHP
	
	}
	
	function xerteonline_usage_stats(){
	
		global $wpdb;
		
		$table_name = $wpdb->prefix . "xerteonline_usage";
	
		$data = $wpdb->get_results("select * from " . $table_name . " order by post_id ASC, date_accessed ASC", OBJECT);
		
		echo "<h2>Usage stats for your learning objects</h2>";
		
		$curr_post = "";
		
		while($post_use = array_shift($data)){
		
			if($curr_post==""){
			
				$curr_post = $post_use->post_id;
				echo "<div><h2>";
				$post_info = get_post( $post_use->post_id );
				echo $post_info->post_title . "</h2>";
			
			}
		
			if($curr_post!=$post_use->post_id){
			
				echo "</div>";
				$curr_post = $post_use->post_id;
				echo "<div><h2>";
				$post_info = get_post( $post_use->post_id );
				echo $post_info->post_title . "</h2>";			
			
			}
			
			$post_info = get_post( $post_use->post_id );
			
			$user_info = get_userdata($post_use->user_id);
			
			echo "<strong>User : </strong> " . $user_info->user_login . " <strong>Date : </strong> " . date("D jS F Y - G:i:s",$post_use->date_accessed);
		
			echo "</p>";
		
		}
	
	}
	
	function xerteonline_guidance(){
	
		?>
		<h1>Xerte Online Training and Guidance</h1>

<h2><a href="http://www.jisctechdis.ac.uk/techdis/resources/detail/goingdigital/Xerte_QuickRef">Page Types Reference</a></h2>
<p>An overview of the kinds of pages you can create.</p>

<h2><a href="http://www.jisctechdis.ac.uk/techdis/resources/detail/goingdigital/Xerte_FirstLOTut">Creating your first learning object</a></h2>
<p>Step by step introduction to creating and distributing your first Xerte learning object.</p>

<h2><a href="http://www.jisctechdis.ac.uk/techdis/resources/detail/goingdigital/XerteTut_MultiChoice">Using the multiple choice page</a></h2>
<p>How to create an interactive quiz page on Xerte.</p>

<h2><a href="http://www.jisctechdis.ac.uk/techdis/resources/detail/goingdigital/XerteTut_DD">Using the drag and drop page</a></h2>
<p>Using drag and drop to provide interaction and informal self assessment.</p>

<h2><a href="http://www.jisctechdis.ac.uk/techdis/resources/detail/goingdigital/XerteTut_Hotspot">Using the image hotspots page</a></h2>
<p>Using images interactively to prompt or to test.</p>

<h2><a href="http://www.jisctechdis.ac.uk/techdis/resources/detail/goingdigital/Xerte_EditingPt1">Editing, managing and sharing learning objects (part 1)</a></h2>
<p>This tutorial covers the basics of editing, managing and sharing Xerte objects including previewing and publishing changes, how to make learning objects public, creating folders and organising learning objects, etc.</p>

<h2><a href="http://www.jisctechdis.ac.uk/techdis/resources/detail/goingdigital/Xerte_EditingPt2">Editing, managing and sharing learning objects (part 2)</a></h2>
<p>This tutorial features more advanced steps following on from part 1 including using RSS feeds, adding notes, sharing learning objects for collaborative development, exporting learning objects from Xerte toolkits, amongst many others.</p>

<h2><a href="http://www.jisctechdis.ac.uk/techdis/resources/detail/goingdigital/XerteTut_Categories">Using the categories page type</a></h2>
<p>Tutorial covering the usage of the categories page type.</p>

<h2><a href="http://www.jisctechdis.ac.uk/techdis/resources/detail/goingdigital/XerteTut_Navigators">Using the navigators page types</a></h2>
<p>Using the various navigators page types which provide different means of displaying information on the same page in smaller or separate chunks.</p>

<h2><a href="http://www.jisctechdis.ac.uk/techdis/resources/detail/goingdigital/XerteTut_Timeline">Using the timeline / matching pairs page type</a></h2>
<p>The timeline / matching pairs page type allows you to add 'drag items to correct sequence or to matching pairs' interaction extremely quickly, this tutorial covers the use of this page type.</p>

<h2><a title="Sharing your learning object with other Xerte Online Toolkit users and organisations - &quot;XPERT&quot;" href="http://www.jisctechdis.ac.uk/techdis/resources/detail/goingdigital/Xerte_XPERT">Sharing your learning object with other Xerte Online Toolkit users and organisations - "XPERT"</a></h2>
<p>Learn to share your learning objects via Open Courseware Syndication.</p>
<?PHP
	
	}

?>