<?php
/**
 * The template used for displaying a row with an image that breaks out of normal page margins to appear opposite
 * WYSIWYG content that remains within the page margins.
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

$floatGroup = get_sub_field('img_float');
//ACF image field
$img = $floatGroup['image'];
//'left' (default) || 'right'
$float = $floatGroup['float'];
//WYSIWYG content opposite the image
$text = get_sub_field('text');

$change_top = get_sub_field('change_top');
$style = get_sub_field('style');
$video = esc_url($style['video_url']);
$classes = array('row', 'full-width-image-float-row', $float);
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
} ?>
<section id="post-<?php the_ID(); echo '-'.$sectionrow; ?>" class="<?php echo implode(' ',$classes); ?>" style="<?php
if ( $style['background_image'] ) { echo 'background-image: url(' . esc_url($style['background_image']) . ');'; }
if ( $style['background_color'] ) { echo 'background-color: ' . sanitize_hex_color($style['background_color']) . ';'; }
if ( $style['color'] ) { echo 'color: ' . sanitize_hex_color($style['color']) . ';'; } ?>" >
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
	} ?><?php if ($video): echo '<div class="black">'; endif; ?>
	<?php /** BEGIN UNIQUE LAYOUT */
	if($img){ ?>
		<div class="img-wrap <?php echo($float); ?>">
			<?php echo wp_get_attachment_image( intval($img), 'full' ); ?>
		</div>
	<?php } ?>
	<div class="wrap">
		<?php if ($titletext): echo $titletext; endif;
			if ($text): echo $text; endif;
		?>
	</div>
	
</section><!-- section -->

<?php if ( $style['other'] && in_array('shadow', $style['other']) ) { echo '<div class="shadow"></div>'; } ?>