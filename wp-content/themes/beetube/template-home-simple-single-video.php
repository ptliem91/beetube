<?php
/**
 * Template Name: Simple Homepage With Single Video
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
<style>.page #sidebar {
    margin-top: -1px;
}</style>
<?php 
	
			get_template_part('home-featured-full-width'); 
		
?>


<?php
$featuredVideo =  get_option('jtheme_index_status');
if($featuredVideo == true){
get_template_part('cat-featured');
 }else{
 echo '<br /><br />';
 }
 ?>

<div id="main"><div class="wrap cf">
	<div id="content" role="main" >
	<?php get_template_part('loop-actions'); ?>
	</div>
	
	<div id="content" role="main" style="margin:0px">
	<?php 
		 
		$current_page = max( 1, get_query_var('paged') );
		$vlimit = get_option('jtheme_index_vlimit');
		$indexCat = get_option('jtheme_index_cat');
		$indexSort = get_option('jtheme_index_sort');
		$getSort = $_GET['orderby'];
		
		$kulPost = array(
		'posts_per_page' => $vlimit,
		//'order' => 'ASC',
		'cat' => $indexCat,
		'orderby' => $indexSort
		);
		$wp_query = new WP_Query( $kulPost );
		
		
		
		if (have_posts()) :
			//get_template_part('loop-actions');			
			global $loop_view; 
		$ajaxload = get_option('jtheme_archive_ajaxload');
	?>
	<div class="loop-content-m">
	<div class="loop-content switchable-view <?php echo $loop_view; ?>" data-view="<?php echo $loop_view; ?>" data-ajaxload=<?php echo $ajaxload; ?>>
   	<?php //get_template_part('loop-header'); ?>
	 
			<h1 class="loop-title">
			<span class="prefix">Most Popular</span>
			<span class="loop-subtitle">Billions of Videos</span>
			</h1>
			
		<div class="nag cf">				
				
			<?php while (have_posts()) : the_post();
				
				get_template_part('item-video');
			endwhile; ?>
		</div>
	</div><!-- end .loop-content -->
    </div>
	<?php
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
$featuredVideo =  get_option('jtheme_index_status');
if($featuredVideo == true){
get_template_part('cat-featured-footer');
 }else{
 echo '<br /><br />';
 }
 ?>
</div><!-- end #main -->

<?php get_footer(); ?>