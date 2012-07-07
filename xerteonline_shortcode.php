<?PHP

	function xerteonline_shortcode( $atts ) {		
	
		$post = get_post($atts['post']);

		?>
		<iframe src="<?PHP echo site_url(); ?>/?xerte_online=<?PHP echo $post->post_title; ?>" width="1020" height="740"></iframe>
		<?PHP
		
	}
	
	add_shortcode('xerte-online', 'xerteonline_shortcode' );
	
?>