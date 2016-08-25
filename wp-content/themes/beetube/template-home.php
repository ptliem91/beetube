<?php
/**
 * Template Name: Landing Page Template
 * 
 * If you want to set up an alternate home page, just use this template for your page.
 *
 * @package BeeeTube
 * @subpackage Page Template
 *  1.0
 */

get_header(); ?>

<?php 

	$args = (array)get_option('jtheme_home_featured');
	//$args = (array)get_option('jtheme-responsive-settings');
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
	$featuredVideo =  get_option('jtheme_landingpage_status');
		if($featuredVideo == true){
		get_template_part('cat-featured');
		 }else{
		 echo '<br /><br />';
		 }
?>


<div id="main" class="home-temp">
<div class="wrap cf home-content">
	<div id="content">
	<?php
		// Output home sections based on user's settings
		$sections = get_option('jtheme_home_sections');
		if(!empty($sections)) {
			foreach($sections as $section_args) {
				jtheme_section_box($section_args);
			}
		}
	?>
	</div><!-- end #content -->
	
	<?php get_sidebar(); ?>
</div>

<?php
$featuredVideo =  get_option('jtheme_landingpage_status');
		if($featuredVideo == true){
		get_template_part('cat-featured-footer');
		 }else{
		 echo '<br /><br />';
		 }
?>
</div><!-- end #main -->

<?php get_footer(); ?>