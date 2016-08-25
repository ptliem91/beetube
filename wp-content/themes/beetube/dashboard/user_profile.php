<?php
/**
*
* Allow users to update their profiles from Frontend.
*
 
/* Get user info. */



global $current_user, $wp_roles;
get_currentuserinfo();
 
/* Load the registration file. */
require_once( ABSPATH . WPINC . '/registration.php' );
$error = array();
/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
 
/* Update user password. */
if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
if ( $_POST['pass1'] == $_POST['pass2'] )
wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
else
$error[] = __('<div class="error-box">The passwords you entered do not match. Your password was not updated.</div>', 'profile');
}
 
/* Update user information. */
if ( !empty( $_POST['url'] ) )
wp_update_user( array ('ID' => $current_user->ID, 'user_url' => esc_attr( $_POST['url'] )));
if ( !empty( $_POST['email'] ) ){
if (!is_email(esc_attr( $_POST['email'] )))
$error[] = __('<div class="error-box">The Email you entered is not valid. please try again.</div>', 'profile');
elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
$error[] = __('<div class="error-box">This email is already used by another user. try a different one.</div>', 'profile');
else{
wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
}
}
if ( !empty( $_POST['twitter'] ) )
wp_update_user( array ('ID' => $current_user->ID, 'twitter' => esc_attr( $_POST['twitter'] )));
if ( !empty( $_POST['facebook'] ) )
wp_update_user( array ('ID' => $current_user->ID, 'facebook' => esc_attr( $_POST['facebook'] ))); 
if ( !empty( $_POST['first-name'] ) )
update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
if ( !empty( $_POST['last-name'] ) )
update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
if ( !empty( $_POST['nickname'] ) )
update_user_meta($current_user->ID, 'nickname', esc_attr( $_POST['nickname'] ) );
if ( !empty( $_POST['display_name'] ) )
wp_update_user(array('ID' => $current_user->ID, 'display_name' => esc_attr( $_POST['display_name'] )));
update_user_meta($current_user->ID, 'display_name' , esc_attr( $_POST['display_name'] ));
if ( !empty( $_POST['description'] ) )
update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );

if( isset( $_FILES['uploadPic'] ) ){
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	$attach_id = media_handle_upload( 'uploadPic', 0 );	
	if( $attach_id > 0 ){
		update_user_meta( $current_user->ID,'bee_profile_pic', $attach_id );	
	}
}
 
