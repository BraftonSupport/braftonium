<?php
/**
 * The template used for displaying visual section of page.
 *
 * @package WordPress
 * @subpackage Braftonium
 * @since braftonium 1.0
 */

if(!session_id()) session_start();
$sectionrow = $_SESSION['sectionrow'];
if (get_sub_field('title')){
	$titletext = ($sectionrow==0)?'<h1>'.get_sub_field('title').'</h1>':'<h2>'.get_sub_field('title').'</h2>';
}
$tagline = get_sub_field('tagline');
$button = get_sub_field('button');
$style = get_sub_field('style');
$video = $style['video_url'];

$classes = array('visual');
if ($style['class']){
	$classes[] = $section_class;
}
if ($video){
	$classes[] = 'video';
}

if (!$style['background_image'] && !$style['background_color'] ) {
	$classes[] = "gradient";
}
if ( $style['other'] ) {
	if (in_array('full', $style['other'])){
		$classes[] = "full";
	}
	if (in_array('compact', $style['other'])){
		$classes[] = "compact";
	}
	if (in_array('thin', $style['other'])){
		$classes[] = "thin";
	}
} ?>

<section class="<?php echo implode(' ',$classes); ?>" style="<?php
	if ( $style['background_image'] && !$video ) { echo 'background-image: url(' . $style['background_image'] . ');'; }
	if ( $style['background_color'] && !$video ) { echo 'background-color: ' . $style['background_color'] . ';'; }
	if ( $style['color'] ) { echo 'color: ' . $style['color'] . ';'; } ?>" >

<div class="wrap">

<?php echo $titletext;
echo $tagline;
if ($button):
	echo '<a href="'.$button['url'].'" class="button"';
	if ($button['target']): echo 'target="'.$button['target'].'"'; endif;
	echo '>'.$button['title'].'</a>';
endif; ?>

</div>

	<?php if ( $video ) {
		if (strpos($video, 'youtube.com') == true ) {
			$videoid = preg_replace('/https:\/\/www.youtube.com\/watch\?v=/', '', $video);
		?>

			<iframe id="video" src="https://www.youtube.com/embed/<?php echo $videoid; ?>?autoplay=1&mute=1&loop=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		<?php } else {
			$vidstring = chop($video, '.webm');
			$vidstring = chop($vidstring, '.mp4'); ?>
			<!-- <button id="vidpause"><?php //echo get_svg_path('icon-pause'); ?></button> -->
			<video playsinline autoplay muted loop id="video">
				<source src="<?php echo $vidstring; ?>.webm" type="video/webm">
				<source src="<?php echo $vidstring; ?>.mp4" type="video/mp4">
			</video>
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
						// pauseButton.innerHTML = '<i class="fa fa-pause" aria-hidden="true"></i>';
					} else {
						vid.pause();
						// pauseButton.innerHTML = '<i class="fa fa-play" aria-hidden="true"></i>';
					}
				})
				</script>
		<?php }
	} ?>
</section><!-- section -->

<?php if ( $style['other'] && in_array('shadow', $style['other']) ) { echo '<div class="shadow"></div>'; } ?>
