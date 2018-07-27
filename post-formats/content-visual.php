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
if (get_sub_field('title')):
	$titletext = ($sectionrow==0)?'<h1>'.get_sub_field('title').'</h1>':'<h2>'.get_sub_field('title').'</h2>';
endif;
$tagline = get_sub_field('tagline');
$button = get_sub_field('button');
$style = get_sub_field('style');
$video = $style['video_url'];

$classes = array('visual');
if ($style['add_class']){
	$classes[] = $style['add_class'];
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
	if (in_array('center', $style['other'])){
		$classes[] = "center";
	}
} ?>

<section id="post-<?php the_ID(); echo '-'.$sectionrow; ?>" class="<?php echo implode(' ',$classes); ?>" style="<?php
if ( $style['background_image'] ) { echo 'background-image: url(' . $style['background_image'] . ');'; }
if ( $style['background_color'] ) { echo 'background-color: ' . $style['background_color'] . ';'; }
if ( $style['color'] ) { echo 'color: ' . $style['color'] . ';'; } ?>" >
	<?php if ( $style['video_url'] ) {
		if (strpos($video, 'youtube.com') == true || strpos($video, '.webm') == false && strpos($video, '.mp4') == false) {
			$videoid = preg_replace('/https:\/\/www.youtube.com\/watch\?v=/', '', $video);
		?>

			<iframe id="video" src="https://www.youtube.com/embed/<?php echo $videoid; ?>?autoplay=1&mute=1&loop=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		<?php } else { ?>
			<!-- <button id="vidpause"><?php //echo get_svg_path('icon-pause'); ?></button> -->
			<video playsinline autoplay muted loop id="video">
				<source src="<?php echo $video; ?>" type="video/<?php if (strpos($video, '.webm') == true): echo 'webm'; elseif (strpos($video, '.mp4') == true): echo 'mp4'; endif; ?>">
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
	} ?><?php if ($video): echo '<div class="black">'; endif; ?><div class="wrap">

		<?php if ($titletext): echo $titletext; endif;
		if ($tagline): echo $tagline; endif;
		if ($button):
			echo '<a href="'.$button['url'].'" class="button"';
			if ($button['target']): echo 'target="'.$button['target'].'"'; endif;
			echo '>'.$button['title'].'</a>';
		endif; ?>

	<?php if ($video): echo '</div>'; endif; ?></div>
</section><!-- section -->

<?php if ( $style['other'] && in_array('shadow', $style['other']) ) { echo '<div class="shadow"></div>'; } ?>
