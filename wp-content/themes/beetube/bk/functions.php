<?php

/*= Load Files
 *=============================================================================*/

// Load the functions
require_once( trailingslashit(get_template_directory()) . 'functions/helpers.php' );
require_once( trailingslashit( get_template_directory() ) . 'functions/plugins-compat.php' );
require_once( trailingslashit( get_template_directory() ) . 'functions/video-functions.php' );
require_once( trailingslashit( get_template_directory() ) . 'functions/beetube-postviews.php' );

// Load the widgets
require_once( trailingslashit( get_template_directory() ) . 'widgets/widget-posts.php' );
require_once( trailingslashit( get_template_directory() ) . 'widgets/widget-related-posts.php' ); 
require_once( trailingslashit( get_template_directory() ) . 'widgets/widget-user-bio.php' ); 
require_once( trailingslashit( get_template_directory() ) . 'widgets/widget-single-post-stats.php' ); 
require_once( trailingslashit( get_template_directory() ) . 'widgets/widget-comments.php' ); 
require_once( trailingslashit( get_template_directory() ) . 'widgets/widget-ad.php' ); 
require_once( trailingslashit( get_template_directory() ) . 'widgets/widget-tweets/widget-tweets.php' ); 
 
// Load the admin functions
if(is_admin()) {
	require_once( trailingslashit( get_template_directory() ). 'admin/panel.php');
	require_once( trailingslashit( get_template_directory() ). 'admin/forms.php');
	require_once( trailingslashit( get_template_directory() ) . 'admin/admin.php' );
}

// Load the extentions
require_once( trailingslashit( get_template_directory() ) . 'extensions/jtheme-post-likes.php' );
require_once( trailingslashit( get_template_directory() ) . 'extensions/jtheme-jplayer.php' );

/*= Theme Setup
 *=============================================================================*/

/**
 * Theme Feature: Content Width
 *
 * Sets up the content width value based on the theme's design.
 * @see jtheme_content_width() for template-specific adjustments.
 */
if(!isset($content_width))
	$content_width = 620;
	
/**
 * Adjusts content_width value for specific.
 *
 *  1.4
 *
 * @return void
 */
function jtheme_content_width() {
	global $content_width;

	if ( is_page_template('page-template-full-width.php'))
		$content_width = 950;
	elseif(is_singular()) {
		global $post;
		$video_layout = get_post_meta($post->ID, 'jtheme_video_layout', true);
		if($video_layout == 'full-width')
			$content_width = 950;
	}
}
add_action( 'template_redirect', 'jtheme_content_width' );
 
