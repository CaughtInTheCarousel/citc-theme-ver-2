<?php get_header(); wp_reset_query(); ?>

	<div class="row">
				
		<div class="content small-12 column <?php echo engine_content_position(); ?>">		
		
			<div <?php post_class(); ?>>
				
				<div class="entry-content">
					<h1 class="page-title"><?php the_title(); ?></h1>
					<?php the_content(); ?>
					<?php engine_link_pages('before=<div class="page-links pagination">&after=</div>'); ?>
				</div>
					
			</div>
			<!-- /.post -->
			
			<?php get_template_part('parts/related'); ?>
			
			<?php // comments_template('', true); ?>
			
		</div>
		<!-- /.content small-12 large-9 column -->
		
		<?php if( engine_content_position() ) : ?>
		
		<div class="sidebar small-12 large-3 column" id="sidebar">
			<?php get_sidebar(); ?>
		</div>
		<!-- /#sidebar.sidebar small-12 large-3 column -->
		
		<?php endif; ?>
		
	</div>
	<!-- /.row -->

<?php get_footer(); ?>