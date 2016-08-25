<?php
/**
 * The template for displaying featured posts on category pages
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.0
 */
?>

<?php
	$args = (array)get_option('jtheme_cat_featured');
	// If user set 'Post Number' to 0 or leave it empty in theme options, return.
	
	if(empty($args['posts_per_page']))
		return;
	$args['current_cat'] = false;
	$args = jtheme_parse_query_args($args);
	$query = new WP_Query($args); 
	
	if($query->have_posts()):

		// Load scripts only when needed
		//wp_enqueue_script('jquery-carousel');
		
		// Get items
		$items = '';
		$show_vidoes = $i = 0;
		if( get_option('jtheme_video_or_thumb') == 'video' ){
			$show_vidoes = 1;
		}
		while ($query->have_posts()) : $query->the_post(); 			
			$thumb_html = jtheme_thumb_html('custom-large', '', '', false);
			
			// Build classname
			$classes = array();
			if( $show_vidoes ){	$classes[] = 'item-video';	}
			else{	$classes[] = 'item-post';	}
			
			$class = implode(' ', $classes);
			$post_title = get_the_title($post->ID);
			$post_title = snippet_text($post_title, 25);
			if( $show_vidoes ){
				$items .= '<li class="'.$class.' reel-video">'.get_jtheme_video($post->ID, false).' <div class="hori-title"><a href="'.get_permalink($post->ID).'">'.$post_title.'</a></div></li>';
			}
			else{
				$items .= '<li class="'.$class.'">'.$thumb_html.' <div class="hori-title"><a href="'.get_permalink($post->ID).'">'.$post_title.'</a></div></li>';
			}
		endwhile; ?>
	<!--
	<div class="cat-featured wall">
		<div class="carousel fcarousel fcarousel-5 wrap cf">
		<div class="carousel-container">
			<div class="carousel-clip">
				<ul class="carousel-list"><?php //echo $items; ?></ul>
			</div><!-- end .carousel-clip -->
			<!--
			<div class="carousel-prev"></div>
			<div class="carousel-next"></div>
		</div><!-- end .carousel-container -->
        
		<!--</div> end .carousel
	</div>  end .cat-featured -->
    <div class="cat-featured wall <?php echo (get_option('jtheme-featured-responsive')==1)?'':'disable-responsive'?>">
    <div class="hori-wrap">
			
			<!--

			<div class="scrollbar">
				<div style="transform: translateZ(0px) translateX(0px); width: 71px;" class="handle">
					<div class="mousearea"></div>
				</div>
			</div>-->

			<div class="frame cycleitems fcarousel" id="cycleitems">
				<ul class="clearfix carousel-list">
					<?php echo $items; ?>
				</ul>
			</div>
<!--
			<div class="controls center">
				<button disabled="disabled" class="btn prev disabled"><i class="icon-chevron-left"></i> prev</button>
				<button class="btn next">next <i class="icon-chevron-right"></i></button>
			</div>
            -->
		</div>
        </div>

	<?php endif; wp_reset_query(); ?>