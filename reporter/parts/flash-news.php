<?php

/**
 * Flash News
 *
 * Displays a series of post titles within a small slider
 *
 * @package WordPress
 * @subpackage reporter
 * @since reporter 1.0
 */

?>
<?php  

global $reporter_data;
	
// Defaults
if( !isset( $reporter_data['flash_news_header']) ) 		$reporter_data['flash_news_header'] = __('Flash News', 'engine');
if( !isset( $reporter_data['flash_news_anim_speed']) ) 	$reporter_data['flash_news_anim_speed'] = 1000;
if( !isset( $reporter_data['flash_news_timer_speed']) ) 	$reporter_data['flash_news_timer_speed'] = 5000;
if( !isset( $reporter_data['flash_news_num']) ) 			$reporter_data['flash_news_num'] = 5;
if( !isset( $reporter_data['flash_news_cat']) ) 			$reporter_data['flash_news_cat'] = FALSE;

// If enabled
if( $reporter_data['flash_news'] ) : ?>
<div class="flash-news">
	
	<h6 class="heading uppercase flash-header"><?php echo $reporter_data['flash_news_header']; ?></h6>
	
	<?php 
	
	// Get the category ID's
	if( $reporter_data['flash_news_cat'] ) { 
		
		$cat = '';
		
		foreach($reporter_data['flash_news_cat'] as $k => $v)
		{
			if( $v ) $cat[] = $k;
		}
		
		$args['category__in'] = $cat;
	
	}

	$args['posts_per_page'] = $reporter_data['flash_news_num'];
	
	$q = new WP_Query($args);
	
	?>
	
	<?php if($q->have_posts() ) : ?>
	<ul data-orbit data-options="animation_speed:<?php echo $reporter_data['flash_news_anim_speed']; ?>; stack_on_small:false; bullets:false; timer_speed:<?php echo $reporter_data['flash_news_timer_speed']; ?>;">
		<?php while ( $q->have_posts() ) : $q->the_post(); ?>
		<li><span class="entry-time"><?php the_time(); ?></span> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php endwhile; ?>
	</ul>
	<?php else : // If no posts found ?>
	<span class="radius secondary label"><?php _e('No posts found','engine'); ?></span>
	<?php endif; wp_reset_query(); ?>
	
</div>
<!-- /.flash-news -->
<?php endif; ?>