<?php 
/**
 * Page Template
 *
 * This is the template that displays all pages by default.
 * Please note that this is the Wordpress construct of pages
 * and that other 'pages' on your Wordpress site will use a
 * different template.
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.0
 */

get_header(); ?>

<div id="main"><div class="wrap cf">

	<div id="content" role="main">
		<div style="padding-right:20px;">
		<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			

			<div class="page-content rich-content">
			<h1 class="page-title"><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => '<p class="entry-nav pag-nav"><strong>'.__('Pages:', 'jtheme').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</div>
		</div><!--end .hentry-->
		<?php endwhile; ?>
		</div>
	</div><!--end #content-->
	
	<?php get_sidebar(); ?>

</div></div><!-- end #main -->

<?php get_footer(); ?>