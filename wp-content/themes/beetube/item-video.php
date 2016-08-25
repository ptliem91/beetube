<?php
/**
 * The template for displaying videos in section box or on archive pages
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.0
 */
$video_thumb_class = '';
if( get_option('jtheme_video_or_thumb') == 'video' ){
	$video_thumb_class = ' thumbvid ';	
} 
?>
	<div id="post-<?php the_ID(); ?>" <?php $item_format = is_video() ? 'video' : 'post'; post_class('item clearfix '.$video_thumb_class.' cf item-'.$item_format); ?>>
		<?php
			// Set image size based on section view, only for section box
			global $section_view;
			$thumb_size = 'custom-full';
			if(!empty($section_view)) {
				if($section_view == 'list-large')
					$thumb_size = 'custom-full';
				elseif($section_view == 'grid-mini')
					$thumb_size = 'custom-medium';
			}
			if( get_option('jtheme_video_or_thumb') == 'video'){
				jtheme_video($post->ID, false);	
			}
			else{
				jtheme_thumb_html_hori($thumb_size);	
			}
			
		?>
			
		<div class="data">
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
                <span class="stats"><?php echo jtheme_get_post_stats_new(); ?></span>
			</p>
					
			<p class="stats"><?php echo jtheme_get_post_stats(); ?></p>
			<p class="entry-summary"><?php jtheme_excerpt(); ?></p>
		</div>
	</div><!-- end #post-<?php the_ID(); ?> -->