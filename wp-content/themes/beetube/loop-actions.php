<?php
/**
 * Loop Actions Template
 *
 * The template displays the loop actions on archive pages.
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.0
 */
?>
	<?php
		global $wp_query;
		
		$selected_sort_types = jtheme_selected_sort_types(); // Get selected sort types
		$selected_view_types = jtheme_selected_view_types(); // Get selected view types
		$selected_view_auto = get_option('jtheme_auto_grid'); // Get selected view types
		
		/* Get the loop view of current page based on
		 * user's cookie and the selected sort types
		 */
		global $loop_view;
		if(!empty($_COOKIE['loop_view']) && in_array($_COOKIE['loop_view'], array_keys($selected_view_types)))
			$loop_view = $_COOKIE['loop_view'];
		elseif(!empty($selected_view_types)) {
			$_view_types = array_keys($selected_view_types);
			$loop_view = $_view_types[0];
		} else {
			$loop_view = $selected_view_auto;
		}
		
		global $section_view;
		if(in_array('list-large', array_keys($selected_view_types)))
			$section_view = 'list-large';
		elseif(in_array('grid-mini', array_keys($selected_view_types)) && count($selected_view_types) == 1)
			$section_view = 'grid-small';
		
		$loop_actions_status = get_option('jtheme_loop_actions_status');
		if(!$loop_actions_status)
			return;

		// Output loop action bar if has selected sort types or view types
		if(!empty($selected_sort_types) || !empty($selected_view_types)) {
			echo '<div class="loop-actions cf">';	
			
			/* Output sort(orderby and order) if has selected sort types
			 *=======================================================*/
			if(!empty($selected_sort_types)) {
				// Get base url uses remove_query_arg() function
				$base_url = remove_query_arg(array('meta_key', 'meta_value', 'orderby', 'order'));
				
				// Get query vars from $wp_query uses get_query_var() function
				$meta_key = get_query_var('meta_key');
				$orderby = get_query_var('orderby');
				$order = strtolower(get_query_var('order'));
				
				// Get 'order' var from url
				$url_order = isset($_GET['order']) ? strtoupper($_GET['order']) : '';
				if($url_order != 'asc' && $url_order != 'desc')
					$url_order = '';
				
				// Get current sort type based query vars
				if($orderby == 'meta_value_num' && !empty($meta_key)) {
					$current_sort_type = $meta_key;
				} elseif($orderby == 'comment_count') {
					$current_sort_type = 'comments';
				} else {
					$current_sort_type = $orderby;
				}
	
				// Output orderby
				$out_orderby = array(); 
				$orderby_items = array(); 
				$i = 1;
				foreach($selected_sort_types as $type => $args) {
					// Start build url
					$url = $base_url;
					
					// Add order to url if has specific correct order in current url 
					if($url_order)
						$url = add_query_arg('order', strtolower($order), $url);
						
					// Add sort type as orderby
					$url = add_query_arg(array('orderby'=>$type), $url);
					
					// Check the sort typs is current? 
					$current = '';
					if($type == $current_sort_type || (empty($current_sort_type) && $i == 1))
						$current = ' current';

					// Output sort type link
					$out_orderby[] = ' <a href="'.$url.'" title="'.esc_attr($args['title']).'" class="'.$type.$current.'"><i>'.$args['label'].'</i></a> ';
					
					$orderby_items[$type] = array(
						'url' => $url,
						'title' => esc_attr($args['title']),
						'label' => esc_attr($args['label']),
						'current' => ($type == $current_sort_type) || (empty($current_sort_type) && $i == 1)
					);
					
					$i++;
				}
				
				// Output order(ASC/DESC) based on user's settings
				if(!is_home()){ 
				$out_order = '';
				if(get_option('jtheme_sort_order')) {
					// Supported order types
					$order_types = array(
						'asc' => __('Sort Ascending', 'jtheme'),
						'desc' => __('Sort Descending', 'jtheme')
					);

					// Generate reversed order to url
					$to_order = ($order == 'asc') ? 'desc' : 'asc';
					$to_order_url = add_query_arg('order', $to_order);
					
					// Output order link
					$out_order = '<span class="order"><a class="'.$to_order.'" href="'.$to_order_url.'" title="'.esc_attr($order_types[$to_order]).'">'.$order_types[$to_order].'</a></span><!-- end .order -->';
				}
				}				

				// Output sort html
				echo '<div class="sort"><span class="prefix sortby"><span>'.__('Sắp xếp', 'jtheme').'</span></span>';
				echo '<span class="orderby"><div class="top-arrow"></div>'.implode( $out_orderby).'</span><!-- end .orderby -->';
				
				echo '<select class="orderby-select">';
				
				foreach($orderby_items as $type => $item) {
					echo '<option value="'.$item['url'].'"'.selected($item['current'], true, false).'>'.$item['label'].'</option>';
				}
				echo '</select>';
				if(!is_home()){ 
				echo $out_order;
				}
				echo '</div><!-- end .sort -->';
			}
			
			/* Output view if has selected view types
			 *=======================================================*/
			
			 $smallAdcode =  get_option('jtheme_small_adcode');
			$smallAdimg =  get_option('jtheme_small_adimg');
			if(!empty($smallAdcode) && empty($smallAdimg)){
			?>
			<div class="topbanner">
				<?php echo $smallAdcode; ?>
			</div>
			<?php
			}
			
			if(empty($smallAdcode) && !empty($smallAdimg)){
				?>
			<div class="topbanner">
					<img src="<?php echo $smallAdimg; ?>" />
			</div>
			<?php
			}
			
			 
			if(!empty($selected_view_types)) {
				echo '<div class="view"><span class="prefix viewas">'.__('View As:', 'jtheme').'</span>';
				$i = 0;
				echo '<div class="grid-view">';
				foreach($selected_view_types as $type => $label) {
					// Check the view typs is current? 
					$current = '';
					if($type == $loop_view)
						$current = ' current';
					
					// Output view type link
					echo '<a href="#" title="'.esc_attr($label).'" data-type="'.$type.'" class="grid-view-switcher '.$type.'-link'.$current.'"><i></i></a>';
				}
				
				echo '</div></div><!-- end .view -->';
			}
			
			echo '</div><!-- end .loop-actions -->';
		}
	?>
