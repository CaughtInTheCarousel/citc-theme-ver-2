			
<!-- .entry-header -->
<header class="entry-header">
	
	<div class="entry-meta">
		<span class="entry-comments"><a href="<?php comments_link(); ?>"><i class="icon-comments"></i><?php comments_number(0, 1, '%'); ?></a></span>
		<span class="entry-date"><i class="icon-calendar"></i><?php the_time( get_option('date_format') ); ?></span>				
	</div>

	<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	
</header>
<!-- /.entry-header -->

<div class="entry-content">
	<?php echo engine_excerpt(17); ?>
</div>
