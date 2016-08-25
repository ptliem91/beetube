<?php
$id = get_query_var( 'author' );
$author_name =  get_the_author_meta( 'display_name', $id);
$author_bio =  get_the_author_meta( 'description', $id);
$author_web =  get_the_author_meta( 'user_url', $id);
$author_fb =  get_the_author_meta( 'facebook', $id);
$author_tw =  get_the_author_meta( 'twitter', $id);
?>
<div class="author-info">
	<div class="author-thumb"><?php echo get_avatar(get_the_author_meta( 'ID' ), 70, get_bloginfo('template_url') . '/images/gravatar.png'); ?></div>
	<div class="author-bio">
		<h3>About <a><?php echo $author_name; ?></a> </h3>
		<p><?php echo $author_bio; ?></p>
		<div class="author-links">
			<p class="url">Website: <a target="_blank" href="<?php echo $author_web; ?>"><?php echo $author_web; ?></a>  </p>
			<div id="social-nav">
				<ul>
					<li class="facebook">
					<a title="Become a fan on Facebook" href="<?php echo $author_fb; ?>" target="_blank">Become a fan on Facebook</a>
					</li>
					<li class="twitter">
					<a title="Follow us on twitter" href="<?php echo $author_tw; ?>" target="_blank">Follow us on twitter</a>
					</li>
					
				</ul>
				
			</div>
			<div class="clear"></div>
		
		</div>
	</div>
	<div class="clear"></div>

</div>