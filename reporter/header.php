<?php

/**
 * Header
 *
 * Displays the header
 *
 * @package WordPress
 * @subpackage reporter
 * @since reporter 1.0
 */

?>

<?php global $reporter_data; ?>

<?php get_template_part('parts/head'); ?>

<body <?php body_class(); ?>>
	
	<div class="header">
		
		<div class="citc-logo">
			<a href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" /></a>
		</div>
		
		<div class="header-top container">
			
			<div class="row">
				
				<div class="large-9 small-12 column flash-news-wrap">
					<?php get_template_part('parts/flash-news'); ?>
				</div>
				
				<div class="large-3 small-12 column header-social-wrap">
					<?php dt_social(); ?>
				</div>
				
			</div>
			<!-- /.row  -->
			
		</div>
		<!-- /.header-top -->
		
		<div class="primary-menu container">
						
			<div class="top-bar-container">
				<nav class="top-bar">
					<ul class="title-area">
						<li class="name">
							<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
						</li>          
						<li class="toggle-topbar menu-icon"><a href="#"><span><?php _e('Menu','engine'); ?></span></a></li>
					</ul>
					<section class="top-bar-section">
					<?php 
						wp_nav_menu(array( 
					        'container' => false,                           // remove nav container
					        'container_class' => '',           				// class of container
					        'menu' => '',                      	        	// menu name
					        'menu_class' => 'left',         				// adding custom nav class
					        'theme_location' => 'primary-menu',             // where it's located in the theme
					        'before' => '',                                 // before each link <a> 
					        'after' => '',                                  // after each link </a>
					        'link_before' => '',                            // before each link text
					        'link_after' => '',                             // after each link text
					        'depth' => 5,                                   // limit the depth of the nav
					    	'fallback_cb' => false,    						// this uses the below function to list pages as a menu
					    	'walker' => new engine_menu_walker( array(
				                'in_top_bar' => true,
				                'item_type' => 'li'
				            ) ), 
						));
					?>
					</section>
				</nav>
			</div>
			
		</div>
		<!-- /.primary-menu container -->
		
	</div>
	<!-- /.header -->
	
	<div class="main container">