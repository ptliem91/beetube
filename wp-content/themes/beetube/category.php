<?php
/**
 * Category Template
 *
 * The template for displaying Category Archive pages.
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.0
 */

get_header(); ?>

<?php
$featuredVideo =  get_option('jtheme_category_status');
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
		
	
		if (have_posts()) :
			//get_template_part('loop-actions');
			
			get_template_part('loop-content');
			//get_template_part('loop-nav');
		else :
			get_template_part('loop-error');
		endif; 
		
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

	<?php get_sidebar(); ?>

</div>
<?php
$featuredVideo =  get_option('jtheme_category_status');
if($featuredVideo == true){
 get_template_part('cat-featured-footer');
}else{
 echo '<br /><br />';
 }
 ?>
</div><!-- end #main -->

<?php get_footer(); ?>