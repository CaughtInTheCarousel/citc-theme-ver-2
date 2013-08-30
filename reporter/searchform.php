<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<div class="row collapse">
		<div class="small-8 columns">
			<input type="text" name="s" placeholder="<?php _e('Enter a keyword...','engine'); ?>">
		</div>
		<div class="small-4 columns">
			<input type="submit" class="button postfix radius" id="searchsubmit" value="<?php _e('Search','engine'); ?>" />
		</div>
	</div>
</form>