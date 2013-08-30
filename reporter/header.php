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
		
		<div class="header-main">
			
			<div class="container">
					
				<!-- .logo -->
				<div class="logo">
					
					<?php $logo = $reporter_data['logo']  ?>
					
					<?php if($logo != '') : ?>
					
						<h1 class="logo-image"><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>" /></a></h1>
						
					<?php else: ?>
						
						<h1 class="logo-text"><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
					
					<?php endif; ?>
					
					</div>
				<!-- /.logo -->
	
				<div class="row header-main-row">
				
					<?php if( is_active_sidebar('header_main_l') ) : ?>
					<div class="large-4 small-6 column header-main-menu">
						
						<?php if( !isset($reporter_data['header_menu_left_title']) ) $reporter_data['header_menu_left_title'] = 'Left Title';  ?>
						<a href="#" data-dropdown="drop1" class="trigger"><?php echo $reporter_data['header_menu_left_title']; ?> <i class="icon-chevron-down"></i></a>
						<div id="drop1" class="f-dropdown content" data-dropdown-content>
							
							<ul class="large-block-grid-2 small-block-grid-1">
								<?php dynamic_sidebar('header_main_l'); ?>
							</ul>
							<!-- /.small-block-grid-1 large-block-grid-2 -->					
			
						</div>
						
					</div>
					<!-- /.large-6 column -->
					<?php endif; ?>
					
					<?php if( is_active_sidebar('header_main_r') ) : ?>
					<div class="large-4 small-6 column header-main-menu">
						
						<?php if( !isset($reporter_data['header_menu_right_title']) ) $reporter_data['header_menu_right_title'] = 'Right Title';  ?>
						<a href="#" data-dropdown="drop2" class="trigger"><?php echo $reporter_data['header_menu_right_title']; ?> <i class="icon-chevron-down"></i></a>
						
						<div id="drop2" class="f-dropdown content" data-dropdown-content>
							
							<ul class="large-block-grid-2 small-block-grid-1">
								<?php dynamic_sidebar('header_main_r'); ?>
							</ul>
							<!-- /.small-block-grid-1 large-block-grid-2 -->	
						
						</div>
					
					</div>
					<!-- /.large-6 column -->
					<?php endif; ?>
					
					<div class="header-search large-4 column right">
						<?php get_search_form(); ?>
					</div>
					<!-- /.header-search -->
					
				</div>
				<!-- /.row -->
				
			</div>
			<!-- /.container -->

		</div>
		<!-- /.header-main -->
		
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