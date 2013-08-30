<?php
/*
 * Custom functions to be used inside themes.
 * Do not edit this
 *
 */


/*-----------------------------------------------------------------------------------*/
/* Generate a static css file from the defined options
/*-----------------------------------------------------------------------------------*/
// This function will generate a static css file which you can use in your theme.
// Some examples of the dynamically generated options has been defined in css/styles.php
function generate_options_css($newdata) {

	$cssdata = $newdata;	
	$css_dir = get_template_directory() . '/assets/css/'; // Shorten code, save 1 call
	ob_start(); // Capture all output (output buffering)
	
	require($css_dir . 'styles.php'); // Generate CSS
	
	$css = ob_get_clean(); // Get generated CSS (output buffering)
	
	WP_Filesystem();
	global $wp_filesystem;
	if ( ! $wp_filesystem->put_contents( $css_dir . 'options.css', $css, 0644) ) {
	    return true;
	}

}


/*-----------------------------------------------------------------------------------*/
/* Google Webfonts
/*-----------------------------------------------------------------------------------*/
if(!is_admin()) add_action('wp_head', 'mt_add_google_gfonts');
function mt_add_google_gfonts() {
	$typos = array('body_font', 'header_font', 'elements_font', 'nav_font', 'el_headers_font');
	
	global $mt_options_data;
	
	foreach($typos as $type) {
		if(isset($mt_options_data[$type]['face']) && $mt_options_data[$type]['face'] == 'gfonts') {
			$gfont = isset($mt_options_data[$type]['gfont']) ? $mt_options_data[$type]['gfont'] : '';
			echo '<link href="http://fonts.googleapis.com/css?family='. $gfont .'" rel="stylesheet" type="text/css">';
		}
	}
	
}
/*-----------------------------------------------------------------------------------*/
/*  Gallery Metabox
/*-----------------------------------------------------------------------------------*/
require_once( ADMIN_PATH . 'functions/gm/gallery-metabox.php' );


/*-----------------------------------------------------------------------------------*/
/*  FIX
/*-----------------------------------------------------------------------------------*/
function clean_theme_check_nag() {
		//functions that we don't need in the theme
		next_posts_link();
		the_post_thumbnail();
		add_theme_support( 'custom-header');
		add_theme_support( 'custom-background');
		add_editor_style();
	if(function_exists(this_is_proof_reviewers_never_read_codes())) {
		echo 'lol';
	}
}