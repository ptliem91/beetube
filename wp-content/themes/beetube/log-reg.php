<?php
/**
 * Template Name: Login/Register
 * 
 * If you want to set up an alternate home page, just use this template for your page.
 *
 * @package BeeeTube
 * @subpackage Page Template
 *  1.0
 */
 get_header();
?>

 
	<?php global $user_ID, $user_identity; get_currentuserinfo(); if (!$user_ID) { 
	
			$refer = $_SERVER['REQUEST_URI'];
			 if(strpos($refer,'?') !== false) {
			   $refer .= '&register=true';
			} else {
			   $refer .= '?register=true';
			}

			?>

			<?php $register = $_GET['register']; $reset = $_GET['reset']; if ($register == true) { ?>
			
			<div class="alert alert-success" style="text-align:center">
				
				<strong>Well done! You successfully Registered </strong><br />
				<a class="alert-link" >Check your email for the password and then return to log in.</a>.
				
			</div>
			<?php } elseif ($reset == true) { ?>
				<div class="alert alert-success" style="text-align:center">
				
				<strong>Well done! Updated Password </strong><br />
				<a class="alert-link" >Check your email to reset your password.</a>.
				
			</div>
			<?php } else { ?>

			
			<?php } ?>
	<div class="wrap cf ">
	
		<div class="user-container">
		
		
			<div class="login-container left">			
				<div class="login">
				
					<h2 class="form-heading">LOGIN FORM</h2>
					<p></p>
					
					<form method="post" action="<?php bloginfo('url') ?>/wp-login.php" class="wp-user-form">
						<div class="form-group">
							<label for="user_login"><?php _e('Username'); ?></label>
							<input type="text" class="form-control" id="user_login" placeholder="Enter email" name="log" value="<?php echo esc_attr(stripslashes($user_login)); ?>" />
						</div>
						<div class="form-group">
							<label for="user_pass"><?php _e('Password'); ?></label>
							<input type="password" class="form-control" placeholder="Password" name="pwd" value="" id="user_pass">
						</div>
								  
						<div class="rememberme">
							<label for="rememberme">
							<input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" tabindex="13" /> Remember me
							</label>
						</div>
						<?php do_action('login_form'); ?>
						<input type="submit" name="user-submit" value="<?php _e('Login'); ?>" tabindex="14" class="user-submit" />
						<input type="hidden" name="redirect_to" value="<?php bloginfo('url') ?>" />
						<input type="hidden" name="user-cookie" value="1" />
					</form>
					<p class="forget acti3">
							<a href="#">Forgot your password?</a>
				    </p>
				</div>
			</div>
			
			
			<div class="login-container right">			
				<div class="login">
				
					<h2 class="form-heading">REGISTER FORM</h2>
					<p>Get Started with a new Account</p>
					
					<form method="post" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" class="wp-user-form">
						<div class="username">
							<label for="user_login"><?php _e('Username'); ?>: </label>
							<input type="text" name="user_login" value="<?php echo esc_attr(stripslashes($user_login)); ?><?php if($user){ echo $user_profile['username'] ; } ?>" size="20" id="user_login" tabindex="101" />
						</div>
						<div class="password">
							<label for="user_email"><?php _e('Your Email'); ?>: </label>
							<input type="text" name="user_email" value="<?php echo esc_attr(stripslashes($user_email)); ?><?php if($user){ echo $user_profile['email'] ; } ?>" size="25" id="user_email" tabindex="102" />
						</div>
						<div class="login_fields">
							<?php do_action('register_form'); ?>
							<input type="submit" name="user-submit" value="<?php _e('Sign up!'); ?>" class="user-submit" tabindex="103" />
							<input type="hidden" name="redirect_to" value="<?php echo $refer; ?>" />
							<input type="hidden" name="user-cookie" value="1" />
						</div>
					</form>
					
					<p class="forget acti3">
							After sign up please visit your email to get password! 
				    </p>
				</div>
			</div>
			<br clear="all" />
			
		</div>
		
		
		
		
		<div class="forgot-container">
		
		
			<div class="login-container right">			
				<div class="login">
				
					<h2 class="form-heading">FORGOT PASSWORD</h2>
					<p>Set Your New Password</p>
					
					<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
						<div class="username">
							<label for="user_login" class="hide"><?php _e('Username or Email'); ?>: </label>
							<input type="text" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
						</div>
						<div class="login_fields">
							<?php do_action('login_form', 'resetpass'); ?>
							<input type="submit" name="user-submit" value="<?php _e('Reset my password'); ?>" class="user-submit" tabindex="1002" />
							<?php $reset = $_GET['reset']; if($reset == true) { echo '<p>A message will be sent to your email address.</p>'; } ?>
							<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true" />
							<input type="hidden" name="user-cookie" value="1" />
						</div>
					</form>
					<p class="forget acti3">
							Visit your email to get New password! 
				    </p>
					
				</div>
			</div>
			<br clear="all" />
			
		</div>
	
	
	</div>
<?php } else { // is logged in ?>
<?php
			function insert_attachment($file_handler,$post_id,$setthumb='false') {
 
		// check to make sure its a successful upload
		if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();
		 
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		 
		$attach_id = media_handle_upload( $file_handler, $post_id );
		 
		if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);
		return $attach_id;	
		
		} 

            if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['insert_post'] )) { //check that our form was submitted
           
            $title = $_POST['video_title']; //set our title

            if ($_POST['video_description']=="") { // check if a description was entered
            $description = "See Video title..."; // if not, use placeholder
            } else {
            $description = $_POST['video_description']; //if so, use it
            }

            $tags = $_POST['video_tags']; //load thread tags (custom tax) into array
			

            $post = array( //our wp_insert_post args
            'post_title'    => wp_strip_all_tags($title),
            'post_content'  => $description,
            'post_category' => array('0' => $_POST['cat']),
            'tax_input' => array('post_tag' => $tags),
            'post_status'   => 'pending',
            'post_type' => 'post'
            );

            $my_post_id = wp_insert_post($post); //send our post, save the resulting ID
			
			$videoLink = $_POST['video_link'];
			$videoCustomLink = $_POST['upload_attachment_url'];
			$videoEmbed = $_POST['video_embed_code'];
			$videoLayout = $_POST['video_layout'];
			$videotitle = $_POST['seo_title'];
			$videoDescription = $_POST['seo_description'];
			$videoKeywords = $_POST['seo_keywords'];
			
			
            $current_user = wp_get_current_user(); //check who is logged in
			if(!empty($_POST['upload_attachment_url'])){
			add_post_meta($my_post_id, 'jtheme_video_file', $videoCustomLink);
            }
			add_post_meta($my_post_id, 'jtheme_video_layout', $videoLayout);            
            add_post_meta($my_post_id, 'jtheme_video_url', $videoLink);
            add_post_meta($my_post_id, 'jtheme_video_code', $videoEmbed);
			//Seo 
            add_post_meta($my_post_id, 'jtheme_meta_title', $videotitle);
            add_post_meta($my_post_id, 'jtheme_meta_description', $videoDescription);
            add_post_meta($my_post_id, 'jtheme_meta_keywords', $videoKeywords);
			
		global $post;		 
		if (isset($_FILES['upload_attachment'])) {
		$files = $_FILES['upload_attachment'];
			foreach ($files['name'] as $key => $value) {
				if ($files['name'][$key]) {
					$file = array(
					'name' => $files['name'][$key],
					'type' => $files['type'][$key],
					'tmp_name' => $files['tmp_name'][$key],
					'error' => $files['error'][$key],
					'size' => $files['size'][$key]
					);
					 
					$_FILES = array("upload_attachment" => $file);
					foreach ($_FILES as $file => $array) {
					$newupload2 = insert_attachment($file,$post->ID);
					$attachvideo = wp_get_attachment_url( $newupload2);
					add_post_meta($my_post_id, 'jtheme_video_file', $attachvideo);
					set_post_thumbnail( $my_post_id, $newupload2 );
					}
				}
			}
		}		
						
			

			$postSuccess = '<div class="success-box">Your post has posted successfully</div>';
			$displayPost = 'block'; 
			$displayUser= 'none';
			$profileactibtn = '';
			$postactibtn = 'author-optionn';
            }
			if(empty($displayPost)){$displayPost = 'none'; $postactibtn = ''; }
			if(empty($displayUser)){$displayUser = 'block'; $profileactibtn = 'author-option'; }
			
			?>
				

		<div class="wrap cf ">
	
			<div class="dashboard-container">
				<div class="author-msg">
					<h2>Hi <?php global $user_ID, $user_identity; get_currentuserinfo(); echo $user_identity ?></h2>
					<p>Welcome to Dashboard, Here you can change anything you want except of User name. </p>
				</div>
				
				<div class="author-content">
				
					<div  class="leftbar">
						<div class="profilepic">
						<?php 
						echo get_avatar($user_ID, 90, get_bloginfo('template_url') . '/images/gravatar.png');
						?>
                        </div>
                        
                        <div class="profilebtn <?php echo $profileactibtn; ?>"></div>
						
						<div class="newpostbtn <?php echo $postactibtn; ?>"></div>
						
                        <div class="clear"></div>
					</div>
					
					<div class="rightbar">
					<?php echo $postSuccess; ?>
						<div class="user-profile" style="display:<?php echo $displayUser; ?>">
							<?php
							get_template_part('dashboard/user_profile');
							?>
						</div>
						
						<div class="new-post" style="display:<?php echo $displayPost; ?>">
						<h3 class="section-title">Add New Post</h3>
							<?php
							get_template_part('dashboard/new-post');
							?>
						</div>
						
					</div>
					<div class="clear"></div>
					
				</div>
				
			</div>
			
		</div>
		
		<?php }

       get_footer();

		?>