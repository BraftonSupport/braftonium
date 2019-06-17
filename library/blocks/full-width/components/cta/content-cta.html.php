<?php
/**
 * The template used for displaying row section of page.
 *
 * @package WordPress
 * @subpackage Braftonium
 * @since braftonium 1.0
 */

global $sectionrow;
$title = wp_kses_post(get_sub_field('title'));
if ($title):
	$titletext = ($sectionrow==0)?'<h1>'.$title.'</h1>':'<h2>'.$title.'</h2>';
endif;

$text = wp_kses_post(get_sub_field('text'));
$button = get_sub_field('button');

$style = get_sub_field('style');
$video = esc_url($style['video_url']);
$classes = array('cta');
if ($style['add_class']){
	$classes[] = sanitize_html_classes($style['add_class']);
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
	if (in_array('center', $style['other'])){
		$classes[] = "center";
	}
}
?>
<!-- start CTA block -->
<section id="post-<?php the_ID(); echo '-'.$sectionrow; ?>" class="<?php echo implode(' ',$classes); ?>" style="<?php
if ( $style['background_image'] ) { echo 'background-image: url(' . esc_url($style['background_image']) . ');'; }
if ( $style['background_color'] ) { echo 'background-color: ' . sanitize_hex_color($style['background_color']) . ';'; }
if ( $style['color'] ) { echo 'color: ' . sanitize_hex_color($style['color']) . ';'; } ?>" >
<?php if ( $style['background_image'] ) { echo '<div class="black">'; } ?>
<?php if ( $style['video_url'] ) {
		if (strpos($video, 'youtube.com') == true || strpos($video, '.webm') == false && strpos($video, '.mp4') == false) {
			$videoid = preg_replace('/https:\/\/www.youtube.com\/watch\?v=/', '', $video);
		?>
			<iframe id="video" src="https://www.youtube.com/embed/<?php echo $videoid; ?>?autoplay=1&mute=1&loop=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		<?php } else { ?>
			<button id="vidpause"><?php echo braftonium_get_svg_path('icon-pause').braftonium_get_svg_path('icon-play'); ?></button>
			<video playsinline autoplay muted loop id="video">
				<source src="<?php echo $video; ?>" type="video/<?php if (strpos($video, '.webm') == true): echo 'webm'; elseif (strpos($video, '.mp4') == true): echo 'mp4'; endif; ?>">
			</video>
		<?php
			braftonium_video_script();
		}
	} ?><?php if ($video): echo '<div class="black">'; endif; ?><div class="wrap container">

		<?php echo '<div class="text">';
		if (isset($button['url'])&&!isset($button['title'])): echo '<a href="'.esc_url($button['url']).'"';
			if (isset($button['target'])): echo ' target="'.sanitize_text_field($button['target']).'"'; endif;
		echo '>'; endif;
		if (isset($titletext)): echo $titletext; endif;
		if (isset($button['url'])&&!isset($button['title'])): echo '</a>'; endif;
		if ($text): echo $text; endif;
		echo '</div>';
		if (isset($button['title'])):
			echo '<p><a href="'.esc_url($button['url']).'" class="blue-btn"';
			if ($button['target']): echo 'target="'.sanitize_text_field($button['target']).'"'; endif;
			echo '>'.sanitize_text_field($button['title']).'</a></p>';
		endif; ?>

	</div>
<?php if ( $style['background_image'] ) { echo '</div>'; } ?>
</section><!-- section -->

<?php if ( $style['other'] && in_array('shadow', $style['other']) ) { echo '<div class="shadow"></div>'; } ?>
<!-- end CTA block -->