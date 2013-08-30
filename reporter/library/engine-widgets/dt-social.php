<?php
/*
Plugin Name: DT Social
Plugin URI: http://designerthemes.com/
Description: Easily share your social profiles on your website
Version: 1.2.1
Author: DT
Author URI: http://designerthemes.com/
*/

class DTSocial {

	var $settings;
	var $services;
	
    function __construct() 
    {	
    	$this->services = array(
    		'500px' => 'e.g. http://500px.com/username',
			'AddThis' => 'e.g. http://www.addthis.com',
			'Behance' => 'e.g. http://www.behance.net/username',
			'Blogger' => 'e.g. http://username.blogspot.com',
			'Mail' => 'e.g. mailto:user@name.com',
			'Delicious' => 'e.g. http://delicious.com/username',
			'DeviantART' => 'e.g. http://username.deviantart.com/',
			'Digg' => 'e.g. http://digg.com/username',
			'Dopplr' => 'e.g. http://www.dopplr.com/traveller/username',
			'Dribbble' => 'e.g. http://dribbble.com/username',
			'Evernote' => 'e.g. http://www.evernote.com',
			'Facebook' => 'e.g. http://www.facebook.com/username',
			'Flickr' => 'e.g. http://www.flickr.com/photos/username',
			'Forrst' => 'e.g. http://forrst.me/username',
			'GitHub' => 'e.g. https://github.com/username',
			'Google+' => 'e.g. http://plus.google.com/userID',
			'Grooveshark' => 'e.g. http://grooveshark.com/username',
			'Instagram' => 'e.g. http://instagr.am/p/picID',
			'Lastfm' => 'e.g. http://www.last.fm/user/username',
			'LinkedIn' => 'e.g. http://www.linkedin.com/in/username',
			'MySpace' => 'e.g. http://www.myspace.com/userID',
			'Path' => 'e.g. https://path.com/p/picID',
			'PayPal' => 'e.g. mailto:email@address',
			'Picasa' => 'e.g. https://picasaweb.google.com/userID',
			'Pinterest' => 'e.g. http://pinterest.com/username',
			'Posterous' => 'e.g. http://username.posterous.com',
			'Reddit' => 'e.g. http://www.reddit.com/user/username',
			'RSS' => 'e.g. http://example.com/feed',
			'ShareThis' => 'e.g. http://sharethis.com',
			'Skype' => 'e.g. skype:username',
			'Soundcloud' => 'e.g. http://soundcloud.com/username',
			'Spotify' => 'e.g. http://open.spotify.com/user/username',
			'StumbleUpon' => 'e.g. http://www.stumbleupon.com/stumbler/username',
			'Tumblr' => 'e.g. http://username.tumblr.com',
			'Twitter' => 'e.g. http://twitter.com/username',
			'Viddler' => 'e.g. http://www.viddler.com/explore/username',
			'Vimeo' => 'e.g. http://vimeo.com/username',
			'Virb' => 'e.g. http://username.virb.com',
			'Windows' => 'e.g. http://www.apple.com',
			'WordPress' => 'e.g. http://username.wordpress.com',
			'YouTube' => 'e.g. http://www.youtube.com/user/username',
			'Zerply' => 'e.g. http://zerply.com/username'
    	);
    	
    	add_action('admin_init', array(&$this, 'admin_init'));
        add_action('admin_menu', array(&$this, 'admin_menu'), 99);
        add_shortcode('dt_social', array(&$this, 'shortcode'));
        add_action('widgets_init', create_function('', 'register_widget("DTSocial_Widget");'));
	}
	
