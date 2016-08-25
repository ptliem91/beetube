<?php
/**
 * Author Added Template
 *
 * The template for displaying Posts Added by current author.
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.0
 */

// Get the ID of current user so we can use it later.
$user_id = jtheme_get_queried_user_id(); 
 
get_header(); ?>

<div id="main" class="authermain">
<div class="wrap cf">
	<div id="content" role="main">
		
		
	
		<?php 
			if (have_posts()) :
				get_template_part('loop-actions');
				get_template_part('loop-content');
				//get_template_part('loop-nav');
			else :
				get_template_part('loop-error');
			endif; 
		?>
	</div><!-- end #content -->
	<div class="authersidebar">
		<?php get_sidebar(); ?>
	</div>

</div></div><!-- end #main -->

<?php get_footer(); ?>