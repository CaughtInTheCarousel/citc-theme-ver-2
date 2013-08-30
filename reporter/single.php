<?php get_header();  wp_reset_query(); ?>

	<div class="row">
				
		<div class="content small-12 column <?php echo engine_content_position(); ?>">		
		
			<article <?php post_class(); ?>>
			
				<div class="featured-image">
					
					<?php engine_thumbnail(); ?>
					
				</div>
				<!-- /.featured-image -->
						
				<!-- .entry-header -->
				<header class="entry-header main-header">
					
					<div class="entry-meta">
						<span class="entry-comments"><a href="<?php comments_link(); ?>"><i class="icon-comments"></i><?php comments_number(0, 1, '%'); ?></a></span>
						<span class="entry-date"><i class="icon-calendar"></i><?php the_time( get_option('date_format') ); ?></span>
						
						<span class="entry-tags hide"><?php the_tags(); ?></span>				
					</div>
			
					<h2 class="entry-title"><?php the_title(); ?></h2>
					
				</header>
				<!-- /.entry-header -->
				
				<div class="entry-content">
					<?php the_content(); ?>
					<?php engine_link_pages('before=<div class="page-links pagination">&after=</div>'); ?>
				</div>
					
			</article>
			<!-- /.post -->
			
			<?php get_template_part('parts/related'); ?>
			
			<?php comments_template('', true); ?>
			
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