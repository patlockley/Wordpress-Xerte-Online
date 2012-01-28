<?PHP

	function xerteonline_shortcode( $atts ) {		

		?>
		<iframe src="?p=<?PHP echo $atts['post']; ?>" width="1020" height="740"></iframe>
		<?PHP
		
	}
	
	add_shortcode('xerte-online', 'xerteonline_shortcode' );
	
?>