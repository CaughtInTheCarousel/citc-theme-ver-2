<?php

if ( post_password_required() )
	return;
?>

<?php if ('open' == $post->comment_status) : ?>

<div id="comments" class="comments comments-area">
	
	<?php if ( have_comments() ) : ?>
			
		<?php // You can start editing here -- including this comment! ?>

		<h2 class="headline widget-title"><?php comments_number(); ?></h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'style' => 'ol', 'avatar_size' => 80, 'callback' => 'engine_comments' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav class="comment-nav clearfix" role="navigation">
			<div class="next-prev right">
				
				<?php if( get_next_comments_link() ) : ?>
				<div class="next-post"><?php next_comments_link( '<i class="icon-chevron-right"></i>' ); ?></div>
				<?php endif; ?>
				
				<?php if( get_previous_comments_link() ) : ?>
				<div class="prev-post"><?php previous_comments_link( '<i class="icon-chevron-left"></i>' ); ?></div>
				<?php endif; ?>
				
				
			</div>
		</nav>
		<?php endif; // check for comment navigation ?>
	
	<?php endif; ?>

	
	<?php comment_form( array( 'label_submit' => __('Submit', 'engine') ) ); ?>


</div><!-- .comments-area -->

<?php endif; ?>