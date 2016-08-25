<?php
/**
 * jtheme Related Posts Widget
 *
 * Display related posts on single post pages.
 * 
 * @package BeeeTube
 * @subpackage Widgets
 *  1.2.5
 */

class jtheme_Widget_Related_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget-posts widget-related-posts', 'description' => __( "Display related posts on single post pages.", 'jtheme') );
		parent::__construct('jtheme-widget-related-posts', __('JTHEME-Related-Posts', 'jtheme'), $widget_ops);
		$this->alt_option_name = 'alt_jtheme_widget_related_posts';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		if(!is_singular())
			return;
			
		$cache = wp_cache_get('jtheme_widget_related_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}
		
		$style = isset($instance['style']) ? $instance['style'] : 'list';
		
		extract($args);
		ob_start();

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'jtheme') : $instance['title'], $instance, $this->id_base);
		
		?>
		
		<?php echo $before_widget; ?>
		
		<?php $r = jtheme_related_posts(array('number'=>$instance['posts_per_page'], 'fields'=>'object')); 
		if(!$r || !is_object($r) || !$r->have_posts())
			return;
		?>
		
		<?php 
		if ( $title ) echo $before_title . $title . $after_title; 
		if( get_option('jtheme_video_or_thumb') == 'video' ){
			$vidthumb_opt = 1;
		}
		?>
		
		<ul class="<?php echo 'post-'.$style; ?>">
			<?php 
			while ($r->have_posts()) : $r->the_post(); $item_format = is_video() ? 'video' : 'post'; 
			$sidebar_vidthumb_class = '';
			if( $vidthumb_opt && is_video() ){
				$sidebar_vidthumb_class = ' sidebar-vidthumb';
			}
			?>
			<li class="item cf <?php echo 'item-'.$item_format . $sidebar_vidthumb_class; ?>">
				<?php 
					if( $vidthumb_opt && is_video() ){
						jtheme_video(get_the_ID(), false);
					}
					else{
						$image_size = ($style == 'list-full') ? 'custom-medium' : 'custom-small';
						jtheme_thumb_html($image_size);
					}
				?>
				
				<div class="data">
					<h4 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h4>
				
					<p class="meta">
						<span class="author"><?php _e('Added by', 'jtheme'); ?> <?php the_author_posts_link(); ?></span>
						<span class="time"><?php printf(__('%s ago', 'jtheme'), relative_time(get_post_time('U', true))); ?></span>
					</p>
					
					<p class="stats"><?php echo jtheme_get_post_stats(); ?></p>
				</div>
			</li>
			<?php endwhile; wp_reset_query(); ?>
		</ul>
		
		<?php echo $after_widget; ?>
		
		<?php

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('jtheme_widget_related_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$new_instance['title'] = strip_tags($new_instance['title']);
		$new_instance['posts_per_page'] = (int) $new_instance['posts_per_page'];
		
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['alt_jtheme_widget_related_posts']) )
			delete_option('alt_jtheme_widget_related_posts');

		return $new_instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('jtheme_widget_related_posts', 'widget');
	}

	function form( $instance ) {
		$defaults = array(
			'title' => __('Related Posts', 'jtheme'),
			'posts_per_page' => 6,
			'orderby' => 'date',
			'order' => 'desc',
			'style' => 'list',
			'cat' => '',
			'current_cat' => true,
			'current_author' => true,
			'post__in' => '',
			'style' => 'list', // list, list-full, grid-2 or grid-3
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 

		// Styles
		$styles = array( 
			'list' => __( 'List with Thumbnail', 'jtheme' ),
			'list-full' => __( 'List with Full Width Thumbnail', 'jtheme' ),
			'grid-2' => __( '2 Columns Grid', 'jtheme' ), 
			'grid-3' => __( '3 Columns Grid', 'jtheme' )
		);
		
		$dropdown_categories = wp_dropdown_categories(array(
			'echo' => 0, 
			'name' => $this->get_field_name( 'cat' ),
			'selected' => $instance['cat'],
			'show_option_all' => __('All', 'jtheme'),
			'class' => 'widefat'
		));
		
		$dropdown_sort_types = jtheme_dropdown_sort_types(array(
			'echo' => 0, 
			'name' => $this->get_field_name( 'orderby' ),
			'selected' => $instance['orderby'],
			'class' => 'widefat'
		));
	
		$dropdown_order_types = jtheme_dropdown_order_types(array(
			'echo' => 0, 
			'name' => $this->get_field_name( 'order' ),
			'selected' => $instance['order'],
			'class' => 'widefat'
		)); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'jtheme') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>"><?php _e('Number:', 'jtheme') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" value="<?php echo $instance['posts_per_page']; ?>" />
		</p>
		
		
		
	<?php }
}

// Register Widget
add_action('widgets_init', 'register_jtheme_widget_related_posts');
function register_jtheme_widget_related_posts() {
	register_widget('jtheme_Widget_Related_Posts');
}