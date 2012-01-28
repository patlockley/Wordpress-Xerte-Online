<?PHP

	add_action('init', 'xerteonlinewordpress_custom_page_type_create');

	function xerteonlinewordpress_custom_page_type_create() 
	{
	  $labels = array(
		'name' => _x('Xerte Onlines', 'post type general name'),
		'singular_name' => _x('Xerte Online', 'post type singular name'),
		'add_new' => _x('Add New', 'xerte_online'),
		'add_item' => __('Add New '),
		'edit_item' => __('Edit Xerte Online'),
		'item' => __('New Xerte Online'),
		'view_item' => __('View Xerte Online'),
		'search_items' => __('Search Xerte Online'),
		'not_found' =>  __('No Xerte Onlines found'),
		'not_found_in_trash' => __(	'No Xerte Online found in Trash'), 
		'parent_item_colon' => '',
		'menu_name' => 'Xerte Online'

	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'menu_item' => plugin_dir_url(__FILE__) . "logo.jpg",
		'_edit_link' => 'post.php?post=%d',	
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
		'rewrite' => false,
		'description' => 'A Collection of terms which which to search for resources with',
		'supports' => array('title')
	  ); 
	  register_post_type('xerte_online',$args);

	}

?>