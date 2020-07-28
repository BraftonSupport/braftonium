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
<!-- Begin Image Float block -->
<section id="post-<?php the_ID(); echo '-'.$sectionrow; ?>" class="<?php echo implode(' ',$classes); ?>" style="<?php
if ( $style['background_image'] ) { echo 'background-image: url(' . esc_url($style['background_image']) . ');'; }
if ( $style['background_color'] ) { echo 'background-color: ' . sanitize_hex_color($style['background_color']) . ';'; }
if ( $style['color'] ) { echo 'color: ' . sanitize_hex_color($style['color']) . ';'; } ?>" >
	
	<?php if($img){ ?>
		<div class="img-wrap <?php echo($float); ?>">
			<?php echo wp_get_attachment_image( intval($img), 'full',false, array('loading' => 'lazy') ); ?>
		</div>
	<?php } ?>
	<div class="wrap">
		<?php if ($titletext): echo $titletext; endif;
			if ($text): echo $text; endif;
		?>
	</div>
	
</section><!-- section -->
<!-- end Image Float block -->
<?php if ( $style['other'] && in_array('shadow', $style['other']) ) { echo '<div class="shadow"></div>'; } ?>