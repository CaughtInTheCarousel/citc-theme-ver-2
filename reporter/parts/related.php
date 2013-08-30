<?php 

$q = engine_related(); 

$count = $q->post_count;

if( $count > 3 ) $count = 3;

if( $count == 1 ) $thumb_size = 'large';
if( $count == 2 ) $thumb_size = 'medium';
if( $count == 3 ) $thumb_size = 'small';

?>

<?php if($q->have_posts()) : ?>

<div class="related">
	
	<h3 class="widget-title"><?php _e('Related','engine'); ?></h3>
	<ul class="small-block-grid-1 large-block-grid-<?php echo $count; ?> grid-<?php echo $count; ?>">
		
		<?php while ($q->have_posts()) : $q->the_post(); ?>
		
		<li <?php post_class(); ?>>
			
			<article class="the-post">
			
				<div class="featured-image">
					
					<a href="<?php the_permalink(); ?>"><?php engine_thumbnail($thumb_size); ?></a>
					
				</div>
				<!-- /.featured-image -->
					
				<?php get_template_part('loop'); ?>
			
			</article>
			<!-- /.the-post -->
			
		</li>
	
	<?php endwhile; wp_reset_query(); ?> 
	</ul>
	
</div>
<!-- /.related -->

<?php endif; ?>