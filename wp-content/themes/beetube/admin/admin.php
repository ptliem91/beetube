<?php
/*= Theme Options
 *=============================================================================*/
 
/* General Settings
 *=============================================================================*/
class jtheme_General_Settings extends jtheme_Panel {
	function __construct(){
		$this->menu_slug = 'theme-options';
		
		parent::__construct();
	}
	
	function add_menu_pages(){
		$this->page_hook = add_menu_page(__('Theme Options', 'jtheme'), __('Theme Options', 'jtheme'), 'edit_theme_options', $this->menu_slug, array(&$this, 'menu_page'), '', 61);
		add_submenu_page('theme-options', __('General Settings', 'jtheme'), __('General', 'jtheme'), 'edit_theme_options', $this->menu_slug, array(&$this, 'menu_page'));
	}
	
	function add_meta_boxes(){
		add_meta_box( 'jtheme-general-settings', __('General Settings', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'jtheme-custom-labels-settings', __('Custom Labels Settings', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		
		add_meta_box( 'jtheme-design-settings', __('Design Settings', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'jtheme-header-settings', __('Header Settings', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'jtheme-footer-settings', __('Footer Settings', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		
		add_meta_box( 'jtheme-video-settings', __('Video Settings', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'jtheme-home-featured-settings', __('Slider Settings', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'jtheme-archive-settings', __('Archive Pages Settings', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'jtheme-cat-featured-settings', __('Featured Posts Settings', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'jtheme-single-settings', __('Single Post Pages Settings', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		//add_meta_box( 'jtheme-post-likes-settings', __('Post Likes Settings', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'jtheme-fb-comments', __('FB Comments', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'jtheme-hook-settings', __('Hook Settings', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		add_meta_box( 'jtheme-responsive-settings', __('Responsive Settings', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		
	}
	
	function fields(){
		$supported_view_types = jtheme_supported_view_types();
		$fields = array(
			// Fields for Archive Settings
			'jtheme-archive-settings' => array(
				array(
					'type' => 'description',
					'value' => __('These settings determine how to display content on archive pages.', 'jtheme')
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_loop_actions_status',
					'value' => true,
					'title' => __('Loop Actions', 'jtheme'),
					'label' => __('Check this to show "Loop Actions" bar', 'jtheme')
				),
				array(
					'name' => 'jtheme_sort_types_order'
				),
				array(
					'name' => 'jtheme_sort_types',
					'callback' => 'jtheme_sort_types_settings',
					'value' => jtheme_supported_sort_types()
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_sort_order',
					'value' => true,
					'title' => __('Sort Order', 'jtheme'),
					'label' => __('Check this to show ASC/DESC order', 'jtheme')
				),
				array(
					'name' => 'jtheme_view_types_order'
				),
				array(
					'name' => 'jtheme_view_types',
					'callback' => 'jtheme_view_types_settings',
					'value' => jtheme_supported_view_types()
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_archive_ajaxload',
					'value' => true,
					'title' => __('Ajaxload', 'jtheme'),
					'label' => __('Check this to enble Ajax video on archive pages (Only works with "List Large" view)', 'jtheme')
				)
			),
			
			// Fields for Category Featured Settings
			'jtheme-cat-featured-settings' => array(
				array(
					'name' => 'jtheme_cat_featured',
					'callback' => 'jtheme_cat_featured_settings'
				),
				array(
					'name' => 'jtheme_cat_featured_footer',
					'callback' => 'jtheme_cat_featured_footer_settings'
				),
				array(
					'name' => 'jtheme_cat_featured[posts_per_page]',
					'value' => 15
				),
				array(
					'name' => 'jtheme_cat_featured_footer[posts_per_page]',
					'value' => 15
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_index_status',
					'title' => __('Show on Index page', 'jtheme'),
					'label' => __('check this to Show Featured videos on index page', 'jtheme'),
					'value' => true
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_category_status',
					'title' => __('Show on Category Pages', 'jtheme'),
					'label' => __('check this to Show Featured videos on Category Pages', 'jtheme'),
					'value' => true
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_landingpage_status',
					'title' => __('Show on Landing Page template', 'jtheme'),
					'label' => __('check this to Show Featured videos on Landing Page template', 'jtheme'),
					'value' => true
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_single_stand_status',
					'title' => __('Show on Single Page Standard', 'jtheme'),
					'label' => __('check this to Show Featured videos on Single Video Pages', 'jtheme'),
					'value' => true
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_single_fulltop_status',
					'title' => __('Show on Single Page Full-Width Top', 'jtheme'),
					'label' => __('check this to Show Featured videos on Single Page Full-Width before the video', 'jtheme'),
					'value' => true
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_single_fullmid_status',
					'title' => __('Show on Single Page Full-Width MID', 'jtheme'),
					'label' => __('check this to Show Featured videos on Single Page Full-Width after the video', 'jtheme'),
					'value' => true
				),
			),
			
			// Fields for Custom Labels Settings
			'jtheme-custom-labels-settings' => array(
				array(
					'type' => 'description',
					'value' => __("These settings enable you to change the labels of Wordpress built-in post type 'post', to 'Videos', or whatever you want to name it.", 'jtheme')
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_post_labels_status',
					'title' => __('Custom Labels', 'jtheme'),
					'label' => __('check this to enable custom labels for post type "post"?', 'jtheme'),
					'value' => false
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_post_labels[name]',
					'title' => __('name', 'jtheme'),
					'value' => __('Videos', 'jtheme')
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_post_labels[singular_name]',
					'title' => __('singular_name', 'jtheme'),
					'value' => __('Video', 'jtheme')
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_post_labels[add_new]',
					'title' => __('add_new', 'jtheme'),
					'value' => __('Add New', 'jtheme')
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_post_labels[add_new_item]',
					'title' => __('add_new_item', 'jtheme'),
					'value' => __('Add New Video', 'jtheme')
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_post_labels[edit_item]',
					'title' => __('edit_item', 'jtheme'),
					'value' => __('Edit Video', 'jtheme')
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_post_labels[new_item]',
					'title' => __('new_item', 'jtheme'),
					'value' => __('New Video', 'jtheme')
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_post_labels[all_items]',
					'title' => __('all_items', 'jtheme'),
					'value' => __('All Videos', 'jtheme')
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_post_labels[view_item]',
					'title' => __('view_item', 'jtheme'),
					'value' => __('View Video', 'jtheme')
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_post_labels[search_items]',
					'title' => __('search_items', 'jtheme'),
					'value' => __('Search Videos', 'jtheme')
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_post_labels[not_found]',
					'title' => __('not_found', 'jtheme'),
					'value' => __('No videos found.', 'jtheme')
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_post_labels[not_found_in_trash]',
					'title' => __('not_found_in_trash', 'jtheme'),
					'value' => __('No videos found in Trash.', 'jtheme')
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_post_labels[menu_name]',
					'title' => __('menu_name', 'jtheme'),
					'value' => __('Videos', 'jtheme')
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_post_labels[name_admin_bar]',
					'title' => __('name_admin_bar', 'jtheme'),
					'value' => __('Video', 'jtheme')
				)
			),
			'jtheme-video-settings' => array(
				array(
					'type' => 'select',
					'name' => 'jtheme_default_player[video_file]',
					'value' => 'mediaelement',
					'options' => array(
						'mediaelement' => __('MediaElement (Wordpress Default Player)', 'jtheme'), 
						'jplayer' => __('jPlayer', 'jtheme'), 
					),
					'title' => __('Default Player for Video File', 'jtheme'),
				),
				array(
					'type' => 'select',
					'name' => 'jtheme_video_or_thumb',
					'value' => 'thumb',
					'options' => array(
						'thumb' => __('Show thumbnail in listing', 'jtheme'), 
						'video' => __('Show videos in listing', 'jtheme'), 
					),
					'title' => __('Select Video/Thumbnail to show in listing', 'jtheme'),
				),
				/*array(
					'type' => 'select',
					'name' => 'jtheme_jplayer[ratio]',
					'value' => '16:9',
					'options' => jtheme_jplayer_ratio(),
					'title' => __('Size', 'jtheme'),
				),*/
			),
			// Fields for General Settings
			'jtheme-general-settings' => array(
				array(
					'type' => 'select',
					'name' => 'jtheme_logo_type',
					'value' => 'image',
					'options' => array(
						'text' => __('Text Logo', 'jtheme'), 
						'image' => __('Image Logo', 'jtheme')
					),
					'title' => __('Logo Type', 'jtheme'),
				),
				array(
					'type' => 'upload',
					'name' => 'jtheme_logo',
					'title' => __('Image Logo', 'jtheme'),
					'desc' => __( 'Upload a logo for your theme, or specify the image url of your online logo.', 'jtheme'),
					'value' => get_template_directory_uri().'/images/logo.png'
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_site_description',
					'title' => __('Tagline', 'jtheme'),
					'label' => __( 'Show site tagline?', 'jtheme')
				),
				array(
					'type' => 'upload',
					'name' => 'jtheme_favicon',
					'title' => __('Favicon', 'jtheme'),
					'desc' => __( 'Upload a 16px x 16px PNG/GIF image that will represent your website\'s favicon.', 'jtheme'),
					'value' => get_template_directory_uri().'/images/favicon.ico'
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_loader',
					'title' => __('Loader', 'jtheme'),
					'label' => __( 'Check this box to enable loader', 'jtheme'),
					'value' => true
					
				),		
				array(
					'type' => 'upload',
					'name' => 'jtheme_loader_img',
					'title' => __('Loader Image', 'jtheme'),
					'desc' => __( 'Upload a GIF animated image which will show before loading page.', 'jtheme'),
					'value' => get_template_directory_uri().'/images/loading.gif'
				),
				array(
					'type' => 'custom',
					'title' => __('Main Navigation', 'jtheme'),
					'label' => __('Check this to enable footer navigation in footer area.', 'jtheme'),
					'desc' => sprintf(__('By default, the main navigation is a list of your categories, if your want to customize it, add a menu on <a href="%s">Apperance->Menus</a> page and set this menu as "Main Navigation" in "Theme Location" box.', 'jtheme'), admin_url('nav-menus.php')),
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_social',
					'title' => __('Social share Enable Disable', 'jtheme'),
					'label' => __( 'Check this box to enable Social share on single video page buttons', 'jtheme'),
					'value' => true
					
				),	
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_seo_metaon',
					'title' => __('SEO meta on/off', 'jtheme'),
					'label' => __( 'Check this box to enable SEO meta on/off on front--end posting', 'jtheme'),
					'value' => true
					
				),	
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_featured_imageon',
					'title' => __('Featured image on/off', 'jtheme'),
					'label' => __( 'Check this box to enable Featured image on/off', 'jtheme'),
					'value' => true
					
				),	
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_user_login',
					'title' => __('User Login Enable Disable', 'jtheme'),
					'label' => __( 'Check this box to enable User Login System', 'jtheme'),
					'value' => true
					
				),	
				array(
					'type' => 'text',
					'name' => 'jtheme_index_vlimit',
					'title' => __('Simple HomePage Videos', 'jtheme'),
					'desc' => __( "Put here How much Videos You want to show on index page", 'jtheme'),
					'value' => 12,
					'class' => 'small-text'
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_index_cat',
					'title' => __('Special Catgorey for Simple HomePage', 'jtheme'),
					'desc' => __( "Put here Category ID That category videos Will Show on Simple HomePage Example: 2, If YOU will leave it empty then randomly latest videos will show on index page ", 'jtheme'),
					'value' => '',
					'class' => 'small-text'
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_index_nav',
					'title' => __('Infinite scroll Pagination Enable', 'jtheme'),
					'label' => __( 'Check this box to enable Pagination on Simple HomePage', 'jtheme'),
					'value' => false
					
				),	
				array(
					'type' => 'select',
					'name' => 'jtheme_index_sort',
					'value' => 'viewed',
					'options' => array(
						'views' => __('Most Viewed', 'jtheme'), 
						'liked' => __('Most Liked', 'jtheme')
					),
					'title' => __('Sort Videos Simple HomePage', 'jtheme'),
					'desc' => __( "Select any option to show your videos as on Simple HomePage", 'jtheme')
				),
				array(
					'type' => 'select',
					'name' => 'jtheme_sidebar_pos',
					'value' => 'right',
					'options' => array(
						'right' => __('Right Side', 'jtheme'), 
						'left' => __('Left Side', 'jtheme')
					),
					'title' => __('Sidebar position', 'jtheme'),
					'desc' => __( "Select any option to show Sidebar position", 'jtheme')
				),
				array(
					'type' => 'select',
					'name' => 'jtheme_auto_grid',
					'value' => 'grid-medium',
					'options' => array(
						'grid-mini' => __('Grid View with Mini Thumbnail', 'jtheme'),
						'grid-small' => __('Grid View with Small Thumbnail', 'jtheme'),
						'grid-medium' => __('Grid View with Medium Thumbnail', 'jtheme'),
						'list-small' => __('List View with Small Thumbnail', 'jtheme'),
						'list-medium' => __('List View with Medium Thumbnail', 'jtheme'),
						'list-large' => __('List View with Large Thumbnail', 'jtheme'),
					),
					'title' => __('Auto Selection for Grid System', 'jtheme'),
					'desc' => __( "Select any option to show your Auto Selection for Grid System", 'jtheme')
				),
				array(
					'type' => 'textarea',
					'name' => 'jtheme_bottom_adcode',
					'title' => __('AD Code For Bottom Ad', 'jtheme'),
					'desc' => __( "Put Here Your ad code you ad height and with should be 728x90 ", 'jtheme'),
					'value' => '',					
				),
				array(
					'type' => 'upload',
					'name' => 'jtheme_bottom_adimg',
					'title' => __('Upload Image For Bottom Ad', 'jtheme'),
					'desc' => __( "Put Here Url of your ad image or upload image for your bottom ad, image should be 728x90 ", 'jtheme'),
					'value' => 'http://placehold.it/728x90 ',					
				),
				array(
					'type' => 'textarea',
					'name' => 'jtheme_small_adcode',
					'title' => __('AD Code For small Ad', 'jtheme'),
					'desc' => __( "Put Here Your ad code you ad height and with should be 470x60 ", 'jtheme'),
					'value' => '',					
				),
				array(
					'type' => 'upload',
					'name' => 'jtheme_small_adimg',
					'title' => __('Upload Image For small Ad', 'jtheme'),
					'desc' => __( "Put Here Url of your ad image or upload image for your small ad for home page and single full width page, image should be 470x60 ", 'jtheme'),
					'value' => 'http://placehold.it/470x60',					
				),
				
				array(
					'type' => 'textarea',
					'name' => 'jtheme_header_adcode',
					'title' => __('AD Code For header Ad', 'jtheme'),
					'desc' => __( "Put Here Your ad code you ad height and with should be 470x60 ", 'jtheme'),
					'value' => '',					
				),
				array(
					'type' => 'upload',
					'name' => 'jtheme_header_adimg',
					'title' => __('Upload Image For header Ad', 'jtheme'),
					'desc' => __( "Put Here Url of your ad image or upload image for your header ad for home page and single full width page, image should be 470x60 ", 'jtheme'),
					'value' => 'http://placehold.it/470x60',					
				),
				
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_responsive',
					'value' => true,
					'title' => __('Responsive', 'jtheme'),
					'label' => __( 'Check this to enable responsive?', 'jtheme')
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_masonry',
					'value' => true,
					'title' => __('Masonry Layout', 'jtheme'),
					'label' => __( 'Check this to enable jQuery Masonry layout with Sidebar and Footbar (Uncheck it if have issues, because it can\'t working with some plugins)', 'jtheme')
				),
				
			),
			
			// Fields for Single Settings
			'jtheme-single-settings' => array(
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_related_status',
					'value' => true,
					'title' => __('Show Related Posts', 'jtheme'),
					'label' => __( 'Check this to Enable related videos on single page.', 'jtheme')
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_related_posts',
					'title' => __('Related Posts', 'jtheme'),
					'desc' => __( "How many related posts should be displayed on the single post page? If you don't want to show it leave this field blank or set to 0.", 'jtheme'),
					'value' => 4,
					'class' => 'small-text'
				),
				array(
					'type' => 'select',
					'name' => 'jtheme_related_posts_view',
					'title' => __('Related Posts View', 'jtheme'),
					'value' => 'grid-mini',
					'options' => array(
						'grid-mini' => $supported_view_types['grid-mini'],
						'grid-small' => $supported_view_types['grid-small'],
						'grid-medium' => $supported_view_types['grid-medium']
					)
				),
				array(
					'type' => 'select',
					'name' => 'jtheme_single_video_layout',
					'title' => __('Single Video Layout', 'jtheme'),
					'desc' => __( 'Specify a default layout for all of the video posts, and you can override this setting for individual posts in "Video Settings" panel on edit post page.', 'jtheme'),
					'options' => array(
						'standard' => __('Standard', 'jtheme'), 
						'full-width' =>__('Full Width', 'jtheme')
					),
					'value' => 'standard',
					'class' => 'small-text'
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_single_video_autoplay',
					'title' => __('Autoplay', 'jtheme'),
					'label' => __( 'Check this to autoplay video when viewing a single video post?', 'jtheme'),
					'value' => true,
					'class' => 'small-text'
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_info_toggle',
					'title' => __('"More/Less" Toggle', 'jtheme'),
					'desc' => __( "Enter a number as less height for video detatils area, eg. 100, if you don't need this function, leave this field blank or set to 0. Note: this function is only works on single video post pages.", 'jtheme'),
					'value' => 100,
					'class' => 'small-text'
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_single_thumb',
					'title' => __('Thumbnail', 'jtheme'),
					'label' => __( 'Check this to show thumbnail on single posts.', 'jtheme'),
					'value' => false,
					'class' => 'small-text'
				)
			),
			
			// Fields for Post Likes Settings
			'jtheme-post-likes-settings' => array(
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_post_likes[login_required]',
					'value' => true,
					'title' => __('Login Required', 'jtheme'),
					'label' => __('Users must be registered and logged in to like post ', 'jtheme')
				),
				array(
					'type' => 'custom',
					'name' => 'jtheme_post_likes_page',
					'title' => __('Likes Page', 'jtheme'),
					'custom' => wp_dropdown_pages(array('echo' => false, 'name' => 'jtheme_post_likes_page', 'selected' => get_option('jtheme_post_likes_page'), 'show_option_none' => __('&mdash; Select &mdash;', 'jtheme'))),
					'desc' => 
					sprintf(__('<p>Select a page as user\'s likes page, if the page doesn\'t exist:<br />
					1. <a href="%s">Adding a new page</a><br />
					2. Give this page a title like "My Likes".<br />
					3. Set page template as "Likes".<br />
					<br />
					The "Likes Page" is a page for display user/visitor\'s liked posts.<br />
					<strong>* Logged in:</strong> If the user is logged in, the page will display the user\'s liked posts based on the user\'s ID.<br />
					<strong>* Not Logged in:</strong> If the visitor is not logged in, the page will display the visitor\'s liked posts based on the visitor\'s IP.<br />
					<strong>* Login Required + Not Logged in:</strong> If "Login Required" and the user is not logged in, the page will display a message to remind users to register and login.<br />', 'jtheme'), admin_url('post-new.php?post_type=page')),
				)
			),
			
			// Fields for Header Settings
			'jtheme-header-settings' => array(
				array(
					'type' => 'color',
					'name' => 'jtheme_nav_bgcolor',
					'value' => '#444',
					'title' => __('Main Nav BG Color', 'jtheme'),
					'desc' => __('You can change the main nav bg color', 'jtheme')
				),
				array(
					'type' => 'color',
					'name' => 'jtheme_topnav_bgcolor',
					'value' => '#222',
					'title' => __('Top Bar BG Color', 'jtheme'),
					'desc' => __('You can change Top Bar bg color', 'jtheme')
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_header_search',
					'value' => true,
					'title' => __('Search Box', 'jtheme'),
					'label' => __('Check this to enable search box in header area', 'jtheme')
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_top_nav_status',
					'value' => true,
					'title' => __('Top Navigation', 'jtheme'),
					'label' => __('Check this to enable Header Top navigation.', 'jtheme'),
					'desc' => sprintf(__('By default, the Top navigation is a list of your pages, if your want to customize it, add a menu on <a href="%s">Apperance->Menus</a> page and set this menu as "Top Navigation" in "Theme Location" box.', 'jtheme'), admin_url('nav-menus.php'))
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_social_nav_status',
					'value' => true,
					'title' => __('Social Navigation', 'jtheme'),
					'label' => __('Check this to enable social navigation in Header area', 'jtheme')
				),				
				array(
					'type' => 'fields',
					'title' => __('Tumblr Link', 'jtheme'),
					'fields' => array(
						array(
							'type' => 'checkbox',
							'name' => 'jtheme_social_nav_links[tumblr][status]',
							'value' => true
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[tumblr][url]',
							'prepend' => __('URL:', 'jtheme'),
							'value' => 'http://tumblr.com',
							'class' => 'regular-text'
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[tumblr][title]',
							'prepend' => __('Title Attribute:', 'jtheme'),
							'value' => __('Follow us on Tumblr', 'jtheme'),
							'class' => 'regular-text'
						)
					)
				),
				array(
					'type' => 'fields',
					'title' => __('Facebook Link', 'jtheme'),
					'fields' => array(
						array(
							'type' => 'checkbox',
							'name' => 'jtheme_social_nav_links[facebook][status]',
							'value' => true
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[facebook][url]',
							'prepend' => __('URL:', 'jtheme'),
							'value' => 'http://facebook.com/joinwebs',
							'class' => 'regular-text'
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[facebook][title]',
							'prepend' => __('Title Attribute:', 'jtheme'),
							'value' => __('Become a fan on Facebook', 'jtheme'),
							'class' => 'regular-text'
						)
					)
				),
				array(
					'type' => 'fields',
					'title' => __('Twitter Link', 'jtheme'),
					'fields' => array(
						array(
							'type' => 'checkbox',
							'name' => 'jtheme_social_nav_links[twitter][status]',
							'value' => true
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[twitter][url]',
							'prepend' => __('URL:', 'jtheme'),
							'value' => 'http://twitter.com/joinwebs',
							'class' => 'regular-text'
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[twitter][title]',
							'prepend' => __('Title Attribute:', 'jtheme'),
							'value' => __('Follow us on twitter', 'jtheme'),
							'class' => 'regular-text'
						)
					)
				),
				array(
					'type' => 'fields',
					'title' => __('Vimeo', 'jtheme'),
					'fields' => array(
						array(
							'type' => 'checkbox',
							'name' => 'jtheme_social_nav_links[vimeo][status]',
							'value' => true
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[vimeo][url]',
							'prepend' => __('URL:', 'jtheme'),
							'value' => 'http://vimeo.com/joinwebs',
							'class' => 'regular-text'
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[vimeo][title]',
							'prepend' => __('Title Attribute:', 'jtheme'),
							'value' => __('Follow us on vimeo', 'jtheme'),
							'class' => 'regular-text'
						)
					)
				),
				array(
					'type' => 'fields',
					'title' => __('Google Plus Link', 'jtheme'),
					'fields' => array(
						array(
							'type' => 'checkbox',
							'name' => 'jtheme_social_nav_links[gplus][status]',
							'value' => true
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[gplus][url]',
							'prepend' => __('URL:', 'jtheme'),
							'value' => 'http://google.com/joinwebs',
							'class' => 'regular-text'
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[gplus][title]',
							'prepend' => __('Title Attribute:', 'jtheme'),
							'value' => __('Premium Wordpress Themes', 'jtheme'),
							'class' => 'regular-text'
						)
						
					)
				),
				array(
					'type' => 'fields',
					'title' => __('LinkedIn Link', 'jtheme'),
					'fields' => array(
						array(
							'type' => 'checkbox',
							'name' => 'jtheme_social_nav_links[lin][status]',
							'value' => true
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[lin][url]',
							'prepend' => __('URL:', 'jtheme'),
							'value' => 'http://linked.com/joinwebs',
							'class' => 'regular-text'
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[lin][title]',
							'prepend' => __('Title Attribute:', 'jtheme'),
							'value' => __('Premium Wordpress Themes', 'jtheme'),
							'class' => 'regular-text'
						)
						
					)
				),
				array(
					'type' => 'fields',
					'title' => __('Dribble Link', 'jtheme'),
					'fields' => array(
						array(
							'type' => 'checkbox',
							'name' => 'jtheme_social_nav_links[drib][status]',
							'value' => true
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[drib][url]',
							'prepend' => __('URL:', 'jtheme'),
							'value' => 'http://dribble.com/joinwebs',
							'class' => 'regular-text'
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[drib][title]',
							'prepend' => __('Title Attribute:', 'jtheme'),
							'value' => __('Premium Wordpress Themes', 'jtheme'),
							'class' => 'regular-text'
						)
						
					)
				),
				array(
					'type' => 'fields',
					'title' => __('Youtube Link', 'jtheme'),
					'fields' => array(
						array(
							'type' => 'checkbox',
							'name' => 'jtheme_social_nav_links[youtu][status]',
							'value' => true
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[youtu][url]',
							'prepend' => __('URL:', 'jtheme'),
							'value' => 'http://youtube.com/joinwebs',
							'class' => 'regular-text'
						),
						array(
							'type' => 'text',
							'name' => 'jtheme_social_nav_links[youtu][title]',
							'prepend' => __('Title Attribute:', 'jtheme'),
							'value' => __('Premium Wordpress Themes', 'jtheme'),
							'class' => 'regular-text'
						)
						
					)
				)
				
				
			),
			'jtheme-home-featured-settings' => array( // Home Featured Settings
				
				array(
					'name' => 'jtheme_home_featured',
					'callback' => 'jtheme_home_featured_settings',
					'value' => array(
						'posts_per_page' => 12
					)
				)
			),
			
			// Fields for Footer Settings
			'jtheme-footer-settings' => array(
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_footbar_status',
					'value' => true,
					'title' => __('Footbar', 'jtheme'),
					'label' => sprintf(__( 'Check this to enable footbar (Footer Widget Areas), and add widgets on <a href="%s">Appearance->Widgets</a> page', 'jtheme'), admin_url('widgets.php')),
				),
				array(
					'type' => 'select',
					'name' => 'jtheme_footbar_layout',
					'value' => 'c3',
					'options' => array(
						'c3' => __('3 Columns', 'jtheme'), 
						'c4' => __('4 Columns', 'jtheme'), 
						'c4s1' => __('4+1 Columns', 'jtheme')
					),
					'title' => __('Footbar Layout', 'jtheme'),
					'desc' => sprintf(__('Select a layout for your footer widget areas, after you change this option, you may need to re-configure widgets on  <a href="%s">Appearance->Widgets</a> page', 'jtheme'), admin_url('widgets.php'))
				),
				
				array(
					'type' => 'text',
					'name' => 'jtheme_site_copyright',
					'title' => __('Text for Copyright', 'jtheme'),
					'value' => __('Copyright %1$s &copy; %2$s All rights reserved.', 'jtheme'),
					'desc' => __("<code>%1&#36;s</code> is current year, <code>%2&#36;s</code> is a link with your site name.", 'jtheme')
				),
				array(
					'type' => 'textarea',
					'name' => 'jtheme_site_credits',
					'title' => __('Text for Credits', 'jtheme'),
					'value' => __('Powered by <a target="_blank" href="http://Wordpress.org/">Wordpress</a> & <a target="_blank" href="http://themeforest.net/item/beetube-video-wordpress-theme/7055188" title="BeeTube Video WordPress Theme">BeeTube</a> by <a target="_blank" href="http://joinwebs.com" title="Premium Wordpress Themes">JoinWebs</a>', 'jtheme'),
					'desc' => __('Whether Wordpress or Joinwebs, No attribution or backlinks are strictly required, but play the game, it\'s always nice to be credited for your site. Any form of spreading the word is always appreciated!', 'jtheme')
				),
				
			),
			
			
			// Fields for Hook Settings
			'jtheme-hook-settings' => array(
				array(
					'type' => 'textarea',
					'name' => 'jtheme_head_code',
					'title' => __('Head Code', 'jtheme'),
					'desc' => __( 'Paste any code here. It will be inserted before the <code>&lt;/head&gt;</code> tag of your theme.', 'jtheme'),
				),
				array(
					'type' => 'textarea',
					'name' => 'jtheme_footer_code',
					'title' => __('Footer Code', 'jtheme'),
					'desc' => __( 'Paste any code here, e.g. your Google Analytics tracking code. It will be inserted before the <code>&lt;/body&gt;</code> tag of your theme.', 'jtheme'),
				)
			),
			
			// Fields for Hook Settings
			'jtheme-fb-comments' => array(
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_fbcomment',
					'value' => true,
					'title' => __('FB Comments', 'jtheme'),
					'label' => __("Check this to enable FB comments.", 'jtheme')
				),
				array(
					'type' => 'text',
					'name' => 'jtheme_fb_appid',
					'title' => __('FB App ID', 'jtheme'),
					'desc' => __( 'Put here your FB app ID <a target="_blank" href="https://developers.facebook.com/apps">get ID</a>', 'jtheme'),
				)
			),
			// Fields for Responsive Settings
			'jtheme-responsive-settings' => array(
				array(
					'type' => 'checkbox',
					'name' => 'jtheme-featured-responsive',
					'value' => true,
					'title' => __('Featured Slider', 'jtheme'),
					'label' => __("Check this to enable Featured Slider on Mobile.", 'jtheme')
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme-bslider-responsive',
					'value' => true,
					'title' => __('Big Slider', 'jtheme'),
					'label' => __("Check this to enable Big Slider on Mobile.", 'jtheme')
				),
			),
			
			// Fields for Design Settings
			'jtheme-design-settings' => array(
				array(
					'type' => 'select',
					'name' => 'jtheme_wrap_layout',
					'value' => 'full-wrap',
					'options' => array('full-wrap' => __('Full Width', 'jtheme'), 'boxed-wrap'=>__('Boxed', 'jtheme')),
					'title' => __('Layout', 'jtheme'),
				),
				array(
					'type' => 'select',
					'name' => 'jtheme_wrap_width',
					'value' => '1170px',
					'options' => array('boxed-wrap'=>__('1170px', 'jtheme')),
					'title' => __('Boxed Layout Width', 'jtheme'),
					'desc' => __('If you have select Boxed Layout from above Option so it will auto work.', 'jtheme'),
				),
				array(
					'type' => 'select',
					'name' => 'jtheme_color_scheme',
					'value' => 'green',
					'options' => array('red'=>__('Light Red', 'jtheme'),'lgreen'=>__('Light Green', 'jtheme'),'lblue'=>__('Light Blue', 'jtheme'),'green' => __('Green', 'jtheme'), 'blue'=>__('Blue', 'jtheme')),
					'title' => __('Select Color Scheme', 'jtheme'),
				),
				array(
					'type' => 'color',
					'name' => 'jtheme_bgcolor',
					'value' => '#EEE',
					'title' => __('Custom Background Color', 'jtheme'),
					'append' => __("Default color value is #EEEEEE", 'jtheme')
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_bgpat',
					'value' => true,
					'title' => __('Background Pattern', 'jtheme'),
					'label' => __("Check this to enable background pattern.", 'jtheme')
				),
				array(
					'type' => 'select',
					'name' => 'jtheme_preset_bgpat',
					'value' => get_template_directory_uri().'/images/bg-pattern.png',
					'options' => jtheme_get_patterns(),
					'title' => __('Preset Background Pattern', 'jtheme'),
					'desc' => jtheme_preset_bgpat_preview()
				),
				array(
					'type' => 'upload',
					'name' => 'jtheme_custom_bgpat',
					'value' => '',
					'title' => __('Custom Background Pattern', 'jtheme'),
					'desc' => __('This option will override "Preset Background Pattern" in the above.', 'jtheme'),
				),
				array(
					'type' => 'select',
					'name' => 'jtheme_bgrep',
					'value' => 'repeat',
					'options' => array('repeat', 'repeat-x', 'repeat-y', 'no-repeat'),
					'title' => __('Background Repeat', 'jtheme')
				),
				array(
					'type' => 'select',
					'name' => 'jtheme_bgatt',
					'value' => 'fixed',
					'options' => array('fixed', 'scroll'),
					'title' => __('Background Attachment', 'jtheme')
				),
				array(
					'type' => 'checkbox',
					'name' => 'jtheme_bgfull',
					'value' => false,
					'title' => __('Full Page Background Image', 'jtheme'),
					'label' => __("Check this to enable full page background image(not working below IE9).", 'jtheme')
				)
			)
			
			
			
		);
		
		return $fields;
	}
}
jtheme_register_panel('jtheme_General_Settings');

/**
 * Get all patterns from "{theme_direcoty}/patterns/"
 */
function jtheme_get_patterns() {
	$dir = get_template_directory().'/patterns';
	
	$patterns = array(
		get_template_directory_uri().'/images/bg-pattern.png' => __('Default', 'jtheme')
	);
	
	if (!is_dir($dir))
		return $patterns;
	
    if ($handler = opendir($dir)) {
        while (($file = readdir($handler)) !== false) {
			// Get file extension
			if(function_exists('pathinfo'))
				$file_ext = pathinfo($file, PATHINFO_EXTENSION);
			else
				$file_ext = end(explode(".", $file));
			
			if ($file != "." && $file != ".." && in_array($file_ext, array('jpg', 'png', 'gif'))) {
				$file_url = get_template_directory_uri().'/patterns/'.$file;
				$patterns[$file_url] = $file;
			}
        }
        closedir($handler);
	}
	
	return $patterns;
}

function jtheme_preset_bgpat_preview() {
	$pat = get_option('jtheme_preset_bgpat');
	if(!$pat)
		$pat = get_template_directory_uri().'/images/bg-pattern.png';
	
	$html = '
		<style type="text/css">
			.jtheme-preset-bgpat-preivew{
				margin:20px 0 0;
				height:100px;
				border:1px solid #CCC;
				background:#EEE url('.$pat.');
			}
		</style>
	';
	$html .= '<div class="jtheme-preset-bgpat-preivew"></div>';
	 
	return $html;
}

/* Home Settings
 *=============================================================================*/
class jtheme_Home_Settings extends jtheme_Panel {
	function __construct(){
		$this->menu_slug = 'home-settings';
		
		parent::__construct();
	}
	
	function add_menu_pages(){
		$this->page_hook = add_submenu_page('theme-options', __('Home Settings', 'jtheme'), __('Landing Page', 'jtheme'), 'edit_theme_options', $this->menu_slug, array(&$this, 'menu_page'));
	}
	
	function add_meta_boxes(){
		add_meta_box( 'jtheme-home-sections-settings', __('Landing Page Settings', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
		//add_meta_box( 'jtheme-home-featured-settings', __('Landing Page Slider Settings', 'jtheme'), array(&$this, 'meta_box'), $this->page_hook, 'normal');
	}
	
	function fields(){
		$default_home_sections = array(
			array(
				'title' => __('Newest Videos', 'jtheme'),
				'view' => 'list-large'
			),
			array(
				'title' => __('Most Viewed', 'jtheme'),
				'orderby' => 'views',
				'view' => 'grid-mini'
			),
			array(
				'title' => __('Most Liked', 'jtheme'),
				'orderby' => 'likes',
				'view' => 'grid-medium'
			),
			array(
				'title' => __('Most Commented', 'jtheme'),
				'orderby' => 'comments',
				'view' => 'list-medium'
			)
		);
		$cats = get_terms('category');
		foreach($cats as $cat) {
			$default_home_sections[] = array('taxonomies'=> array('category'=>$cat->term_id), 'title'=>$cat->name);
		}
		
		$fields = array(
			
			'jtheme-home-sections-settings' => array( // Home Sections Settings
				array(
					'name' => 'jtheme_home_sections',
					'callback' => 'jtheme_home_sections_settings',
					'value' => $default_home_sections
				)
			)
		);
		
		return $fields;
	}
}
jtheme_register_panel('jtheme_Home_Settings');

/**
 * General sort types settings meta box
 */
function jtheme_sort_types_settings() {
	$supported_types = jtheme_supported_sort_types();
	$types = get_option('jtheme_sort_types');
	$types_order = get_option('jtheme_sort_types_order');
	
	if(empty($types))
		$types = array();
	if(empty($types_order))
		$types_order = array_keys($supported_types);

	echo '<tr><th>'.__('Sort Types', 'jtheme').'</th> <td><ul class="ui-sortable sortable-list">';
	foreach($types_order as $type) {
		$checked = array_key_exists($type, $types) ? ' checked="checked"' : '';
		$label = $supported_types[$type]['label'];
		echo '<li>
			<input style="display:none;" type="checkbox" name="jtheme_sort_types_order[]" value="'.$type.'" checked="checked" />
			<input type="checkbox" name="jtheme_sort_types['.$type.']" value="1" '.$checked.'/> '.$label.
			'</li>';
	}
	echo '</ul>';
	echo __("Check a type to enable it, or drag the types to reorder.", 'jtheme');
	echo '</td></tr>';
}

/**
 * General view types settings meta box
 */
function jtheme_view_types_settings() {
	$supported_types = jtheme_supported_view_types();
	$types = get_option('jtheme_view_types');
	$types_order = get_option('jtheme_view_types_order');
	
	if(empty($types))
		$types = array();
	if(empty($types_order))
		$types_order = array_keys($supported_types);

	echo '<tr><th>'.__('View Types', 'jtheme').'</th><td><ul class="sortable-list">';
	foreach($types_order as $type) {
		$checked = array_key_exists($type, $types) ? ' checked="checked"' : '';
		$label = $supported_types[$type];
		echo '<li>
			<input style="display:none;" type="checkbox" name="jtheme_view_types_order[]" value="'.$type.'" checked="checked" />
			<input type="checkbox" name="jtheme_view_types['.$type.']" value="1" '.$checked.'/> '.$label.
			'</li>';
	}
	echo '</ul>';
	echo __("Check a type to enable it, or drag the types to reorder.", 'jtheme');
	echo '</td></tr>';
}

/**
 * Home featured settings meta box
 */
function jtheme_home_featured_settings() {
	$defaults = array(
		'cat' => '',
		'post_type' => 'post',
		'taxonomies' => '',
		'orderby' => '',
		'order' => '',
		'posts_per_page' => 18,
		'posts__in' => '',
		'autoplay' => 0,
		'ajaxload' => true,
		'autoscroll' => 0,
		'layout' => 'standard', // standard, full-width
		'first_post_media' => 'video'
	);
	$args = get_option('jtheme_home_featured');
	foreach($defaults as $key => $value) {
		if(!array_key_exists($key, $args)) {
			$args[$key] = 0;
		}
	}
	$args = wp_parse_args($args, $defaults);
	
	$dropdown_sort_types = jtheme_dropdown_sort_types(array(
		'echo' => 0, 
		'name' => 'jtheme_home_featured[orderby]',
		'selected' => $args['orderby']
	));
	
	$dropdown_order_types = jtheme_dropdown_order_types(array(
		'echo' => 0, 
		'name' => 'jtheme_home_featured[order]',
		'selected' => $args['order']
	));
	
	$dropdown_views_timing = jtheme_dropdown_views_timing(array(
		'echo' => 0, 
		'name' => 'jtheme_home_featured[views_timing]',
		'selected' => $args['views_timing']
	));
	
	$dropdown_layouts = jtheme_form_field(array(
		'echo' => 0,
		'type' => 'select',
		'options' => array(
			'standard' => __('Standard', 'jtheme'), 
			'full-width' => __('Full Width', 'jtheme')
		),
		'name' => 'jtheme_home_featured[layout]',
		'value' => $args['layout']
	));
	
	$dropdown_post_types = jtheme_dropdown_post_types(array(
		'echo' => 0,
		'name' => 'jtheme_home_featured[post_type]',
		'selected' => $args['post_type']
	));
	
	
	$multi_dropdown_terms = jtheme_multi_dropdown_terms(array(
		'echo' => 0,
		'name' => 'jtheme_home_featured[taxonomies]',
		'selected' => $args['taxonomies']
	));
	
	$html = '<table class="form-table">
		<tr>
			<td colspan="2">
				<div class="description">'.__("These settings enable you to show featured posts on home pages. If you don't want to show it, set 'Number of Posts' to 0.", 'jtheme').'</div>
			</td>
		</tr>
		<tr>
			<th>'.__('Layout', 'jtheme').'</th>
			<td>'.$dropdown_layouts.'</td>
		</tr>';
	
	if($dropdown_post_types) {
	$html .= '<tr>
			<th><label>'.__('Post Type', 'jtheme').'</label></th>
			<td>
				'.$dropdown_post_types.'
			</td>
		</tr>';
	}
	$html .= '<tr>
			<th>'.__('Taxonomy Query', 'jtheme').'</th>
			<td>
				'.$multi_dropdown_terms.'
			</td>
		</tr>
		<tr>
			<th>'.__('Sort', 'jtheme').'</th>
			<td>
				<label>'.__('Order by:', 'jtheme').'</label> '.$dropdown_sort_types.'&nbsp;&nbsp;
				<label>'.__('Order:', 'jtheme').'</label> '.$dropdown_order_types.'&nbsp;&nbsp;
				<label>'.__('Views Timing:', 'jtheme').'</label> '.$dropdown_views_timing.'&nbsp;&nbsp;
			</td>
		</tr>
		<tr>
			<th><label>'.__('Number of Posts', 'jtheme').' </label></th>
			<td>
				<input class="small-text" type="text" value="'.$args['posts_per_page'].'" name="jtheme_home_featured[posts_per_page]" />
			</td>
		</tr>
		<tr>
			<th><label>'.__('Includes', 'jtheme').'</label></th> 
			<td>
				<input class="widefat" type="text" value="'.$args['post__in'].'" name="jtheme_home_featured[post__in]" />
				<p class="description">'.__('If you want to display specific posts, enter post ids to here, separate ids with commas, (e.g. 1,2,3,4). <br />if this field is not empty, category will be ignored. <br/>If you want to display posts sort by the order of your enter IDs, set "Sort" field as <strong>Includes</strong>.', 'jtheme').'</p>
			</td>
		</tr>
		<tr>
			<th><label>'.__('First Post Media', 'jtheme').'</label></th>
			<td>
				'.jtheme_form_field(array(
					'name' => 'jtheme_home_featured[first_post_media]',
					'type' => 'select',
					'value' => $args['first_post_media'],
					'options' => array(
						'video'=>__('Video', 'jtheme'), 
						'thumb'=>__('Thumbnail', 'jtheme'),
					),
					'echo' => false
				)).'<p class="description">'.__('Select a media type for first post', 'jtheme').'
			</td>
		</tr>
		<tr>
			<th><label>'.__('Autoplay', 'jtheme').'</label></th> 
			<td>
				<label><input type="checkbox" value="1" name="jtheme_home_featured[autoplay]" '.checked($args['autoplay'], true, false).'/>'.__('Check this to enable autoplay', 'jtheme').'</label>
			</td>
		</tr>
		<tr>
			<th><label>'.__('Ajaxload', 'jtheme').'</label></th> 
			<td>
				<label><input type="checkbox" value="1" name="jtheme_home_featured[ajaxload]" '.checked($args['ajaxload'], true, false).'/>'.__('Check this to enable ajaxload', 'jtheme').'</label>
			</td>
		</tr>
		<tr>
			<th><label>'.__('Autoscroll', 'jtheme').'</label></th> 
			<td>
				<input class="widefat" type="text" value="'.$args['autoscroll'].'" name="jtheme_home_featured[autoscroll]" />
				<p class="description">'.__('Set autoscrolling interval in milliseconds to make carousel to automatic play (eg. 2500), set it to 0 or leave it blank to disable it . <strong>Note</strong>: It will disable autoplay and ajaxload.', 'jtheme').'</p>
			</td>
		</tr>
	</table>';

	return $html;
}

/**
 * Category featured settings meta box
 */
function jtheme_cat_featured_settings() {
	$defaults = array(
		'orderby' => '',
		'order' => '',
		'posts_per_page' => '',
		'item'
	);
	$args = get_option('jtheme_cat_featured');
	$args = wp_parse_args($args, $defaults);
	
	$dropdown_sort_types = jtheme_dropdown_sort_types(array(
		'echo' => 0, 
		'name' => 'jtheme_cat_featured[orderby]',
		'selected' => $args['orderby']
	));
	
	$dropdown_order_types = jtheme_dropdown_order_types(array(
		'echo' => 0, 
		'name' => 'jtheme_cat_featured[order]',
		'selected' => $args['order']
	));
	$multi_dropdown_terms = jtheme_multi_dropdown_terms(array(
		'echo' => 0,
		'name' => 'jtheme_cat_featured[taxonomies]',
		'selected' => $args['taxonomies']
	));
	

	$html = '
		<tr>
			<td colspan="2">
				<h1>Top Featured posts settings</h1>
				<div class="description">'.__("These settings enable you to show Featured posts If you don't want to show it, set 'Number of Posts' to 0.", 'jtheme').'</div>
			</td>
		</tr>
		<tr>
			<th>'.__('Query', 'jtheme').'</th>
			<td>
				<label>'.__('Sort:', 'jtheme').'</label> '.$dropdown_sort_types.'&nbsp;&nbsp;'.$dropdown_order_types.'&nbsp;&nbsp;
				<label>'.__('Number of Posts:', 'jtheme').' </label>
				<input class="small-text" type="text" value="'.$args['posts_per_page'].'" name="jtheme_cat_featured[posts_per_page]" />
			</td>
		</tr>
	';
	$html .= '<tr>
			<th>'.__('Select Category', 'jtheme').'</th>
			<td>
				'.$multi_dropdown_terms.'
			</td>
		</tr>';

	return $html;
}

function jtheme_cat_featured_footer_settings() {
	$defaults = array(
		'orderby' => '',
		'order' => '',
		'posts_per_page' => '',
		'item'
	);
	$args = get_option('jtheme_cat_featured_footer');
	$args = wp_parse_args($args, $defaults);
	
	$dropdown_sort_types = jtheme_dropdown_sort_types(array(
		'echo' => 0, 
		'name' => 'jtheme_cat_featured_footer[orderby]',
		'selected' => $args['orderby']
	));
	
	$dropdown_order_types = jtheme_dropdown_order_types(array(
		'echo' => 0, 
		'name' => 'jtheme_cat_featured_footer[order]',
		'selected' => $args['order']
	));
	$multi_dropdown_terms = jtheme_multi_dropdown_terms(array(
		'echo' => 0,
		'name' => 'jtheme_cat_featured_footer[taxonomies]',
		'selected' => $args['taxonomies']
	));
	

	$html = '
		<tr>
			<td colspan="2">
				<h1>Footer Featured posts settings</h1>
				<div class="description">'.__("These settings enable you to show Featured posts If you don't want to show it, set 'Number of Posts' to 0.", 'jtheme').'</div>
			</td>
		</tr>
		<tr>
			<th>'.__('Query', 'jtheme').'</th>
			<td>
				<label>'.__('Sort:', 'jtheme').'</label> '.$dropdown_sort_types.'&nbsp;&nbsp;'.$dropdown_order_types.'&nbsp;&nbsp;
				<label>'.__('Number of Posts:', 'jtheme').' </label>
				<input class="small-text" type="text" value="'.$args['posts_per_page'].'" name="jtheme_cat_featured_footer[posts_per_page]" />
			</td>
		</tr>
	';
	$html .= '<tr>
			<th>'.__('Select Category', 'jtheme').'</th>
			<td>
				'.$multi_dropdown_terms.'
			</td>
		</tr>';

	return $html;
}


/**
 * Home sections settings meta box
 */
function jtheme_home_sections_settings() {
	$html = '
	<tr><td colspan="2">
	<div class="item-box">
	<p class="description" style="padding:10px;">'.__('To adding a section, click "<strong>Add New Section</strong>" button. <br />Drag sections up or down to change their order of appearance on home page.<br/>Don\'t forget to click "<strong>Save Changes</strong>" button.', 'jtheme').'</p>
	<div class="item-list-container" id="jtheme-home-sections-item-list-container">
		<a href="#" class="button add-new-item" data-position="prepend">'.__('Add New Section', 'jtheme').'</a>
		<ul class="item-list ui-sortable" id="jtheme-home-sections-item-list">';
		
	$items = get_option('jtheme_home_sections');
	if(!empty($items) && is_array($items)) {
		foreach($items as $number => $item) {
			$item = array_filter($item);
			if(!empty($item))
				$html .= jtheme_home_section_item($number, $item);
		}
	}
	
	$html .= '
		</ul>
		<ul class="item-list-sample" id="jtheme-home-sections-item-list-sample" style="display:none;">'.jtheme_home_section_item().'</ul>
	<a href="#" class="button add-new-item" data-position="append">'.__('Add New Section', 'jtheme').'</a>
	
	</div></div>
	</td></tr>';
	
	return $html;
}

/**
 * Single section settings
 */
function jtheme_home_section_item($number = null, $item = array()) {
	$default_item = array(
		'post_type' => 'post',
		'cat' => '',
		'view' => '',
		'orderby' => '',
		'order' => '',
		'taxonomies' => '',
		'tax_query' => array(),
		'post__in' => '',
		'posts_per_page' => '',
		'title' => '',
		'link' => '',
		'before' => '',
		'after' => '',
		'views_timing' => ''
	);
	$item = wp_parse_args($item, $default_item);
	if($number === null)
		$number = '##';

	$dropdown_view_types = jtheme_dropdown_view_types(array(
		'echo' => 0, 
		'name' => 'jtheme_home_sections['.$number.'][view]',
		'selected' => !empty($item['view']) ? $item['view'] : 'grid-small'
	));
	
	$dropdown_sort_types = jtheme_dropdown_sort_types(array(
		'echo' => 0, 
		'name' => 'jtheme_home_sections['.$number.'][orderby]',
		'selected' => $item['orderby']
	));
	
	$dropdown_order_types = jtheme_dropdown_order_types(array(
		'echo' => 0, 
		'name' => 'jtheme_home_sections['.$number.'][order]',
		'selected' => $item['order']
	));
	
	$dropdown_views_timing = jtheme_dropdown_views_timing(array(
		'echo' => 0, 
		'name' => 'jtheme_home_sections['.$number.'][views_timing]',
		'selected' => $item['views_timing']
	));
	
	$dropdown_post_types = jtheme_dropdown_post_types(array(
		'echo' => 0, 
		'name' => 'jtheme_home_sections['.$number.'][post_type]',
		'selected' => $item['post_type']
	));
	
	$taxonomies = get_taxonomies(array('public'=>true), 'objects');
	$multi_dropdown_terms = jtheme_multi_dropdown_terms(array(
		'echo' => 0,
		'name' => 'jtheme_home_sections['.$number.'][taxonomies]',
		'selected' => $item['taxonomies']
	));
	
	$section_title = __('Section Box', 'jtheme');
	$section_title .= !empty($item['title']) ? ': <spanc class="in-widget-title">'.$item['title'].'</span>' : '';
	
	$html = '
	<li rel="'.$number.'">
		<div class="section-box closed">
		<div class="section-handlediv" title="Click to toggle"><br></div><h3 class="section-hndle"><span>'.$section_title.'</span></h3>
		
		<div class="section-inside">
		
		<table class="item-table">
			<tr>

				<td>
					<table class="item-table">';
	
			if($dropdown_post_types) {
				$html .= '<tr>
				<th><label>'.__('Post Type', 'jtheme').'</label></th>
					<td>
						'.$dropdown_post_types.'
					</td>
				</tr>';
			}
	
			$html .= '
						<tr>
							<th>'.__('Taxomoy Query', 'jtheme').'</th>
							<td>
								'.$multi_dropdown_terms.'
							</td>
						</tr>
						<tr>
							<th>'.__('Sort', 'jtheme').'</th>
							<td>
								<label>'.__('Order by:', 'jtheme').'</label> '.$dropdown_sort_types.'&nbsp;&nbsp;
								<label>'.__('Order:', 'jtheme').'</label> '.$dropdown_order_types.'&nbsp;&nbsp;
								<label>'.__('Views Timing:', 'jtheme').'</label> '.$dropdown_views_timing.'
							</td>
						</tr>
						<tr>
							<th><label>'.__('Number of Posts:', 'jtheme').' </label></th>
							<td>
								<input class="small-text" type="text" value="'.$item['posts_per_page'].'" name="jtheme_home_sections['.$number.'][posts_per_page]" />&nbsp;&nbsp;
							</td>
						</tr>
						<tr>
							<th><label>'.__('Includes', 'jtheme').'</label></th> 
							<td>
								<input class="widefat" type="text" value="'.$item['post__in'].'" name="jtheme_home_sections['.$number.'][post__in]" />
								<p class="description">'.__('If you want to display specific posts, enter post ids to here, separate ids with commas, (e.g. 1,2,3,4). <br />if this field is not empty, category will be ignored. <br/>If you want to display posts sort by the order of your enter IDs, set "Sort" field as <strong>Includes</strong>.', 'jtheme').'</p>
							</td>
						</tr>
						<tr>
							<th><label>'.__('View', 'jtheme').'</label></th> 
							<td>'.$dropdown_view_types.'</td>
						</tr>
						<tr>
							<th><label>'.__('Title', 'jtheme').'</label></th> 
							<td>
								<input class="widefat" type="text" value="'.$item['title'].'" name="jtheme_home_sections['.$number.'][title]" />
								<p class="description">'.__('If you specify a category, the default title is the category name, and you can still fill in this field to override it.', 'jtheme').'</p>
							</td>
						</tr>
						<tr>
							<th><label>'.__('Link', 'jtheme').'</label></th> 
							<td>
								<input class="widefat" type="text" value="'.$item['link'].'" name="jtheme_home_sections['.$number.'][link]" />
								<p class="description">'.__('If you specified a category, the default link is the category link, and you can still fill in this field to override it.', 'jtheme').'</p>
							</td>
						</tr>
						<tr>
							<th><label>'.__('Before', 'jtheme').'</label></th> 
							<td>
								<textarea rows="5" class="widefat" name="jtheme_home_sections['.$number.'][before]">'.$item['before'].'</textarea>
								<p class="description">'.__('Maybe you want to insert something before this section, such as your ad code. (support html and shortcode).', 'jtheme').'</p>
							</td>
						</tr>
						<tr>
							<th><label>'.__('After', 'jtheme').'</label></th> 
							<td>
								<textarea rows="5" class="widefat" name="jtheme_home_sections['.$number.'][after]">'.$item['after'].'</textarea>
								<p class="description">'.__('Maybe you want to insert something after this section, such as your ad code. (support html and shortcode).', 'jtheme').'</p>
							</td>
						</tr>
					</table>
				</td>
				
				<td style="width:50px;">
					<a href="#" class="button delete-item">'.__('Delete', 'jtheme').'</a>
				</td>
			</tr>
		</table>
		</div>
		</div>
	</li>
	';

	return $html;
}

/**
 * HTML dropdown list of post types
 *
 *  1.2.6
 */
function jtheme_dropdown_post_types($args='') {
	$defaults = array(
		'name' => '',
		'selected' => '',
		'echo' => true
	);
	$args = wp_parse_args($args, $defaults);
	extract($args);
	
	$post_types = get_post_types(array('public'=>true), 'objects');
	unset($post_types['page']);
	unset($post_types['attachment']);
	if(count($post_types) < 2)
		return;

	$post_type_options = array('all'=>__('All', 'jtheme'));
	foreach($post_types as $type_name=>$type_object)
		$post_type_options[$type_name] = $type_object->labels->singular_name;
		
	$dropdown = jtheme_form_field(array(
		'echo' => 0,
		'type' => 'select',
		'options' => $post_type_options,
		'name' => $name,
		'value' => $selected
	));
	
	if($echo)
		echo $dropdown;
	else
		return $dropdown;
}

/**
 * HTML dropdown list of taxonomies terms
 *
 *  1.2.6
 */
function jtheme_multi_dropdown_terms($args='') {
	$defaults = array(
		'name' => '',
		'selected' => '',
		'echo' => true
	);
	$args = wp_parse_args($args, $defaults);
	extract($args);


	$taxes = get_taxonomies(array('public'=>true), 'objects');
	// Only category and post_format now
	$taxes = array(
		'category'=>$taxes['category'],
		'post_format'=>$taxes['post_format'],
		// 'post_tag'=>$taxes['post_tag']
	);
	$dropdown = '';
	foreach($taxes as $tax_name=>$tax_object) {
		$dropdown_args = array(
			'echo' => 0,
			'taxonomy' => $tax_name,
			'name' => $name.'['.$tax_name.']',
			'selected' => !empty($selected[$tax_name]) ? $selected[$tax_name] : array(),
			'show_option_all' => __('All', 'jtheme'),
			'hide_empty' => false,
			'hide_if_empty' => true,
			'number' => 2000,
			'orderby' => 'name'
		);
		if($tax_name == 'post_format')
			$dropdown_args['show_option_none'] = __('Standard', 'jtheme');
		$dropdown_terms = wp_dropdown_categories($dropdown_args);
		
		if($dropdown_terms)
			$dropdown .= '<label>'.$tax_object->labels->singular_name.':</label> '.$dropdown_terms.'&nbsp;&nbsp;';
	}
	
	$dropdown .= __('Tags (Separate tag slugs with commas):', 'jtheme').' ';
	$dropdown .= jtheme_form_field(jtheme_instance_field(array(
		'type' => 'text',
		'name' => $name.'[post_tag]',
		'value' => '',
		'class' => 'regular-text',
		'label' => 'Tag Slug',
		'echo' => 0
	)));
	
	if($echo)
		echo $dropdown;
	else
		return $dropdown;
}


/**
 * HTML dropdown list of view types
 */
function jtheme_dropdown_view_types($args){
	$defaults = array(
		'name' => '',
		'selected' => '',
		'echo' => true
	);
	$args = wp_parse_args($args, $defaults);
	extract($args);
	
	$view_types = jtheme_supported_view_types();
	
	$dropdown = '<select name="'.$name.'">';
	foreach($view_types as $type => $label) {
		$dropdown .= '<option value="'.$type.'"'.selected($type, $selected, false).'>'.$label.'</option>';
	}
	$dropdown .= '</select>';
	
	if($echo)
		echo $dropdown;
	else
		return $dropdown;
}

/**
 * HTML dropdown list of sort types
 */
function jtheme_dropdown_sort_types($args){
	$defaults = array(
		'name' => '',
		'selected' => '',
		'class' => '',
		'echo' => true
	);
	$args = wp_parse_args($args, $defaults);
	extract($args);
	
	$sort_types = jtheme_supported_sort_types();
	$sort_types['post__in'] = array(
		'label' => __('Includes', 'jtheme')
	); 
	
	$dropdown = '<select class="'.$class.'" name="'.$name.'">';
	foreach($sort_types as $type => $args) {
		$dropdown .= '<option value="'.$type.'"'.selected($type, $selected, false).'>'.$args['label'].'</option>';
	}
	$dropdown .= '</select>';
	
	if($echo)
		echo $dropdown;
	else
		return $dropdown;
}

/**
 * HTML dropdown list of views timing
 */
function jtheme_dropdown_views_timing($args){
	$defaults = array(
		'name' => '',
		'selected' => '',
		'class' => '',
		'echo' => true
	);
	$args = wp_parse_args($args, $defaults);
	extract($args);
	
	$views_timing = jtheme_views_timings();
	
	$dropdown = '<select class="'.$class.'" name="'.$name.'">';
	foreach($views_timing as $option => $label) {
		$dropdown .= '<option value="'.$option.'"'.selected($option, $selected, false).'>'.$label.'</option>';
	}
	$dropdown .= '</select>';
	
	if($echo)
		echo $dropdown;
	else
		return $dropdown;
}

/**
 * HTML dropdown list of order types
 */
function jtheme_dropdown_order_types($args){
	$defaults = array(
		'name' => '',
		'selected' => '',
		'class' => '',
		'echo' => true
	);
	$args = wp_parse_args($args, $defaults);
	extract($args);
	
	$order_types = array(
		'DESC' => __('Sort Descending', 'jtheme'),
		'ASC' => __('Sort Ascending', 'jtheme')
	);
	
	$dropdown = '<select class="'.$class.'" name="'.$name.'">';
	foreach($order_types as $type => $label) {
		$dropdown .= '<option value="'.$type.'"'.selected($type, $selected, false).'>'.$label.'</option>';
	}
	$dropdown .= '</select>';
	
	if($echo)
		echo $dropdown;
	else
		return $dropdown;
}


/*= Custom Pnale on edit post Page
 *=============================================================================*/

class jtheme_Video_Settings_Panel extends jtheme_Post_Panel {

	function __construct() {
		$this->name = 'jtheme-video-settings';
		$this->title = __('Video Settings', 'jtheme');
		//$this->post_types = array('post');
		
		parent::__construct();
	}
	
	function fields() {
		$single_video_layout = get_option('jtheme_single_video_layout');
		$video_layout_label = ($single_video_layout == 'standard' || !$single_video_layout) ? __('Standard', 'jtheme') : __('Full Width', 'jtheme');
		
		$fields = array(
			array(
				'type' => 'select',
				'name' => 'jtheme_video_layout',
				'title' => __('Video Layout', 'jtheme'),
				'desc' => sprintf(__( 'The default single video layout is <b>"%s"</b>, select a layout if you want to use different layout to override it.', 'jtheme'), $video_layout_label),
				'options' => array(
					'' => '',
					'standard' => __('Standard', 'jtheme'), 
					'full-width' =>__('Full Width', 'jtheme')
				),
				'value' => ''
			),
			array(
				'type' => 'description',
				'value' => '<hr class="sepline" style="margin:0 -20px;" />'
			),
			array(
				'type' => 'description',
				'value' => __('Please choose one of the following ways to embed the video into your post, the video is determined in the order: <b>Video Code > Video URL > Video File.</b>', 'jtheme'),
			),
			array(
				'type' => 'description',
				'value' => '<hr class="sepline" style="margin:0 -20px;" />'
			),
			array(
				'type' => 'textarea',
				'name' => 'jtheme_video_file',
				'title' => __('Video File', 'jtheme'),
				'desc' => __( 'Paste your video file url to here. <b>Supported Video Formats:</b> mp4, m4v, webmv, webm, ogv and flv.<br /><br/>
				<b>About Cross-platform and Cross-browser Support</b><br/>
				If you want your video works in all platforms and browsers(HTML5 and Flash), you should provide various video formats for same video, if the video files are ready, enter one url per line. For Example: <br />
				<code>http://yousite.com/sample-video.m4v</code><br />
				<code>http://yousite.com/sample-video.ogv</code><br />
				<b>Recommended Format Solution</b>: webmv + m4v + ogv.
				', 'jtheme'),
			),
			array(
				'type' => 'upload',
				'name' => 'jtheme_video_poster',
				'title' => __('Video Poster', 'jtheme'),
				'desc' => __( 'The preview image for video file, recommended size is 960px*540px.', 'jtheme'),
			),
			array(
				'type' => 'description',
				'value' => '<hr class="sepline" style="margin:0 -20px;" />'
			),
			array(
				'type' => 'text',
				'name' => 'jtheme_video_url',
				'title' => __('Video URL', 'jtheme'),
				'desc' => __( 'Paste the url from popular video sites like YouTube or Vimeo. For example: <br/>
				<code>http://www.youtube.com/watch?v=nTDNLUzjkpg</code><br/>
				or<br/>
				<code>http://vimeo.com/23079092</code><br/><br/>
				See <a href="http://codex.Wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">Supported Video Sites</a>.', 'jtheme')
			),
			array(
				'type' => 'description',
				'value' => '<hr class="sepline" style="margin:0 -20px;" />'
			),
			array(
				'type' => 'textarea',
				'name' => 'jtheme_video_code',
				'title' => __('Video Code', 'jtheme'),
				'desc' => __( 'Paste the raw video code to here, such as <code>&lt;object&gt;</code>, <code>&lt;embed&gt;</code> or <code>&lt;iframe&gt;</code> code.', 'jtheme')
			),
			array(
				'type' => 'description',
				'value' => '<hr class="sepline" style="margin:0 -20px;" />'
			),
			array(
				'type' => 'description',
				'value' => __('<h1>SEO READY</h1>', 'jtheme'),
			),
			array(
				'type' => 'textarea',
				'name' => 'jtheme_meta_title',
				'title' => __('Meta Title', 'jtheme'),
				'desc' => __( 'IF you want to put your custom meta Title then put here otherwise your post title will be the default meta Title', 'jtheme')
			),
			array(
				'type' => 'textarea',
				'name' => 'jtheme_meta_description',
				'title' => __('Meta Description', 'jtheme'),
				'desc' => __( 'IF you want to put your custom meta description then put here otherwise your post description will be the default meta description', 'jtheme')
			),
			
			array(
				'type' => 'textarea',
				'name' => 'jtheme_meta_keywords',
				'title' => __('Meta Keywords', 'jtheme'),
				'desc' => __( 'IF you want to put your custom meta Keywords then put here otherwise your post TAGS will be the default meta Keywords', 'jtheme')
			),
			array(
				'type' => 'text',
				'name' => 'likes',
				'title' => __('Video Likes', 'jtheme'),
				'desc' => __( 'You can not edit likes count until this post would liked once genuinely from the front-end', 'jtheme')
			),
			array(
				'type' => 'text',
				'name' => 'views',
				'title' => __('Video Views', 'jtheme'),
				'desc' => __( 'You can not set views count until you will not preview this video once then you would be able to edit views count', 'jtheme')
			),
			
			
			
		);
		return $fields;
	}
}
jtheme_register_post_panel('jtheme_Video_Settings_Panel');