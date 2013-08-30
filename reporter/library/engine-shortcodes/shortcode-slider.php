<?php

// [engine_slider title="Slider" qty="4" category="" autoplay="5000" random="false"]
function engine_slider_sc( $atts ) {

	// Variables
	extract( shortcode_atts( array(
		'title' => 'Slider',
		'qty' => '4',
		'category' => '',
		'autoplay' => '5000',
		'random' => false,
		'thumb_size' => 'large',
		'excerpt_length' => '30'
	), $atts ) );
	
	// Defaults
	if(!isset($category)) $category = '';
	if(!isset($random)) { $random = '0'; }
	if(!isset($autoplay)) $autoplay = '0';
	if(!isset($qty)) $qty = '-1';
	if(!isset($thumb_size)) $thumb_size = 'large';
	if(!isset($excerpt_length)) $excerpt_length = '30';
	
	if( !empty($category) ) {
	
		// Make category an array
		$category = explode(', ', $category);
		$args['category__in'] = $category;
	
	}
	
	// Args for the query
	$args = array(
		'posts_per_page' => $qty,
		'category__in' => $category,
	);
	
	$q = new WP_Query($args);
	
	if($q->have_posts() ) :  
	
	// This is needed for a bunch of HTML
	ob_start(); 
	
	?>
	
	<?php if($title): ?>
	<h4 class="widget-title"><?php echo stripslashes($title); ?></h4>
	<?php endif; ?>
	
	<div class="slider flexslider" data-autoplay="<?php echo $autoplay; ?>" data-random="<?php echo $random; ?>">
	
		<ul class="slides">
			
			<?php while ( $q->have_posts() ) : $q->the_post(); ?>
			<li <?php post_class(); ?>>
	
				<article class="the-post">
				
					<div class="featured-image">
						
						<a href="<?php the_permalink(); ?>"><?php engine_thumbnail($thumb_size); ?></a>
						
					</div>
					<!-- /.featured-image -->
							
					<!-- .entry-header -->
					<header class="entry-header">
						
						<div class="entry-meta">
							<span class="entry-comments"><a href="<?php comments_link(); ?>"><i class="icon-comments"></i><?php comments_number(0, 1, '%'); ?></a></span>
							<span class="entry-category"><i class="icon-folder-open"></i><?php the_category(', '); ?></span>
							<span class="entry-date"><i class="icon-calendar"></i><?php the_time( get_option('date_format') ); ?></span>				
						</div>
					
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						
					</header>
					<!-- /.entry-header -->
	
					<?php if( $excerpt_length != '0' ): ?>
					
						<div class="entry-content">
							<?php echo wpautop(engine_excerpt($excerpt_length)); ?>
						</div>
						
					<?php endif; ?>

				</article>
				<!-- /.the-post -->
				
			</li>
			<?php endwhile; ?>
			
		</ul>
		
	</div>
	<?php else: ?>
	<span class="radius secondary label"><?php _e('No posts found','engine'); ?></span>
	<?php 
	endif; 
	wp_reset_query();
	
	$output = ob_get_contents();
	
	ob_end_clean();
	
	return $output;
	
		
}
add_shortcode( 'engine_slider', 'engine_slider_sc' );