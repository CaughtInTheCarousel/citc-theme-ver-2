<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}    
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 				=> "placebo", //REQUIRED!		
			), 
			"enabled" => array (
				"placebo" 				=> "placebo", //REQUIRED!
			),
		);

		// Font Settings
		$of_font_body_size = array("10px","11px","12px","13px","14px","15px","16px","17px","18px","19px","20px","21px","22px"); 
		$of_font_header_size = array("12px","13px","14px","15px","16px","17px","18px","19px","20px","21px","22px","23px","24px","25px","26px","27px","28px","29px","30px","31px","32px","33px","34px","35px","36px","37px","38px","39px","40px"); 
		$of_font_line_height = array("1.2em","1.3em","1.4em","1.5em","1.6em","1.7em","1.8em");
		$of_font_weight = array("100","200","300","400","500","600","700","800","900");

		// Number of posts in hlp and hlb sections
		$of_lp_number_select = array("-1","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"); 

		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}

		// Images URL
		$url =  ADMIN_DIR . 'assets/images/';
		$scheme_url =  ADMIN_DIR . 'assets/images/schemes/';
		$slider_img_url =  ADMIN_DIR . 'assets/images/slider/';

		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/assets/img/backgrounds/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/assets/img/backgrounds/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();


$of_options[] = array( "name" => __('General Settings', 'engine'),
					"type" => "heading");

$of_options[] = array( "name" => "",
					"std" => __("Logo Settings",'engine'),
					"type" => "groupheader");

$of_options[] = array( "name" => __("Custom Logo",'engine'),
					"desc" => __("Upload a custom logo for your site, or specify the image address of your online logo. (e.g. http://yoursite.com/logo.png)",'engine'),
					"id" => "logo",
					"std" => '',
					"type" => "media");
					
$of_options[] = array( "name" => __('Logo Width', 'engine'),
                    "desc" => __('Enter the width of your logo.', 'engine'),
                    "id" => "logo_width",
                    "std" => "280",
                    "type" => "text");
                    
$of_options[] = array( "name" => __('Logo Height', 'engine'),
                    "desc" => __('Enter the height of your logo. This also determines the height of the main header area.', 'engine'),
                    "id" => "logo_height",
                    "std" => "69",
                    "type" => "text");


$of_options[] = array( "name" => "",
					"std" => __("Featured Image Settings",'engine'),
					"type" => "groupheader");
					
$of_options[] = array( "name" => __("Default Featured Image",'engine'),
					"desc" => __("Upload an optional image to use as a default featured image for posts without one set.",'engine'),
					"id" => "placeholder_image",
					"std" => '',
					"type" => "media");


// Header Options
$of_options[] = array( "name" => __('Header Settings', 'engine'),
					"type" => "heading");


$of_options[] = array( "name" => "",
					"std" => __("Layout Settings",'engine'),
					"type" => "groupheader");
					

$of_options[] = array( "name" => "",
					"desc" => __("Headings Layout",'engine'),
					"id" => "header_layout",
					"std" => "default",
					"type" => "select",
					"options" => array(
						'header_default',
						'header_style_2',
						'header_style_3',
					));

$of_options[] = array( "name" => "",
					"std" => __("Widget Drop down Settings",'engine'),
					"type" => "groupheader");
					

$of_options[] = array( "name" => __("Header Left Drop down Title",'engine'),
					"desc" => __("Enter a title for the left drop down that appears in the header.",'engine'),
					"id" => "header_menu_left_title",
					"std" => 'Left Title',
					"type" => "text");	
					
$of_options[] = array( "name" => __("Header Right Drop down Title",'engine'),
					"desc" => __("Enter a title for the left drop down that appears in the header.",'engine'),
					"id" => "header_menu_right_title",
					"std" => 'Right Title',
					"type" => "text");	
						
					
$of_options[] = array( "name" => "",
					"std" => __("Flash News Settings",'engine'),
					"type" => "groupheader");
					
$of_options[] = array( "name" => __("Show Flash News",'engine'),
					"desc" => __("Check this to display the flash news, this appears within the top bar.",'engine'),
					"id" => "flash_news",
					"std" => 1,
					"type" => "checkbox");
					
$of_options[] = array( "name" => __("Header",'engine'),
					"desc" => __("Enter a header.",'engine'),
					"id" => "flash_news_header",
					"std" => __('Flash News','engine'),
					"type" => "text");
					
$of_options[] = array( "name" => __("Speed",'engine'),
					"desc" => __("Enter how many milliseconds each slide should appear for.",'engine'),
					"id" => "flash_news_timer_speed",
					"std" => 5000,
					"type" => "text");
					
