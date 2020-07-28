<?php
/**
 * The template used for displaying list section of page.
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

$show_text = get_sub_field('show_text');
	if ($show_text && in_array('intro', $show_text)): $intro = wp_kses_post(get_sub_field('intro_text')); endif;
	if ($show_text && in_array('outro', $show_text)): $outro = wp_kses_post(get_sub_field('outro_text')); endif;
$list_type = get_sub_field('list_type');
	if ($list_type=='custom'): $custom = get_sub_field('custom_list'); endif;
	if ($list_type=='recent'): $recent = get_sub_field('recent'); $number = get_sub_field('number_of_posts'); endif;
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
		echo '<div class="slick">';
			if ( $custom ) :
				$slide = get_sub_field('slide');
				foreach( $slide as $item ):
					if($item['button']):
						$url = esc_url($item['button']['url']);
						$text = sanitize_text_field($item['button']['title']);
						$target = sanitize_text_field($item['button']['target']);
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
						echo '<div class="image"><a class="prev blue-btn"></a>';
							if ($imagestyle =='circle'):
								echo wp_get_attachment_image( intval($item['image']), 'thumbnail', '', ['class' => 'round', 'loading'=> 'lazy'] );
							else:
								echo wp_get_attachment_image( intval($item['image']), 'oval', '', ['class' => 'round', 'loading'=> 'lazy'] );
							endif;
						echo '<a class="next blue-btn"></a></div>';
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
			elseif ( $recent ):
				$recent_query = new WP_Query(
					array( 
						'post_type' => $recent,
						'showposts' => $number
					)
				);
				while ($recent_query->have_posts()) : $recent_query->the_post(); ?>
				<div class="list-item"><div class="container"><?php
					if ( get_the_title($post) ):
						echo '<h3>'.get_the_title($post).'</h3>';
					endif;
					if ( has_post_thumbnail() ):
						echo '<div class="image"><a class="prev blue-btn"></a>';
							if ($imagestyle =='circle'):
								the_post_thumbnail('thumbnail', ['class' => 'round']);
							else:
								the_post_thumbnail('oval', ['class' => 'round']);
							endif;
						echo '<a class="next blue-btn"></a></div>';
					endif;
					echo '<div class="text"><p>';
						$content= get_the_content();
						$the_excerpt= substr($content,0,strpos($content,'.')+1);
						if (strlen($the_excerpt) > 125){
							echo implode(' ', array_slice(explode(' ', strip_tags($the_excerpt)), 0, 15)).'...';
						} else {
							echo strip_tags($the_excerpt);
						}
						echo '</p>';
						if ( $showbutton ){ ?>
							<a href="<?php echo get_permalink(); ?>" class="blue-btn"><?php _e( 'Read More', 'braftonium' ); echo '<span class="hide">'.$titlestring.'</span>'; ?></a>
						<?php } 
					echo '</div>';
				echo '</div></div>';
				endwhile;
				wp_reset_postdata();
				wp_reset_query();
			echo '</div>';
		endif; ?>

	<?php echo $outro; ?>
	</div>
</section><!-- section -->

<?php if ( $style['other'] && in_array('shadow', $style['other']) ) { echo '<div class="shadow"></div>'; } ?>
