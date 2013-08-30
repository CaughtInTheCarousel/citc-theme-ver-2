<?php

class Engine_Posts_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => __('Posts','engine'),
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('engine_posts_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'qty' => '',
			'category' => array(),
			'autoplay' => '5000',
			'orderby' => 'date',
			'asc' => 'DESC',
			'style' => 'title',
			'excerpt_length' => '17',
		);
				
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		$terms = get_terms('category');
		
		$all_terms = array();
		
		foreach( $terms as $term ) {
			$all_terms[ $term->term_id] = $term->name;
		}
		
		$orderby_options = array(
			'date' => __('Date','engine'),
			'title' => __('Title','engine'),
			'rand' => __('Random','engine'),
			'comment_count' => __('Comments','engine'),
		);
		
		$order_options = array(
			'DESC' => 'DESC',
			'ASC' => 'ASC',
		);
		
		$style_options = array(
			'title' => __('Title Only','engine'),
			'title_meta' => __('Title & Meta','engine'),
			'title_meta_thumb_side' => __('Title, Meta & Thumb (thumb on side)','engine'),
			'title_meta_thumb_1' => __('Title, Meta & Thumb (1 column)','engine'),
			'title_meta_thumb_2' => __('Title, Meta & Thumb (2 columns)','engine'),
			'title_meta_thumb_3' => __('Title, Meta & Thumb (3 columns)','engine'),
			'title_meta_thumb_4' => __('Title, Meta & Thumb (4 columns)','engine'),
		);
		
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				<?php _e('Title (optional)','engine'); ?>
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('style') ?>">
				<?php _e('Style','engine'); ?>
				<?php echo aq_field_select('style', $block_id, $style_options, $style) ?>
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
			<label for="<?php echo $this->get_field_id('orderby') ?>">
				<?php _e('Order By','engine'); ?>
				<?php echo aq_field_select('orderby', $block_id, $orderby_options, $orderby) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('asc') ?>">
				<?php _e('Order','engine'); ?>
				<?php echo aq_field_select('asc', $block_id, $order_options, $asc); ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('excerpt_length') ?>">
				<?php _e('Excerpt Length (optional)','engine'); ?>
				<?php echo aq_field_input('excerpt_length', $block_id, $excerpt_length, $size = 'full') ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
	
	
		extract($instance);
		
		$size = filter_var($size, FILTER_SANITIZE_NUMBER_INT);
		
		if(!isset($category)) $category = array();
		if(!isset($random)) { $random = '0'; }
		if(!isset($orderby)) $orderby = 'date';
		if(!isset($asc)) $asc = 'DESC';
		if(!isset($style)) $style = 'title';
		if(!isset($excerpt_length)) $excerpt_length = '17';
		
		$category = implode(', ', $category);
		
		echo do_shortcode('[engine_posts title="'.$title.'" style="'.$style.'" category="'.$category.'" qty="'.$qty.'" orderby="'.$orderby.'" order="'.$asc.'" excerpt_length="'.$excerpt_length.'"]');
	}
	
}