<?php

// font stack
function engine_font_stack($id, $cssdata){

	$font = $cssdata[$id]['face'];
	$stack = '';

	switch ( $font ) {

		case 'arial':
			$stack = 'Arial, sans-serif';
		break;
		case 'verdana':
			$stack = 'Verdana, "Verdana Ref", sans-serif';
		break;
		case 'trebuchet':
			$stack = '"Trebuchet MS", Verdana, "Verdana Ref", sans-serif';
		break;
		case 'georgia':
			$stack = 'Georgia, serif';
		break;
		case 'times':
			$stack = 'Times, "Times New Roman", serif';
		break;
		case 'tahoma':
			$stack = 'Tahoma,Geneva,Verdana,sans-serif';
		break;
		case 'palatino':
			$stack = '"Palatino Linotype", Palatino, Palladio, "URW Palladio L", "Book Antiqua", Baskerville, "Bookman Old Style", "Bitstream Charter", "Nimbus Roman No9 L", Garamond, "Apple Garamond", "ITC Garamond Narrow", "New Century Schoolbook", "Century Schoolbook", "Century Schoolbook L", Georgia, serif';
		break;
		case 'helvetica':
			$stack = '"Helvetica Neue", Helvetica, Arial, sans-serif';
		break;
        case 'gfonts':
        	$gfont = $cssdata[$id]['gfont'];
        	$gfont = preg_replace('/\:.*/', '', preg_replace('/\&.*/', '', $gfont) );
        	$stack = '"'. $gfont .'", "Helvetica Neue", Helvetica, Arial, sans-serif';
        break;
        	
	}
	return $stack;
}

function emCalc($pxWidth) {
	return $pxWidth / 12 * 1;
}

$body_font = 'body_font';
$heading_face = 'heading_styles';

$body_bg = $cssdata['body_bg'];
$body_color = $cssdata['background_color'];

if( !$body_color ) $body_color = '#e6e6e6';

if( $cssdata['body_bg_custom'] ) $body_bg = $cssdata['body_bg_custom'];

?>

/*---------------------------*/
/*		   general
/*---------------------------*/

body,
.posts .title-meta .entry-meta { font-family: <?php echo engine_font_stack('body_font', $cssdata); ?>; }

body {
	background: <?php echo $body_color; ?> <?php if($cssdata['background_image']) : ?>url(<?php echo $body_bg; ?>) <?php echo $cssdata['body_bg_properties']; ?><?php endif; ?>; 
}

h1,h2,h3,h4,h5,h6,
.entry-time,
.header-main-menu .trigger,
.header-search input,
.entry-meta,
blockquote,
.the-author,
.comment-meta,
label { font-family: <?php echo engine_font_stack('header_font', $cssdata); ?>; }

.logo .logo-text,
.footer-widgets,
.page-numbers li span,
.next-prev a:hover,
.page-links .current,
.content input[type="submit"]:hover,
.slider .entry-header,
.slider .entry-content,
.flex-direction-nav .flex-prev,
.flex-direction-nav .flex-next,
.widget_tag_cloud a:hover { 
	background-color: <?php echo $cssdata['primary_color']; ?>;  
}

.top-bar-section ul li > a:hover,
.top-bar-section ul li.active > a,
.heading,
a,
a:hover,
.page-title,
.the-author a,
.entry-content .widget-title,
.featured-image:hover a:after { color: <?php echo $cssdata['primary_color'] ?>; }

@media (min-width: 768px) {
	logo { width: <?php echo $cssdata['logo_width']; - 35; ?>px; }
	.logo img,
	.logo-text {
		width: <?php echo $cssdata['logo_width']; - 35; ?>px;
		height: <?php echo $cssdata['logo_height']; ?>px;
	}
	.header-main-row { padding-left: <?php echo $cssdata['logo_width'] - 50; ?>px; }
	.header-main-menu .trigger { 
		height: <?php echo $cssdata['logo_height']; ?>px; 
		line-height: <?php echo $cssdata['logo_height']; ?>px; 
	}
	.header-search { height: <?php echo $cssdata['logo_height']; ?>px; }
	.header-search form { 
		<?php echo $cssdata['logo_height']; ?>px; 
		width: 100%;
		display: table;
		height: 100%;
	}
	.header-search form > .row {
		display: table-cell;
		text-align: center;
		vertical-align: middle;
	}
}

/*---------------------------*/
/*		  custom css
/*---------------------------*/	
 
<?php print($cssdata['custom_css']) ?>