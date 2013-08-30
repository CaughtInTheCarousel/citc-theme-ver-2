jQuery(document).ready(function($) {
	
	var url = mtvars.templateurl + 'admin/front-end/webfonts.php';
	
	function gfonts_preview(id) {
	
		var face = $(id).find('.of-typography-face').val(),
			font_family = $(id).find('.gfont-input input').val(),
			font_size = $(id).find('.of-typography-size').val(),
			font_height = $(id).find('.of-typography-height').val(),
			font_weight = $(id).find('.of-typography-style').val(),
			font_color = $(id).find('.of-typography-color').val();
		
		var query = [];
		
		query.push(url);
		
		if(font_family) {
			query.push('?font_family=' + font_family);
		} else {
			return false;
		}
		
		if(font_height) {
			query.push('&font_height=' + font_height);
		}
		
		if(font_size) {
			query.push('&font_size=' + font_size);
		}
		
		if(font_weight) {
			query.push('&font_weight=' + font_weight);
		}
		
		if(font_color) {
			query.push('&font_color=' + font_color);
		}
		
		query = query.join('');
		
		//find the iframe
		$(id).find('iframe').attr('src', query);
	}
	
	$('.section-typography').each(function() {
		var id = $(this);
		
		$(id).find('.of-typography-face').change(function() {
			var face = $(id).find('.of-typography-face').val();
			if(face == 'gfonts') {
				$(id).find('.typography-preview').slideDown();
			} else {
				$(id).find('.typography-preview').slideUp();
			}
		});
		
		$(id).find('.gfont-input input').bind('input keyup', function() {
			var $this = $(id);
			clearTimeout($this.data('timer'));
			$this.data('timer', setTimeout(function(){
			    $this.removeData('timer');
				
				gfonts_preview(id);
				
			}, 2000));
		});
		
		$(id).find('.of-typography-size').change(function() {
			var $this = $(id);
			clearTimeout($this.data('timer'));
			$this.data('timer', setTimeout(function(){
			    $this.removeData('timer');
				
				gfonts_preview(id);
				
			}, 2000));
		});
		
		$(id).find('.of-typography-height').change(function() {
			var $this = $(id);
			clearTimeout($this.data('timer'));
			$this.data('timer', setTimeout(function(){
			    $this.removeData('timer');
				
				gfonts_preview(id);
				
			}, 2000));
		});
		
		$(id).find('.of-typography-color').change(function() {
			var $this = $(id);
			clearTimeout($this.data('timer'));
			$this.data('timer', setTimeout(function(){
			    $this.removeData('timer');
				
				gfonts_preview(id);
				
			}, 2000));
		});
		
	});
	
});