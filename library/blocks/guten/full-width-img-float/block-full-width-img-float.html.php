<?php
/**
 * The template used for displaying a row with an image that breaks out of normal page margins to appear opposite
 * WYSIWYG content that remains within the page margins.
 *
 * @package WordPress
 * @subpackage Braftonium
 * @since braftonium 1.0
 */
$sectionrow = $block['id'];
$title = wp_kses_post(get_field('title'));
if ($title):
	$titletext = '<h2>'.$title.'</h2>';
endif;

$floatGroup = get_field('img_float');
//ACF image field
$img = $floatGroup['image'];
//'left' (default) || 'right'
$float = $floatGroup['float'];
//WYSIWYG content opposite the image
$text = get_field('text');

$change_top = get_field('change_top');
$style = get_field('style');
$video = esc_url($style['video_url']);
$classes = array('brafton_block','row', 'full-width-image-float-row', $float);
if ($style['add_class']){
	$classes[] = sanitize_html_classes($style['add_class']);
}
$shadow = false;
if ( $style['other'] ) {
	// var_dump($style['other']);
	if(($key = array_search("shadow", $style['other'])) !== false){
		unset($style['other'][$key]);
		$shadow = true;
	}
    $classes = array_merge($classes, $style['other']);
}
if($block['className']){
    $classes[] = $block['className'];
}
?>
<!-- Begin Image Float block -->
<section id="post-<?php the_ID(); echo '-'.$sectionrow; ?>" class="<?php echo implode(' ',$classes); ?>" style="<?php
if ( $style['background_image'] ) { echo 'background-image: url(' . esc_url($style['background_image']) . ');'; }
if ( $style['background_color'] ) { echo 'background-color: ' . sanitize_hex_color($style['background_color']) . ';'; }
if ( $style['color'] ) { echo 'color: ' . sanitize_hex_color($style['color']) . ';'; } ?>" >
	
	<?php if($img){ ?>
		<div class="img-wrap <?php echo($float); ?>">
			<?php echo wp_get_attachment_image( intval($img), 'medium_large', false,array('loading' => 'lazy') ); ?>
		</div>
	<?php } ?>
	<div class="wrap">
		<?php if ($titletext): echo $titletext; endif;
			if ($text): echo $text; endif;
		?>
	</div>
	
</section><!-- section -->
<!-- end Image Float block -->
<?php if ( $shadow ) { echo '<div class="shadow"></div>'; } ?>