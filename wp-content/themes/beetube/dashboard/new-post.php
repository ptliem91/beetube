<?php

            

            $current_user = wp_get_current_user();

            ?>

            <div id="postbox">

            <form id="new_thread" name="new_thread" method="post" action="" enctype="multipart/form-data">
			
			<label for="comment">Video Title</label>
            <input type="text" id="author" value="" name="video_title" placeholder="Video Title" />
			<br/>
			
			<label for="comment">Post Description</label>
            <textarea id="comment" name="video_description"></textarea>
			<br />
			
			<div class="info-box">
				Note: Please choose one of the following ways to embed the video into your post, the video is determined in the order: 
				Video Code > Video URL > Video File.
			</div>
			
			
			<div class="video-options">
				
				<input type="radio" name="video_options" value="video_url" class="video-url" checked />
				<label for="comment">Video Link From Youtube/Vimeo etc..</label>
				<input type="radio" name="video_options" value="video_custom" class="video-custom" />
				<label for="comment">Custom Video Upload / Put custom Video URL</label>
				<input type="radio" name="video_options" value="video_embed_code" class="video-embed-code" />
				<label for="comment">Embed/Object Code</label>
			</div>
			
			<div class="video-url vid-option">
				<label for="comment">Video Link</label>
				<input type="text" id="author" value="" name="video_link" placeholder="For example: http://www.youtube.com/watch?v=nTDNLUzjkpg " />
				<p>
					Paste the url from popular video sites like YouTube or Vimeo.
					For example:
					http://www.youtube.com/watch?v=nTDNLUzjkpg 
					or 
					http://vimeo.com/23079092
				</p>
			</div>
			
			<div class="video-custom vid-option">
				<label for="comment">Put here your video url with proper extension</label>
				<input type="text" name="upload_attachment_url" id="url" size="20" placeholder="For Example:http://yousite.com/sample-video.mp4">
				<h2>OR</h2>
				<label for="comment">You can upload video here</label>
				<br/>
				<input type="file" name="upload_attachment[]" id="user-image-featured" size="20">
				<p>
					Paste your video file url to here. Supported Video Formats: mp4, m4v, webmv, webm, ogv and flv.
					About Cross-platform and Cross-browser Support. If you want your video works in all platforms and browsers(HTML5 and Flash), you should provide 
					various video formats for same video, if the video files are ready, enter one url per line. 
					For Example: 
					http://yousite.com/sample-video.m4v
					http://yousite.com/sample-video.ogv
					Recommended Format Solution: webmv + m4v + ogv.
				</p>
				<br/>
			</div>
			
			<div class="video-embed-code vid-option">
				<label for="comment">Video Embed Code</label>
				<textarea id="comment" name="video_embed_code"></textarea>
				<p>Paste the raw video code to here, such as <-object->, <-embed-> or <-iframe-> code.</p>
				<br/>
			</div>
			<?php
				$seoMeta = get_option('jtheme_seo_metaon');
				if($seoMeta == true){ ?>
			<div class="video-seo-block">
				<label for="comment">Meta Title</label>
				<textarea id="comment" name="seo_title"></textarea>
				<p>IF you want to put your custom meta Title then put here otherwise your post title will be the default meta Title</p>
				<br/>
			</div>
			
			<div class="video-seo-block">
				<label for="comment">Meta Description</label>
				<textarea id="comment" name="seo_description"></textarea>
				<p>IF you want to put your custom meta description then put here otherwise your post description will be the default meta description</p>
				<br/>
			</div>
			
			<div class="video-seo-block">
				<label for="comment">Meta Keywords</label>
				<textarea id="comment" name="seo_keywords"></textarea>
				<p>IF you want to put your custom meta Keywords then put here otherwise your post TAGS will be the default meta Keywords</p>
				<br/>
			</div>
			<?php } ?>
			<div class="video-cat">
				<label for="comment">Video Categories</label><br/>
				<?php wp_dropdown_categories( 'show_option_none=Category&tab_index=4&taxonomy=category' ); ?>
			</div>
			
			 <!-- images -->
			<div class="video-img">
				<label for="images">Featured Image:</label><br/>
				<input type="file" name="upload_attachment[]" id="user-image-featured" size="20">
			</div>
			
			<div class="video-cat">
				<label for="comment">Video Layout</label><br/>
				<select name="video_layout">
					<option selected="selected" value=""></option>
					<option value="standard">Standards</option>
					<option value="full-width">Full Width</option>
				</select>
			</div>
			
			<label for="comment">Video Tags</label>
            <input type="text" id="author" value="" name="video_tags" placeholder="Video Tags" />
				
			       
            <!-- Submit button-->
            <br />
            <input type="submit" value="Save Post" tabindex="5" id="thread_submit" name="thread_submit" class="thread-button" />

            <input type="hidden" name="insert_post" value="post" />

            <?php wp_nonce_field( 'new_thread' ); ?>

            </form>

            </div>
