<?php
/**
 * Featured Posts widget w/ category exclude class
 * This allows specific Category IDs to be removed from the Sidebar Featured Posts list
 *
 * @link http://wordpress.org/support/topic/dt-slider-widget-with-category-exclude
 */
class DT_Slider extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_dt_slider', 'description' => __("The most featured posts on your site", 'engine') );
		parent::__construct('dt-slider', __('DT Slider', 'engine'), $widget_ops);
		$this->alt_option_name = 'widget_dt_slider';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_dt_slider', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('', 'engine') : $instance['title'], $instance, $this->id_base);
 			
 		$category = empty( $instance['category'] ) ? '' : $instance['category'];
 		$qty = empty( $instance['qty'] ) ? '3' : $instance['qty'];
 		$excerpt_length = empty( $instance['excerpt_length'] ) ? '0' : $instance['excerpt_length'];
 		

		$r = new WP_Query(array('posts_per_page' => $qty, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'category__in' => explode(',', $category) ));
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; 
		
		echo do_shortcode('[engine_slider title="'.$title.'" category="'.$category.'" qty="'.$qty.'" autoplay="0" random="0" thumb_size="small" excerpt_length="'.$excerpt_length.'"]');
		
		echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_dt_slider', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['qty'] = (int) $new_instance['qty'];
		$instance['excerpt_length'] = (int) $new_instance['excerpt_length'];
		$instance['category'] = strip_tags( $new_instance['category'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_dt_slider']) )
			delete_option('widget_dt_slider');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_dt_slider', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$qty = isset($instance['qty']) ? absint($instance['qty']) : 5;
		$autoplay = isset($instance['autoplay']) ? esc_attr($instance['autoplay']) : 0;
		$random = isset($instance['random']) ? esc_attr($instance['random']) : '';
		$excerpt_length = isset($instance['excerpt_length']) ? absint($instance['excerpt_length']) : 0;
		$category = isset($instance['category']) ? esc_attr( $instance['category'] ) : '';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'engine'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p>
			<label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e('Category:', 'engine'); ?></label> 
			
			<?php 
			
			$args = array(
				'selected' => $category,
				'name' => $this->get_field_name('category'),
				'id' => $this->get_field_id('category'),
				'class' => 'widefat'
			);
			
			wp_dropdown_categories($args); 
			
			?>
			
		</p>
		
		<p><label for="<?php echo $this->get_field_id('qty'); ?>"><?php _e('Number of posts:', 'engine'); ?></label>
		<input id="<?php echo $this->get_field_id('qty'); ?>" name="<?php echo $this->get_field_name('qty'); ?>" type="text" value="<?php echo $qty; ?>" size="3" /></p>
		
		<p><label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php _e('Excerpt Length:', 'engine'); ?></label>
		<input id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" type="text" value="<?php echo $excerpt_length; ?>" size="3" /></p>
		
<?php
	}
}

function DT_Slider_init() {
    register_widget('DT_Slider');
}

add_action('widgets_init', 'DT_Slider_init');

?>