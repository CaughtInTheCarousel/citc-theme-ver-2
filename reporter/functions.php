<?php

/**
* Theme Constants
*/

define( 'ENGINE_URI', get_template_directory_uri() );
define( 'THEME_URI', get_stylesheet_directory_uri() );
define( 'ENGINE_IMG', THEME_URI . '/assets/img' );
define( 'ENGINE_CSS', THEME_URI . '/assets/css' );
define( 'ENGINE_JS', THEME_URI . '/assets/js' );
define( 'ENGINE_LIB', TEMPLATEPATH . '/library' );

/**
* Theme Includes
*/
require_once (TEMPLATEPATH . '/admin/index.php');
//require_once (TEMPLATEPATH . '/admin/classes/class.SidebarGenerator.php');
require_once (ENGINE_LIB . '/theme-metaboxes/custom-meta-boxes.php');
require_once (ENGINE_LIB . '/theme-metaboxes/theme-metaboxes.php');
require_once (ENGINE_LIB . '/engine-resizer.php');
require_once (ENGINE_LIB . '/engine-pagination.php');
//require_once (ENGINE_LIB . '/engine-categorymeta.php');
require_once (ENGINE_LIB . '/theme-pagebuilder/aq-page-builder.php');
require_once (ENGINE_LIB . '/engine-functions.php');
require_once (ENGINE_LIB . '/shortcodes/reactor-shortcodes.php');

// Widgets
require_once (ENGINE_LIB . '/engine-widgets/featured-posts.php');
require_once (ENGINE_LIB . '/engine-widgets/dt-social.php');
require_once (ENGINE_LIB . '/engine-widgets/dt-slider.php');

// Shortcodes
require_once (ENGINE_LIB . '/engine-shortcodes/shortcode-slider.php');
require_once (ENGINE_LIB . '/engine-shortcodes/shortcode-posts.php');
require_once (ENGINE_LIB . '/engine-shortcodes/shortcode-heading.php');

// Engine Blocks
require_once(AQPB_PATH . 'blocks/engine-slider-block.php');
require_once(AQPB_PATH . 'blocks/engine-posts-block.php');
require_once(AQPB_PATH . 'blocks/engine-heading-block.php');

// Register Page Builder block
aq_register_block('Engine_Slider_Block');
aq_register_block('Engine_Posts_Block');
aq_register_block('Engine_Heading_Block');

add_filter('widget_text', 'do_shortcode');

/**
* Content Width
*/
$content_width = 700;

/**
* Add theme support
*/
add_theme_support('post-thumbnails');
add_theme_support( 'automatic-feed-links' );

/**
* Theme Menu Locations
*/
register_nav_menus(array(
    'primary-menu' => __('Primary Menu','engine')
));


/**
 * Enqueue JavaScript and Stylesheet Files
 */
 
if (!function_exists('engine_scripts')) 
{

	function engine_scripts() {
		
		
		// Stylesheets
		wp_enqueue_style( 'font-awesome','http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.min.css' );
		wp_enqueue_style( 'flexslider', ENGINE_CSS . '/flexslider.css' );
		wp_enqueue_style( 'theme-style', THEME_URI . '/style.css' );
	    wp_enqueue_style( 'options-style', ENGINE_CSS . '/options.css' );
		
	    // JavaScript
	    wp_enqueue_script('jquery');
	    wp_enqueue_script( 'modernizr', ENGINE_JS . '/modernizr.js', array('jquery'), '', TRUE );
	    wp_enqueue_script( 'easing', ENGINE_JS . '/jquery.easing.min.js', array('jquery'), '', TRUE );
	    wp_enqueue_script( 'foundation', ENGINE_JS . '/foundation/foundation.min.js', array('jquery', 'modernizr', 'easing'), '', TRUE );
	    wp_enqueue_script( 'media-queries', ENGINE_JS . '/respond.min.js', '', '1', FALSE );
	    wp_enqueue_script( 'flexslider', ENGINE_JS . '/jquery.flexslider-min.js', array('jquery'), '', TRUE );
	    wp_enqueue_script( 'fitvids', ENGINE_JS . '/jquery.fitvids.js', array('jquery'), '', TRUE );
	    wp_enqueue_script( 'custom-js', ENGINE_JS . '/custom.js', array('jquery', 'foundation'), '1', TRUE );
	     
	    if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
		
	}
	
	add_action( 'wp_enqueue_scripts', 'engine_scripts' );

}

/*
 *
 * Engine Widget Registration
 * Register all the different widget areas
 *
 */


if (!function_exists('engine_widget_registration')) 
{

	function engine_widget_registration() 
	{
		
		$sidebars = array(
			'global_sidebar' => __('Global Sidebar', 'engine'), 
			'header_main_l' => __('Header Main Left Dropdown', 'engine'),
			'header_main_r' => __('Header Main Right Dropdown', 'engine'),
			'footer_top' => __('Footer Top', 'engine'),
			'footer_bottom' => __('Footer Bottom', 'engine'),
		);
			
		
		foreach ($sidebars as $key => $value) {
			
			register_sidebar(array('name'=> $value,
				'id' => $key,
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h3 class="widget-title"><span>',
				'after_title' => '</span></h3>'
			));
			
		}

	
	}
	
	add_action('init', 'engine_widget_registration');

}



/*
 *
 * Custom excerpt length
 *
 */
 
if (!function_exists('engine_custom_excerpt_length')) 
{
	// custom excerpt length
	function engine_custom_excerpt_length( $length ) {
		return 100;
	}
	add_filter( 'excerpt_length', 'engine_custom_excerpt_length' );
	
}


/*
 *
 * Custom Comments
 *
 */


if (!function_exists('engine_comments'))
{

	function engine_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-wrap">
		<?php endif; ?>
				
			<div class="comment-author">
				
				<div class="comment-avatar">
					<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</div>
				<!-- /.comment-avatar -->
				
				<div class="comment-body">
					
					<?php printf(__('<cite class="fn the-author">%s</cite>'), get_comment_author_link()) ?>
					<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					<div class="comment-meta commentmetadata">
						<?php echo get_comment_date(); ?>
						<?php edit_comment_link(__('(Edit)', 'engine'),'  ','' ); ?>
					</div>

					<?php if ($comment->comment_approved == '0') : ?>
					<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'engine') ?></em>
					<?php endif; ?>
	
					<div class="comment-content">
						<?php comment_text() ?>
					</div>
					
				</div>
				<!-- /.comment-body -->
				
			</div>
			<!-- .comment-author -->
			
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
	<?php
	}
	
}


function reporter_body_class($classes = '') {
	
	global $reporter_data; 
	
	$header_layout = $reporter_data['header_layout'];
	
	if( $header_layout != '' ) 
		$classes[] = $header_layout;
		
		
	return $classes;
}

add_filter('body_class','reporter_body_class');


