<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
//
//		File:
//			trouble.php
//		Description:
//			This file compiles helpful information.
//		Copyright:
//			Copyright (c) 2016 Ternstyle LLC.
//
////////////////////////////////////////////////////////////////////////////////////////////////////

/****************************************Commence Script*******************************************/

//                                *******************************                                 //
//________________________________** INITIALIZE                **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
if(!isset($_GET['page']) or $_GET['page'] !== 'ayvpp-trouble') {
	return;
}
//                                *******************************                                 //
//________________________________** SETTINGS                  **_________________________________//
//////////////////////////////////**                           **///////////////////////////////////
//                                **                           **                                 //
//                                *******************************                                 //
add_action('init','WP_ayvpp_trouble_actions');

function WP_ayvpp_trouble_actions() {
	global $getWP;
	$getWP->addError('Upgrade to the PRO version of the Automatic YouTube Video Posts Plugin now! <a href="http://www.ternstyle.us/automatic-video-posts-plugin-for-wordpress/purchase" target="_blank">Click Here.</a>');
}

function WP_ayvpp_trouble() {
	global $ayvpp_options,$WP_ayvpp_ip,$WP_ayvpp_met,$getWP;
	
	$WP_ayvpp_met = ini_get('max_execution_time');
	ini_set('max_execution_time',($WP_ayvpp_met+5));
	$WP_ayvpp_met_hard = false;
	if($WP_ayvpp_met == ini_get('max_execution_time')) {
		$WP_ayvpp_met_hard = true;
	}
	
	include(AYVPP_DIR.'/views/trouble.php');
}

/****************************************Terminate Script******************************************/
?>