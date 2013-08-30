<?php

/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage reporter
 * @since reporter 1.0
 */
 
?>

<!DOCTYPE html>
<!--[if IE 6]> <html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]> <html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) | !(IE 9) ]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	
	<?php // Respnsive settings ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
	
	<title><?php wp_title( '|', true, 'right' ); ?> <?php bloginfo('name'); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	
	<?php wp_head(); ?>
	
</head>