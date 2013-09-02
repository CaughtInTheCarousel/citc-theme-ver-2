<?php 

/*
 *
 * Return an array of all the archive options
 *
 */
 
if (!function_exists('engine_layout_options')) 
{
	function engine_layout_options() {
		
		if( !is_admin() ) {
		
			global $reporter_data; 
			
			// Default Archive Layout
			$archive_layout = '3';
			$archive_first_layout = '2';
			$archive_first_layout_number = '6';
				
			if( is_archive() || is_home() || is_search() ) { 
				
				$archive_layout = $reporter_data['archive_layout'];
				$archive_first_layout = $reporter_data['archive_first_layout'];
				$archive_first_layout_number = $reporter_data['archive_first_layout_number'];
				
				
			}
			
			$output = array(
				'archive_layout' => $archive_layout,
				'archive_first' => $archive_first_layout,
				'archive_number' => $archive_first_layout_number,
			);
			
			return $output;
		
		}
		
	}
}


/*
 *
 * Get the content position with the sidebar options
 *
 */
 
if (!function_exists('engine_content_position')) 
{
	function engine_content_position() {
		
		if( !is_admin() ) {
		
			global $reporter_data; 
		
			// Default
			$sidebar_position = 'right';
			$content_position = 'left';
			
			if( isset($reporter_data['archive_sidebar_pos']) ) $sidebar_position = $reporter_data['archive_sidebar_pos'];
			
			// Default sidebar position for post and page
			if( is_single() ) if( isset($reporter_data['post_sidebar_pos']) ) $sidebar_position = $reporter_data['post_sidebar_pos'];			
			if( is_page() ) if( isset($reporter_data['page_sidebar_pos']) ) $sidebar_position = $reporter_data['page_sidebar_pos'];
			
			// Override if post meta is set for post or page
			if( is_singular() ) {
			
				$single_sidebar_position = get_post_meta(get_the_ID(), 'engine_sidebar_pos', TRUE);
				
				if( $single_sidebar_position != '' ) 
					$sidebar_position = $single_sidebar_position;
			}
			
			// Archive sidebar position
			if( is_archive() ) {
			
				$t_id = get_queried_object()->term_id;
			}
			
			if( $sidebar_position == 'right' ) $content_position = 'large-9 left';
			if( $sidebar_position == 'left' ) $content_position = 'large-9 right';
			if( $sidebar_position == 'none' ) $content_position = FALSE;
			
			$output = $content_position;
			
			return $output;
		
		}
		
	}
}


/*
 *
 * Get the correct thumbnail
 *
 */

if (!function_exists('engine_thumbnail')) 
{
	function engine_thumbnail($type = 'archive') {
		
		if( !is_admin() ) {
		
			// Thumbnail ID
			$thumb = get_post_thumbnail_id();
			
			// Get place holder image if available
			$img_url = engine_placeholder_image();
			
			// If has a featured image, get the URL
			if( $thumb ) $img_url = wp_get_attachment_url( $thumb, 'full' );
			
			// Set size for single
			if( is_singular() || is_front_page() ) {
				$img = engine_resize( $img_url, 700, 350, false ); // Full Width Image
				if( !engine_content_position() ) $img = engine_resize( $img_url, 940, 510, false ); 
					
				if( $type == 'large' )
					$img = engine_resize( $img_url, 940, 510, false ); // 1 Column
					
				if( $type == 'medium' )
					$img = engine_resize( $img_url, 700, 350, false ); // 2 Column
					
				if( $type == 'small' )
					$img = engine_resize( $img_url, 460, 250, false ); // 3 Column
					
				if( $type == 'smallest' )
					$img = engine_resize( $img_url, 220, 120, false ); // 4 Column
					
				if( $type == 'tiny' )
					$img = engine_resize( $img_url, 90, 50, false ); // Widget size
			}
			
			// Archive
			if( is_archive() || is_home() || is_search() ) {
				
				$layout_options = engine_layout_options();
				
				// Archive Types
				if( $type == 'archive' && array_key_exists('archive_layout', $layout_options) ) 
					$layout = $layout_options['archive_layout'];
					
				if( $type == 'archive-first' && array_key_exists('archive_first', $layout_options) ) 
					$layout = $layout_options['archive_first'];
				
				// Set size depending on layout
				if($layout == '1') {
					$img = engine_resize( $img_url, 700, 350, false ); // Full Width Image
					if( !engine_content_position() ) $img = engine_resize( $img_url, 940, 510, false ); 
				}
				if($layout == '2') $img = engine_resize( $img_url, 460, 250, false ); // 2 Column 
				if($layout == '3') $img = engine_resize( $img_url, 300, 165, false ); // 3 Column
				if($layout == '4') $img = engine_resize( $img_url, 220, 120, false ); // 4 Column	

			}
	
			// Output the image
			if($img) : ?>
			<img src="<?php echo $img ?>" alt="<?php the_title(); ?>"/>
			<?php endif;
		
		}
		
	}
}


