<?PHP

function xerteonline_customfeed() {

	load_template( plugin_dir_path(__FILE__) . 'xerterssfeed.php');
 
}
add_action('do_feed_xofeed', 'xerteonline_customfeed', 10, 1); 

function xerteonline_feed_rewrite($wp_rewrite) {
	$feed_rules = array(
	'feed/(.+)' => 'index.php?feed=' . $wp_rewrite->preg_index(1),
	'(.+).xml' => 'index.php?feed='. $wp_rewrite->preg_index(1)
	);
	$wp_rewrite->rules = $feed_rules + $wp_rewrite->rules;
}
add_filter('generate_rewrite_rules', 'xerteonline_feed_rewrite');

?>