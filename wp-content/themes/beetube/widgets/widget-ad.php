<?php
/**
 * jtheme Ad Widget
 *
 * Displays the advertising, supported Plain Text, HTML, PHP or Shortcode.
 * 
 * @package BeeeTube
 * @subpackage Widgets
 *  1.0
 */
 
class jtheme_Widget_Ad extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'widget-ad', 'description' => __('Displays the advertising.', 'jtheme') );
		$control_ops = array('width' => 400, 'height' => 350);
		
		parent::__construct("jtheme-ad", __('JTHEME-Advertising', 'jtheme'), $widget_ops, $control_ops );      
	}

	function widget($args, $instance) {  
		extract($args);
		
		$image = $instance['image'];
		$url = $instance['url'];
		$alt = $instance['alt'];
		$code = $instance['code'];
		$target = !empty($instance['target']) ? ' target="_blank"' : '';
		$nofollow = !empty($instance['nofollow']) ? ' rel="nofollow"' : '';
		
        echo $before_widget;

		if ( $instance['title'] )
			echo $before_title . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $after_title;
			
		echo '<div class="ad-widget">';
		if(!empty($code))
			echo wp_kses_stripslashes($code);
		else
			echo '<a'.$target.$nofollow.' href="'.$url.'"><img src="'.$image.'" alt="'.$alt.'" /></a>';
		echo '</div>';
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {      
		$instance = $old_instance;
		
		$instance = $new_instance;
		$instance['target'] = isset($new_instance['target']) ? 1 : 0;
		$instance['nofollow'] = isset($new_instance['nofollow']) ? 1 : 0;
		
		return $instance;
	}

	function form($instance) {  
		// Defaults
		$defaults = array(
			'title' => '',
			'image' => '',
			'url' => '',
			'text' => '',
			'alt' => '',
			'target' => true,
			'nofollow' => true,
			'code' => ''
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults);
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','jtheme'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
		<h4><?php _e('Image Ad','jtheme'); ?></h4>
		<p>
            <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Link URL:','jtheme'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('url'); ?>" value="<?php echo $instance['url']; ?>" class="widefat" id="<?php echo $this->get_field_id('url'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image URL:','jtheme'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $instance['image']; ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('alt'); ?>"><?php _e('Alternate Text:','jtheme'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo $instance['alt']; ?>" class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" />
        </p>
			<p>
			<input type="checkbox" value="1" name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>" <?php checked($instance['target'], true); ?> />
			<label for="<?php echo $this->get_field_id('target'); ?>"><?php _e('Open link in new window or tab?', 'jtheme'); ?></label>
		</p>
		<p>
			<input type="checkbox" value="1" name="<?php echo $this->get_field_name('nofollow'); ?>" id="<?php echo $this->get_field_id('nofollow'); ?>" <?php checked($instance['nofollow'], true); ?> />
			<label for="<?php echo $this->get_field_id('nofollow'); ?>"><?php _e('Add nofollow attribute to the link?', 'jtheme'); ?></label>
		</p>
		
		<h4><?php _e('or Ad Code','jtheme'); ?></h4>
		 <p>
            <label for="<?php echo $this->get_field_id('code'); ?>"><?php _e('Ad code:','jtheme'); ?></label>
            <textarea name="<?php echo $this->get_field_name('code'); ?>" rows="10" class="widefat" id="<?php echo $this->get_field_id('code'); ?>"><?php echo $instance['code']; ?></textarea>
        </p>
        <?php
	}
}

// Register Widget
add_action('widgets_init', 'register_jtheme_widget_ad');
function register_jtheme_widget_ad() {
	register_widget('jtheme_Widget_Ad');
}
?>