$of_options[] = array( "name" => __("Animation Speed",'engine'),
					"desc" => __("Enter how long the animation speed should last.",'engine'),
					"id" => "flash_news_anim_speed",
					"std" => 1000,
					"type" => "text");
					
$of_options[] = array( "name" => __("Amount",'engine'),
					"desc" => __("Enter how many posts you want to show.",'engine'),
					"id" => "flash_news_num",
					"std" => 5,
					"type" => "text");
					
$of_options[] = array( "name" => __("Category",'engine'),
					"desc" => __("Select which categories to pull from.",'engine'),
					"id" => "flash_news_cat",
					"std" => '',
					"type" => "multicheck",
					"options" => $of_categories);
					
// Layout Options
$of_options[] = array( "name" => __('Layout Settings', 'engine'),
					"type" => "heading");
					
// Archive Options
$of_options[] = array( "name" => "",
					"std" => __("Archive Settings",'engine'),
					"type" => "groupheader");


$of_options[] = array( "name" => __('First Few Posts Layout', 'engine'),
					"desc" => __('Select which layout you want to use for the first few posts. This layout will show on the first page of results.', 'engine'),
					"id" => "archive_first_layout",
					"std" => "2",
					"type" => "images",
					"options" => array(
						'1' => $url . '1-col-portfolio.png',
						'2' => $url . '2-col-portfolio.png',
						'3' => $url . '3-col-portfolio.png',
						'4' => $url . '4-col-portfolio.png')
					);			
					
$of_options[] = array( "name" => __("First Few Posts Number",'engine'),
					"desc" => __("Enter how many posts you want to show using the first few posts layout.",'engine'),
					"id" => "archive_first_layout_number",
					"std" => 6,
					"type" => "text");
					
					
$of_options[] = array( "name" => __('Archive Layout', 'engine'),
					"desc" => __('This is the default layout for archives, categories, tags etc...', 'engine'),
					"id" => "archive_layout",
					"std" => "2",
					"type" => "images",
					"options" => array(
						'1' => $url . '1-col-portfolio.png',
						'2' => $url . '2-col-portfolio.png',
						'3' => $url . '3-col-portfolio.png',
						'4' => $url . '4-col-portfolio.png')
					);	
					
// Sidebar Options
$of_options[] = array( "name" => "",
					"std" => __("Sidebar Position",'engine'),
					"type" => "groupheader");
					
$of_options[] = array( "name" => __('Archives', 'engine'),
					"desc" => __('This is the default sidebar position for archives. You can also override this setting when editing a specific category.', 'engine'),
					"id" => "archive_sidebar_pos",
					"std" => "right",
					"type" => "images",
					"options" => array(
						'right' => $url . '2cr.png',
						'left' => $url . '2cl.png',
						'none' => $url . '1col.png')
					);
					
$of_options[] = array( "name" => __('Posts', 'engine'),
					"desc" => __('This is the default sidebar position for posts. You can also override this setting when editing a specific post.', 'engine'),
					"id" => "post_sidebar_pos",
					"std" => "right",
					"type" => "images",
					"options" => array(
						'right' => $url . '2cr.png',
						'left' => $url . '2cl.png',
						'none' => $url . '1col.png')
					);
					
$of_options[] = array( "name" => __('Pages', 'engine'),
					"desc" => __('This is the default sidebar position for pages. You can also override this setting when editing a specific page.', 'engine'),
					"id" => "page_sidebar_pos",
					"std" => "right",
					"type" => "images",
					"options" => array(
						'right' => $url . '2cr.png',
						'left' => $url . '2cl.png',
						'none' => $url . '1col.png')
					);
					


// Typography Options
$of_options[] = array( "name" => __('Font Settings', 'engine'),
					"type" => "heading");

$of_options[] = array( "name" => "",
					"std" => __("Font Family Settings",'engine'),
					"type" => "groupheader");

$of_options[] = array( "name" => __("Body font family",'engine'),
					"desc" => "",
					"id" => "body_font",
					"std" => array('face' => 'helvetica',),
					"type" => "typography");

$of_options[] = array( "name" => __("Headings font family",'engine'),
					"desc" => "",
					"id" => "header_font",
					"std" => array('face' => 'helvetica'),
					"type" => "typography");
					




// Design Settings
$of_options[] = array( "name" => __("Design Settings",'engine'),
					"type" => "heading");
					
// Main color
$of_options[] = array( "name" => "",
					"std" => __("Colors Settings",'engine'),
					"type" => "groupheader");

