<?php

class Engine_Slider_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => __('Slider','engine'),
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('engine_slider_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'qty' => '',
			'category' => array(),
			'autoplay' => '5000',
			'excerpt_length' => '30',
			'random' => false
		);
				
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		$terms = get_terms('category');
		
		$all_terms = array();
		
		foreach( $terms as $term ) {
			$all_terms[ $term->term_id] = $term->name;
		}
		
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				<?php _e('Title (optional)','engine'); ?>
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('qty') ?>">
				<?php _e('Number of Posts','engine'); ?>
				<?php echo aq_field_input('qty', $block_id, $qty, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('category') ?>">
				<?php _e('Categories','engine'); ?>
				<?php echo aq_field_multiselect('category', $block_id, $all_terms, $category); ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('excerpt_length') ?>">
				<?php _e('Excerpt Length','engine'); ?>
				<?php echo aq_field_input('excerpt_length', $block_id, $excerpt_length, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('autoplay') ?>">
				<?php _e('Autoplay','engine'); ?>
				<?php echo aq_field_input('autoplay', $block_id, $autoplay, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('random') ?>">
				<?php _e('Randomize?','engine'); ?>
				<?php echo aq_field_checkbox('random', $block_id, $random); ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
	
	
		extract($instance);
		
		$size = filter_var($size, FILTER_SANITIZE_NUMBER_INT);
		
		if( $size > 6 ) $th_size = 'large';
		if( $size <= 6 ) $th_size = 'medium';
		if( $size < 4 ) $th_size = 'small';
		
		if(!isset($category)) $category = '';
		if(!isset($random)) $random = '0'; 
		if(!isset($autoplay)) $autoplay = '0';
		if(!isset($excerpt_length)) $excerpt_length = '30';
		
		if(!empty($category)) $category = implode(', ', $category);
		
		echo do_shortcode('[engine_slider title="'.$title.'" category="'.$category.'" qty="'.$qty.'" autoplay="'.$autoplay.'" random="'.$random.'" thumb_size="'.$th_size.'" excerpt_length="'.$excerpt_length.'"]');
	}
	
}