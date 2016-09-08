<?php
/**
 * Footer Template 
 *
 * The footer template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the bottom of the file. It is used mostly as a closing
 * wrapper, which is opened with the header.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.0
 */
?>

<?php $masonry_type = 'css3'; ?>

	<?php do_action( 'jtheme_before_footer_php' ); ?>
	
	<footer id="footer">
		<?php // Footbar
		$footbar_status = get_option('jtheme_footbar_status'); 
		$footbar_layout = get_option('jtheme_footbar_layout', 'c3');
		$masonry = get_option('jtheme_masonry', true);
		if($masonry)
			$masonry = ' class=""';
		if($footbar_status) : 
		echo '<div id="footbar" class="footbar-'.$footbar_layout.'" data-layout="'.$footbar_layout.'"><div class="wrap cf"><div id="footbar-inner"'.$masonry.'>';
			if($footbar_layout == 'c4s1') {
				for($i=1;  $i<=5; $i++) {
					$class = 'widget-col widget-col-'.$i;
				
					if($i < 5)
						$class .= ' widget-col-links';
				
					echo '<div class="'.$class.'">';
						dynamic_sidebar('footbar-'.$i);
					echo '</div>';
				}
			} else {
				dynamic_sidebar('footbar');
			}
		echo '</div></div></div><!-- end #footbar -->';
		endif;
		?>

		<div id="colophon" role="contentinfo"><div class="wrap cf">		
			
			
			<?php  // Copyright
				if($copyright = get_option('jtheme_site_copyright')) 
					printf('<p id="copyright">'.$copyright.'</p>', date('Y'), '<a href="'.home_url().'">'.get_bloginfo('name').'</a>'); 
			?>
			
			<?php // Credits
				if($credits = get_option('jtheme_site_credits')) 
					echo '<p id="credits">'.$credits.'</p>';
			?>
		</div></div><!-- end #colophon -->
	</footer><!-- end #footer -->
	
</div><!-- end #page -->

<script src="<?php echo get_template_directory_uri(); ?>/js/horizental/jquery.cbpQTRotator.js"></script>
<script>
      var navigation = responsiveNav(".nav-collapse", {
        animate: true,        // Boolean: Use CSS3 transitions, true or false
        transition: 250,      // Integer: Speed of the transition, in milliseconds
        label: "&nbsp;&nbsp;&nbsp;",        // String: Label for the navigation toggle
        insert: "before",      // String: Insert the toggle before or after the navigation
        customToggle: "",     // Selector: Specify the ID of a custom toggle
        openPos: "relative",  // String: Position of the opened nav, relative or static
        jsClass: "js",        // String: 'JS enabled' class which is added to <html> el
        init: function(){},   // Function: Init callback
        open: function(){},   // Function: Open callback
        close: function(){}   // Function: Close callback
      });
    </script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Place this tag after the last share tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
	<!-- // lieeeeeeee-->
<?php wp_footer(); ?>
	<!-- // liemmmmmmmmmmmmmmmmmmmm -->
</body>
</html>