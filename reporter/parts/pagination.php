<?php if( get_previous_posts_link() || get_next_posts_link() ) : ?>
				
<ul class="small-block-grid-2">
	
	<li>
		<?php 
		engine_pagination(array(
			'prev_next' => false,
			'before' => '', // Begin loop_pagination() arguments.
			'after' => '',
			)
		);
		?>
	</li>

	<li class="right next-prev">
		
		<?php if( get_next_posts_link() ) : ?>
		<!-- .prev-post -->
		<div class="prev-post">
			<?php next_posts_link( '<i class="icon-chevron-right"></i>' ); ?>
		</div>
		<!-- /.prev-post -->
		<?php endif; ?>
		
		<?php if( get_previous_posts_link() ) : ?>
		<!-- .next-post -->
		<div class="next-post">
		 	<?php previous_posts_link( '<i class="icon-chevron-left"></i>' ); ?>
		</div>
		<!-- /.next-post -->
		<?php endif; ?>
		
	</li>

</ul>

<?php endif; ?>