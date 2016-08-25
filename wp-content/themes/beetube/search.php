<?php
/**
 * Search Template
 *
 * The template for displaying Search Results pages.
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.0
 */

get_header(); ?>

<div id="main"><div class="wrap cf">
	
	<div id="content" role="main">
	
	
	
		<?php if (have_posts()) : global $loop_view; ?>
			<?php $sidebarmargin = 69; ?>
			<?php get_template_part('loop-actions'); ?>
			<div class="loop-content-m">
				<div class="loop-content switchable-view <?php echo $loop_view; ?>" data-view="<?php echo $loop_view; ?>">
				<?php get_template_part('loop-header');  ?>
					<div class="nag cf">
						<?php while (have_posts()) : the_post();
						
							get_template_part('item-video');
						endwhile; ?>
					</div>
				</div><!-- end .loop-content -->
			
			    <?php get_template_part('loop-nav'); ?>
		    </div>
		<?php else : ?>
		
		<?php $sidebarmargin = 1; ?>
		
			<?php get_template_part('loop-error'); ?>
		
		<?php endif; ?>
	
	</div><!-- end #content -->
	<div style="margin-top:<?php echo  $sidebarmargin; ?>px;">
	<?php get_sidebar(); ?>
	</div>

</div></div><!-- end #main -->

<?php get_footer(); ?>