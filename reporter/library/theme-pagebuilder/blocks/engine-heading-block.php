<?php

class Engine_Heading_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => __('Heading','engine'),
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('engine_heading_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'align' => 'left',
			'link_title' => '',
			'link_url' => ''
		);
				
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		
		$align_options = array(
			'left' => __('Left','engine'),
			'center' => __('Center','engine'),
		);
		
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				<?php _e('Title','engine'); ?>
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('align') ?>">
				<?php _e('Text Align','engine'); ?>
				<?php echo aq_field_select('align', $block_id, $align_options, $align); ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('link_url') ?>">
				<?php _e('Link URL','engine'); ?>
				<?php echo aq_field_input('link_url', $block_id, $link_url, $size = 'full') ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('link_title') ?>">
				<?php _e('Link Text','engine'); ?>
				<?php echo aq_field_input('link_title', $block_id, $link_title, $size = 'full') ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
		
		extract($instance);
		
		if(!isset($align)) $align = 'left';
		if(!isset($link_url)) $link_url = '';
		if(!isset($link_title)) $link_title = '';

		echo do_shortcode('[engine_heading title="'.$title.'" align="'.$align.'" link_title="'.$link_title.'" link_url="'.$link_url.'"]');
	}
	
}