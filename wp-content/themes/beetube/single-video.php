<?php
/**
 * The Template for displaying all single video posts with standard layout.
 *
 * @package BeeeTube
 * @subpackage Template
 * @since deTbue 1.1
 */
if($_GET['embed']){
?>
<!DOCTYPE html>
<!--[if IE 6]><html class="ie ie6 oldie" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="ie ie7 oldie" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8 oldie" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="ie ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<!-- Meta Tags -->
<meta charset="<?php bloginfo('charset'); ?>" />
<?php 
	$viewport = 'width=device-width';
	if(get_option('jtheme_responsive')){ 
		$viewport .= ', initial-scale=1, maximum-scale=1'; 
	} 
?>
<meta name="viewport" content="<?php echo $viewport; ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<!-- Title, Keywords and Description -->
<?php jtheme_meta_title($post_id); ?>
<?php jtheme_meta_keywords($post_id); ?>
<?php jtheme_meta_description($post_id); ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if($favicon = get_option('jtheme_favicon')) echo '<link rel="shortcut icon" href="'.$favicon.'" />'."\n"; ?>
<style>
	video.wp-video-shortcode,
	div.wp-video-shortcode-wrapper
	{
		width:95% !important;	
		height:95% !important;
	}
</style>
</head>
<body>
<?php

	 while (have_posts()) : the_post(); global $post;
	 $video_ads_id = get_post_meta($post->ID, 'video_ads_id', true);
				if($video_ads_id=='0'){$video_ads_id='';}
				do_shortcode('[advs id="'.$video_ads_id.'"]'.jtheme_video($post->ID, get_option('jtheme_single_video_autoplay')).'[/advs]');
	 endwhile;
?>
</body>
</html>
<?php

}else
{
	
get_header(); 

$info_toggle = (int)get_option('jtheme_info_toggle');

$featuredVideo =  get_option('jtheme_single_stand_status');
$relatedVideo =  get_option('jtheme_related_status');
?>
<?php
if($featuredVideo == true){
 get_template_part('related-posts'); 
 }else{
 echo '<br /><br />';
 }
 ?>
<div class="entry-header wrap cf">
	<div class="inner cf">
		
	
		
	</div><!-- end .entry-header>.inner -->
	</div><!-- end .entry-header -->
<div id="main"><div class="wrap cf">
	
	
	
	<div id="content" role="main">
		<?php while (have_posts()) : the_post(); global $post;?>
		
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		
		<div id="video">

			<div class="screen fluid-width-video-wrapper">
				<?php 
				$video_ads_id = get_post_meta($post->ID, 'video_ads_id', true);
				if($video_ads_id=='0'){$video_ads_id='';}
				do_shortcode('[advs id="'.$video_ads_id.'"]'.jtheme_video($post->ID, get_option('jtheme_single_video_autoplay')).'[/advs]');
				
				?>
                
                <br clear="all"  />
                
				
			</div><!-- end .screen -->
            <?php
			if( has_hosted_video( $post->ID ) ){
            	$embedURL=(strpos(get_permalink(),"?")!==false)?get_permalink().'&embed=true':get_permalink().'?embed=true';
			?>
           <input type="hidden" name="embedurl" id="embedUrl" value="<?php echo $embedURL?>" />
           <button name="embed" id="getEmbed" value="Embed" >Embed</button>
           
           <textarea id="embedCode" style="display:none; width:85%; height:125px;"></textarea>
           <?php	}	?>
           
           
            
		</div><!-- end #video-->
		<div class="clear"></div>
		<div class="entry-header cf">
			<div class="inner cf">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-meta">
				<span class="author"><?php _e('', 'jtheme'); ?> <?php the_author_posts_link(); ?></span>
				<span class="time"><?php the_date('jS M, Y') ?></span>
				<span class="stats"><?php echo jtheme_get_post_stats(); ?></span>							
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
			
			</div><!-- end .entry-header>.inner -->
		</div><!-- end .entry-header -->
		<div id="details" class="section-box">
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
		
		<?php 
		if($relatedVideo == true){
			jtheme_related_posts(array(
				'number'=>get_option('jtheme_related_posts'), 
				'view'=>get_option('jtheme_related_posts_view', 'grid-medium')
			)); 
		}
		?>

        <?php comments_template('', true); 
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
		<?php endwhile; ?>
	</div><!-- end #content -->

	<?php get_sidebar(); ?>

</div>
<?php
if($featuredVideo == true){
 get_template_part('cat-featured-footer'); 
 }else{
 echo '<br /><br />';
 }
 ?>
</div><!-- end #main -->
	
<?php get_footer(); 
}
?>