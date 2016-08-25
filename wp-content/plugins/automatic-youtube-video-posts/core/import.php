<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//
//		File:
//			import.php
//		Description:
//			This file compiles the import form and performs import upon ajax request.
//		Copyright:
//			Copyright (c) 2016 Ternstyle LLC.
//		License:
//			This software is licensed under the terms of the End User License Agreement (EULA) 
//			provided with this software. In the event the EULA is not present with this software
//			or you have not read it, please visit:
//			http://www.ternstyle.us/automatic-video-posts-plugin-for-wordpress/license.html
//
////////////////////////////////////////////////////////////////////////////////////////////////////

/****************************************Commence Script*******************************************/

//                                *******************************                                 //
//________________________________** INITIALIZE                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
if((!isset($_GET['page']) or $_GET['page'] !== 'ayvpp-import-videos') and isset($GLOBALS['pagenow']) and $GLOBALS['pagenow'] != 'admin-ajax.php') {
	return;
}
//                                *******************************                                 //
//________________________________** ADD EVENTS                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //

add_action('init','WP_ayvpp_import_actions');

//                                *******************************                                 //
//________________________________** ACTIONS                   **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_import_actions() {
	global $getWP;
	$getWP->addError('Upgrade to the PRO version of the Automatic YouTube Video Posts Plugin now! <a href="http://www.ternstyle.us/automatic-video-posts-plugin-for-wordpress/purchase" target="_blank">Click Here.</a>');
	
}
//                                *******************************                                 //
//________________________________** SETTINGS                  **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
function WP_ayvpp_import_videos() {
	global $ayvpp_options;
	include(AYVPP_DIR.'/views/import.php');
}

/****************************************Terminate Script******************************************/
?>