add_action( 'after_setup_theme', 'theme_setup' );
function theme_setup() {
	
	
	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );
	
	// Translation
	load_theme_textdomain( 'jtheme', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// Register Nav Menus
	register_nav_menus(array(
		'main' => __('Main Navigation', 'jtheme'),
		'header' => __('header Navigation', 'jtheme')
	));
	
	// Register Sidebars
	register_sidebar(array(
		'name' => __('Main Sidebar', 'jtheme'),
		'id' => 'main',
		'description' => __('This is the most generic sidebar, If a page does not specify the sidebar, or specify the sidebar but the specified sidebar is empty, this sidebar will be used.', 'jtheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-header"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));
	
	register_sidebar(array(
		'name' => __('Landing Page Sidebar', 'jtheme'),
		'id' => 'home',
		'description' => __('This sidebar will displayed on homepage. If you leave this sidebar empty, the "Main Sidebar" will be used.', 'jtheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-header"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));
	
	register_sidebar(array(
		'name' => __('Category Sidebar', 'jtheme'),
		'id' => 'category',
		'description' => __('This sidebar will displayed on category archive pages. If you leave this sidebar empty, the "Main Sidebar" will be used.', 'jtheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-header"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));
	
	register_sidebar(array(
		'name' => __('Single Video Sidebar', 'jtheme'),
		'id' => 'single-video',
		'description' => __('This sidebar will displayed on single video pages. If you leave this sidebar empty, the "Main Sidebar" will be used.', 'jtheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-header"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));
		
	$footbar_layout = get_option('jtheme_footbar_layout', 'c3');
	if($footbar_layout == 'c4s1') {
		for($i=1;$i<=5;$i++) {
			register_sidebar(array(
				'name' => __('Footbar', 'jtheme').$i,
				'id' => 'footbar-'.$i,
				'description' => __( 'An optional widget area for your site footer', 'jtheme' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<div class="widget-header"><h3 class="widget-title">',
				'after_title' => '</h3></div>',
			));
		}
	} else {
		register_sidebar(array(
			'name' => __('Footbar', 'jtheme'),
			'id' => 'footbar',
			'description' => __( 'An optional widget area for your site footer', 'jtheme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
	}
	
	
		
	/* Add Post Thumbail Support & Add Image Size */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );	
	add_image_size( 'custom-small', 160, 90, true );
	add_image_size( 'custom-medium', 320, 180, true );
	add_image_size( 'custom-large', 640, 360, true );
	add_image_size( 'custom-full', 960, 540, true );
	
	// Add Semantic Markup Support
	add_theme_support( 'html5' );
	
	// Add Post Formats Support
	add_theme_support('post-formats', array( 'video'));

	/* Add Editor Style */
	// add_editor_style();
}

/*= Scripts & Styles
 *=============================================================================*/

/**
 * Register all scripts and styles we needed
 */
add_action('init', 'jtheme_register_scripts');
function jtheme_register_scripts() {
	if (is_admin())
		return;
	
	$protocol = is_ssl() ? 'https' : 'http';
	
	// Scripts
	wp_register_script('modernizr', get_template_directory_uri().'/js/modernizr.min.js', array('jquery'), '2.6.2');
	
	wp_register_script('hori-plugin', get_template_directory_uri().'/js/horizental/plugins.js', array('jquery'), '2.6.2');
	
	wp_register_script('sly', get_template_directory_uri().'/js/horizental/sly.js', array('jquery'), '2.6.2');
	
	wp_register_script('hori', get_template_directory_uri().'/js/horizental/horizontal.js', array('jquery'), '2.6.2');
	
	wp_register_script('hori-modernizer', get_template_directory_uri().'/js/horizental/modernizr.custom.js', array('jquery'), '2.6.2');
	wp_register_script('itotop', get_template_directory_uri().'/js/jquery.itoppage.js', array('jquery'), '2.6.2');
	
	wp_register_script('res-nav', get_template_directory_uri().'/js/responsive-nav.js', array('jquery'), '2.6.2');
	
	wp_register_script('jquery-easing', get_template_directory_uri().'/js/jquery.easing.js', array('jquery'), '1.3', false);
	wp_register_script('jquery-jplayer', get_template_directory_uri() . '/js/jquery.jplayer.min.js', array('jquery'), '2.4.0', false);
	//wp_register_script('jquery-carousel', get_template_directory_uri().'/js/jquery.jcarousel.js', array('jquery'), '0.3.0', true);
	wp_register_script('jquery-fitvids', get_template_directory_uri().'/js/jquery.fitvids.js', array('jquery'), '1.0', true);
	wp_register_script('jquery-plugins', get_template_directory_uri().'/js/jquery.plugins.min.js', array('jquery'), '1.4.6', false);
	wp_register_script('jquery-plugins', get_template_directory_uri().'/js/postviews-cache.js', array('jquery'), '1.4.2', false);
	wp_register_script('theme', get_template_directory_uri().'/js/theme.js', array('jquery'), '1.4.6', true);
	wp_enqueue_script('blog-infinitescroll', get_template_directory_uri().'/js/blog-infinitescroll.js', false, false, true);
	
}

/**
 * Load common scripts. Other scripts we will load them only when needed. 
 * If you are a developer and want to find where are load other scripts,
 * try to searching 'wp_enqueue_script' function, we use it to load all scripts on admin footer.
 */
add_action('wp_enqueue_scripts', 'jtheme_enqueue_scripts', 10);
function jtheme_enqueue_scripts() {
	if(is_admin())
		return false;
	
	$protocol = is_ssl() ? 'https' : 'http';
	
	/* Load common scripts on all pages */
	wp_enqueue_script('modernizr'); 
	
	wp_enqueue_script('hori-plugin');
	wp_enqueue_script('sly');
	wp_enqueue_script('hori');
	wp_enqueue_script('hori-modernizer');
	wp_enqueue_script('itotop');
	wp_enqueue_script('res-nav');
	
	wp_enqueue_script('jquery-plugins');
	wp_enqueue_script('jquery-masonry' );
	wp_enqueue_script('jquery-fitvids' );
	wp_enqueue_script('theme');
	wp_enqueue_script('blog-infinitescroll');
	
	
	/* Load script with the comment form if it is necessary */
	if( is_singular() && get_option( 'thread_comments' ) ) 
		wp_enqueue_script( 'comment-reply' );
		
		
	// Load Styles
	wp_enqueue_style('jtheme-fonts', $protocol.'://fonts.googleapis.com/css?family=Oxygen');
	wp_enqueue_style('jtheme-style', get_stylesheet_uri(), '', '1.4.3');
	
	$preset_bgpat = get_option('jtheme_preset_bgpat');
	$colorscheme = get_option('jtheme_color_scheme');
	$dirUrl = get_template_directory_uri();
	$dirMatch = get_template_directory_uri().'/patterns/black.png';
	
	if($colorscheme == 'blue' && $preset_bgpat == $dirMatch){
	wp_enqueue_style('jtheme-mainstyle', get_template_directory_uri().'/css/stylesheet-blue-black.css', 'jtheme-style', '1.4.3');
	}elseif($colorscheme == 'green' && $preset_bgpat == $dirMatch){
	wp_enqueue_style('jtheme-mainstyle', get_template_directory_uri().'/css/stylesheet-green-black.css', 'jtheme-style', '1.4.3');
	}elseif($colorscheme == 'red' && $preset_bgpat == $dirMatch){
	wp_enqueue_style('jtheme-mainstyle', get_template_directory_uri().'/css/stylesheet-red-black.css', 'jtheme-style', '1.4.3');
	}elseif($colorscheme == 'lgreen' && $preset_bgpat == $dirMatch){
	wp_enqueue_style('jtheme-mainstyle', get_template_directory_uri().'/css/stylesheet-light-green-black.css', 'jtheme-style', '1.4.3');
	}elseif($colorscheme == 'lblue' && $preset_bgpat == $dirMatch){
	wp_enqueue_style('jtheme-mainstyle', get_template_directory_uri().'/css/stylesheet-light-blue-black.css', 'jtheme-style', '1.4.3');
	}elseif($colorscheme == 'blue' && $preset_bgpat != $dirMatch){
	wp_enqueue_style('jtheme-mainstyle', get_template_directory_uri().'/css/stylesheet-blue.css', 'jtheme-style', '1.4.3');
	}elseif($colorscheme == 'green' && $preset_bgpat != $dirMatch){
	wp_enqueue_style('jtheme-mainstyle', get_template_directory_uri().'/css/stylesheet-green.css', 'jtheme-style', '1.4.3');
	}elseif($colorscheme == 'red' && $preset_bgpat != $dirMatch){
	wp_enqueue_style('jtheme-mainstyle', get_template_directory_uri().'/css/stylesheet-red.css', 'jtheme-style', '1.4.3');
	}elseif($colorscheme == 'lgreen' && $preset_bgpat != $dirMatch){
	wp_enqueue_style('jtheme-mainstyle', get_template_directory_uri().'/css/stylesheet-light-green.css', 'jtheme-style', '1.4.3');
	}elseif($colorscheme == 'lblue' && $preset_bgpat != $dirMatch){
	wp_enqueue_style('jtheme-mainstyle', get_template_directory_uri().'/css/stylesheet-light-blue.css', 'jtheme-style', '1.4.3');
	}else{
	wp_enqueue_style('jtheme-mainstyle', get_template_directory_uri().'/css/stylesheet-green.css', 'jtheme-style', '1.4.3');
	}
	
	wp_enqueue_style('jtheme-hori', get_template_directory_uri().'/css/horizontal.css', 'jtheme-style', '1.4.3');
	wp_enqueue_style('jtheme-component', get_template_directory_uri().'/css/component.css', 'jtheme-style', '1.4.3');
	wp_enqueue_style('jtheme-itotope', get_template_directory_uri().'/css/jquery.itoppage.css', 'jtheme-style', '1.4.3');
	wp_enqueue_style('jtheme-res-nav', get_template_directory_uri().'/css/responsive-nav.css', 'jtheme-style', '1.4.3');
	
	if(get_option('jtheme_responsive'))
		wp_enqueue_style('jtheme-responsive', get_template_directory_uri().'/responsive.css', 'jtheme-style', '1.4.3');
	if( get_option('jtheme_video_or_thumb') == 'video' )
		wp_enqueue_style('jtheme-videocss', get_template_directory_uri().'/css/to-videos.css', 'jtheme-style', '1.4.3');
}

/**
 * Embed scripts into the header
 *
 * We embed scripts to the head usually in order to define variables 
 * or these scripts execution in the head rather than in the footer.
 */
add_action('wp_head', 'jtheme_head_scripts', 0);
function jtheme_head_scripts() { 
?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('ajax.php'); ?>',
	theme_ajaxurl = '<?php echo get_template_directory_uri().'/ajax.php'; ?>',
	ajaxerror = "<?php echo wp_kses_stripslashes(__("Something\'s error. Please try again later!", 'jtheme')); ?>";
</script>
<?php }


/*= Admin Scripts and Styles
 *=============================================================================*/
add_action( 'admin_init', 'jtheme_register_admin_scripts' );
//add_action('admin_print_scripts', 'jtheme_enqueue_admin_scripts');
//add_action('admin_print_styles', 'jtheme_enqueue_admin_styles');

/**
 * Reigster all scripts and styles we need load on admin. 
 */
function jtheme_register_admin_scripts() {
	wp_register_style( 'jtheme-admin', trailingslashit( get_template_directory_uri() ) . 'admin/css/admin.css', false, '', 'screen' );
	wp_register_style( 'jtheme-colorpicker', trailingslashit( get_template_directory_uri() ) . 'admin/js/colorpicker/colorpicker.css', false, '', 'screen' );
	
	wp_register_script( 'jtheme-admin', trailingslashit( get_template_directory_uri() ) . 'admin/js/admin.js', array('jquery', 'media-upload'), '', true );
	wp_register_script( 'jtheme-colorpicker', trailingslashit( get_template_directory_uri() ) . 'admin/js/colorpicker/colorpicker.js', array('jquery'), '', true );
	wp_register_script( 'jtheme-itemlist', trailingslashit( get_template_directory_uri() ) . 'admin/js/itemlist.js', array('jquery'), '', true );
}

/**
 * Load admin scripts
 */
function jtheme_enqueue_admin_scripts() {
	wp_enqueue_media();
	wp_enqueue_script('jtheme-colorpicker');
	wp_enqueue_script('jtheme-itemlist');
	wp_enqueue_script('jtheme-admin');
}

/**
 * Load admin styles
 */
function jtheme_enqueue_admin_styles() {
	wp_enqueue_style('jtheme-colorpicker');
	wp_enqueue_style('jtheme-admin');
}



/**
 * Prepare scripts for ajax calls when needed
 *
 * @since 1.4
 */
add_action('the_post', 'jtheme_prepare_scripts', 10);
function jtheme_prepare_scripts($query) {
	if(is_admin())
		return false;
	
	global $post;
	$code = trim(get_post_meta($post->ID, 'jtheme_video_code', true));
	
	if(has_shortcode($code, 'jplayer'))
		wp_enqueue_script('jquery-jplayer');
				
	$library = apply_filters( 'wp_video_shortcode_library', 'mediaelement' );	
	if(has_shortcode($code, 'video') && 'mediaelement' === $library && did_action( 'init' ) ) {
		wp_enqueue_style( 'wp-mediaelement' );
		wp_enqueue_script( 'wp-mediaelement' );
	}
}


/**
 * Get post views by 'WP Postviews' plugin
 */
function jtheme_get_post_views($post_id = '') {
	global $post;
	
	if(!$post_id)
		$post_id = $post->ID;
		
	$views = get_post_meta($post_id, 'views', true);
	$views = absint($views);
	//$views = number_format_i18n($views);
	$views = short_number($views);
	
	return $views;
}

/**
 * Change the labels of Wordpress built-in post type 'post'
 * to custom labels based on user's settings.
 */
function jtheme_post_object_labels() {
	$custom_labels = get_option('jtheme_post_labels');
	if(!empty($custom_labels)) {
		global $wp_post_types;
		$labels = &$wp_post_types['post']->labels;
	
		foreach($custom_labels as $key => $label) {
			if(!empty($label))
				$labels->$key = $label;
		}
	}
}
function jtheme_post_menu_labels() {
	global $menu;
	global $submenu;
	
	$custom_labels = get_option('jtheme_post_labels');
	
	if(!empty($custom_labels['menu_name'])) {
		$menu[5][0] = $custom_labels['menu_name'];
		$submenu['edit.php'][5][0] = $custom_labels['menu_name'];
	}
	if(!empty($custom_labels['add_new']))
		$submenu['edit.php'][10][0] = $custom_labels['add_new'];
}
if(get_option('jtheme_post_labels_status')) {
	add_action( 'init', 'jtheme_post_object_labels' );
	add_action( 'admin_menu', 'jtheme_post_menu_labels' );
}

/** 
 * Custom Gravatar 
 */
add_filter( 'avatar_defaults', 'jtheme_custom_gravatar' );
function jtheme_custom_gravatar( $avatar_defaults ) {
    $avatar = get_template_directory_uri() . '/images/gravatar.png';
    $avatar_defaults[$avatar] = 'Custom Gravatar (/images/gravatar.png)';
    return $avatar_defaults;
}

/**
 * Custom RSS Feed Link 
 */
add_filter('feed_link', 'jtheme_custom_feed_link', 10, 2);
function jtheme_custom_feed_link($output, $feed) {
	if($url = get_option('jtheme_rss_url'))
		return $url;
		
	return $output;
}

/** 
 * Custom User Contact Methods
 */
add_filter( 'user_contactmethods', 'jtheme_custom_user_contactmethods');
function jtheme_custom_user_contactmethods($methods) {
	// Add custom contact methods
	$new_methods = array(
		'twitter' => __('Twitter', 'jtheme'),
		'facebook' => __('Facebook', 'jtheme'),
		'location' => __('Location', 'jtheme')
	);
	
	return $new_methods + $methods;
}


// Get queried user id
function jtheme_get_queried_user_id() {
	global $authordata;
	if(isset( $authordata->ID )){
		$user_id = $authordata->ID;
	} else {
		$user = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
		
		$user_id = $user->ID;
	}
	
	return $user_id;
}
function jtheme_nav_custom_css() {
	$navBGcolor =  get_option('jtheme_nav_bgcolor');
	$topBGcolor =  get_option('jtheme_topnav_bgcolor');
	$output = '<style>';
	$output .= '#main-nav {background:'.$navBGcolor.' !important;}#main-nav ul li ul{background:'.$navBGcolor.' !important}';
	$output .= '#top-nav {background:'.$topBGcolor.' !important;}#header-search .search-text-div input[type="text"]{background:'.$topBGcolor.' !important;}';
	$output .= '</style>';
	return $output;
}

// Add Public Variables
add_filter('query_vars', 'jtheme_custom_query_vars');
function jtheme_custom_query_vars($query_vars) {
	$query_vars[] = 'filter';
	$query_vars[] = 'views_timing';

	return $query_vars;
}

/**
 * Reset and parse query args based passed $args
 *
 *  1.0
 */
function jtheme_parse_query_args($args) {
	$defaults = array(
		'post_type' => 'post',
		'ignore_sticky_posts' => true,
		'orderby' => 'date',
		'order' => 'desc',
		'cat' => '',
		'tax_query' => '',
		'taxonomies' => array(),
		'meta_key' => '',
		'post__in' => '',
		'current_cat' => '',
		'current_author' => ''
	);
	$args = wp_parse_args($args, $defaults);
	// extract($args);
	
	// Set post_type
	if($args['post_type']=='all') {
		$post_types = get_post_types(array('public'=>true), 'names');
		unset($post_types['page']);
		unset($post_types['attachment']);
		$args['post_type'] = $post_types;
	}
	
	// Set post__in, ignore other arguments and return
	if(!empty($args['post__in']) && !is_array($args['post__in'])) {
		$args['post__in'] = explode(',', $args['post__in']);
		return $args; 
	}
	
	// Set tax_query
	$taxes = array_filter($args['taxonomies']);
	if(!empty($taxes)) {
		foreach($taxes as $tax=>$terms) {
			$args['tax_query']['relation'] = 'AND';
			
			if($tax=='post_format' && ($terms=='-1' || $terms=='standard')) {
				$post_formats = get_theme_support('post-formats');
				$terms = array();
				foreach ($post_formats[0] as $format) {
					$terms[] = 'post-format-'.$format;
				}
				$args['tax_query'][] = array(
					'taxonomy' => $tax,
					'field' => 'slug',
					'terms' => $terms,
					'operator' => 'NOT IN'
				);
			} elseif($tax == 'post_tag') {
				if(!is_array($terms))
					$terms = explode(',', trim($terms));
				$args['tax_query'][] = array(
					'taxonomy' => $tax,
					'field' => 'slug',
					'terms' => $terms,
					'operator' => 'IN'
				);
			} else {
				$args['tax_query'][] = array(
					'taxonomy' => $tax,
					'field' => 'id',
					'terms' => (array)$terms,
					'operator' => 'IN'
				);
			}
		}
	}

	// Set 'author' to current author id on author archive page if 'current_author' is true
	if(!empty($args['current_author']) && is_author())
		$args['author'] = jtheme_get_queried_user_id();

	// Set 'cat' to current cat id on category archive page if 'current_cat' is true
	if(!empty($args['current_cat']) && is_category())
		$args['cat'] = get_queried_object_id();

	return $args;
}

// Filter to "pre_get_posts" to change query vars
add_action( 'pre_get_posts', 'jtheme_custom_get_posts' );
function jtheme_custom_get_posts( $query ) {
	if(is_admin())
		return;
		
	$orderby = $query->get('orderby');
	$order = $query->get('order');
	
	// If no 'orderby' specified, get first sort type from selected sort types
	$selected_sort_types = jtheme_selected_sort_types();
	if(!empty($selected_sort_types) && empty($orderby)) {
		$_sort_types = array_keys($selected_sort_types);
		$orderby = $_sort_types[0];
		$query->set('orderby', $orderby);
	}
	
	// Reset query vars based orderby parameter
	if($orderby == 'comments') {
		$query->set('orderby', 'comment_count');
	} 
	elseif($orderby == 'views') {	
		$query->set('orderby', 'meta_value_num');
		$query->set('meta_key', 'views');
		
		// The arguments for BAW Post Views Count plugin
		if(function_exists('baw_pvc_main')) {
			global $timings;
			$views_timing = $query->get('views_timing') ? $query->get('views_timing') : 'all';
			$date = $views_timing == 'all' ? '' : '-'. date( $timings[$views_timing] );
			$meta_key = apply_filters( 'baw_count_views_meta_key', '_count-views_' . $views_timing . $date, $views_timing, $date );
			$query->set('meta_key', $meta_key);
		}
	} 
	elseif($orderby == 'likes') {	
		$query->set('orderby', 'meta_value_num');
		$query->set('meta_key', 'likes');
	} 
	elseif($orderby == 'title' && !$order) {
		// If order by title, and no order specified, set "ASC" as default order.
		$query->set('order', 'ASC');
	}

	// Only display posts on search results page
	if (is_search())
		$query->set('post_type', 'post');
	
	// Make tax_query support "post-format-standard"
	$tax_query = $query->get('tax_query');
	
	if(!empty($tax_query)) {
		foreach($tax_query as $index => $single_tax_query) {
			if(empty($single_tax_query['terms']))
				continue;
			
			$in_post_formats = (array)$single_tax_query['terms'];
			
			if($single_tax_query['taxonomy'] == 'post_format'
			&& $single_tax_query['field'] == 'slug'
			&& in_array('post-format-standard', $in_post_formats)) {
				// Get reverse operator
				$reverse_operator = 'IN';
				if(empty($single_tax_query['operator']) || $single_tax_query['operator'] == 'IN')
					$reverse_operator = 'NOT IN';
				elseif($single_tax_query['operator'] == 'AND')
					break;
				
				// Get "not in post formats"
				$post_formats = get_theme_support('post-formats');
				$all_post_formats = array();
				if(is_array( $post_formats[0])) {
					$all_post_formats = array();
					foreach($post_formats[0] as $post_format)
						$all_post_formats[] = 'post-format-'.$post_format;
				}
				$not_in_post_formats = array_diff($all_post_formats, $in_post_formats);
				
				// Reset post_format in tax_query
				$query->query_vars['tax_query'][$index] = array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => $not_in_post_formats,
					'operator' => $reverse_operator
				);
			}
		}
	}
	
	return $query;
}

/* Filters that allow shortcodes in Text Widgets */
add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

/* Enable oEmbed in Text/HTML Widgets */
add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );

/* Filters that allow shortcodes in term description */
add_filter( 'term_description', 'do_shortcode' );

/*= Custom Coding Ready
 *=============================================================================*/

/**
 * Add Custom Head Code
 * 
 * @since 1.0
 */
add_action('wp_head', 'jtheme_custom_head_code', 999);
function jtheme_custom_head_code() {
	$code = get_option('jtheme_head_code');
	if($code)
		echo stripslashes($code);
}

/** 
 * Add Custom Footer Code
 *
 * @since 1.0
 */
add_action('wp_footer', 'jtheme_custom_footer_code', 999);
function jtheme_custom_footer_code() {
	$code = get_option('jtheme_footer_code');
	if($code)
		echo stripslashes($code);
}


/*= Template Functions
 *=============================================================================*/
 
/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 *  1.4
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function jtheme_doc_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'jtheme_doc_title', 10, 2 ); 
 
/**
 * Get page description
 *
 * @since 1.2.3
 */
function jtheme_get_doc_desc() {
	$description = '';

	if (is_home()) {
		$description = get_bloginfo( 'description' );
	}
	elseif (is_singular()) {
		if (is_front_page())
			$description = get_bloginfo( 'description' );
		else {
			$description = get_post_field( 'post_excerpt', get_queried_object_id() );
			
			if(empty($description) && function_exists('mb_strimwidth')) {
				$content = get_post_field( 'post_content', get_queried_object_id() );
				$content = strip_shortcodes($content);
				$content = strip_tags($content);
				$description = mb_strimwidth($content, 0, 200, '');
			}
		}
	}
	elseif ( is_archive() ) {
		if ( is_author() ) {
			$description = get_the_author_meta( 'description', get_query_var( 'author' ) );
		}
		elseif ( is_category() || is_tag() || is_tax() )
			$description = term_description( '', get_query_var( 'taxonomy' ) );
		elseif ( is_post_type_archive() ) {
			$post_type = get_post_type_object( get_query_var( 'post_type' ) );
			if ( isset( $post_type->description ) )
				$description = $post_type->description;
		}
	}

	return apply_filters( 'jtheme_get_doc_desc', $description );
}


function jtheme_get_meta_desc($post_id) {
	$description = '';

	if (is_home()) {
		$description = get_bloginfo( 'description' );
	}
	elseif (is_singular()) {
		if (is_front_page())
			$description = get_bloginfo( 'description' );
		else {
			$description = get_post_meta($post_id, 'jtheme_meta_description', true);
			if(empty($description)){
				$description = get_post_field( 'post_excerpt', get_queried_object_id() );
			
				if(empty($description) && function_exists('mb_strimwidth')) {
					$content = get_post_field( 'post_content', get_queried_object_id() );
					$content = strip_shortcodes($content);
					$content = strip_tags($content);
					$description = mb_strimwidth($content, 0, 200, '');
				}
			}
		}
		
	}
	elseif ( is_archive() ) {
		if ( is_author() ) {
			$description = get_the_author_meta( 'description', get_query_var( 'author' ) );
		}
		elseif ( is_category() || is_tag() || is_tax() )
			$description = term_description( '', get_query_var( 'taxonomy' ) );
		elseif ( is_post_type_archive() ) {
			$post_type = get_post_type_object( get_query_var( 'post_type' ) );
			if ( isset( $post_type->description ) )
				$description = $post_type->description;
		}
	}

	return apply_filters( 'jtheme_get_meta_desc', $description );
}
 
 
/**
 * Meta description
 */
function jtheme_meta_description($post_id) {
	$description = jtheme_get_meta_desc($post_id);
	
	if ( !empty( $description ) )
		$description = '<meta name="description" content="' . str_replace( array( "\r", "\n", "\t" ), '', esc_attr( strip_tags( $description ) ) ) . '" />' . "\n";

	echo apply_filters( 'jtheme_meta_description', $description );
}

/**
 * Generates meta keywords/tags for the site.
 */
function jtheme_meta_keywords($post_id) {
	$keywords = '';

	if ( is_singular() && !is_preview() ) {
		
		$keywords = get_post_meta($post_id, 'jtheme_meta_keywords', true);
			if(empty($keywords)){
			$post = get_queried_object();
			$taxonomies = get_object_taxonomies( $post->post_type );
			if ( is_array( $taxonomies ) ) {
				foreach ( $taxonomies as $tax ) {
					if ( $terms = get_the_term_list( get_queried_object_id(), $tax, '', ', ', '' ) )
						$keywords[] = $terms;
				}
				if ( !empty( $keywords ) )
					$keywords = join( ', ', $keywords );
			}
		}
	}

	if(!empty($keywords))
		$keywords = '<meta name="keywords" content="' . esc_attr( strip_tags( $keywords ) ) . '" />' . "\n";

	echo apply_filters( 'jtheme_meta_keywords', $keywords );
} 
/**
 * Sidebar Position.
 */
function jtheme_sidebar_position() {
	$sidebarPos =  get_option('jtheme_sidebar_pos');
	if($sidebarPos == 'left'){
		?>
			<style>
				#content{
					float:right !important;
				}
				.loop-content{
					padding-left: 13px !important;
					padding-right: 0px !important;
				}
				#content .loop-actions, .single-post #content {
					padding-left: 13px !important;
					padding-right: 0px !important;
				}
				#sidebar {
					float:left !important;
				}
				#sidebar .widget{
					padding-left: 0px !important;
					padding-right: 15px !important;
				}
			</style>
		<?php
	}
}
/**
 * Generates meta Title for the site.
 */
function jtheme_meta_title($post_id) {
	$title = '';

	if ( is_singular() && !is_preview() ) {
		
		$title = get_post_meta($post_id, 'jtheme_meta_title', true);
		if(!empty($title)){
			?>
				<title><?php echo $title; ?></title>
			<?php
			}elseif(empty($title)){
			?>
				<title><?php wp_title( '|', true, 'right' ); ?></title>
			<?php
			}
			
		
	}else{
	?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php
	}

} 

/**
 * Get Video Thumbnail URL
 *
 * @param string $size Optional. Image size. Defaults to 'custom-medium';.
 */ 
function jtheme_thumb_url($size = 'custom-medium', $default = '', $post_id = null, $echo = false){
	global $post;
	
	if(!$post_id)
		$post_id = $post->ID;
	if(!$size)
		$size == 'custom-medium';
	
	/* Check if this video has a feature image */
	if(has_post_thumbnail() && $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size))
		$thumb_url = $thumb[0];

	/* If no feature image, try to get thumbnail by "Video Thumbnails" plugin */
	if(empty($thumb_url) && function_exists('get_video_thumbnail')) {
		$video_thumbnail = get_video_thumbnail($post_id);
		if(!is_wp_error($video_thumbnail))
			$thumb_url = $video_thumbnail;
	}

	/* If this is a video by jplayer, try to get thumbnail from video_posts */
	if(empty($thumb_url) && $poster = get_post_meta($post_id, 'jtheme_video_poster', true))
		$thumb_url = $poster;
	
	/* If still no image or is wp error, define default image */
	if(empty($thumb_url) || is_wp_error($thumb_url)) {
		if($default === false || $default === 0)
			return false;
		
		$thumb_url = !empty($default) ? $default : get_template_directory_uri().'/images/nothumb.png';
	}
		
	if($echo)
		echo $thumb_url;
	else
		return $thumb_url;
} 
 
/**
 * Display Video Thumbnail HTML
 *
 * @param int $size Optional. Image size. Defaults to 'custom-medium';.
 */
function jtheme_thumb_html($size = 'custom-medium', $default = '', $post_id = null, $echo = true) {
	global $post;
	
	if(!$post_id)
		$post_id = $post->ID;
	if(!$size)
		$size == 'custom-medium';
	
	// Get thumb url
	$thumb_url = jtheme_thumb_url($size, $default, $post_id, false);

	$html = '
	<div class="thumb">
		<a class="clip-link" data-id="'.$post->ID.'" title="'.esc_attr(get_the_title($post_id)).'" href="'.get_permalink($post_id).'">
			<span class="clip">
				<img src="'.$thumb_url.'" alt="'.esc_attr(get_the_title($post_id)).'" /><span class="vertical-align"></span>
			</span>
							
			<span class="overlay"></span>
		</a>
	</div>';
	
	if($echo)
		echo $html;
	else
		return $html;
}

function jtheme_thumb_html_hori($size = 'custom-medium', $default = '', $post_id = null, $echo = true) {
	global $post;
	
	if(!$post_id)
		$post_id = $post->ID;
	if(!$size)
		$size == 'custom-medium';
	
	// Get thumb url
	$thumb_url = jtheme_thumb_url($size, $default, $post_id, false);

	$html = '
	<div class="thumb">
		<a class="clip-link" data-id="'.$post->ID.'" title="'.esc_attr(get_the_title($post_id)).'" href="'.get_permalink($post_id).'">
			<span class="clip">
				<img src="'.$thumb_url.'" alt="'.esc_attr(get_the_title($post_id)).'" /><span class="vertical-align"></span>
			</span>
							
			<span class="overlay"></span>
		</a>
		<div class="hori-like">
			<p class="stats">'.jtheme_get_post_stats().'</p>
		</div>
	</div>';
	
	if($echo)
		echo $html;
	else
		return $html;
} 

 
function jtheme_thumb_html_single($size = 'custom-medium', $default = '', $post_id = null, $echo = true) {
	global $post;
	
	if(!$post_id)
		$post_id = $post->ID;
	if(!$size)
		$size == 'custom-medium';
	
	// Get thumb url
	
	if ( has_post_thumbnail($post_id)) {
	$thumb_url = jtheme_thumb_url($size, $default, $post_id, false);
		$html = '
	<div class="thumb">
		<div class="clip-link">
			<span class="clip">
				<img src="'.$thumb_url.'" alt="'.esc_attr(get_the_title($post_id)).'" /><span class="vertical-align"></span>
			</span>
							
			
		</div>
		
	</div>';
				
	}else{
	$thumb_url = get_template_directory_uri().'/images/nothumb.png';
	$html = '
	<div class="thumb">
		<div class="clip-link">
			<span class="clip">
				<img style="width:82%" src="'.$thumb_url.'" alt="'.esc_attr(get_the_title($post_id)).'" /><span class="vertical-align"></span>
			</span>
							
			
		</div>		
	</div>';
	}
	
	
	if($echo)
		echo $html;
	else
		return $html;
}

/**
 * Display post excerpt
 *
 * @since 1.2.3
 */
function jtheme_excerpt($length = 220, $echo = true){
	global $post;
	$excerpt = strip_shortcodes($post->post_excerpt);
	
	if(!$excerpt)
		$excerpt = mb_strimwidth(strip_tags(strip_shortcodes(get_the_content(''))), 0, $length, '...');
	
	if($echo)
		echo $excerpt;
	else
		return $excerpt;
}
 
/**
 * Output a Section Box
 * 
 *  1.0
 */
function jtheme_section_box($args = array()) {
	$defaults = array(
		'post_type' => 'post',
		'cat' => '',
		'taxonomies' => array(),
		'view' => 'grid-small',
		'title' => '',
		'link' => '',
		'post__in' => '',
		'posts_per_page' => '',
		'hide_if_empty' => false
	);
	$args = wp_parse_args($args, $defaults);
	extract($args);
	
	$posts_per_page = absint($posts_per_page);
	// Set default posts number if no specified
	if(empty($posts_per_page)) {
		if($view == 'grid-mini')
			$posts_per_page = 8;
		elseif($view == 'grid-small')
			$posts_per_page = 6;
		elseif($view == 'grid-medium')
			$posts_per_page = 4;
		elseif($view == 'list-small')
			$posts_per_page = 3;
		elseif($view == 'list-medium')
			$posts_per_page = 2;
		elseif($view == 'list-large')
			$posts_per_page = 1;
	}
	$args['posts_per_page'] = $posts_per_page;
	
	$args = jtheme_parse_query_args($args);
	$query = new WP_Query($args);
	
	// Output nothing if there is no posts
	if(!$query->have_posts() && $hide_if_empty)
		return;
	
	// Output content before section
	if(!empty($before))
		echo '<div class="section-box section-before rich-content">'. do_shortcode(wp_kses_stripslashes($before)).'</div><!-- end .section-box -->';
	
	// Section box begin
	echo '<div class="section-box">';
		
	global $section_view;	
	$section_view = $view;
				
	// Get term name as title
	$term = '';
	$cat = '';
	if(!empty($taxonomies['category'])) 
		$cat = $taxonomies['category'];
	if($cat)
		$term = get_term($cat, 'category');
	if(empty($title) && $term)
		$title = $term->name;
	if(empty($link) && $term)
		$link = get_term_link($term, 'category');
				
	$title = '<span class="name">'.$title.'</span>';
				
	// Add link to title and more
	$more = '';
	if($link) {
		$title = '<a class="name-link" href="'.$link.'">'.$title.'</a>';
		$more = '<div class="view-all"><a class="more-link" href="'.$link.'"><span>'.__('View All', 'jtheme').' </span></a></div>';
	}
				
	// Output section header
	echo '<div class="section-header"><h2 class="section-title">'.$title.'</h2></div>';
				
	// Output section content
	echo '<div class="section-content '.$view.'"><div class="nag cf">';
	while ($query->have_posts()) : $query->the_post();
		get_template_part('item-video');
	endwhile;
	
	wp_reset_postdata();
	
	echo '</div>';
	
	echo $more.'</div><!-- end .section-content -->';
	
	// End section box
	echo '</div><!-- end .section-box -->';
				
	// Output content after section
	if(!empty($after))
		echo '<div class="section-box section-after rich-content">'. do_shortcode(wp_kses_stripslashes($after)).'</div><!-- end .section-box -->';
}

/**
 * Output Likes page button
 * 
 *  1.4
 */
function jtheme_likes_page_button() {	
	if(get_option('jtheme_header_likes') && $likes_page_id = get_option('jtheme_post_likes_page')) {
		$jtheme_post_likes = get_option('jtheme_post_likes');
		$login_required = !empty($jtheme_post_likes['login_required']) ? true : false;
		if(!is_user_logged_in() && $login_required)
			return false;
			
		echo '<a class="btn btn-likes btn-red" href="'.get_permalink($likes_page_id).'">'.get_the_title($likes_page_id).'</a>';
	}
}
/**
 * Output Account button
 * 
 *  1.4
 */
function jtheme_account_button() { 
	if(!is_user_logged_in() || !get_option('jtheme_header_account'))
		return;
		
	$user_id = get_current_user_id();
	$current_user = wp_get_current_user();
	$profile_url = get_author_posts_url($user_id);
	$edit_profile_url  = get_edit_profile_url($user_id);
	$current_url = get_current_url(); ?>
	<div id="account-nav" class="user-nav">
		<a class="dropdown-handle" href="<?php echo $profile_url; ?>">
			<?php echo get_avatar( $user_id, 32 ); ?>
			<span class="display-name btn">
				<span class="arrow-down"><?php echo $current_user->display_name; ?></span> 
				<i class="mini-arrow-down"></i>
			</span>
		</a>
					
		<div class="dropdown-content">
			<ul class="dropdown-content-inner">
				<li><a class="profile-link" href="<?php echo $profile_url; ?>"><?php _e('Profile', 'jtheme'); ?></a></li>
				<li><a class="account-link" href="<?php echo $edit_profile_url; ?>"><?php _e('Account', 'jtheme'); ?></a></li>
				<li><a class="logout-link" href="<?php echo esc_url(wp_logout_url($current_url)); ?>"><?php _e('Log out', 'jtheme'); ?></a></li>
			</ul>
		</div>
	</div><!-- end #account-nav -->
<?php }
 
/**
 * Output Sign up button
 * 
 *  1.4
 */
function jtheme_signup_button() { 
	if(!is_user_logged_in() && get_option('users_can_register') && get_option('jtheme_header_signup')) {
		echo '<a class="btn btn-green btn-signup" href="'.site_url('wp-login.php?action=register', 'login').'">'.__('Sign up', 'jtheme').'</a>';
	}
	
	return;
}

/**
 * Output Log in button
 * 
 *  1.4
 */
function jtheme_login_button() {
	if(is_user_logged_in() || !get_option('jtheme_header_login'))
		return; ?>
		
	<div id="login-nav" class="user-nav">
			<div class="dropdown">
				<a class="dropdown-handle btn btn-black btn-login" href="<?php echo wp_login_url(); ?>"><?php _e('Log In', 'jtheme'); ?></a>
					
				<div class="dropdown-content"><div class="dropdown-content-inner">
					<?php wp_login_form(); ?>
				</div></div>
			</div>
		</div><!-- end #login-nav -->
<?php }
	

/**
 * Output AddThis Button Code
 * 
 *  1.0
 */
function jtheme_addthis($args = array()) { 
	$defaults = array(
		'post_id' => 0,
		'url' => '',
		'title' => ''
	);
	$args = wp_parse_args($args, $defaults);
	extract($args);
		
	if(empty($url))
		$url = wp_get_shortlink($post_id, 'post'); 
	if(empty($title) && $post_id)
		$title = get_the_title($post_id);
	?>
	<?php 
		$params = array();
		if($url) 
			$params[] = "addthis:url='".esc_url($url)."'";
		if($title) 
			$params[] = "addthis:title='".esc_attr($title)."'";
	?>
	<div class="addthis_toolbox addthis_default_style" <?php echo implode(' ', $params); ?>>
		<ul>
			<li><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a></li>
			<li><a class="addthis_button_tweet"></a></li>
			<li><a class="addthis_button_google_plusone" g:plusone:size="medium"></a></li>
			<li><a class="addthis_button_pinterest_pinit"></a></li>
			<li><a class="addthis_counter addthis_pill_style"></a></li>
		</ul>
	</div>
<?php } 

// Load AddThis js file in footer once
add_action('wp_footer', 'jtheme_addthis_js', 1);
function jtheme_addthis_js() {
	if(!get_option('jtheme_addthis'))
		return;
	
	$protocol = is_ssl() ? 'https' : 'http';
	$pubid = get_option('jtheme_addthis_pubid');
	$file = $protocol.'://s7.addthis.com/js/300/addthis_widget.js';
	$file .= !empty($pubid) ? '#pubid='.$pubid : '';
	//wp_enqueue_script('addthis', $file, '', null, true);
}

function jtheme_post_actions($post_id){ ?>
	<div class="entry-actions">
		<?php jtheme_like_post($post_id); ?>		
	</div>
<?php }

/**
 * Get post stats(views/comments/likes)
 *
 *  1.0
 */
function jtheme_get_post_stats($pid = '') {
	global $post;
	if(!$pid)
		$pid = $post->ID;
	if(!$pid)
		return;
	
	$views = sprintf(__('%s <span class="suffix"></span>', 'jtheme'), '<i class="count">'.jtheme_get_post_views($pid).'</i>');
	$comments = sprintf(__('%s <span class="suffix"></span>', 'jtheme'), '<i class="count">'.get_comments_number($pid).'</i>');
	$likes = sprintf(__('%s <span class="suffix"></span>', 'jtheme'), '<i class="count" data-pid="'.$pid.'">'.jtheme_get_post_likes($pid).'</i>');
	
	$liked = jtheme_is_user_liked_post($pid) ? ' liked': '';
				
	$stats = '<span class="views">'.$views.'</span>';
	$stats .= '<span class="comments">'.$comments.'</span>';
	$stats .= '<span class="jtheme-post-likes likes'.$liked.'">'.$likes.'</span>';
	
	return $stats;
}

function jtheme_get_post_stats_new($pid = '') {
	global $post;
	if(!$pid)
		$pid = $post->ID;
	if(!$pid)
		return;
	
	$views = sprintf(__('%s <span class="suffix">Views</span>', 'jtheme'), '<i class="count">'.jtheme_get_post_views($pid).'</i>');
	$comments = sprintf(__('%s <span class="suffix">Comments</span>', 'jtheme'), '<i class="count">'.get_comments_number($pid).'</i>');
	$likes = sprintf(__('%s <span class="suffix">Likes</span>', 'jtheme'), '<i class="count" data-pid="'.$pid.'">'.jtheme_get_post_likes($pid).'</i>');
	
	$liked = jtheme_is_user_liked_post($pid) ? ' liked': '';
				
	$stats = '<span class="views">'.$views.'</span>';
	
	return $stats;
}


/**
 * Related Posts
 *
 * @since 1.0
 */
function jtheme_related_posts($args = '') {
	global $post;
	
	$query_args = array();

	$defaults = array(
		'view' => 'grid-mini',
		'number' => 0,
		'fields' => '' // object, html or leave it blank
	);
	$args = wp_parse_args($args, $defaults);
	extract($args);
	
	// Only displayed on singular post pages
	if(!is_singular())
		return;

	// Check limited number
	if(!$number)
		return;
	
	// Check taxonomies
	$taxes = get_post_taxonomies($post->ID);
	
	if(empty($taxes))
		return;
	
	$taxes = array_unique(array_merge(array('post_tag', 'category'), $taxes));
	
	$tax_query = array();
	$in_tax_query_array = array();
	$and_tax_query_array = array();
	
	foreach($taxes as $tax) {
		if($tax == 'post_format') {
			// Post format
			$post_format = get_post_format($post->ID);
			if(!$post_format) $post_format = 'standard';
			$post_format_query_array = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => 'post-format-'.$post_format,
				'operator' => 'IN'
			);
	
			continue;
		}
		
		$terms = get_the_terms($post->ID, $tax);
			
		if(empty($terms))
			continue;
		$term_ids = array();
		foreach($terms as $term)
			$term_ids[] = $term->term_id;
		
		$in_tax_query_array[$tax] = array(
			'taxonomy' => $tax,
			'field' => 'id',
			'terms' => $term_ids,
			'operator' => 'IN'
		);
		
		$and_tax_query_array[$tax] = array(
			'taxonomy' => $tax,
			'field' => 'id',
			'terms' => $term_ids,
			'operator' => 'AND'
		);
	}
	
	if(empty($in_tax_query_array) && empty($and_tax_query_array))
		return;		
	
	$query_args = array(
		'post_type' => get_post_type($post->ID),
		'ignore_sticky_posts' => true, 
		'posts_per_page' => $number
	);
	
	$current_post_id = $post->ID;
	$found_posts = array();
	
	// Multiple Taxonomy Query: relation = AND, operator = AND
	$query_args['tax_query'] = $and_tax_query_array;
	$query_args['tax_query'][] = $post_format_query_array;
	$query_args['tax_query']['relation'] = 'AND';
	$query_args['post__not_in'] = array($post->ID);
	$related = new WP_Query($query_args); 
	foreach($related->posts as $post)
		$found_posts[] = $post->ID;
		
	// Multiple Taxonomy Query: relation = AND, operator = IN
	if(count($found_posts) < $number) {
		$query_args['tax_query'] = $in_tax_query_array;
		$query_args['tax_query'][] = $post_format_query_array;
		$query_args['tax_query']['relation'] = 'AND';
		$query_args['post__not_in'] = array_merge(array($current_post_id), $found_posts);
		$related = new WP_Query($query_args); 
		foreach($related->posts as $post)
			$found_posts[] = $post->ID;
	}
	
	$post_format_query = array(
		'taxonomy' => 'post_format',
		'field' => 'slug',
		'terms' => get_post_format(),
		'operator' => 'IN'
	);
	
	// Foreach Each Taxonomy Query: operator = AND
	if(count($found_posts) < $number) {
		
		foreach($and_tax_query_array as $and_tax_query) {
			$query_args['tax_query'] = array($and_tax_query);
			$query_args['tax_query'][] = $post_format_query_array;
			$query_args['tax_query']['relation'] = 'AND';
			$query_args['post__not_in'] = array_merge(array($current_post_id), $found_posts);
			$related = new WP_Query($query_args);
			foreach($related->posts as $post)
				$found_posts[] = $post->ID;
			
			if(count($found_posts) > $number)
				break;
		}
	}

	// Foreach Each Taxonomy Query: operator = IN
	if(count($found_posts) < $number) {
		
		foreach($in_tax_query_array as $in_tax_query) {
			$query_args['tax_query'] = array($in_tax_query);
			$query_args['tax_query'][] = $post_format_query_array;
			$query_args['tax_query']['relation'] = 'AND';
			$query_args['post__not_in'] = array_merge(array($current_post_id), $found_posts);
			$related = new WP_Query($query_args);
			foreach($related->posts as $post)
				$found_posts[] = $post->ID;
			
			if(count($found_posts) > $number)
				break;
		}
	}

	if(empty($found_posts))
		return;
		
	$query_args['tax_query'] = '';
	$query_args['post__in'] = $found_posts;
	$related = new WP_Query($query_args);
	
	if($fields == 'object')
		return $related;
	
	if(!empty($args['template']) && is_callable($args['template'])) {
		call_user_func($args['template'], $related);
		return;
	}
	?>
	
	<div class="section-box related-posts">
		<div class="section-header"><h3 class="section-title"><?php _e('You may also like', 'jtheme') ?></h3></div>
			
		<div class="section-content <?php echo $view; ?>"><div class="nag cf">
			<?php if( $related->have_posts() ) : while( $related->have_posts() ) : $related->the_post(); 
			global $post;
			global $section_view;
			$section_view = 'grid-mini';
			get_template_part('item-video');
			endwhile; endif; wp_reset_query(); ?>
		</div></div>
	</div><!-- end .related-posts -->
<?php }

/**
 * Custom Comment Form
 *
 * @since 1.0
 */
function jtheme_comment_form( $args = array(), $post_id = null ) {
	global $id;

	if ( null === $post_id )
		$post_id = $id;
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = ! empty( $user->ID ) ? $user->display_name : '';

	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'jtheme' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'jtheme' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'jtheme' ) . '</label>' .
		            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);

	$required_text = sprintf( ' ' . __('Required fields are marked %s', 'jtheme'), '<span class="required">*</span>' );
	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'jtheme') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'jtheme' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', 'jtheme' ) . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'jtheme' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a Reply', 'jtheme' ),
		'title_reply_to'       => __( 'Leave a Reply to %s', 'jtheme' ),
		'cancel_reply_link'    => __( 'Cancel reply', 'jtheme' ),
		'label_submit'         => __( 'Post Comment', 'jtheme' ),
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open() ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<div id="respond" class="cf">
				<div  class="section-header"><h3 id="reply-title" class="section-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3></div>
				
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
						<?php do_action( 'comment_form_top' ); ?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
							<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
						<?php else : ?>
							<?php echo $args['comment_notes_before']; ?>
							<?php
							do_action( 'comment_form_before_fields' );
							foreach ( (array) $args['fields'] as $name => $field ) {
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
						<?php echo $args['comment_notes_after']; ?>
						<p class="form-submit">
							<input name="submit" class="btn btn-black" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
							<?php comment_id_fields( $post_id ); ?>
						</p>
						<?php do_action( 'comment_form', $post_id ); ?>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
	<?php
} 
 
/**
 * Custom Comment Callback
 *
 * @since 1.0
 */
function jtheme_comment_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class('cf'); ?> id="comment-<?php comment_ID() ?>">
		<div id="comment-div-<?php comment_ID() ?>" class="comment-div cf">
		<div class="comment-inner">
			<?php if ($args['avatar_size'] != 0) echo '<div class="comment-avatar"><img src="', get_template_directory_uri() . '/images/gravatar.png" /></div>'; ?>

			<div class="comment-meta">
				<span class="comment-author"><?php printf(__('<cite class="fn">%s</cite>', 'jtheme'), get_comment_author_link()) ?></span>
				<a class="comment-time" href="<?php echo '#comment-'.$comment->comment_ID; ?>"><?php printf(__('%s ago', 'jtheme'), relative_time(get_comment_time('U', true))); ?></a>
				<?php edit_comment_link(__('Edit', 'jtheme'),' <span class="sep">/</span> ','' ); ?>
			</div>

			<div class="comment-content">
				<?php if ($comment->comment_approved == '0') : ?>
					<p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'jtheme') ?></p>
				<?php endif; ?>
		
				<?php comment_text(); ?>
			</div>
			
			<div class="comment-actions">
				<?php comment_reply_link(array_merge( $args, array('add_below' => 'comment-div', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		</div>
		</div><!-- end .comment-div -->
<?php }

/**
 * Custom Ping callback
 *
 *  1.0
 */
function jtheme_ping_callback($comment, $args, $depth ) { ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<?php comment_author_link(); ?> <span class="meta"><?php comment_date(); ?></span>
<?php 
}

/* Add 'Lost password' link to loginform */
add_filter('login_form_middle', 'lost_password', 10, 2);
function lost_password($html, $args) {
	return '<a class="lost-password" href="'.esc_url( wp_lostpassword_url() ).'">'.__('Lost password?', 'jtheme').'</a>';
}

/**
 * Get views timings
 */
function jtheme_views_timings() {
	$views_timings = array( 
		'all' => __( 'All', 'jtheme' ),
		'day' => __( 'Day', 'jtheme' ),
		'week' => __( 'Week', 'jtheme' ),
		'month' => __( 'Month', 'jtheme' ), 
		'year' => __( 'Year', 'jtheme' )
	);
		
	return $views_timings;
}

/**
 * Get supported sort types
 */
function jtheme_supported_sort_types() {
	$types = array(
		'date' => array(
			'label' => __('Ngày đăng', 'jtheme'),
			'title' => __('Sắp xếp theo Ngày đăng', 'jtheme')
		),
		'title' => array(
			'label' => __('Tên phim', 'jtheme'),
			'title' => __('Sắp xếp theo Tên phim', 'jtheme')
		),
		'views' => array(
			'label' => __('Views', 'jtheme'),
			'title' => __('Sắp xếp theo Views', 'jtheme')
		),
		'likes' => array(
			'label' => __('Likes', 'jtheme'),
			'title' => __('Sắp xếp theo Likes', 'jtheme')
		),
		'comments' => array(
			'label' => __('Comments', 'jtheme'),
			'title' => __('Sắp xếp theo Comments', 'jtheme')
		),
		'rand' => array(
			'label' => __('Random', 'jtheme'),
			'title' => __('Sort Randomly', 'jtheme')
		)
	);
				
	return apply_filters('jtheme_supported_sort_types', $types);
}

/**
 * Get selected sort types
 */
function jtheme_selected_sort_types() {
	$selected_types = get_option('jtheme_sort_types');
	if(empty($selected_types))
		return array();

	$supported_types = jtheme_supported_sort_types();
	foreach($selected_types as $key => $value)
		$selected_types[$key] = $supported_types[$key];

	return apply_filters('jtheme_selected_sort_types', $selected_types);
}

/**
 * Get supported view types
 */
function jtheme_supported_view_types() {
	$types = array(
		'grid-mini' => __('Grid View with Mini Thumbnail', 'jtheme'),
		'grid-small' => __('Grid View with Small Thumbnail', 'jtheme'),
		'grid-medium' => __('Grid View with Medium Thumbnail', 'jtheme'),
		'list-small' => __('List View with Small Thumbnail', 'jtheme'),
		'list-medium' => __('List View with Medium Thumbnail', 'jtheme'),
		'list-large' => __('List View with Large Thumbnail', 'jtheme'),
	);
				
	return apply_filters('jtheme_supported_view_types', $types);
}

/**
 * Get selected view types
 */
function jtheme_selected_view_types() {
	$selected_types = get_option('jtheme_view_types');
	if(empty($selected_types))
		return array();

	$supported_types = jtheme_supported_view_types();
	foreach($selected_types as $key => $value)
		$selected_types[$key] = $supported_types[$key];

	return apply_filters('jtheme_selected_view_types', $selected_types);
}

/* Add custom body class */
add_filter('body_class', 'jtheme_custom_body_class');
function jtheme_custom_body_class($classes) {
	$classes[] = get_option('jtheme_wrap_layout');
	return $classes;
}


if(get_option('jtheme_fb_ogtags'))
	add_action('wp_head', 'jtheme_fb_ogtags');
/**
 * Add Facebook Open Graph Tag to wp_head
 *
 * @since 1.2.3
 */
function jtheme_fb_ogtags(){
	$site_name = esc_attr(get_option('blogname'));
	$type = is_front_page() ? 'website' : 'article';
	$url = get_permalink();
	$title = wp_title( '|', false, 'right' );
	$desc = jtheme_get_doc_desc();
	$image = '';
	$admins = '';
	
	// Get image
        if (is_singular()) {
			global $post;
			
			// Get image by feature image
			$image = jtheme_thumb_url('large', false, $post->ID);
			
			// Get image from post attachments
			if(empty($image) && $images = get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID))
				if (is_array($images) && !empty($images))
					$image = wp_get_attachment_thumb_url(current($images)->ID);
			
			// Get first image from post content
			if(empty($image) && preg_match('/<img[^>]*src=([\'"])(.*?)\\1/i', $post->post_content, $matches))
				$image = $matches[2];
        }
	
	// Generate meta tags
	$nl = "\n";
	$tags = '';
	$tags .= '<meta property="og:site_name" content="'.$site_name.'" />'.$nl;
	$tags .= '<meta property="og:type" content="'.$type.'" />'.$nl;
	$tags .= '<meta property="og:url" content="'.$url.'" />'.$nl;
	if($title)
		$tags .= '<meta property="og:title" content="'.$title.'" />'.$nl;
	if($desc)
		$tags .= '<meta property="og:description" content="'.  esc_attr($desc).'" />'.$nl;
	if($image)
		$tags .= '<meta property="og:image" content="'.$image.'" />'.$nl;
	if($admins)
		$tags .= '<meta property="fb:admins" content="'.esc_attr($admins).'" />'.$nl;

	echo $tags;
}

/**
 * Add Custom CSS file
 * 
 * @since 1.3
 */
add_action('wp_enqueue_scripts', 'jtheme_enqueue_custom_css', 998);
function jtheme_enqueue_custom_css(){
	$custom_css = trailingslashit( get_template_directory() ) . 'custom.css';
	
	if(file_exists($custom_css))
		wp_enqueue_style('custom', trailingslashit( get_template_directory_uri() ) . 'custom.css');
}	



/**
 * Add Custom JS file
 * 
 * @since 1.3
 */
add_action('wp_enqueue_scripts', 'jtheme_enqueue_custom_js', 998);
function jtheme_enqueue_custom_js(){
	$custom_js = trailingslashit( get_template_directory() ) . 'custom.js';

	if(file_exists($custom_js))
		wp_enqueue_script('custom', trailingslashit( get_template_directory_uri() ) . 'custom.js', array('jquery'), '1.0', false, 998 );
}

/**
 * Include custom.php file if it exists
 * 
 * @since 1.3
 */
$custom_php = trailingslashit( get_template_directory() ) . 'custom.php';
if(file_exists($custom_php)) 
	include_once($custom_php);


### Function: Snippet Text
if(!function_exists('snippet_text')) {
	function snippet_text($text, $length = 0) {
		if (defined('MB_OVERLOAD_STRING')) {
		  $text = @html_entity_decode($text, ENT_QUOTES, get_option('blog_charset'));
		 	if (mb_strlen($text) > $length) {
				return htmlentities(mb_substr($text,0,$length), ENT_COMPAT, get_option('blog_charset')).'...';
		 	} else {
				return htmlentities($text, ENT_COMPAT, get_option('blog_charset'));
		 	}
		} else {
			$text = @html_entity_decode($text, ENT_QUOTES, get_option('blog_charset'));
		 	if (strlen($text) > $length) {
				return htmlentities(substr($text,0,$length), ENT_COMPAT, get_option('blog_charset')).'...';
		 	} else {
				return htmlentities($text, ENT_COMPAT, get_option('blog_charset'));
		 	}
		}
	}
}	

function user_template_link(){
	global $wpdb;
	$userTemplateLink = $wpdb->get_results("SELECT `post_id` FROM $wpdb->postmeta WHERE `meta_key` ='_wp_page_template' AND `meta_value` = 'log-reg.php' ", ARRAY_A);
		$FinelLink = get_permalink($userTemplateLink[0]['post_id']);
	return $FinelLink;
}
function menu_fix_on_search_page( $query ) {
    if(is_search()){
        $query->set( 'post_type', array(
         'post', 'nav_menu_item'
            ));
          return $query;
    }
}
add_filter( 'pre_get_posts', 'menu_fix_on_search_page' );

			if (!function_exists('infinite')) {

				function infinite() {
					global $wp_query;
					$pages = intval($wp_query->max_num_pages);
					$paged = (get_query_var('paged')) ? intval(get_query_var('paged')) : 1;
					if (empty($pages)) {
						$pages = 1;
					}
					if (1 != $pages) {
						echo '<div class="jw-pagination jw-infinite-scroll" data-has-next="' . ($paged === $pages ? 'false' : 'true') . '">';
						echo '<a class="btn btn-small no-more" href="#">' . __('No more posts', 'JoinWebs') . '</a>';
						echo '<a class="btn btn-small loading" href="#">' . __('Loading posts ...', 'JoinWebs') . '</a>';
						echo '<a class="btn btn-small next" href="' . get_pagenum_link($paged + 1) . '"><i class="icon-repeat"></i>' . __('Load More', 'JoinWebs') . '</a>';
						echo '</div>';
					}
				}

			}	



function bee_user_avatar( $avatar, $id_or_email, $size, $default, $alt ){
	$bee_profile_pic_id = get_user_meta( $id_or_email, 'bee_profile_pic', true );
	
	if( $bee_profile_pic_id > 0 ){
		$bee_profile_url = wp_get_attachment_url( $bee_profile_pic_id );
	}
	if( $bee_profile_url ){
		$user = false;
		if ( is_numeric( $id_or_email ) ) {
			
        $id = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );
			
        } elseif ( is_object( $id_or_email ) ) {
			
            if ( ! empty( $id_or_email->user_id ) ) {
                $id = (int) $id_or_email->user_id;
                $user = get_user_by( 'id' , $id );
            }
			
    } else {
        $user = get_user_by( 'email', $id_or_email );	
    }
		
    if ( $user && is_object( $user ) ) {
			
        if ( $user->data->ID  > 0 ) {
                $avatar = '<img alt="" src="'.$bee_profile_url.'" class="avatar photo" width="'.$size.'"  />';
        }
			
    }

    return $avatar;
	}
	
}
add_filter( 'get_avatar' , 'bee_user_avatar' , 1 , 5 );
