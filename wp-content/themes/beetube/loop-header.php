<?php
/**
 * Loop Header Template
 *
 * Displays information at the top of the page about archive and search results when viewing those pages.  
 * This is not shown on the home page and singular views.
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.0
 */
?>

	<?php 
		
		global $wp_query;
		$loop_title = '';
		$loop_desc = '';
		
		// Get loop title and loop description
		if(is_home() && !is_front_page()) {
			$posts_page_id = get_option('page_for_posts');
			$loop_title = '<em>'.get_the_title($posts_page_id).'</em>';
		} elseif(is_category()) {
			$loop_title = sprintf(__('<span class="prefix">Category</span> %s', 'jtheme'), '<span class="loop-subtitle">'.single_cat_title('', false).'</span>');
		} elseif(is_tag()) {
			$loop_title = sprintf(__('<span class="prefix">Tag</span> %s', 'jtheme'), '<span class="loop-subtitle">'.single_tag_title('', false).'</span>');
		} elseif(is_author()) {
			$id = get_query_var( 'author' );
			get_template_part('dashboard/author-info');
			//$loop_title = sprintf(__('<span class="prefix">User</span> %s', 'jtheme'), '<span class="loop-subtitle">'.get_the_author_meta( 'display_name', $id).'</span>');
		} elseif( is_search()) {
			$loop_title = sprintf(__( '<span class="prefix">Search Results for</span> %s', 'jtheme'), '<span class="loop-subtitle">'.esc_attr(get_search_query()).'</span>');
			$loop_desc = sprintf(__( 'About %s results', 'jtheme'), '<i class="count">'.$wp_query->found_posts.'</i>');
		} elseif(is_archive()) {
			if (is_day()):
				$loop_title = sprintf( __( '<span class="prefix">Daily Archives</span> %s', 'jtheme'), '<span class="loop-subtitle">'.get_the_date().'</span>');
			elseif (is_month()):
				$loop_title = sprintf( __( '<span class="prefix">Monthly Archives</span> %s', 'jtheme'), '<span class="loop-subtitle">'.get_the_date(_x( 'F Y', 'monthly archives date format', 'jtheme')).'</span>');
			elseif (is_year()):
				$loop_title = sprintf( __( '<span class="prefix">Yearly Archives</span> %s', 'jtheme'), '<span class="loop-subtitle">'.get_the_date(_x( 'Y', 'yearly archives date format', 'jtheme')).'</span>');
			else :
				$loop_title = '<span class="loop-subtitle">'.__( 'Browse Archives', 'jtheme' ).'</span>'; 
			endif;
		}
		
		// Output loop title and loop description
		if(!empty($loop_title)) {
			$loop_actions_status = get_option('jtheme_loop_actions_status');
			$class = (!$loop_actions_status) ? ' below-no-actions' : '';
			echo '
			<div class="loop-header'.$class.'">
				<h1 class="loop-title">'.$loop_title.'</h1>
				<span class="loop-desc">'. $loop_desc.'</span>
			</div><!-- end .loop-header -->';
		}
		
	?>