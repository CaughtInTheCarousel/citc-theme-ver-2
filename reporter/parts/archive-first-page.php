<?php 
$opt = engine_layout_options();
$total = $wp_query->post_count;
$count = 0; 
?>


<?php if( is_home() ): ?>
<h1 class="page-title"><?php _e('Latest Posts','engine'); ?></h1>
<?php elseif( is_category() ): ?>
<h1 class="page-title"><?php _e('Latest from','engine'); ?> <?php wp_title(); ?></h1>
<?php endif; ?>	

<?php if(have_posts()) : ?>

<ul class="small-block-grid-1 large-block-grid-<?php echo $opt['archive_first']; ?> grid-<?php echo $opt['archive_first']; ?>">

	<?php while (have_posts()) : the_post(); ?>
	
	<?php $count++; ?>
	
	<?php if( $count < ($opt['archive_number'] + 1) ) : ?>
	<li <?php post_class(); ?>>
		
		<article class="the-post">
				
			<div class="featured-image">
				
				<a href="<?php the_permalink(); ?>"><?php engine_thumbnail('archive-first'); ?></a>
				
			</div>
			<!-- /.featured-image -->

			<?php get_template_part('loop'); ?>
		
		</article>
		<!-- /.the-post -->
		
	</li>
	<?php endif; ?>
	
<?php if($count == $opt['archive_number']) : ?>	
</ul>
<!-- /.small-block-grid-1 large-block-grid-2 -->
<?php endif; ?>

<?php if( $count > $opt['archive_number']) : ?>

	<?php if($count == ($opt['archive_number'] + 1) ) : ?>
	<h3 class="page-title"><?php _e('Earlier Posts','engine') ?></h3>
	<ul class="small-block-grid-1 large-block-grid-<?php echo $opt['archive_layout']; ?> grid-<?php echo $opt['archive_layout']; ?>">
	<?php endif; ?>
	
		<li <?php post_class(); ?>>
			
			<article class="the-post">
			
				<div class="featured-image">
					
					<a href="<?php the_permalink(); ?>"><?php engine_thumbnail('archive'); ?></a>
					
				</div>
				<!-- /.featured-image -->
					
				<?php get_template_part('loop'); ?>
			
			</article>
			<!-- /.the-post -->
			
		</li>
	
	<?php if( $count == $total ) : ?>
	</ul>
	<?php endif; //Endif $count == $total ?>
	
<?php endif; //Endif $total > 6 ?>

<?php endwhile; else: ?>
<span class="label"><?php _e('No posts found.','engine'); ?></span>
<?php endif; ?>