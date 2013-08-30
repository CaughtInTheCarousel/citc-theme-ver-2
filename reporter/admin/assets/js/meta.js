jQuery(document).ready(function($){

	//global post id
	var post_ID = $('#post_ID').val();

	//Masked Inputs (images as radio buttons)
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();

	//toggle open/close testimonial
	$(".mt-ms-toggle").live( 'click', function(){
	
		var msbody = $(this).parent();
		msbody.toggleClass("active").next().slideToggle("fast");
		return false; //Prevent the browser jump to the link anchor
		
	});	
	
	//upload image
	jQuery('.ms-upload-button').live( 'click', function(){
		
		var inputID = $(this).prev().attr('id');
			
		window.send_to_editor = function(html) 
		
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#' + inputID).val(imgurl);
			tb_remove();
		}
		
		tb_show('', 'media-upload.php?post_id='+ post_ID +'&amp;TB_iframe=true');
		return false;
	
	});
	
	//add new testimonial
	$(".mt-ms-add-new").live('click', function(){
	
		var mscontainer = $(this).prev();
		var mscontainerID = mscontainer.attr('id');
		var mssecurity = mscontainer.find('input.ms_nonce').attr('id');
		
		var numArr = $('#'+mscontainerID  +' li').map(function() { 
			var str = this.id;
			str = str.substring(str.length - 2, str.length);
			str = parseFloat(str);
			return str;			
		}).get();
		
		var maxNum = Math.max.apply(Math, numArr);
		if (maxNum < 1 ) { maxNum = 0};
		var newNum = maxNum + 1;
		
		var data = {
			action: 'add_new_meta_slide',
			id: mscontainerID,
			num: newNum,
			security: mssecurity
		};
	
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$.post(ajaxurl, data, function(response) {
		
			mscontainer.append(response);
			
		});
		
		return false;
	
	});
	
	
	//delete testimonial
	$(".mt-ms-delete").live('click', function(){
		
		var $trash = $(this).parent().parent();
		$trash.fadeOut(500,function(){ $(this).remove(); });
		return false;
	
	});

	/*	Slider crop check
	=========================*/
	
	jQuery('#mt_slider_crop_crop').each(function() {
		
		if($(this).is(':checked')) {
			$(this).siblings('input:text, span').show();
		}
		
		$(this).click(function() {
			if($(this).is(':checked')) {
				$(this).siblings('input:text, span').fadeIn();
			} else {
				$(this).siblings('input:text, span').fadeOut();
			}
		});
	
	});
	
	function sortms() {	
		jQuery('.meta-slides').each( function() {
			var id = jQuery(this).attr('id');
			$('#'+ id).sortable({
				placeholder: "placeholder",
				opacity: 0.6
			});
		});	
	}
	
	/*	Page select
	=========================*/
	function changeTemplate(template) {
		if(template == 'template-portfolio-filter.php') {
			jQuery('#mt-meta-box-portfolio-categories').show();
		} else {
			jQuery('#mt-meta-box-portfolio-categories').hide();
		}

		if(template == 'template-portfolio-paginated.php') {
			jQuery('#mt-meta-box-portfolio-pagi').show();
		} else {
			jQuery('#mt-meta-box-portfolio-pagi').hide();
		}

		if(template == 'template-page-with-slider.php') {
			jQuery('#mt-meta-box-slider').show();
		} else {
			jQuery('#mt-meta-box-slider').hide();
		}

		if(template == 'template-homepage.php') {
			jQuery('#mt-meta-box-homepage').show();
		} else {
			jQuery('#mt-meta-box-homepage').hide();
		}

		if(template == 'template-sidebar.php') {
			jQuery('#mt-meta-box-sidebar').show();
		} else {
			jQuery('#mt-meta-box-sidebar').hide();
		}

		if(template == 'template-sidenav.php') {
			jQuery('#mt-meta-box-sidebar-nav').show();
		} else {
			jQuery('#mt-meta-box-sidebar-nav').hide();
		}

		if(template == 'template-contact.php') {
			jQuery('#mt-meta-box-contact').show();
		} else {
			jQuery('#mt-meta-box-contact').hide();
		}

	}
	
	var currTemplate = jQuery('#page_template').val();
	changeTemplate(currTemplate);
	
	jQuery('#page_template').change(function() {
		var template = jQuery(this).find('option:selected').val();
		changeTemplate(template);
	});
	
});