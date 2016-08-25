<?php
/**
 * Template Name: Archives
 *
 * A template to use on pages that lists your categories, archives, and last posts.
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.1
 */

get_header(); ?>

<div id="main"><div class="wrap cf archive-wrap">
	
	<div id="entry-header"><div class="inner">
		<h1 class="page-title"></h1>
	</div></div><!-- end .entry-header -->
	
	<div id="content" role="main">
	
		<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<div class="page-content rich-content archive-content">
				
				<?php
					// Recently Updated
					$args = array(
						'view' => 'list-small',
						'title' => __('Recently Added', 'jtheme'),
						'post_type' => 'post',
						'ignore_sticky_posts' => true,
						'posts_per_page' => 12,
						'orderby' => 'date'
					);
					jtheme_section_box($args);
					
					// Most Liked
					$args = array(
						'view' => 'grid-medium',
						'title' => __('Most Liked', 'jtheme'),
						'post_type' => 'post',
						'ignore_sticky_posts' => true,
						'posts_per_page' => 6,
						'orderby' => 'likes'
					);
					jtheme_section_box($args);
					
					// Most Viewed
					$args = array(
						'view' => 'grid-mini',
						'title' => __('Most Viewed', 'jtheme'),
						'post_type' => 'post',
						'ignore_sticky_posts' => true,
						'posts_per_page' => 12,
						'orderby' => 'views'
					);
					jtheme_section_box($args);
					
					// Most Commented
					$args = array(
						'view' => 'grid-small',
						'title' => __('Most Commented', 'jtheme'),
						'post_type' => 'post',
						'ignore_sticky_posts' => true,
						'posts_per_page' => 9,
						'orderby' => 'comments'
					);
					jtheme_section_box($args);
				?>

				<?php wp_link_pages(array('before' => '<p class="entry-nav pag-nav"><strong>'.__('Pages:', 'jtheme').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</div>
			
		</div><!--end .hentry-->
		<?php endwhile; ?>
		
	</div><!--end #content-->
	
	<div id="sidebar" class="archive-temp">
		<?php
			$widget_args = array(
				'before_title' => '<div class="widget-header"><h3 class="widget-title">',
				'after_title' => '</h3></div>',
			);
			the_widget('WP_Widget_Text', array('title'=>__('', 'jtheme')), $widget_args);
			the_widget('WP_Widget_Calendar', array('title'=>__('', 'jtheme')), $widget_args); 
			the_widget('WP_Widget_Categories', array('title'=>__('Category Archives', 'jtheme'), 'count'=>true), $widget_args); 
			the_widget('WP_Widget_Archives', array('title'=>__('Monthly Archives', 'jtheme')), $widget_args); 
			the_widget('WP_Widget_Tag_Cloud', array('title'=>__('Tag Archives', 'jtheme')), $widget_args); 
			the_widget('jtheme_Widget_Comments', array('title'=>__('Recent Comments', 'jtheme'), 'number'=>5), array_merge($widget_args, array('widget_id'=>'widget-comments-on-archives-page'))); 
		?>
	</div><!--end #sidebar-->

</div></div><!-- end #main -->

<?php get_footer(); ?>