$of_options[] = array( "name" => __("Highlight color",'engine'),
					"desc" => __("Choose your highlight color, used a lot in the elements, gradients, links etc",'engine'),
					"id" => "primary_color",
					"std" => "#d12f2f",
					"type" => "color");


// Background
$of_options[] = array( "name" => "",
					"std" => __("Background Settings",'engine'),
					"type" => "groupheader");
					
$of_options[] = array( "name" => __("Background Color",'engine'),
					"desc" => __("Choose your background color.",'engine'),
					"id" => "background_color",
					"std" => "",
					"type" => "color");
					
$of_options[] = array( "name" => __("Enable Background Image",'engine'),
					"desc" => __("Check this to use a background image for the theme, otherwise only the solid color you chose above will be displayed.",'engine'),
					"id" => "background_image",
					"std" => 0,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Background Image",'engine'),
					"desc" => __("Select a background image",'engine'),
					"id" => "body_bg",
					"std" => $bg_images_url."bg01.png",
					"type" => "tiles",
					"options" => $bg_images);
					
$of_options[] = array( "name" => __("Custom Background",'engine'),
					"desc" => __("Upload a custom background for your theme. This will override the option above.",'engine'),
					"id" => "body_bg_custom",
					"std" => "",
					"mod" => "min",
					"type" => "media");				

$of_options[] = array( "name" => __("Background Image Properties",'engine'),
					"desc" => __("You can define additional shorthand properties for the background such as no-repeat here. This is for advanced CSS users only.",'engine'),
					"id" => "body_bg_properties",
					"std" => "repeat center top",
					"type" => "text");

// Page Title Options
$of_options[] = array( "name" => __("Page Title Options",'engine'),
					"type" => "heading");

$of_options[] = array( "name" => __("Additional Padding",'engine'),
					"desc" => __("Add here additional padding if you want to have higher page title area (in pixels). It will add that amount of padding to the top and bottom of page title",'engine'),
					"id" => "pagetitle_add_padding",
					"std" => "0",
					"type" => "text");

$of_options[] = array( "name" => __("Page Title Font Color",'engine'),
					"desc" => __("Choose font color for page title. Can be overwrited on the page settings - #555555 for light style, #ffffff for dark style",'engine'),
					"id" => "pagetitle_font_color",
					"std" => "",
					"type" => "color");

$of_options[] = array( "name" => __("Show Page Title Shadow",'engine'),
					"desc" => __("Check this to show shadow in the page title.",'engine'),
					"id" => "show_pagetitle_shadow",
					"std" => 0,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Page Title Background Color",'engine'),
					"desc" => __("Choose your background color for page title.",'engine'),
					"id" => "pt_background_color",
					"std" => "",
					"type" => "color");
					
$of_options[] = array( "name" => __("Enable Page Title Background Image",'engine'),
					"desc" => __("Check this to use a background image for page title, otherwise only the solid color you chose above will be displayed.",'engine'),
					"id" => "pt_background_image",
					"std" => 0,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Page Title Background Image",'engine'),
					"desc" => __("Select a background image for page title",'engine'),
					"id" => "pt_body_bg",
					"std" => $bg_images_url."bg01.png",
					"type" => "tiles",
					"options" => $bg_images);
					
$of_options[] = array( "name" => __("Page Title Custom Background",'engine'),
					"desc" => __("Upload a custom background for page title. This will override the option above.",'engine'),
					"id" => "pt_body_bg_custom",
					"std" => "",
					"mod" => "min",
					"type" => "media");				

$of_options[] = array( "name" => __("Page Title Background Image Properties",'engine'),
					"desc" => __("You can define additional shorthand properties for the background such as no-repeat here. This is for advanced CSS users only.",'engine'),
					"id" => "pt_body_bg_properties",
					"std" => "repeat center top",
					"type" => "text");

// Custom CSS
$of_options[] = array( "name" => __("Custom CSS",'engine'),
					"type" => "heading");

$of_options[] = array( "name" => "",
					"std" => __("If you want to add some custom css to the theme this is the right place to do this. CSS from this field will overwrite other css properties.",'engine'),
					"type" => "info");

$of_options[] = array( "name" => __("Custom CSS",'engine'),
                    "desc" => "",
                    "id" => "custom_css",
                    "std" => "",
                    "type" => "textarea");

				
// Backup Options
$of_options[] = array( "name" => __("Backup Settings",'engine'),
					"type" => "heading");
					
$of_options[] = array( "name" => __("Backup and Restore Settings",'engine'),
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => __("You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.",'engine'),
					);
					
$of_options[] = array( "name" => __("Transfer Theme Options Data",'engine'),
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => __("You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click 'Import Options'",'engine'),
					);
					
	}
}
?>
