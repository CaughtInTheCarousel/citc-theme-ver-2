<?php
/** "Clear" block 
 * 
 * Clear the floats vertically
 * Optional to use horizontal lines/images
**/
class AQ_Clear_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Clear',
			'size' => 'span12 no-margin',
		);
		
		//create the block
		parent::__construct('aq_clear_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'horizontal_line' => 'none',
			'line_color' => '#353535',
			'pattern' => '1',
			'height' => ''
		);
		
		$line_options = array(
			'none' => 'None',
			'single' => 'Single',
			'double' => 'Double',
			'image' => 'Use Image',
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		$line_color = isset($line_color) ? $line_color : '#353535';
		
		?>
		<p class="description note">
			<?php _e('Use this block to clear the floats between two or more separate blocks vertically.', 'framework') ?>
		</p>
		<?php
		
	}
	
	function block($instance) {
		extract($instance);
		
		switch($horizontal_line) {
			case 'none':
				break;
			case 'single':
				echo '<hr class="engine-block-clear engine-block-hr-single" style="background:'.$line_color.';"/>';
				break;
			case 'double':
				echo '<hr class="engine-block-clear engine-block-hr-double" style="background:'.$line_color.';"/>';
				echo '<hr class="engine-block-clear engine-block-hr-single" style="background:'.$line_color.';"/>';
				break;
			case 'image':
				echo '<hr class="engine-block-clear engine-block-hr-image cf"/>';
				break;
		}
		
		if($height) {
			echo '<div class="cf" style="height:'.$height.'px"></div>';
		}
		
	}
	
}