jQuery(document).ready(function() {

	//Change "insert into post" to "Use this Button"

	tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
	
	tbframe_interval;
	
	jQuery('.mt_upload_button').each(function() {
	
		jQuery(this).click(function() {
		
			mt_input = jQuery(this).prev().attr('id');
				
			window.send_to_editor = function(html) 
			
			{
				imgurl = jQuery('img',html).attr('src');
				jQuery('#' + mt_input).val(imgurl);
				tb_remove();
			}
		
			var post_ID = jQuery('#post_ID').val();
		
			tb_show('', 'media-upload.php?post_id='+ post_ID +'&amp;type=image&amp;TB_iframe=true');
			return false;
		
		});
	
	});

});
