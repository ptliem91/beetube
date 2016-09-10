<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the top of the file. It is used mostly as an opening
 * wrapper, which is closed with the footer.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]><html class="ie ie6 oldie" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="ie ie7 oldie" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8 oldie" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="ie ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<!-- Meta Tags -->
<meta charset="<?php bloginfo('charset'); ?>" />
<?php 
	$viewport = 'width=device-width';
	if(get_option('jtheme_responsive')){ 
		$viewport .= ', initial-scale=1, maximum-scale=1'; 
	} 
?>
<meta name="viewport" content="<?php echo $viewport; ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<!-- Title, Keywords and Description -->
<?php $post_id = $post->ID; ?>
<?php jtheme_meta_title($post_id); ?>
<?php jtheme_meta_keywords($post_id); ?>
<?php jtheme_meta_description($post_id); ?>
<meta property="og:type" content="video" />  
<meta property="og:image" content="<?php $image_id = get_post_thumbnail_id();
$image_url = wp_get_attachment_image_src($image_id,'large', true);
echo $image_url[0];  ?>"/>
<?php jtheme_sidebar_position(); ?>


<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if($favicon = get_option('jtheme_favicon')) echo '<link rel="shortcut icon" href="'.$favicon.'" />'."\n"; ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
// Generate CSS Style based on user's settings on Theme Options page
$css = '';

$bgpat = get_option('jtheme_bgpat');
$bgcolor = get_option('jtheme_bgcolor');

if($bgpat) {
	$preset_bgpat = get_option('jtheme_preset_bgpat');
	$custom_bgpat = get_option('jtheme_custom_bgpat'); 
	$bgpat = !empty($custom_bgpat) ? $custom_bgpat : $preset_bgpat;
	$bgpat = $bgpat ? 'url("'.$bgpat.'")' : '';
	$bgpat = apply_filters('jtheme_bgpat', $bgpat);
	
	$bgrep = get_option('jtheme_bgrep');
	$bgatt = get_option('jtheme_bgatt');
	$bgfull = get_option('jtheme_bgfull');
	$bgpos = 'center top';
	$bgsize = '';
	if($bgfull) {
		$bgrep = 'no-repeat';
		$bgatt = 'fixed';
		$bgsize .= '-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;';
	}
	$css .= "body{background:".implode(' ', array_filter(array($bgcolor,$bgpat,$bgrep,$bgpos,$bgatt)))." !important;".$bgsize."}\n";
	
} else {
	$css .= 'body{background:'.$bgcolor.' !important;}';
}

$info_toggle = (int)get_option('jtheme_info_toggle');
if(!empty($info_toggle))
	$css .= '.info-less{height:'.$info_toggle.'px;}';

if(!empty($css)) {
	echo "\n<!-- Generated CSS BEGIN -->\n<style type='text/css'>\n";
	echo $css;
	echo "\n</style>\n<!-- Generated CSS END -->\n";
}
echo jtheme_nav_custom_css();
$loader =  get_option('jtheme_loader');
$loaderImg =  get_option('jtheme_loader_img');
if($loader == true){
?>	
<script>
subinsblogla=0;
setInterval(function(){
if(document.readyState!='complete'){
 document.documentElement.style.overflow="hidden";
 var subinsblog=document.createElement("div");
 subinsblog.id="subinsblogldiv";
 var polu=99*99*99999999*999999999;
 subinsblog.style.zIndex=polu;
 subinsblog.style.background="#f8f8f8 url(<?php echo $loaderImg; ?>) 50% 50% no-repeat";
 subinsblog.style.backgroundPositionX="100%";
 subinsblog.style.backgroundPositionY="100%";
 subinsblog.style.position="fixed";
 subinsblog.style.right="0px";
 subinsblog.style.left="0px";
 subinsblog.style.top="0px";
 subinsblog.style.bottom="0px";
 if(subinsblogla==0){
  document.documentElement.appendChild(subinsblog);
  subinsblogla=1;
 }
}else if(document.getElementById('subinsblogldiv')!=null){
 document.getElementById('subinsblogldiv').style.display="none";
 document.documentElement.style.overflow="auto";
}
},-1000);
</script>
<?php
}
$wrap_layout = get_option('jtheme_wrap_layout');
$wrap_width = get_option('jtheme_wrap_width');
if($wrap_layout == 'boxed-wrap') : $box_style = "#page { width: $wrap_width !important; }"; endif; 
?>

