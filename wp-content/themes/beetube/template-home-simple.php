<?php
/**
 * Template Name: Simple Homepage Template
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
	<div id="content" role="main">
	<?php get_template_part('loop-actions'); ?>
	</div>
	
	<div id="content" role="main" style="margin-top:0px;">
	<?php 
		$current_page = max( 1, get_query_var('paged') );
		$vlimit = get_option('jtheme_index_vlimit');
		$indexCat = get_option('jtheme_index_cat');
		$indexSort = get_option('jtheme_index_sort');		
		if(isset($_GET['orderby'])){
		$getSort = $_GET['orderby'];
		}
		if($current_page == 1 && !isset($getSort)) {
		$kulPost = array(
		'posts_per_page' => $vlimit,
		//'order' => 'ASC',
		'cat' => $indexCat,
		'orderby' => $indexSort
		);
		$wp_query = new WP_Query( $kulPost );
		}
		
		
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
	
	<div class="page-sidebar">

	<?php get_sidebar(); ?>
	
	</div>
	
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