/*
 * Function similar to wp_link_pages but outputs an unordered list instead and adds a class of current to the current page
 */
 
function engine_link_pages( $args = '' ) {
	
	$defaults = array(
		'before'           => '<p>' . __( 'Pages:', 'engine' ), 'after' => '</p>',
		'link_before'      => '', 'link_after' => '',
		'next_or_number'   => 'number', 'nextpagelink' => __( 'Next page', 'engine' ),
		'previouspagelink' => __( 'Previous page', 'engine' ), 'pagelink' => '%',
		'echo'             => 1
	);
 
	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );
 
	global $page, $numpages, $multipage, $more, $pagenow;
 
	$output = '';
	if ( $multipage ) {
		if ( 'number' == $next_or_number ) {
			$output .= $before;
			$output .= '<ul>';
			for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
				$j = str_replace( '%', $i, $pagelink );
				if ( ( $i == $page )) {
					$output .= '<li class="current">';
				} else {
					$output .= '<li>';
				}
				if ( ( $i != $page ) || ( ( ! $more ) && ( $page == 1 ) ) ) {
					$output .= _wp_link_page( $i );
				}
				$output .= $link_before . $j . $link_after;
				if ( ( $i != $page ) || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= '</a>';
			}
			$output .= '</li>';
			$output .= $after;
		} else {
			if ( $more ) {
				$output .= $before;
				$i = $page - 1;
				if ( $i && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $link_before . $previouspagelink . $link_after . '</a>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $link_before . $nextpagelink . $link_after . '</a>';
				}
				$output .= '</ul>';
				$output .= $after;
			}
		}
	}
 
	if ( $echo )
		echo $output;
 
	return $output;
}


/*
 *
 * Use a placeholder image if available
 *
 */


if (!function_exists('engine_placeholder_image')) 
{
	function engine_placeholder_image() {
		global $reporter_data; 
		if( isset($reporter_data['placeholder_image']) ) {
			$image = $reporter_data['placeholder_image'];
		
			return $image;	
		}
	}
}



/*
 *
 * Trim excerpt
 *
 */

if (!function_exists('engine_trim_excerpt')) 
{
	function engine_trim_excerpt($text)
	{
		return str_replace(' [...]', '...', $text);
	}
	add_filter('get_the_excerpt', 'engine_trim_excerpt');
}


/*
 *
 * Function to choose the excerpt length
 *
 */
 
if (!function_exists('engine_excerpt')) 
{
	function engine_excerpt($limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		} 
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
			return $excerpt;
	}
}

/**
 * class required_walker
 * Custom output to enable the the ZURB Navigation style.
 * Courtesy of Kriesi.at. http://www.kriesi.at/archives/improve-your-wordpress-navigation-menu-output
 * From required+ Foundation http://themes.required.ch
 */
 
class engine_menu_walker extends Walker_Nav_Menu {

	/**
	 * Specify the item type to allow different walkers
	 * @var array
	 */
	var $nav_bar = '';