<style>#back-top { position: fixed; bottom: 30px;right:0px;}#back-top  a { width: 108px; display: block; text-align: center; font: 11px/100% Arial, Helvetica, sans-serif; text-transform: uppercase; text-decoration: none; color: #bbb; -webkit-transition: 1s; -moz-transition: 1s; transition: 1s;}#back-top  a:hover { color: #000;}#back-top  span { width: 108px; height: 108px; display: block; margin-bottom: 7px; background: #ddd url(&#39;http://4.bp.blogspot.com/-0mlo-caVkrQ/Ub835FbxwKI/AAAAAAAACv4/y9bfGt2b1fs/s1600/0017.png&#39;) no-repeat center center; -webkit-border-radius: 15px; -moz-border-radius: 15px; border-radius: 15px; -webkit-transition: 1s; -moz-transition: 1s; transition: 1s;}#back-top  a:hover span{background-color: #777;} <?php echo  $box_style; ?>
</style>
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page">
<header id="header">
	<div id="top-nav">
	<div class="wrap cf">
	<?php
	if(get_option('jtheme_header_search')) { ?>				 
                 <div id="header-search">
					<ul>
					<?php if(get_option('jtheme_user_login') == true){ ?>
					<?php global $user_ID, $user_identity; get_currentuserinfo(); if (!$user_ID) { ?>  
					  <li class="acti1"><a href="<?php echo user_template_link(); ?>"><span>Are You New? </span> Register</a></li>					
					  <li class="acti2"><a href="<?php echo user_template_link(); ?>">Login</a></li>					  
					   <?php } else { // is logged in ?>
					   <li class="acti1"><a href="<?php echo user_template_link(); ?>">Howdy, <?php echo $user_identity; ?></a></li>
					  <li class="acti2"><a href="<?php echo wp_logout_url('index.php'); ?>">Logout</a></li>                  
					  <?php } }?>
					<li class="search-toggle search-toggle-normal"></li>
					</ul>
					<?php get_search_form(); ?>
				</div><!-- end #header-search -->
				<?php } 
				if(get_option('jtheme_top_nav_status')) {
					$nav_menu = wp_nav_menu(array('theme_location'=>'header', 'container'=>'', 'depth'=>1, 'echo'=>0, 'fallback_cb' => '')); 

					// The fallback menu
					if(empty($nav_menu))
						$nav_menu = '<ul>'.wp_list_pages(array('depth'=>1, 'title_li'=>'', 'echo'=>0)).'</ul>';

					echo '<div class="tnav"><nav class="nav-collapse">'.$nav_menu.'</nav></div><!-- end #Top-nav -->';
				}
						// Search Box
				
				?>
				<div class="clear"></div>
				</div></div>

<div class="header-secend">	
<div class="wrap cf">	
	<div id="branding" class="<?php echo get_option('jtheme_logo_type', 'text'); ?>-branding" role="banner">
		<?php if(is_front_page()) { ?>
			<h1 id="site-title"><a rel="home" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<?php } else { ?>
			<div id="site-title"><a rel="home" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></div>
		<?php } ?>
		
		<?php if (get_option('jtheme_logo_type') == 'image' && $logo = get_option('jtheme_logo')) { ?>
			<a id="site-logo" rel="home" href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
		<?php } ?>
		
		<?php if(is_front_page()) { ?>
			<h2 id="site-description"<?php if(!get_option('jtheme_site_description')) echo ' class="hidden"'; ?>><?php bloginfo('description'); ?></h2>
		<?php } else { ?>
			<div id="site-description"<?php if(!get_option('jtheme_site_description')) echo ' class="hidden"'; ?>><?php bloginfo('description'); ?></div>
		<?php } ?>
	</div><!-- end #branding -->
		<?php
			$headerAdcode =  get_option('jtheme_header_adcode');
			$headerAdimg =  get_option('jtheme_header_adimg');
			if(!empty($headerAdcode) && empty($headerAdimg)){
			?>
			<div class="headerbanner">
				<?php echo $headerAdcode; ?>
			</div>
			<?php
			}
			if(empty($headerAdcode) && !empty($headerAdimg)){
				?>
			<div class="headerbanner">
					<img src="<?php echo $headerAdimg; ?>" />
			</div>
			<?php
			}
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
			
	
	
</div>
</div>
</header><!-- end #header-->

<!-- liem add -->
<div>
	<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/" >

			<input type="text" size="100" name="s" id="s" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" placeholder="Gõ tên PHIM bạn muốn xem..."/>
	
		
	</form>
</div>

<div id="main-nav"><div class="wrap cf">

	<?php 
		$nav_menu = wp_nav_menu(array('theme_location'=>'main', 'container'=>'', 'fallback_cb' => '', 'echo' => 0)); 
		
		// The fallback menu
		if(empty($nav_menu)) {
			$nav_menu = '<ul class="menu">';
			$nav_menu .= '<li class=""><a rel="home" href="'.home_url().'">'.__('Home', 'jtheme').'</a></li>';
			$nav_menu .= wp_list_categories(array('title_li'=>'','current_category'   => 0, 'echo'=>0));
			$nav_menu .= '</ul>';
		}
		echo $nav_menu;
	?>
</div></div><!-- end #main-nav -->

<?php do_action( 'jtheme_after_header_php' ); ?>