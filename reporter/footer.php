	</div>
	<!-- /.main.row -->
	
	<?php if( is_active_sidebar('footer_top') ) : ?>
	<div class="footer-fullwidth-widgets container">
		
		<ul class="small-block-grid-1 large-block-grid-4">
			<?php dynamic_sidebar('footer_top'); ?>
		</ul>
		
	</div>
	<!-- /.footer-fullwidth-widgets container -->
	<?php endif; ?>
	
	<?php if( is_active_sidebar('footer_bottom') ) : ?>
	<div class="footer-widgets container">
		
		<ul class="small-block-grid-1 large-block-grid-4">
			<?php dynamic_sidebar('footer_bottom'); ?>
		</ul>	
		
		<p class="footer-info"><?php bloginfo('name'); ?> &copy; <?php echo date('Y'); ?> | Hand Crafted by <a href="http://www.designerthemes.com/" target="_parent">DesignerThemes.com</a></p>	
		
	</div>
	<!-- /.footer-widgets container -->
	<?php endif; ?>
	
<?php wp_footer(); ?>
</body>
</html>