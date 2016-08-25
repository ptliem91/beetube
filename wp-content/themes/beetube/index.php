<?php
/**
 * Index Template
 *
 * This is the most generic template file in a Wordpress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * Learn more: http://codex.Wordpress.org/Template_Hierarchy
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.0
 */

get_header(); ?>

<?php 
	$args = (array)get_option('jtheme_home_featured');
	if(!empty($args['posts_per_page'])) {
		$layout = '';
		if(!empty($args['layout']) && $args['layout'] == 'full-width')
			$layout = 'full-width';
		if(!empty($_REQUEST) && $_REQUEST['featured_layout'] == 'full-width')
			$layout = 'full-width';
		
		if($layout == 'full-width')
			get_template_part('home-featured-full-width'); 
		else
			get_template_part('home-featured'); 
	}

		$featuredVideo =  get_option('jtheme_index_status');
		if($featuredVideo == true){
		get_template_part('cat-featured');
		 }else{
		 echo '<br /><br />';
		 }
 ?>

<div id="main"><div class="wrap cf">
	<div id="content" role="main">
	<?php get_template_part('loop-actions'); ?>
	</div>
	
	<div id="content" role="main">
	<?php 
		if(is_home()){ 
		get_template_part('loop-header');
		}
		if (have_posts()) :
			//get_template_part('loop-actions');
			get_template_part('loop-content');
			//get_template_part('loop-nav');
		else :
			get_template_part('loop-error');
		endif; 
	?>
	</div><!-- end #content -->

	<?php get_sidebar(); ?>

</div>
	<?php
	$featuredVideo =  get_option('jtheme_index_status');
		if($featuredVideo == true){
		get_template_part('cat-featured-footer');
		 }else{
		 echo '<br /><br />';
		 }
	?>
</div><!-- end #main -->

<?php get_footer(); ?>