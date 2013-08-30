<?php $opt = engine_layout_options(); ?>

<?php if( is_home() ): ?>
<h1 class="page-title"><?php _e('Latest Posts','engine'); ?> 
	<?php if( is_paged() ) : ?><span class="radius secondary label"><?php _e('Page','engine'); ?> <?php echo $paged; ?></span><?php endif; ?>
</h1>
<?php elseif( is_category() ): ?>
<h1 class="page-title">
	<?php _e('Latest from','engine'); ?> <?php wp_title(); ?> 
	<?php if( is_paged() ) : ?><span class="radius secondary label"><?php _e('Page','engine'); ?> <?php echo $paged; ?></span><?php endif; ?>
</h1>
<?php endif; ?>	

<?php if(have_posts()) : ?>

<ul class="small-block-grid-1 large-block-grid-<?php echo $opt['archive_layout']; ?> grid-<?php echo $opt['archive_layout']; ?>">
	
	<?php while (have_posts()) : the_post(); ?>
	
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

<?php endwhile; ?> 
</ul>
<?php else: ?>
<span class="label"><?php _e('No posts found.','engine'); ?></span>
<?php endif; ?>