<?php get_header(); ?>

	<div class="row">
				
		<div id="content" class="content small-12 column <?php echo engine_content_position(); ?>">		
			
			<?php 
			
			$opt = engine_layout_options();
			
			if( !is_paged() && $opt['archive_first'] != $opt['archive_layout']) {
				get_template_part('parts/archive-first-page');
			} else {
				get_template_part('parts/archive-list');
			} 
			?>
			
			<?php get_template_part('parts/pagination'); ?>
			
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