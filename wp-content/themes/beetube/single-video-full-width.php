<?php
/**
 * The Template for displaying all single video post with full width layout.
 *
 * @package BeeeTube
 * @subpackage Template
 * @since deTbue 1.1
 */

get_header(); 

$info_toggle = (int)get_option('jtheme_info_toggle');
?>

<div class="wall full-width-video-layout">

<?php 
$featuredVideo =  get_option('jtheme_single_fulltop_status');
$featuredVideo2 =  get_option('jtheme_single_fullmid_status');
$relatedVideo =  get_option('jtheme_related_status');
if($featuredVideo == true){
 get_template_part('related-posts'); 
 echo '<style>.full-sidebar #sidebar{border-top:none !important;}</style>';
 }else{
 echo '<br /><br />';
 }
 if($featuredVideo2 == true && $featuredVideo == false){
 $fulwidth =  'width:99%';
 }
 ?>


<div id="video" class="wrap cf">
	<div class="entry-header cf">
		
	
		
	</div><!-- end .entry-header -->
	
	<div class="screen fluid-width-video-wrapper">
				<?php jtheme_video($post->ID, get_option('jtheme_single_video_autoplay')); ?>
			</div><!-- end .screen -->
</div><!-- end #video -->
</div><!-- end #wall -->

<div id="main" class="full-single-page">
	<div class="wrap cf">
<?php while (have_posts()) : the_post(); global $post;?>
		<div class="data-single-full cf">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permalink to %s', 'jtheme'), get_the_title()); ?>"><?php the_title(); ?></a></h2>
				<div class="entry-meta">
				<span class="author vcard">
				<?php printf( '<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( __( 'View all posts by %s', 'jtheme' ), get_the_author() ) ),
					get_the_author());
				?>
				</span>
				
				<time class="entry-date" datetime="<?php echo the_time('jS M, Y'); ?>"><?php the_time('jS M, Y'); ?></time></a>
                <span class="stats"><?php echo jtheme_get_post_stats_new(); ?><?php echo jtheme_get_post_stats(); ?></span>
				</div>
				<?php jtheme_post_actions($post->ID); ?>
					<?php
					$social = get_option('jtheme_social');
					if($social == true){ ?>
					<div id="social-share">						
						<div id="" class="social-share">
							<div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-type="button_count"></div>
						</div>					
						<div id="" class="social-share">
							<div style="height:5px;"></div>
							<a href="https://twitter.com/share" class="twitter-share-button" data-via="" data-lang="en">Tweet</a>
						</div>
						<div id="" class="social-share">
							<div style="height:5px;"></div>
							<div class="g-plus" data-action="share" data-annotation="bubble"></div>
						</div>
						<div id="" class="social-share" style="margin-left: 0px;">
							<div style="height:5px;"></div>
							<a href="//www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=http%3A%2F%2Ffarm8.staticflickr.com%2F7027%2F6851755809_df5b2051c9_z.jpg&description=Next%20stop%3A%20Pinterest" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a>
							<!-- Please call pinit.js only once per page -->
							<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
						</div>
						<div class="clear"></div>
					</div>
					<?php } ?>
		</div>
	<div id="content" role="main" style="<?php echo $fulwidth ?>">
		
		
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<div id="details" class="section-box" style="<?php echo $fulwidth ?>">
			
			
			<div class="section-content">
			<div id="info"<?php if(!empty($info_toggle)) echo ' class="more-less" data-less-height="'.$info_toggle.'"'; ?>>
				

				<div class="entry-content rich-content">
					<?php the_content(); ?>
					<?php wp_link_pages(array('before' => '<p class="entry-nav pag-nav"><span>'.__('Pages:', 'jtheme').'</span> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				</div><!-- end .entry-content -->
			
				<div id="extras">
				<div>
					<h4><?php _e('Category:', 'jtheme'); ?></h4> <?php the_category(', '); ?>
				</div>
					<?php the_tags('<h4>'.__('Tags:', 'jtheme').'</h4>', ', ', ''); ?>
				</div>
			</div><!-- end #info -->
			</div><!-- end .section-content -->
			
			<?php if($info_toggle > 0) { ?>
			<div class="info-toggle">
				<a href="#" class="info-toggle-button info-more-button">
					<span class="more-text"><?php _e('Show more', 'jtheme'); ?></span> 
					<span class="less-text"><?php _e('Show less', 'jtheme'); ?></span>
				</a>
			</div>
			<?php } ?>
		</div><!--end #deatils-->
		</div><!-- end #post-<?php the_ID(); ?> -->
		
		<?php comments_template('', true); ?>
		
		<?php 			
			if($featuredVideo2 == true && $featuredVideo == false){
			 echo '</div></div>';
			 get_template_part('related-posts');
			 echo '<div class="wrap cf"><br/><div id="content" class="single-full-down" role="main"><div class="single-full-top"></div><br/> ';
			 }
			 ?>
		
		<?php 
		if($featuredVideo == true && $relatedVideo == true){
			jtheme_related_posts(array(
				'number'=>get_option('jtheme_related_posts'), 
				'view'=>get_option('jtheme_related_posts_view', 'grid-mini')
			)); 
		}
		
		
			$smallAdcode =  get_option('jtheme_small_adcode');
			$smallAdimg =  get_option('jtheme_small_adimg');
			if(!empty($smallAdcode) && empty($smallAdimg)){
			?>
			<div class="full-single-ad">
				<?php echo $smallAdcode; ?>
			</div>
			<?php
			}
			
			if(empty($smallAdcode) && !empty($smallAdimg)){
				?>
			<div class="full-single-ad">
					<img src="<?php echo $smallAdimg; ?>" />
			</div>
			<?php
			}

        // comments_template('', true); ?>

		<?php endwhile; 
		$bottomAdcode =  get_option('jtheme_bottom_adcode');
		$bottomAdimg =  get_option('jtheme_bottom_adimg');
		if(!empty($bottomAdcode) && empty($bottomAdimg)){
		?>
		<div class="single-banner">
			<?php echo $bottomAdcode; ?>
		</div>
		<?php
		}
		
		if(empty($bottomAdcode) && !empty($bottomAdimg)){
			?>
		<div class="single-banner">
				<img src="<?php echo $bottomAdimg; ?>" />
		</div>
		<?php
		}
		?>
	</div><!-- end #content -->
	<div class="full-sidebar">
		<?php get_sidebar(); ?>
	</div>
	
		
</div>
<?php
if($featuredVideo == true){
 get_template_part('cat-featured-footer'); 
 }else{
 echo '<br /><br />';
 }
 ?>
</div><!-- end #main -->
	
<?php get_footer(); ?>