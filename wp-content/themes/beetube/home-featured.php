<?php
/**
 * The template for displaying featured posts on home page
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.0
 */
?>

<?php
	$args = (array)get_option('jtheme_home_featured');
	$args = jtheme_parse_query_args($args);
	$first_post_media = !empty($args['first_post_media']) ? $args['first_post_media'] : 'video';
	$ajaxload = !empty($args['ajaxload']) ? true : false;
	$autoplay = !empty($args['autoplay']) ? true : false;
	$autoscroll = !empty($args['autoscroll']) ? $args['autoscroll'] : false;
	$carHeight = $args['posts_per_page'] * 300;
	$query = new WP_Query($args);
?>

<div class="home-featured wall <?php echo (get_option('jtheme-bslider-responsive')==1)?'':'disable-bslider'?>">
<div class="wrap cf ">

<?php if($query->have_posts()): ?>
	<style>
		
		
		.content_1,.content_2,.content_3{float:left;}
		
		.content_2{height:600px;}
		
	</style>
	<link href="<?php echo get_template_directory_uri(); ?>/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
	<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.jcarousel.js?ver=0.3.0'></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="js/minified/jquery-1.9.1.min.js"%3E%3C/script%3E'))</script>
	<!-- custom scrollbars plugin -->
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script>
		(function($){
			$(window).load(function(){
			
				$(".content_2").mCustomScrollbar({
					scrollInertia:150,

				});
				
			});
		})(jQuery);
	</script>
	<div class="stage" data-ajaxload="<?php echo (string)$ajaxload; ?>">
		<div class="carousel" data-autoscroll-interval="<?php echo $autoscroll; ?>">
		<div class="carousel-list">
			<?php $items = ''; $i = 0; while ($query->have_posts()) : $query->the_post(); global $post; $i++; ?>
			<div class="item <?php echo is_video() ? 'item-video' : 'item-post'; ?>" data-id="<?php the_ID(); ?>">
				<?php
					if($i == 1 && !$autoscroll && is_video($post->ID) && $first_post_media == 'video') {
						echo '<div class="video fluid-width-video-wrapper">';
							jtheme_video($post->ID, $autoplay);
						echo '</div>';					
						
					} 
					
				?>
				
				<?php	
					jtheme_thumb_html('custom-full');
				?>
			
				
				<div class="data-feature clearfix">
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
		
	<div class="nav content_2">
	<div class="carousel">
		
		<div class="carousel-clip" style="height:<?php echo $carHeight; ?>px">
			<?php
			$carousel_thumbvid_class = '';
            if( get_option('jtheme_video_or_thumb') == 'video' ){
				$carousel_thumbvid_class = 'carousel-vid';	
			}
			?>
			<ul class="carousel-list ">
				<?php $items = ''; $i = 0; while ($query->have_posts()) : $query->the_post(); global $post; ?>
				<li data-id="<?php the_ID(); ?>" class="<?php echo is_video() ? 'item-video' : 'item-post'; ?>">
				<div class="inner <?php echo $carousel_thumbvid_class; ?>">
					<?php
					if( get_option('jtheme_video_or_thumb') == 'video' && is_video() ){
						jtheme_video($post->ID, false);	
					}
					else{
						$thumb_size = 'custom-full';
						jtheme_thumb_html($thumb_size);
					}
					?>
			
					<div class="data nav-data">
						
			
						<p class="meta">
							
							<span class="stats"><?php echo jtheme_get_post_stats(); ?></span>
                            <br />
                            <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url'); ?>/images/link-white.png" alt="<?php _e('Read more', 'jtheme') ?>" /></a>
						</p>
					</div>
				</div>
				</li>
				<?php $i++; endwhile; ?>
			</ul>
		</div><!-- end .carousel-clip -->
		
		<!--
		<a class="carousel-prev" href="#"></a>
		<a class="carousel-next" href="#"></a>
		
		-->
	</div><!-- end .carousel -->
	</div><!-- end .nav -->

<?php endif; wp_reset_query(); ?>

</div><!-- end .wrap -->
</div><!-- end #wall -->