/* Redirect so the page will show updated info.*/
/*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
if ( count($error) == 0 ) {
//action hook for plugins and extra fields saving
do_action('edit_user_profile_update', $current_user->ID);
wp_redirect( get_permalink().'?updated=true' ); exit;
}
}
  $userid = $current_user->ID;


?>
 
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>
<?php if ( !is_user_logged_in() ) : ?>
 
<p class="warning">
<?php _e('<div class="error-box">You must be logged in to edit your profile.</div>', 'profile'); ?>
</p><!-- .warning -->
<?php else : ?>

        
		<?php if ( $_GET['updated'] == 'true' ) : ?> <div class="success-box">Your profile has been updated.</div> <?php endif; ?>
        <?php if ( count($error) > 0 ) echo '<p class="error">' . implode("<br />", $error) . '</p>'; ?>


	<form method="post" id="adduser" action="<?php the_permalink(); ?>" enctype="multipart/form-data">
				
				<h3 class="section-title">Name Settings</h3>
				
				<p class="comment-form-author">
                <label for="first-name"><?php _e('First Name', 'profile'); ?></label>
                <input class="text-input" name="first-name" type="text" id="url" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" />
				</p>
				
				<p class="comment-form-email">
                <label for="last-name"><?php _e('Last Name', 'profile'); ?></label>
                <input class="text-input" name="last-name" type="text" id="url" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" />
				</p>
				
				<p class="comment-form-email">
                <label for="nickname"><?php _e('Nickname', 'profile'); ?></label>
                <input class="text-input" name="nickname" type="text" id="url" value="<?php the_author_meta( 'nickname', $current_user->ID ); ?>" />
				</p>
				
				<label for="display_name"><?php _e('Display name publicly as') ?></label>
                <select name="display_name" id="url"><br/>
                    <?php
                    $public_display = array();
                    $public_display['display_nickname'] = $current_user->nickname;
                    $public_display['display_username'] = $current_user->user_login;
         
                    if ( !empty($current_user->first_name) )
                    $public_display['display_firstname'] = $current_user->first_name;
         
                    if ( !empty($current_user->last_name) )
                    $public_display['display_lastname'] = $current_user->last_name;
         
                    if ( !empty($current_user->first_name) && !empty($current_user->last_name) ) {
                    $public_display['display_firstlast'] = $current_user->first_name . ' ' . $current_user->last_name;
                    $public_display['display_lastfirst'] = $current_user->last_name . ' ' . $current_user->first_name;
                    }
         
                    if ( ! in_array( $current_user->display_name, $public_display ) ) // Only add this if it isn't duplicated elsewhere
                    $public_display = array( 'display_displayname' => $current_user->display_name ) + $public_display;
                     
                    $public_display = array_map( 'trim', $public_display );
                    $public_display = array_unique( $public_display );
         
                    foreach ( $public_display as $id => $item ) {
                    ?>
                    <option <?php selected( $current_user->display_name, $item ); ?>><?php echo $item; ?></option>
                    <?php
                    }
                    ?>
                </select>
				
			<h3 class="section-title cnt">Contact Info</h3>
			
				
				<p class="comment-form-author">
                <label for="email"><?php _e('E-mail *', 'profile'); ?></label>
                <input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" />
				</p>
				
				<p class="comment-form-email">
                <label for="url"><?php _e('Website URL', 'profile'); ?></label>
                <input class="text-input" name="url" type="text" id="url" value="<?php the_author_meta( 'user_url', $current_user->ID ); ?>" />
				</p>
				
				<p class="comment-form-email">
				<label for="url"><?php _e('Facebook', 'profile'); ?></label>
                <input class="text-input" name="facebook" type="text" id="url" value="<?php the_author_meta( 'facebook', $current_user->ID ); ?>" />
				</p>
				
				<p class="comment-form-author">
				<label for="url"><?php _e('Twitter', 'profile'); ?></label>
                <input class="text-input" name="twitter" type="text" id="url" value="<?php the_author_meta( 'twitter', $current_user->ID ); ?>" />
				</p>
				<div class="clear"></div>
				
				<label for="description"><?php _e('Biographical Information', 'profile') ?></label>
                <textarea name="description" id="comment" rows="3" cols="50"><?php the_author_meta( 'description', $current_user->ID ); ?></textarea>
           
		   <h3 class="section-title cnt">Password Setting</h3>
		   
				<p class="comment-form-author">
                <label for="pass1"><?php _e('Password *', 'profile'); ?> </label>
                <input class="text-input" name="pass1" type="password" id="url" />
				</p>
				
				<p class="comment-form-email">
                <label for="pass2"><?php _e('Repeat Password *', 'profile'); ?></label>
                <input class="text-input" name="pass2" type="password" id="url" />
				</p>
               <div class="clear"></div>
        	<h3 class="section-title cnt">Upload Picture</h3>
            <p class="comment-form-picture">
            	<label for="uploadPic"><?php _e('Upload Picture', 'profile'); ?> </label>
                <input name="uploadPic" type="file" id="uploadPic" />
            </p>
				<?php
				//action hook for plugin and extra fields
				do_action('edit_user_profile',$current_user);
				?>
        
        
				<p class="form-submit">
					<?php echo $referer; ?>
					<input name="updateuser" type="submit" id="updateuser" class="submit button btnadtextform" value="<?php _e('Update', 'profile'); ?>" />
					<?php wp_nonce_field( 'update-user_'. $current_user->ID ) ?>
					<input name="action" type="hidden" id="action" value="update-user" />
				</p><!-- .form-submit -->
	
	
	</form><!-- #adduser -->

	<?php endif; ?>
	
<?php endwhile; ?>
<?php else: ?>

<p class="no-data">
<?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
</p><!-- .no-data -->
<?php endif; ?>