	function admin_init()
	{
		register_setting( 'dt-social', 'dt_social_settings', array(&$this, 'settings_validate') );
		add_settings_section( 'dt-social', '', array(&$this, 'section_intro'), 'dt-social' );
		$this->settings = get_option( 'dt_social_settings' );
		
		foreach($this->services as $service=>$help){
			$this->add_profile( $service, $service .' URL', $help );
		}
		
		add_settings_field( 'size', __( 'Icon Size', 'engine' ), array(&$this, 'setting_size'), 'dt-social', 'dt-social' );
		add_settings_field( 'links', __( 'Open Links', 'engine' ), array(&$this, 'setting_links'), 'dt-social', 'dt-social' );
		add_settings_field( 'preview', __( 'Preview', 'engine' ), array(&$this, 'setting_preview'), 'dt-social', 'dt-social' );
		add_settings_field( 'instructions', __( 'Shortcode and Template Tag', 'engine' ), array(&$this, 'setting_instructions'), 'dt-social', 'dt-social' );
	}
	
	function admin_menu() 
	{
		$page_hook = add_theme_page( __( 'DT Social Settings', 'engine' ), __( 'Social Settings', 'engine' ), 'update_core', 'dt-social', array(&$this, 'settings_page') );
	}
	
	function settings_page()
	{
		?>
		<div class="wrap">
			<div id="icon-themes" class="icon32"></div>
			<h2>DT Social Settings</h2>
			<p><?php _e('DT Social allows you to display snazzy social icons on your site. Customize the output of DT Social with this settings page. Select the services to be used and basic configuration settings.', 'engine'); ?></p>
			<?php if( isset($_GET['settings-updated']) && $_GET['settings-updated'] ){ ?>
			<div id="setting-error-settings_updated" class="updated settings-error"> 
				<p><strong><?php _e( 'Settings saved.', 'engine' ); ?></strong></p>
			</div>
			<?php } ?>
			<form action="options.php" method="post">
				<?php settings_fields( 'dt-social' ); ?>
				<?php do_settings_sections( 'dt-social' ); ?>
				<p class="submit"><input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'engine' ); ?>" /></p>
			</form>
		</div>
		<?php
	}
	
	function section_intro()
	{
		// Nothing...
	}
	
	function add_profile( $id, $title, $help = '' )
	{
		$args = array(
			'id' => $id,
			'help' => $help
		);
		
		add_settings_field( $id, $title, array(&$this, 'setting_profile'), 'dt-social', 'dt-social', $args );
	}
	
	function setting_profile( $args )
	{
		if( !isset($this->settings[$args['id']]) ) $this->settings[$args['id']] = '';
		
		echo '<input type="text" name="dt_social_settings['. $args['id'] .']" class="regular-text" value="'. $this->settings[$args['id']] .'" /> ';
		if($args['help']) echo '<span class="description">'. $args['help'] .'</span>';
	}
	
	function setting_size()
	{
		if( !isset($this->settings['size']) ) $this->settings['size'] = '16px';
		
		echo '<select name="dt_social_settings[size]">
		<option value="16px"'. (($this->settings['size'] == '16px') ? ' selected="selected"' : '') .'>16px</option>
		<option value="32px"'. (($this->settings['size'] == '32px') ? ' selected="selected"' : '') .'>32px</option>
		</select>';
	}

	function setting_links()
	{
		if( !isset($this->settings['links']) ) $this->settings['links'] = 'same_window';
		
		echo '<select name="dt_social_settings[links]">
		<option value="same_window"'. (($this->settings['links'] == 'same_window') ? ' selected="selected"' : '') .'>In same window</option>
		<option value="new_window"'. (($this->settings['links'] == 'new_window') ? ' selected="selected"' : '') .'>In new window</option>
		</select>';
	}
	
	function setting_preview()
	{
		if($this->settings) echo $this->do_social();
	}
	
	function setting_instructions()
	{
		echo '<p>To use DT Social in your posts and pages you can use the shortcode:</p>
		<p><code>[dt_social]</code></p>
		<p>To use DT Social manually in your theme template use the following PHP code:</p>
		<p><code>&lt;?php if( function_exists(\'dt_social\') ) dt_social(); ?&gt;</code></p>
		<p>You can optionally pass in a "size" and "services" parameter to both of the above to override the default values eg:</p>
		<p><code>[dt_social size="16px" services="Twitter,Facebook,Google+"]</code></p>
		<p><code>&lt;?php if( function_exists(\'dt_social\') ) dt_social( \'16px\', array(\'Twitter\',\'Facebook\',\'Google+\') ); ?&gt;</code></p>';
	}
	
	function settings_validate($input)
	{
		foreach($this->services as $service=>$help){
			$input[$service] = strip_tags($input[$service]);
			if($service != 'Skype') $input[$service] = esc_url_raw($input[$service]);
		}
		return $input;
	}
	
	function shortcode( $atts )
	{
		extract( shortcode_atts( array(
			'size' => '',
			'services' => ''
		), $atts ) );

		$services_wl = array();
		if($services) $services_wl = explode(',', str_replace(' ', '', esc_attr($services)));
		return $this->do_social(esc_attr($size), $services_wl);
	}
	
	function do_social( $size = '', $services_wl = array() )
	{
		$options = get_option( 'dt_social_settings' );
		if( !isset($options['size']) ) $options['size'] = '16px';
		if( $size == '16px' ) $options['size'] = '16px';
		if( $size == '32px' ) $options['size'] = '32px';
		if( !isset($options['links']) ) $options['links'] = 'same_window';
		
		$output = '<div class="dt-social size-'. $options['size'] .'">';
		
		if(empty($services_wl)){
			foreach($this->services as $service=>$help){
				if(isset($options[$service]) && $options[$service]){
					$output .= '<a href="'. $options[$service] .'" class="'. $service .'"'. (($options['links'] == 'new_window') ? ' target="_blank"' : '') .'><img src="'. get_template_directory_uri() . '/library/engine-widgets/images/'. $options['size'] .'/'. $service .'.png'.'" alt="'. $service .'" /></a> ';
				}
			}
		} else {
			foreach($services_wl as $service){
				if(isset($options[$service]) && $options[$service]){
					$output .= '<a href="'. $options[$service] .'" class="'. $service .'"'. (($options['links'] == 'new_window') ? ' target="_blank"' : '') .'><img src="'. get_template_directory_uri() . '/library/engine-widgets/images/' . $options['size'] .'/'. $service .'.png'.'" alt="'. $service .'" /></a> ';
				}
			}
		}
		
		$output .= '</div>';
		return $output;
	}
	
}
global $dt_social;
$dt_social = new DTSocial();

/**
 * Template Tag
 */
function dt_social( $size = '', $services_wl = array() ){
	global $dt_social;
	echo $dt_social->do_social($size, $services_wl);
}

/**
 * Widget
 */
class DTSocial_Widget extends WP_Widget {

	function __construct() {
		parent::WP_Widget( 'dt_social_widget', 'DT Social', array( 'description' => 'Displays your DT Social profiles' ) );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$desc = $instance['description'];
		$size = $instance['size'];
		
		echo $before_widget;
		if ( !empty( $title ) ) echo $before_title . $title . $after_title;
		
		if( $desc ) echo '<p>'. $desc .'</p>';
		
		global $dt_social;
		echo $dt_social->do_social($size);
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['description'] = strip_tags($new_instance['description'], '<a><b><strong><i><em>');
		$instance['size'] = strip_tags($new_instance['size']);
		return $instance;
	}

	function form( $instance ) {
		if ( $instance && isset($instance['title']) ) $title = esc_attr( $instance['title'] );
		else $title = '';
		if ( $instance && isset($instance['description']) ) $desc = esc_attr( $instance['description'] );
		else $desc = '';
		if ( $instance && isset($instance['size']) ) $size = esc_attr( $instance['size'] );
		else $size = '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'engine'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:', 'engine'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" type="text" value="<?php echo $desc; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Size:', 'engine'); ?></label> 
			<select id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>">
				<option value=""<?php if($size == '') echo ' selected="selected"'; ?>>Default</option>
				<option value="16px"<?php if($size == '16px') echo ' selected="selected"'; ?>>16px</option>
				<option value="32px"<?php if($size == '32px') echo ' selected="selected"'; ?>>32px</option>
			</select>
		</p>
		<?php 
	}

}

?>