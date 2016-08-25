<?php
/**
 * 404 Page Template
 *
 * The template for displaying 404 pages (Not Found).
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.0
 */

@header('HTTP/1.1 404 Not Found', true, 404); 
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/error.css" />
<link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
<div id="main">
<div class="wrap cf">
	
	<div id="content" role="main">
		<div class="logo">
			<img src="<?php echo get_option('jtheme_logo'); ?>" />
		</div>
		<div id="post-0" class="post post-404 not-found">
		
			<div class="entry-content">
				<p>
					<?php printf(__('The Page your are looking for is not found!', "jtheme"), home_url()); ?>
				</p>
			</div>
			
			<h1 class="entry-title"><?php _e('404 Error', 'jtheme'); ?></h1>			
			
			<div class="errorbtn"><a href="<?php echo site_url(); ?>">Go To Home</a></div>
			
			<?php 
				if(get_option('jtheme_top_nav_status')) {
					$nav_menu = wp_nav_menu(array('theme_location'=>'header', 'container'=>'', 'depth'=>1, 'echo'=>0, 'fallback_cb' => '')); 

					// The fallback menu
					if(empty($nav_menu))
						$nav_menu = '<ul>'.wp_list_pages(array('depth'=>1, 'title_li'=>'', 'echo'=>0)).'</ul>';

					echo '<div class="tnav"><nav class="nav-collapse">'.$nav_menu.'</nav></div><!-- end #Top-nav -->';
				}
						// Search Box
				
				?>
				
				<?php  // Copyright
				if($copyright = get_option('jtheme_site_copyright')) 
					printf('<p id="copyright">'.$copyright.'</p>', date('Y'), '<a href="'.home_url().'">'.get_bloginfo('name').'</a>'); 
			?>
			
			<?php // Social Navigation
				if(get_option('jtheme_social_nav_status')) {
					echo '<div id="social-nav">';
						
											
						$links = get_option('jtheme_social_nav_links');
						if(!empty($links)) {
							echo '<ul>';
							
							foreach($links as $id => $args) {
								if(empty($args['status']))
									continue;
							
								echo '<li class="'.$id.'"><a target="_blank" href="'.$args['url'].'" title="'.$args['title'].'">'.$args['title'].'</a></li>';
							}
							
							echo '</ul>';
						}
					echo '</div><!-- end #social-nav -->';
				}
			?>
			
		</div><!-- #post-0 -->
	
	</div><!-- end #content -->

	
		
</div></div><!-- end #main -->
