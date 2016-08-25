<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="wrap ayvpp-wrap">
	
	<h2>Video Posts Settings</h2>

	<div class="ayvpp-right">
		<script type="text/javascript" src="https://www.ternstyle.us/automatic-video-posts-plugin-for-wordpress/embed.js"></script>
	</div>

	<form method="post" action="" class="ayvpp-left">
	
		<hr />
		<h3>Plugin Settings</h3>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="key">API Key:</label></th>
				<td>
					<input type="text" name="key" class="regular-text" value="<?php echo $ayvpp_options['key'];?>" />
					<span class="description">You must provide a valid configured Google API Key to use this plugin! <a href="https://code.google.com/apis/console" target="_blank">https://code.google.com/apis/console</a></span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="cron">Import the latest videos every:</label></th>
				<td>
					<?php echo $ternSel->create(array(
						'data'		=>	array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24),
						'name'		=>	'cron',
						'selected'	=>	array((int)$ayvpp_options['cron'])
						
					)); ?> hours<br />
					<span class="description">Set this to determine how many hours to wait between imports. PLEASE NOTE: THIS PLUGIN USES PSEUDO CRON JOBS. IT IS NOT AN ACTUAL CRON JOB. THEREFORE UNLESS SOMEONE VISITS YOUR SITE AT OR AFTER THE SPECIFIED AMOUNT OF TIME IN THIS SETTING THE VIDEOS WILL NOT BE IMPORTED UNTIL THE NEXT VISIT.<br /><br />If you just can't wait <a href="admin.php?page=ayvpp-import-videos">click here</a>.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="admin_import">Import only when logged:</label></th>
				<td>
					<input type="radio" name="admin_import" value="1" <?php if($ayvpp_options['admin_import']) { echo 'checked'; }?> /> yes 
					<input type="radio" name="admin_import" value="0" <?php if(!$ayvpp_options['admin_import']) { echo 'checked'; }?> /> no<br />
					<span class="description">If you set this option to "no" some of your users may have very long wait times to see your site. It is recommended that you keep this set to "yes."</span>
				</td>
			</tr>
		</table>
		<p class="submit"><input type="submit" name="submit" class="button-primary" value="Save Changes" /></p>
		
		<hr />
		<h3>Display Settings</h3>
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="import_thumbnails">Set publish date to time of import instead of YouTube upload date:</label></th>
				<td>
					<input type="radio" name="import_date" value="1" <?php if($ayvpp_options['import_date']) { echo 'checked'; }?> /> yes 
					<input type="radio" name="import_date" value="0" <?php if(!$ayvpp_options['import_date']) { echo 'checked'; }?> /> no<br />
					<span class="description">If you set this to yes all videos will have a publish date of the time they were imported into WordPress&trade;.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="content_display_meta">Display video meta:</label></th>
				<td>
					<input type="radio" name="content_display_meta" value="1" <?php if($ayvpp_options['content_display_meta']) { echo 'checked'; }?> /> yes 
					<input type="radio" name="content_display_meta" value="0" <?php if(!$ayvpp_options['content_display_meta']) { echo 'checked'; }?> /> no<br />
					<span class="description">This option will display or hide the video post meta such as the author and post date when viewing your video post.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="content_truncate">Do you want to add the WordPress "More" tag to your video descriptions?:</label></th>
				<td>
					<input type="radio" name="content_truncate" value="1" <?php if($ayvpp_options['content_truncate']) { echo 'checked'; }?> /> yes 
					<input type="radio" name="content_truncate" value="0" <?php if(!$ayvpp_options['content_truncate']) { echo 'checked'; }?> /> no<br />
					<span class="description">If yes, the more tag will be added so that the whole video description isn't displayed in your post lists.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="content_truncate_after">Number of words before Wordpress' "More" tag:</label></th>
				<td>
					<?php echo $ternSel->create(array(
						'data'		=>	array(10,20,25,30,35,40,45,50,100,200),
						'name'		=>	'content_truncate_after',
						'selected'	=>	array((int)$ayvpp_options['content_truncate_after'])
						
					)); ?>
					<span class="description">This defines the number of words after which the excerpt will cut-off.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="content_top">Place video after description:</label></th>
				<td>
					<input type="radio" name="content_top" value="1" <?php if($ayvpp_options['content_top']) { echo 'checked'; }?> /> yes 
					<input type="radio" name="content_top" value="0" <?php if(!$ayvpp_options['content_top']) { echo 'checked'; }?> /> no<br />
					<span class="description">If yes, the video in each post will be programmatically added after the description.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="video_responsive">Do you want your videos to be responsive?:</label></th>
				<td>
					<input type="radio" name="video_responsive" value="1" <?php if($ayvpp_options['video_responsive']) { echo 'checked'; }?> /> yes 
					<input type="radio" name="video_responsive" value="0" <?php if(!$ayvpp_options['video_responsive']) { echo 'checked'; }?> /> no<br />
					<span class="description">If yes, your videos will become 100% width of their containing element and scale to fit the device being used.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="video_responsive_ratio">Responsive video ratio:</label></th>
				<td>
					<?php echo $ternSel->create(array(
						'data'		=>	array('1:1','3:2','4:3','5:3','5:4','16:9'),
						'name'		=>	'video_responsive_ratio',
						'selected'	=>	array($ayvpp_options['video_responsive_ratio'])
						
					)); ?>
					<span class="description">This defines the ratio by which your responsive videos will scale.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="video_dims">Video dimensions:</label></th>
				<td>
					<input type="text" name="video_dims[]" class="regular-text" value="<?php echo $ayvpp_options['video_dims'][0];?>" /> x <input type="text" name="video_dims[]" class="regular-text" value="<?php echo $ayvpp_options['video_dims'][1];?>" /><br />
					<span class="description">This defines the dimensions of the videos placed in their respective posts.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="video_post_list_show">Display videos in post lists:</label></th>
				<td>
					<input type="radio" name="video_post_list_show" value="1" <?php if($ayvpp_options['video_post_list_show']) { echo 'checked'; }?> /> yes 
					<input type="radio" name="video_post_list_show" value="0" <?php if(!$ayvpp_options['video_post_list_show']) { echo 'checked'; }?> /> no<br />
					<span class="description">If set to yes, videos assigned to posts will be displayed in the posts truncated content in post loops.</span>
				</td>
			</tr>
		</table>
		<p class="submit"><input type="submit" name="submit" class="button-primary" value="Save Changes" /></p>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce('WP_ayvpp_nonce');?>" />
		<input type="hidden" name="_wp_http_referer" value="<?php wp_get_referer(); ?>" />
	</form>
</div>