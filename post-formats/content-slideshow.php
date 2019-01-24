<?php
/**
 * The template used for displaying list section of page.
 *
 * @package WordPress
 * @subpackage Braftonium
 * @since braftonium 1.0
 */

if(!session_id()) session_start();
$sectionrow = $_SESSION['sectionrow'];
$title = wp_kses_post(get_sub_field('title'));
if ($title):
	$titletext = ($sectionrow==0)?'<h1>'.$title.'</h1>':'<h2>'.$title.'</h2>';
endif;

$show_text = get_sub_field('show_text');
	if ($show_text && in_array('intro', $show_text)): $intro = wp_kses_post(get_sub_field('intro_text')); endif;
	if ($show_text && in_array('outro', $show_text)): $outro = wp_kses_post(get_sub_field('outro_text')); endif;
$imagestyle	 = get_sub_field('image_size_and_shape');
$showbutton	 = get_sub_field('showbutton');

$style = get_sub_field('style');
$classes = array('slideshow');
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
	<div class="wrap">

		<?php if ($titletext): echo $titletext; endif;
		if ($intro): echo $intro; endif;
        $slide = get_sub_field('slide');
		echo '<div class="slick">';
			foreach( $slide as $item ):
				if($item['button']):
					$url = esc_url($item['button']['url']);
					$text = sanitize_text_field($item['button']['title']);
					$target = sanitize_text_field($item['button']['target']);
				endif;
				if( is_array($imagestyle)):
					if( in_array('thumb', $imagestyle) ): $size = 'thumbnail'; endif;
					if( in_array('square', $imagestyle) ): $size = 'mediumsquared'; endif;
					if( in_array('full', $imagestyle) ): $size = 'full'; endif;
				endif;
				if ( $item['left-content'] ): $titlestring = sanitize_text_field($item['left-content']); endif;
			?>
                <div class="list-item"><div class="container"><?php
                    if ( $item['left-content'] ):
                        echo '<h3>';
                            echo $titlestring;
                        echo '</h3>';
                    endif;

				if ( $item['image'] ):
					echo '<div class="image"><a class="prev"></a>';
						if ( is_array($imagestyle) && in_array('round', $imagestyle) ):
							echo wp_get_attachment_image( intval($item['image']), $size, "", ["class" => "round"] );
						else:
							echo wp_get_attachment_image( intval($item['image']), $size );
                        endif;
					echo '<a class="next"></a></div>';
				endif;

				echo '<div class="text">';
                    if ( $item['right-content'] ): echo wp_kses_post($item['right-content']); endif;
                    if ( $showbutton && $item['button']['url'] ): echo '<a href="'.$url.'" class="blue-btn" target="'. $target.'">';
                        if ($text=='Read More'||$text==''): _e( 'Read More', 'braftonium' ); echo '<span class="hide">'. $titlestring.'</span>';
                        else: echo $text;
                        endif;
                        echo '</a>';
                    endif;
				echo '</div>';

				echo '</div></div>';
			endforeach;
		?></div>

	<?php echo $outro; ?>
	</div>
</section><!-- section -->

<?php if ( $style['other'] && in_array('shadow', $style['other']) ) { echo '<div class="shadow"></div>'; } ?>