	function __construct( $nav_args = '' ) {

		$defaults = array(
			'item_type' => 'li',
			'in_top_bar' => false,
		);
		$this->nav_bar = apply_filters( 'req_nav_args', wp_parse_args( $nav_args, $defaults ) );
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Check for flyout
		$flyout_toggle = '';
		if ( $args->has_children && $this->nav_bar['item_type'] == 'li' ) {

			if ( $depth == 0 && $this->nav_bar['in_top_bar'] == false ) {

				$classes[] = 'has-flyout';
				$flyout_toggle = '<a href="#" class="flyout-toggle"><span></span></a>';

			} else if ( $this->nav_bar['in_top_bar'] == true ) {

				$classes[] = 'has-dropdown';
				$flyout_toggle = '';
			}

		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		if ( $depth > 0 ) {
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		} else {
			$output .= $indent . ( $this->nav_bar['in_top_bar'] == true ? '<li class="divider"></li>' : '' ) . '<' . $this->nav_bar['item_type'] . ' id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output  = $args->before;
		$item_output .= '<a '. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $flyout_toggle; // Add possible flyout toggle
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {

		if ( $depth > 0 ) {
			$output .= "</li>\n";
		} else {
			$output .= "</" . $this->nav_bar['item_type'] . ">\n";
		}
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {

		if ( $depth == 0 && $this->nav_bar['item_type'] == 'li' ) {
			$indent = str_repeat("\t", 1);
    		$output .= $this->nav_bar['in_top_bar'] == true ? "\n$indent<ul class=\"dropdown\">\n" : "\n$indent<ul class=\"flyout\">\n";
    	} else {
			$indent = str_repeat("\t", $depth);
    		$output .= $this->nav_bar['in_top_bar'] == true ? "\n$indent<ul class=\"dropdown\">\n" : "\n$indent<ul class=\"level-$depth\">\n";
		}
  	}
}


/*
 *
 * Active nav class
 *
 */

if (!function_exists('engine_active_nav_class')) 
{
	// Add Foundation 'active' class for the current menu item
	function engine_active_nav_class( $classes, $item ) {
	    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
	        $classes[] = 'active';
	    }
	    return $classes;
	}
	add_filter( 'nav_menu_css_class', 'engine_active_nav_class', 10, 2 );
	
}

/**
 * Use the active class of ZURB Foundation on wp_list_pages output.
 * From required+ Foundation http://themes.required.ch
 */
 
if (!function_exists('engine_active_list_pages_class')) 
{
	function engine_active_list_pages_class( $input ) {
	
		$pattern = '/current_page_item/';
	    $replace = 'current_page_item active';
	
	    $output = preg_replace( $pattern, $replace, $input );
	
	    return $output;
	}
	add_filter( 'wp_list_pages', 'engine_active_list_pages_class', 10, 2 );
}


/*
 *
 * Count sidebar widgets function, helpful!
 *
 */

if (!function_exists('engine_count_sidebar_widgets')) 
{
	function engine_count_sidebar_widgets( $sidebar_id, $echo = true ) 
	{
	    $the_sidebars = wp_get_sidebars_widgets();
	    if( !isset( $the_sidebars[$sidebar_id] ) )
	        return __( 'Invalid sidebar ID', 'engine' );
	    if( $echo )
	        echo count( $the_sidebars[$sidebar_id] );
	    else
	        return count( $the_sidebars[$sidebar_id] );
	}
}


/*
 *
 * Theme Options UI Tweaks
 *
 */
 
if (!function_exists('theme_options_tweaks')) 
{

	function theme_options_tweaks() {
	
		global $pagenow;
		if(is_admin() && $pagenow == 'themes.php'):
		?>
			<style type="text/css">
				label.multicheck { bottom: -7px; }
				
				#of_container #content .section-checkbox .explain {
					width: 90%;
					max-width: 100%;
				}
			</style>
		<?php
		endif;
		}
	
	add_action('admin_head', 'theme_options_tweaks');
	
}


/*
 *
 * Move bundled scripts to footer
 *
 *
 */
 

if(!function_exists('engine_enqueue_jquery_in_footer')) 
{
	function engine_enqueue_jquery_in_footer( &$scripts ) {
	     
	    if ( ! is_admin() ) {
	        $scripts->add_data( 'jquery', 'group', 1 );
	        $scripts->add_data( 'comment-reply', 'group', 1 );
	    }
	}
	add_action( 'wp_default_scripts', 'engine_enqueue_jquery_in_footer' );
}


/*
 *
 * Related posts
 *
 */

if (!function_exists('engine_related'))
{
	function engine_related($post_type = 'post', $tax = 'category', $num = 3) {
		
		$ids = '';
		
		$terms = wp_get_post_terms( get_the_ID(), $tax );
		
		foreach( $terms as $term ) 
		{
			$ids[] = $term->term_id;
		}
	
		$args = array(
			'tax_query' => array(
				array(
					'taxonomy' => $tax,
					'field' => 'id',
					'terms' => $ids
				)
			),
			'post_type' => $post_type,
			'post__not_in' => array(get_the_ID()),
			'posts_per_page'=> $num,
			'ignore_sticky_posts'=> 1
		);
		
		$query = new WP_Query($args);
		
		return $query;
		
	}
}

function engine_nothing() {
	wp_link_pages();
}