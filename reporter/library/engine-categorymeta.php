<?php 

/*
 *
 * Extra category fields
 *
 */
 
if (!function_exists('engine_extra_category_fields')) 
{

	//add extra fields to category edit form callback function
	function engine_extra_category_fields( $tag ) { 
	
	    $t_id = $tag->term_id;
	    $cat_meta = get_option( "category_$t_id");
	    
	    $current = FALSE;
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="sidebar-pos"><?php _e('Sidebar Position','engine'); ?></label></th>
		<td>
			<select name="Cat_meta[sidebar-pos]" id="sidebar-pos" class="postform">
				
				<?php if( array_key_exists('sidebar-pos', $cat_meta) ) $current = $cat_meta['sidebar-pos']; ?>
				
				<option value="right" <?php if( $current == 'right' ) : ?>selected="selected"<?php endif; ?>>
					<?php _e('Right','engine'); ?>
				</option>
				
				<option value="left" <?php if( $current == 'left' ) : ?>selected="selected"<?php endif; ?>>
					<?php _e('Left','engine'); ?>
				</option>
				
				<option value="none" <?php if( $current == 'none' ) : ?>selected="selected"<?php endif; ?>>
					<?php _e('None','engine'); ?>
				</option>
				
				<?php $current = FALSE; ?>
								
			</select>
			<p class="description"><?php _e('Select a position for the sidebar or simply remove it.','engine'); ?></p>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="firstpage-layout"><?php _e('First Few Posts Layout','engine'); ?></label></th>
		<td>
			<select name="Cat_meta[firstpage-layout]" id="firstpage-layout" class="postform">
				
				<?php if( array_key_exists('firstpage-layout', $cat_meta) ) $current = $cat_meta['firstpage-layout']; ?>
				
				<option <?php if( $current == '' ) : ?>selected="selected"<?php endif; ?> value="">
					<?php _e('Use default','engine') ?>
				</option>
				<option <?php if( $current == '1' ) : ?>selected="selected"<?php endif; ?> value="1">
					<?php _e('1 Column','engine') ?>
				</option>
				<option <?php if( $current == '2' ) : ?>selected="selected"<?php endif; ?> value="2">
					<?php _e('2 Column','engine') ?>
				</option>
				<option <?php if( $current == '3' ) : ?>selected="selected"<?php endif; ?> value="3">
					<?php _e('3 Column','engine') ?>
				</option>
				<option <?php if( $current == '4' ) : ?>selected="selected"<?php endif; ?> value="4">
					<?php _e('4 Column','engine') ?>
				</option>
				
				<?php $current = FALSE; ?>
				
			</select>
			<p class="description"><?php _e('Select which layout you want to use for the first few posts. This layout will show on the first page of results.','engine'); ?></p>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="firstpage-number"><?php _e('First Few Posts Number','engine'); ?></label></th>
		<td>
			<?php if( array_key_exists('firstpage-number', $cat_meta) ) $current = $cat_meta['firstpage-number']; ?>
			<input type="text" name="Cat_meta[firstpage-number]" class="postform" value="<?php echo $current ?>" />
			<p class="description"><?php _e('Enter how many posts you want to show using the first few posts layout.','engine'); ?></p>
			<?php $current = FALSE; ?>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="layout"><?php _e('Layout','engine'); ?></label></th>
		<td>
			<select name="Cat_meta[layout]" id="layout" class="postform">
				
				<?php if( array_key_exists('layout', $cat_meta) ) $current = $cat_meta['layout']; ?>
				
				<option <?php if( $current == '' ) : ?>selected="selected"<?php endif; ?> value="">
					<?php _e('Use default','engine') ?>
				</option>
				<option <?php if( $current == '1' ) : ?>selected="selected"<?php endif; ?> value="1">
					<?php _e('1 Column','engine') ?>
				</option>
				<option <?php if( $current == '2' ) : ?>selected="selected"<?php endif; ?> value="2">
					<?php _e('2 Column','engine') ?>
				</option>
				<option <?php if( $current == '3' ) : ?>selected="selected"<?php endif; ?> value="3">
					<?php _e('3 Column','engine') ?>
				</option>
				<option <?php if( $current == '4' ) : ?>selected="selected"<?php endif; ?> value="4">
					<?php _e('4 Column','engine') ?>
				</option>
				
				<?php $current = FALSE; ?>
				
			</select>
			<p class="description"><?php _e('Change the default layout.','engine'); ?></p>
		</td>
	</tr>
	<?php
	
	}
	
	//add extra fields to category edit form hook
	add_action ( 'edit_category_form_fields', 'engine_extra_category_fields');
}


/*
 *
 * Save category fields
 *
 */

if (!function_exists('engine_save_extra_category_fields')) 
{

	// save extra category extra fields callback function
	function engine_save_extra_category_fields( $term_id ) {
	    if ( isset( $_POST['Cat_meta'] ) ) {
	        $t_id = $term_id;
	        $cat_meta = get_option( "category_$t_id");
	        $cat_keys = array_keys($_POST['Cat_meta']);
	            foreach ($cat_keys as $key){
	            if (isset($_POST['Cat_meta'][$key])){
	                $cat_meta[$key] = $_POST['Cat_meta'][$key];
	            }
	        }
	        //save the option array
	        update_option( "category_$t_id", $cat_meta );
	    }
	}
	
	// save extra category extra fields hook
	add_action ( 'edited_category', 'engine_save_extra_category_fields');

}