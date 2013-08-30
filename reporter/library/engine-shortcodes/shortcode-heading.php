<?php

// [engine_heading title="Headlines" align="left"]
function engine_heading_sc( $atts ) {

	// Variables
	extract( shortcode_atts( array(
		'title' => 'Title',
		'align' => 'left',
		'link_title' => '',
		'link_url' => '',
	), $atts ) );
	
	// Defaults
	if(!isset($align)) $align = 'left';
	if(!isset($link_title)) $link_title = '';
	if(!isset($link_url)) $link_url = '';
		
	// This is needed for a bunch of HTML
	ob_start(); 
	?>
	
	<?php if($title): ?>
	<h4 class="widget-title align-<?php echo $align; ?>">
		<?php echo stripslashes($title); ?>
		<?php if( $link_title != '' ) : ?>
		<span><a href="<?php echo $link_url; ?>"><?php echo $link_title; ?> <i class="icon-chevron-right"></i></a></span>
		<?php endif; ?>
	</h4>
	<?php endif; ?>
	
	<?php
	
	$output = ob_get_contents();
	
	ob_end_clean();
	
	return $output;
		
}
add_shortcode( 'engine_heading', 'engine_heading_sc' );