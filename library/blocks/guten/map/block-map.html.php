<?php
/**
 * The template used for displaying row section of page.
 *
 * @package WordPress
 * @subpackage Braftonium
 * @since braftonium 1.0
 */

$sectionrow = $block['id'];
$map = get_field('map');

$style = get_field('style');
$classes = array('brafton_block','map');

if ($style['add_class']){
	$classes[] = sanitize_html_classes($style['add_class']);
}
if ( $style['other'] ) {
    // var_dump($style['other']);
    $classes = array_merge($classes, $style['other']);
}
if($block['className']){
    $classes[] = $block['className'];
}
?>

<section id="post-<?php the_ID(); echo '-'.$sectionrow; ?>" class="<?php echo implode(' ',$classes); ?>" style="<?php
if ( $style['background_image'] ) { echo 'background-image: url(' . esc_url($style['background_image']) . ');'; }
if ( $style['background_color'] ) { echo 'background-color: ' . sanitize_hex_color($style['background_color']) . ';'; }
if ( $style['color'] ) { echo 'color: ' . sanitize_hex_color($style['color']) . ';'; } ?>" >
	<div class="wrap container">
		<div class="text">
		<?php if( have_rows('address') ):
		echo '<h3>'.braftonium_get_svg_path('icon-map-marker').' '. __( 'Address', 'braftonium' ) .':</h3>';
			while ( have_rows('address') ) : the_row();
				echo sanitize_text_field(get_sub_field('address_line'));
				echo '<br/>';
			endwhile;
		endif;
		if( have_rows('phone') ):
			echo '<h3>'.braftonium_get_svg_path('icon-phone').' '.  __( 'Phone', 'braftonium' ) .':</h3>';
			while ( have_rows('phone') ) : the_row();
				echo sanitize_text_field(get_sub_field('phone_label')).': ';
				echo sanitize_text_field(get_sub_field('phone_number'));
				echo '<br/>';
			endwhile;
		endif;
		if( have_rows('email_input') ):
			echo '<h3>'.braftonium_get_svg_path('icon-envelope').' '. __( 'Email', 'braftonium' ) .':</h3>';
			while ( have_rows('email_input') ) : the_row();
				echo sanitize_text_field(get_sub_field('email_label')).': ';
				echo sanitize_text_field(get_sub_field('email_address'));
				echo '<br/>';
			endwhile;
		endif;
		echo '</div>';
		if( !empty($map) ): 
			braftonium_map_script();
			?>
			<div class="acf-map">
				<div class="marker" data-lat="<?php echo sanitize_text_field($map['lat']); ?>" data-lng="<?php echo sanitize_text_field($map['lng']); ?>"></div>
			</div>
		<?php endif; ?>

	</div>
</section><!-- section -->

<?php if ( $style['other'] && in_array('shadow', $style['other']) ) { echo '<div class="shadow"></div>'; } ?>