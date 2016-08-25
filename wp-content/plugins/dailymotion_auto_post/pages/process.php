<?php defined('ABSPATH') or die("Not Allowed"); 

$channel_id = $_GET['cid'];
$channels = get_option("dmap_channels");
$settings = get_option("dmap_settings");
$channels = (!empty($channels)) ? unserialize($channels) : array();
$ch_videos = (!empty($channels[$channel_id]['posted'])) ? $channels[$channel_id]['posted'] : array();
if(array_key_exists($channel_id,  $channels)) : 
?>
<div class="wrap WP_ayvpp_styling">
	<div class="icon32" id="icon-options-general"><br></div>
	<h2>Processing <?php echo $_GET['cid']; ?></h2>
	<br />
	<br/>
	<?php 
		$count = 0;
		$dm = new  FB_DailyMotion("","");
		$videos = $dm->getUserVideos($_GET['cid']);
		$posts_total =  ($settings['posts_total']) ? $settings['posts_total'] : 1000;
		while($videos) {
			foreach($videos['list'] as $vid) {
				if(!in_array($vid->id,$ch_videos)) {
					$video = $dm->getVideo($vid->id, "poster_url,embed_url,id,title,description");
					$status = ( $settings['auto_publish'] ) ? "publish" : "draft";
					$post_data = dmap_prepear_post_data($video, $status, $channels[$channel_id]['author'], $channels[$channel_id]['cats']);
					$post_id = dmap_post_video($post_data[0],$post_data[1]);
					$ch_videos[] = $vid->id;
					$count++;
					echo "<p>".$video['title']." added</p>";
				}
			}
			if($videos['has_more'] == 'true'  && $count < $posts_total) {
				$page++;
				$videos = $dm->getUserVideos($channel_id,$page);
			} else {
				$videos = false;
				$channels[$channel_id]['posted'] = $ch_videos;
				update_option("dmap_channels", serialize($channels));
				if($count > 0 )
					echo "<h3>$count new videos added</h3>";
				else 
					echo "<h3>No new video found</h3>";
			}
		}
?>
</div>
<?php else : 

	echo "<h3>Channel Not Found</h3>";
	endif;
?>