<?php
/**
 * Featured Posts widget w/ category exclude class
 * This allows specific Category IDs to be removed from the Sidebar Featured Posts list
 *
 * @link http://wordpress.org/support/topic/featured-posts-widget-with-category-exclude
 */
class WP_Widget_Featured_Posts_Exclude extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_featured_entries', 'description' => __("The most featured posts on your site", 'reactor') );
		parent::__construct('featured-posts', __('Featured Posts', 'reactor'), $widget_ops);
		$this->alt_option_name = 'widget_featured_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_featured_posts', 'widget');

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

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Featured Posts', 'reactor') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 10;
 		$category = empty( $instance['category'] ) ? '' : $instance['category'];

		$r = new WP_Query(array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'category__in' => explode(',', $category) ));
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
			<?php  while ($r->have_posts()) : $r->the_post(); ?>
			<li>
				<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
					<?php the_post_thumbnail('thumbnail'); ?>
				</a>
				
				<?php get_template_part('loop'); ?>
			</li>
			<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_query();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_featured_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['category'] = strip_tags( $new_instance['category'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_featured_entries']) )
			delete_option('widget_featured_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_featured_posts', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		$category = isset($instance['category']) ? esc_attr( $instance['category'] ) : '';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'engine'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:', 'engine'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		
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
<?php
	}
}

function WP_Widget_Featured_Posts_Exclude_init() {
    register_widget('WP_Widget_Featured_Posts_Exclude');
}

add_action('widgets_init', 'WP_Widget_Featured_Posts_Exclude_init');

?>