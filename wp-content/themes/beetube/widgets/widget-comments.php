<?php
/**
 * jtheme Recent Comments Widget
 *
 * Display the most recent comments.
 * 
 * @package BeeeTube
 * @subpackage Widgets
 *  1.0
 */
 
class jtheme_Widget_Comments extends WP_Widget {
	
	function jtheme_Widget_Comments() {
	
		$widget_ops = array( 'classname' => 'widget-comments', 'description' => __('Display the most recent comments.', 'jtheme') );
		$control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => "jtheme-comments" );
		$this->WP_Widget( "jtheme-comments", __('JTHEME-Recent-Comments', 'jtheme'), $widget_ops, $control_ops );
		$this->alt_option_name = "jtheme_widget_comments";

		add_action( 'comment_post', array(&$this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache') );
	}

	function flush_widget_cache() {
		wp_cache_delete("jtheme_widget_comments", 'widget');
	}
	
	function widget( $args, $instance ) {
		
		global $comments, $comment;

		$cache = wp_cache_get("jtheme_widget_comments", 'widget');

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

 		extract($args, EXTR_SKIP);
 		$output = '';
		$title = apply_filters('widget_title', $instance['title']);
		
		
 		$output .= $before_widget;
		if ( $title ) {
			$output .= $before_title . $title . $after_title;
		}
		$output .= jtheme_list_comments_widget($instance,false);
		$output .= $after_widget;

		echo $output;
		
		$cache[$args['widget_id']] = $output;
		wp_cache_set("jtheme_widget_comments", $cache, 'widget');
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance = $new_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset($new_instance['show_date']) ? 1 : 0;
		$instance['show_avatar'] = isset($new_instance['show_avatar']) ? 1 : 0;
		
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions["jtheme_widget_comments"]) )
			delete_option("jtheme_widget_comments");

		return $instance;
	}
	
	function form( $instance ) {
		$defaults = array( 
			'title' => __('Recent Comments', 'jtheme'), 
			'number' => 5,
			'show_avatar' => true,
			'show_date' => true,
			'comment_length' => 80
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		$comment_type = array( '' => __( 'All', 'jtheme' ), 'comment' => __( 'Comment', 'jtheme' ) , 'trackback' => __( 'Trackback', 'jtheme' ));
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'jtheme'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Comment Number:', 'jtheme'); ?></label>
			<input class="small-text" type="text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show_avatar' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_avatar'], true ); ?> id="<?php echo $this->get_field_id( 'show_avatar' ); ?>" name="<?php echo $this->get_field_name( 'show_avatar' ); ?>" /> <?php _e( 'Show Avatar?', 'jtheme' ); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_date'], true ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" /> <?php _e( 'Show Comment Date?', 'jtheme' ); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'comment_length' ); ?>"><?php _e('Comment Excerpt Length:', 'jtheme'); ?></label>
			<input size="4" type="text" id="<?php echo $this->get_field_id( 'comment_length' ); ?>" name="<?php echo $this->get_field_name( 'comment_length' ); ?>" value="<?php echo $instance['comment_length']; ?>" />
		</p>
		<?php
	}
}

/** 
 * Function to return the most recent comments
 *
 * @uses get_comments() return array List of comments
 */
function jtheme_list_comments_widget($args = '',$echo = false) {
	global $comments, $comment;
	
	$defaults = array( 
		'title' => __('Recent Comments', 'jtheme'), 
		'number' => 5,
		'show_date' => true ,
		'show_avatar' => true,
		'avatar_size' => 48,
		'comment_length' => 80
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );

	$comments =  get_comments(array(
		'number' => $number,
		'status' => 'approve',
		'type' => 'comment'
	));
		
	$output = '<ul'.($show_avatar ? ' class="has-avatar"' : '').'>';
	
	if($comments) {
		foreach ($comments as $comment) {
			$output .=  '<li>';
				
			if($show_avatar)
				$output .=  get_avatar($comment->comment_author_email, $avatar_size);
				
			$output .= '<div class="data">';	
			$output .= '<span class="author"><a href="'.get_comment_link().'">'.get_comment_author().'</a></span> ';
					
			if($show_date)
				$output .= '<span class="date">'.sprintf(__('%s ago', 'jtheme'), relative_time(get_comment_time('U', true))).'</span> ';
			
			$output .= ' <p class="excerpt">'.mb_strimwidth(strip_tags(apply_filters('comment_content', $comment->comment_content)), 0, $comment_length, "...").'</p>';
				
			$output .= '</div></li>';
		}
	}
	
	$output .= '</ul>';
	
	if($echo)
		echo $output;
	else
		return $output;
}

register_widget('jtheme_Widget_Comments');
?>