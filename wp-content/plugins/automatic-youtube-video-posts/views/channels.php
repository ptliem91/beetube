<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="wrap ">
	
	<h2>Channels / Playlists</h2>
	<br class="clear">

	<div id="col-container">
		<div id="col-right">
			<div class="col-wrap">

				<form method="post" action="">
					
					<div class="tablenav top">
						<div class="alignleft actions">
							<select name="action">
								<option value="" selected="selected">Bulk Actions</option>
								<option value="delete">Delete</option>
								<option value="activate">Activate</option>
								<option value="deactivate">Deactivate</option>
							</select>
							<input type="submit" name="" id="doaction" class="button-secondary action" value="Apply">
						</div>
						<br class="clear">
					</div>
					
					<table class="wp-list-table widefat fixed tags" cellspacing="0">
						<thead>
						<tr class="thead">
							<th scope="col" class="manage-column column-cb check-column"><input type="checkbox" /></th>
							<th scope="col">Name</th>
							<!--<th scope="col">Channel/Playlist</th>-->
							<th scope="col">Type</th>
							<th scope="col">Catgories</th>
							<th scope="col">Author</th>
							<th scope="col">Import</th>
							<th scope="col">Activate / Deactivate</th>
						</tr>
						</thead>
						<tfoot>
						<tr class="thead">
							<th scope="col" class="manage-column column-cb check-column"><input type="checkbox" /></th>
							<th scope="col">Name</th>
							<!--<th scope="col">Channel/Playlist</th>-->
							<th scope="col">Type</th>
							<th scope="col">Categories</th>
							<th scope="col">Author</th>
							<th scope="col">Import</th>
							<th scope="col">Activate / Deactivate</th>
						</tr>
						</tfoot>
						<tbody>
							<?php foreach($ayvpp_options['channels'] as $k => $v) { $d = empty($d) ? ' class="alternate"' : ''; ?>
								<tr id='field-<?php echo $k;?>'<?php echo $d;?>>
									<th scope='row' class="manage-column column-cb check-column">
										<input type='checkbox' name='items[]' id='field_<?php echo $k;?>' value='<?php echo $k;?>' />
										
										<input type="hidden" name="name" value="<?php echo $v['name']; ?>" />
										<input type="hidden" name="channel" value="<?php echo $v['channel']; ?>" />
										<input type="hidden" name="limit" value="<?php echo $v['limit']; ?>" />
										<input type="hidden" name="publish_type" value="<?php echo $v['post_type']; ?>" />
										<input type="hidden" name="type" value="<?php echo $v['type']; ?>" />
										<input type="hidden" name="publish" value=<?php echo $v['publish']; ?> />
										<input type="hidden" name="auto_play" value=<?php echo $v['auto_play']; ?> />
										<input type="hidden" name="related_show" value=<?php echo $v['related_show']; ?> />
										<input type="hidden" name="import_description" value=<?php echo $v['import_description']; ?> />
										<input type="hidden" name="author" value=<?php echo $v['author']; ?> />
										
									</th>
									<td>
										<strong><?php echo $v['name']; ?></strong>
										<div class="row-actions">
											<span class='edit WP_ayvpp_edit'><a href="#TB_inline?width=400&height=600&inlineId=WP_ayvpp_add_item" class="thickbox"><?php _e('Edit','ayvpp'); ?></a></span> | 
											<span class="edit"><a href="admin.php?page=ayvpp-channels&items%5B%5D=<?php echo $k; ?>&action=delete&_wpnonce=<?php echo wp_create_nonce('WP_ayvpp_nonce'); ?>">Delete</a></span>
										</div>
									</td>
									<!--<td><?php echo $v['channel']; ?></td>-->
									<td><?php echo $v['type']; ?></td>
									<td>
										<?php $c = '';$d = 0;$e = ''; ?>
										
										<?php foreach($v['categories'] as $w) {
											$d = $wpdb->get_row('select * from '.$wpdb->prefix.'terms where term_id='.$w);//get_category((int)$w);
											if(!$d) {
												continue;
											}
											$c .= empty($c) ? '' : ',';
											$e .= empty($e) ? '' : ',';
											$c .= $d->name;
											$e .= $d->term_id;
										}echo $c; ?>
										<input type="hidden" name="cats" value="<?php echo $e; ?>" />
									</td>
									<td><input type="hidden" value="<?php echo $v['author']; ?>" /><?php $a = get_userdata($v['author']);echo $a->display_name; ?></td>
									<td><a href="<?php echo get_admin_url(); ?>admin.php?page=ayvpp-import-videos&channel=<?php echo $k; ?>" class="button-primary import">Import</a></td>
									<td>
										<?php if(!isset($v['activated']) or (isset($v['activated']) and $v['activated'])) { ?>
										<a href="admin.php?page=ayvpp-channels&items%5B%5D=<?php echo $k; ?>&action=deactivate&_wpnonce=<?php echo wp_create_nonce('WP_ayvpp_nonce'); ?>" class="button-primary import">Deactivate</a>
										<?php } else if(isset($v['activated']) and !$v['activated']) { ?>
										<a href="admin.php?page=ayvpp-channels&items%5B%5D=<?php echo $k; ?>&action=activate&_wpnonce=<?php echo wp_create_nonce('WP_ayvpp_nonce'); ?>" class="button-primary import">Activate</a>
										<?php } ?>
									</td>
								</tr>
							<?php
								}
							?>
						</tbody>
					</table>
					
					<div class="tablenav top">
						<div class="alignleft actions">
							<select name="action2">
								<option value="" selected="selected">Bulk Actions</option>
								<option value="delete">Delete</option>
							</select>
							<input type="submit" name="" id="doaction" class="button-secondary action" value="Apply">
						</div>
						<br class="clear">
					</div>
					
					<input type="hidden" id="page" name="page" value="ayvpp-channels" />
					<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce('WP_ayvpp_nonce');?>" />
				</form>
				<br /><br />
				<script type="text/javascript" src="https://www.ternstyle.us/automatic-video-posts-plugin-for-wordpress/embed.js"></script>
				
			</div>
		</div>
	
		<div id="col-left">
			<div class="col-wrap">
				<div class="form-wrap">
					<h3><?php _e('Add a new channel, playlist, or search term','ayvpp'); ?>:</h3>
				
					<form id="WP_ayvpp_add_item_form" method="post" action="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=ayvpp-channels">
					
						<div class="form-field">
							<label><?php _e('Name','ayvpp'); ?>:</label>
							<input type="text" name="name" size="40" />
						</div>
						
						<div class="form-field">
							<label><?php _e('Type','ayvpp'); ?>:</label>
							<select name="type" class="postform">
								<option value="channel">Channel</option>
								<option value="playlist">Playlist</option>
								<option value="search">Search</option>
							</select>
						</div>
						
						<div class="form-field">
							<label><?php _e('Channel / Playlist / Search Term','ayvpp'); ?>:</label>
							<input type="text" name="channel" size="40" />
							<p class="description"><?php _e('Enter just the name of the channel, the ID of the playlist, or the search term.','ayvpp'); ?></p>
						</div>
						
						<div class="form-field">
							<label><?php _e('Limit the number of videos imported each import to','ayvpp'); ?>:</label>
							<input type="text" name="limit" size="40" />
							<p class="description"><?php _e('Leave this field blank to set NO limit.','ayvpp'); ?></p>
						</div>
						
						<div class="form-field">
							<label><?php _e('Publish as post type','ayvpp'); ?>:</label>
							<p class="description">PRO only. <a href="https://www.ternstyle.us/automatic-video-posts-plugin-for-wordpress/purchase" target="_blank">Upgrade Now!</a></p>
						</div>
						
						<div class="form-field">
							<label><?php _e('Automatically publish posts','ayvpp'); ?>:</label>
							<input type="radio" name="publish" value=1 class="yes chk" checked /> yes &nbsp;
							<input type="radio" name="publish" value=0 class="no chk" /> no
						</div>
					
							
						<div class="form-field">
							<label><?php _e('Automatically play videos','ayvpp'); ?>:</label>
							<input type="radio" name="auto_play" value=1 class="yes chk" /> yes &nbsp;
							<input type="radio" name="auto_play" value=0 class="no chk" checked /> no
						</div>
							
						<div class="form-field">
							<label><?php _e('Show related videos at the end of each video','ayvpp'); ?>:</label>
							<input type="radio" name="related_show" value=1 class="yes chk" /> yes &nbsp;
							<input type="radio" name="related_show" value=0 class="no chk" checked /> no
							<p class="description"><?php _e('After a YouTube&reg; video completes related videos are displayed by default. Select no if you\'d prefer they\'re not displayed','ayvpp'); ?>.</p>
						</div>
						
						<div class="form-field">
							<label><?php _e('Import and display video descriptions','ayvpp'); ?>:</label>
							<input type="radio" name="import_description" value=1 class="yes chk" checked /> yes &nbsp;
							<input type="radio" name="import_description" value=0 class="no chk" /> no
							<p class="description"><?php _e('If set to yes, the YouTube&reg; video description will be imported and set as the post content.','ayvpp'); ?>.</p>
						</div>
						
						<div class="form-field">
							<label><?php _e('Add videos from this channel/playlist to the following categories','ayvpp'); ?>:</label>
							<div class="categories"><div>
								<?php foreach((array)get_terms('category',array('hide_empty'=>0)) as $k => $v) { ?>
								<label>
									<input type="checkbox" name="categories[]" class="chk" value="<?php echo $v->taxonomy; ?>|<?php echo $v->term_id; ?>" /> <?php echo $v->name; ?>
								</label>
								<?php } ?>
							</div></div>
							<p class="description">Custom taxonomies available in PRO only. <a href="https://www.ternstyle.us/automatic-video-posts-plugin-for-wordpress/purchase" target="_blank">Upgrade Now!</a></p>
						</div>
						
						<div class="form-field">
							<label><?php _e('Attribute videos from this channel to what author?','ayvpp'); ?>:</label>
							<?php wp_dropdown_users(array('name'=>'author')); ?>
						</div>
						
						<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Add Channel"></p>
						
						<input type="hidden" name="item" />
						<input type="hidden" name="action" value="add" />
						<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('WP_ayvpp_nonce'); ?>" />
					</form>
				</div>
			</div>
		</div>
		
	</div>
	<br class="clear" />
</div>