<?php
/*= Plugins Compatibility
 *=============================================================================*/


 
/**
 * Plugin: Contact Form 7
 *
 * @link http://wordpress.org/extend/plugins/contact-form-7/
 * @since 1.0
 */
 
// Add filter to modify the html
add_filter( 'wpcf7_form_elements', 'jtheme_wpcf7_form_elements' );
function jtheme_wpcf7_form_elements($html) {
	$html = str_replace('wpcf7-submit', 'wpcf7-submit btn btn-black', $html);
	return $html;
}

/**
 * Plugin: WP Pagenavi
 *
 * @link http://wordpress.org/extend/plugins/wp-pagenavi/
 * @since 1.0
 

// Add filter to modify the html
add_filter('wp_pagenavi', 'wp_pagenavi_filter');
function wp_pagenavi_filter($out) {
	$out = str_replace("class='previouspostslink'", 'class="prev"', $out);
	$out = str_replace("class='nextpostslink'", 'class="next"', $out);
	
	return $out;
}
*/
// Remove WP Pagenavi Style
remove_action( 'wp_print_styles', array( 'PageNavi_Core', 'stylesheets' ) );


/**
 * Plugin: Automatic Youtube Video Posts
 *
 * @url http://wordpress.org/extend/plugins/automatic-youtube-video-posts/
 * @since 1.3.7
 */

/**
 * Remove filter from the_content that added by Automatic Youtube 
 * Video Posts plugin, because we have integrated it with our theme.
 */
remove_filter('the_content','WP_ayvpp_content');

/**
 * Plugin: Video Thumbnails
 * 
 * Make theme compatible with the plugin Video Thumbnails > 2.0.1
 *
 * @url http://wordpress.org/extend/plugins/video-thumbnails/
 * @since 1.3.7
 */
function jtheme_video_thumbnail_markup( $markup, $post_id ) {
	$markup .= ' ' . get_post_meta($post_id, 'jtheme_video_code', true);
	$markup .= ' ' . get_post_meta($post_id, 'jtheme_video_url', true);

	return $markup;
}

/* Add filter to modify markup */
add_filter( 'video_thumbnail_markup', 'jtheme_video_thumbnail_markup', 10, 2 );

/*= Install Plugins
 *=============================================================================*/

// Include the TGM_Plugin_Activation class.
require_once( trailingslashit( get_template_directory() ) . 'extensions/class-tgm-plugin-activation.php' );
 
/**
 * Register the required or recommended plugins for this theme.
 *
 * @since 1.3.7 
 */
add_action( 'tgmpa_register', 'jtheme_re2plugins' );
function jtheme_re2plugins() {

    $plugins = array(
       	array(
            'name'      => 'Video Thumbnails',
            'slug'      => 'video-thumbnails',
            'required'  => false
        ),
		array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false
        ),
		array(
            'name'      => 'Automatic Youtube Video Posts',
            'slug'      => 'automatic-youtube-video-posts',
            'required'  => false
        ),
		array(
            'name'               => 'Dailymotion Auto Post',
            'slug'               => 'dailymotion_auto_post',
            'source'             => get_template_directory() . '/inc/dailymotion_auto_post.zip',
            'required'           => false,
        ),
		
	);
 
    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'jtheme';
 
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => $theme_text_domain,           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',         // Default parent menu slug
        'parent_url_slug'   => 'themes.php',         // Default parent URL slug
        'menu'              => 'install-required-plugins',   // Menu slug
        'has_notices'       => true,                         // Show admin notices or not
        'is_automatic'      => false,            // Automatically activate plugins after installation or not
        'message'           => '',               // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required &amp; Recommended Plugins', $theme_text_domain ),
            'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
            'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
        )
    );
 
    tgmpa( $plugins, $config );
 
}