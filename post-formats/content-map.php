<?php
/**
 * The template used for displaying row section of page.
 *
 * @package WordPress
 * @subpackage Business_Theme
 * @since businesstheme 2.0
 */

if(!session_id()) session_start();
$sectionrow = $_SESSION['sectionrow'];

$map = get_sub_field('map');
$google_api = get_sub_field('google_api');

$style = get_sub_field('style');
$classes = array('map');

if ($style['class']){
	$classes[] = $section_class;
}
if (!$style['background_image'] && !$style['background_color'] ) {
	$classes[] = "gradient";
}
if ( $style['other'] && in_array('full', $style['other']) ) {
	$classes[] = "full";
} ?>

<section class="<?php echo implode(' ',$classes); ?>" style="<?php
if ( $style['background_image'] ) { echo 'background-image: url(' . $style['background_image'] . ');'; }
if ( $style['background_color'] ) { echo 'background-color: ' . $style['background_color'] . ';'; }
if ( $style['color'] ) { echo 'color: ' . $style['color'] . ';'; } ?>" >
	<?php if ( $style['video_url'] ) {
		if (strpos($video, 'youtube.com') == true || strpos($video, '.webm') == false && strpos($video, '.mp4') == false) {
			$videoid = preg_replace('/https:\/\/www.youtube.com\/watch\?v=/', '', $video);
		?>

			<div id="video"></div>
		
			<script async src="https://www.youtube.com/iframe_api"></script>
			<script>
			 function onYouTubeIframeAPIReady() {
			  var player;
			  player = new YT.Player('video', {
				videoId: '<?php echo $videoid; ?>', // YouTube Video ID
				width: 1000,			   // Player width (in px)
				height: 750,			  // Player height (in px)
				playerVars: {
				  autoplay: 1,		// Auto-play the video on load
				  controls: 1,		// Show pause/play buttons in player
				  showinfo: 0,		// Hide the video title
				  modestbranding: 1,  // Hide the Youtube Logo
				  loop: 1,			// Run the video in a loop
				  fs: 1,			  // Hide the full screen button
				  rel: 0,
				  playsinline: 1,
				  cc_load_policy: 1, // Hide closed captions
				  iv_load_policy: 3,  // Hide the Video Annotations
				  autohide: 0		 // Hide video controls when playing
				},
				events: {
				  onReady: function(e) {
					e.target.mute();
				  }
				}
			  });
			 }
			</script>
		<?php } else {
			$vidstring = chop($video, '.webm');
			$vidstring = chop($vidstring, '.mp4'); ?>
			<button id="vidpause"><i class="fa fa-pause" aria-hidden="true"></i></button>
			<video playsinline autoplay muted loop id="video">
				<source src="<?php echo $vidstring; ?>.webm" type="video/webm">
				<source src="<?php echo $vidstring; ?>.mp4" type="video/mp4">
			</video>
		<?php }
	} ?><div class="wrap container">
		<div>
		<?php if( have_rows('address') ):
		echo '<h3>'.get_svg_path('icon-map-marker').' Address:</h3>';
			while ( have_rows('address') ) : the_row();
				echo get_sub_field('address_line');
				echo '<br/>';
			endwhile;
		endif;
		if( have_rows('phone') ):
			echo '<h3>'.get_svg_path('icon-phone').' Phone:</h3>';
			while ( have_rows('phone') ) : the_row();
				echo get_sub_field('phone_label').': ';
				echo get_sub_field('phone_number');
				echo '<br/>';
			endwhile;
		endif;
		if( have_rows('email_input') ):
			echo '<h3>'.get_svg_path('icon-envelope').' Email:</h3>';
			while ( have_rows('email_input') ) : the_row();
				echo get_sub_field('email_label').': ';
				echo get_sub_field('email_address');
				echo '<br/>';
			endwhile;
		endif;
		echo '</div>';
		if ($google_api): echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGilMdFrZ4H5n6C27oabY7X-r7N-63AAM"></script>'; endif;
		
		if( !empty($map) ): ?>
<div class="acf-map">
	<div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>
</div>
		<?php endif; ?>

	</div>
	<style type="text/css">

.acf-map {
	width: 100%;
	min-height: 300px;
	border: #ccc solid 1px;
}

/* fixes potential theme css conflict */
.acf-map img {
   max-width: inherit !important;
}

</style>
</section><!-- section -->

<?php if ( $style['other'] && in_array('shadow', $style['other']) ) { echo '<div class="shadow"></div>'; } ?>
<?php if ( $style['video_url'] ) { ?>
	<script>
	var vid = document.getElementById("bgvid"),
	pauseButton = document.getElementById("vidpause");
	function vidFade() {
		vid.classList.add("stopfade");
	}
	vid.addEventListener('ended', function() {
		// only functional if "loop" is removed 
		 vid.pause();
		// to capture IE10
		vidFade();
	});
	pauseButton.addEventListener("click", function() {
		vid.classList.toggle("stopfade");
		if (vid.paused) {
	vid.play();
			pauseButton.innerHTML = '<i class="fa fa-pause" aria-hidden="true"></i>';
		} else {
			vid.pause();
			pauseButton.innerHTML = '<i class="fa fa-play" aria-hidden="true"></i>';
		}
	})
	</script>
<?php } ?>