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

			

					<h2 class="entry-title"><?php the_title(); ?></h2>

					

					<!-- TODO: Only display on 'Reviews' category -->

					

					<?php 

						if ( in_category( 'Reviews' )) {

							echo ("<p class=\"album-name\">");

              						the_field('artist_name'); echo("<br />");

              						the_field('album_name'); echo("<br />");

              						the_field('record_label');

							echo("</p>");

						}
						
					?>

				</header>

				<!-- /.entry-header -->

				

				<div class="entry-content">

					<p>Written by: 
						<?php 
							if ( function_exists( 'coauthors_posts_links' ) ) {
   							 	coauthors_posts_links();
							} else {
    								the_author_posts_link();
							}
						?>
					</p>

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