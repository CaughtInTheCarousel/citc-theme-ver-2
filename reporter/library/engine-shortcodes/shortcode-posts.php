<?php

// [engine_posts title="Headlines" qty="9" category="" orderby="date" order="DESC"]
function engine_posts_sc( $atts ) {

	// Variables
	extract( shortcode_atts( array(
		'title' => 'Posts',
		'qty' => '4',
		'category' => '',
		'orderby' => 'date',
		'order' => 'DESC',
		'style' => 'title',
		'thumb_size' => 'large',
		'excerpt_length' => '17'
	), $atts ) );
	
	// Defaults
	if(!isset($category)) $category = '';
	if(!isset($orderby)) { $orderby = 'date'; }
	if(!isset($order)) { $order = 'DESC'; }
	if(!isset($qty)) $qty = '10';
	if(!isset($style)) $style = 'title';
	if(!isset($thumb_size)) $thumb_size = 'large';
	if(!isset($excerpt_length)) $excerpt_length = '17';
	
	// Args for the query
	$args = array(
		'posts_per_page' => $qty,
		'orderby' => $orderby,
		'order' => $order
	);
	
	if( $category ) {
	
		// Make category an array
		$category = explode(', ', $category);
		$args['category__in'] = $category;
	
	}
	
	$columns = '1';
	if( $style == 'title_meta_thumb_2' ) {
		$columns = '2';
		$thumb_size = 'medium';
	}
	if( $style == 'title_meta_thumb_3' ) {
		$columns = '3';
		$thumb_size = 'small';
	}
	if( $style == 'title_meta_thumb_4' ) {
		$columns = '4';
		$thumb_size = 'smallest';
	}
	
	$q = new WP_Query($args);
	
	if($q->have_posts() ) :  
	
	// This is needed for a bunch of HTML
	ob_start(); 
	?>
	
	<?php if($title): ?>
	<h4 class="widget-title"><?php echo stripslashes($title); ?></h4>
	<?php endif; ?>
	
	<ul class="posts <?php echo $style; ?> small-block-grid-1 large-block-grid-<?php echo $columns; ?>">
		
		<?php while ( $q->have_posts() ) : $q->the_post(); ?>
		
		<?php if( get_the_title() && $style == 'title' ) : ?>
		<li>
			<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</li>
		<?php elseif( $style == 'title_meta'): ?>
		<li class="title-meta">
		
			<article class="the-post">
			
				<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<div class="entry-meta">
					<span class="entry-comments"><a href="<?php comments_link(); ?>"><i class="icon-comments"></i><?php comments_number(__('0 Comments','engine'), __('1 Comment','engine'), '% ' . __('Comments','engine')); ?></a></span>
					<span class="entry-date"><i class="icon-calendar"></i><?php the_time( get_option('date_format') ); ?></span>				
				</div>
			
			</article>
			<!-- /.the-post -->
			
		</li>
		<?php elseif( $style == 'title_meta_thumb_side'): ?>
		<li class="title-meta-thumb-side title-meta">
		
			<article class="the-post row">
			
				<div class="featured-image">
					
					<a href="<?php the_permalink(); ?>"><?php engine_thumbnail('tiny'); ?></a>
					
				</div>
				<!-- /.featured-image -->
				
				<div class="details">
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="entry-meta">
						<span class="entry-comments"><a href="<?php comments_link(); ?>"><i class="icon-comments"></i><?php comments_number(__('0 Comments','engine'), __('1 Comment','engine'), '% ' . __('Comments','engine')); ?></a></span>
						<span class="entry-date"><i class="icon-calendar"></i><?php the_time( get_option('date_format') ); ?></span>				
					</div>
				</div>
				<!-- /.details -->
		
			</article>
			<!-- /.the-post -->
			
		</li>
		<?php else: ?>
		<li class="title-meta-thumb">
		
			<article class="the-post">
			
				<div class="featured-image">
					
					<a href="<?php the_permalink(); ?>"><?php engine_thumbnail($thumb_size); ?></a>
					
				</div>
				<!-- /.featured-image -->
					
							
				<!-- .entry-header -->
				<header class="entry-header">
					
					<div class="entry-meta">
						<span class="entry-comments"><a href="<?php comments_link(); ?>"><i class="icon-comments"></i><?php comments_number(0, 1, '%'); ?></a></span>
						<span class="entry-date"><i class="icon-calendar"></i><?php the_time( get_option('date_format') ); ?></span>				
					</div>
				
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					
				</header>
				<!-- /.entry-header -->
				
				<?php if( $excerpt_length ) : ?>
				<div class="entry-content">
					<?php echo engine_excerpt($excerpt_length); ?>
				</div>
				<?php endif; ?>
			
			</article>
			<!-- /.the-post -->
			
		</li>
		<?php
		endif; 
		endwhile; 
		?>
		
	</ul>
	<?php else: ?>
	<span class="radius secondary label"><?php _e('No posts found','engine'); ?></span>
	<?php 
	endif; 
	wp_reset_query();
	
	$output = ob_get_contents();
	
	ob_end_clean();
	
	return $output;
		
}
add_shortcode( 'engine_posts', 'engine_posts_sc' );