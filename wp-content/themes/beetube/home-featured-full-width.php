<?php
/**
 * The template for displaying featured posts on home page
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.1
 */
?>

<?php
	$args = (array)get_option('dp_home_featured');
	$args = jtheme_parse_query_args($args);
	$first_post_media = !empty($args['first_post_media']) ? $args['first_post_media'] : 'video';
	$ajaxload = !empty($args['ajaxload']) ? true : false;
	$autoplay = !empty($args['autoplay']) ? true : false;
	$autoscroll = !empty($args['autoscroll']) ? $args['autoscroll'] : false;
	if(!empty($args['autoscroll'])) {
		$autoplay = false;
		$ajaxload = false;
	}

	$query = new WP_Query($args);
?>
	
<?php if($query->have_posts()): ?>
	<?php
		/* Load scripts only when needed */
		wp_enqueue_script('jquery-carousel');
	?>
		
<div class="home-featured-full wall">
	
	
	
	<div class="stage wrap cf" data-ajaxload="<?php echo (string)$ajaxload; ?>">
	
	
	
		<div class="carousel" data-autoscroll-interval="<?php echo $autoscroll; ?>">
		<div class="carousel-list">
	<?php
		$items = ''; $i = 0;
		while ($query->have_posts()) : $query->the_post(); global $post; $i++; ?>
		<div class="item <?php echo is_video() ? 'item-video' : 'item-post'; ?>" data-id="<?php the_ID(); ?>" id="item-<?php the_ID(); ?>">	
				
			<div class="screen">
				<?php
					if($i == 1 && !$autoscroll && is_video($post->ID) && $first_post_media == 'video') {
						echo '<div class="video fluid-width-video-wrapper" data-ratio="16:9">';
							jtheme_video($post->ID, $autoplay);
						echo '</div>';
					} 
				?>
				
				<?php jtheme_thumb_html('custom-full'); ?>
			</div>
			<div class="data-feature data-single-full">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permalink to %s', 'jtheme'), get_the_title()); ?>"><?php the_title(); ?></a></h2>
			
			<p class="entry-meta">
				<span class="author vcard">
				<?php printf( '<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( __( 'View all posts by %s', 'jtheme' ), get_the_author() ) ),
					get_the_author());
				?>
				</span>
				
				<time class="entry-date" datetime="<?php echo the_time('jS M, Y'); ?>"><?php the_time('jS M, Y'); ?></time></a>
                <span class="stats"><?php echo jtheme_get_post_stats_new(); ?><?php echo jtheme_get_post_stats(); ?></span>
			</p>
					
			

			<p class="entry-summary"><?php jtheme_excerpt(); ?></p>
		</div>
			
		</div><!-- end .item -->
		<?php endwhile; ?>
		</div><!-- end .carousel-list -->
		</div><!-- end .carousel -->
	</div><!-- end .stage -->
	
	

</div><!-- end #wall -->
<?php endif; wp_reset_query(); ?>