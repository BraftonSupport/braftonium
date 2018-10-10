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
$list_type = get_sub_field('list_type');
	if ($list_type=='custom'): $custom = get_sub_field('custom_list'); endif;
	if ($list_type=='recent'): $recent = get_sub_field('recent'); $number = get_sub_field('number_of_posts'); endif;
$imagestyle	 = get_sub_field('image_size_and_shape');
$showbutton	 = get_sub_field('showbutton');

$style = get_sub_field('style');
$classes = array('list');
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
	if (in_array('thin', $style['other'])){
		$classes[] = "thin";
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
		
		if ( $custom ) :
		$count = count($custom);
		echo '<div class="container count'.$count.'">';
			foreach( $custom as $item ):
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
				if ( $item['title'] ): $titlestring = sanitize_text_field($item['title']); endif;
			?>
				<div class="list-item"><?php
				if ( $item['button'] ): echo '<a href="'.$url.'" target="'. $target.'" name="'.$titlestring.'>'; endif;
				if ( $item['image'] ):
					echo '<div class="image">';
						if ( is_array($imagestyle) && in_array('round', $imagestyle) ):
							echo wp_get_attachment_image( intval($item['image']), $size, "", ["class" => "round"] );
						else:
							echo wp_get_attachment_image( intval($item['image']), $size );
						endif;
					echo '</div>';
				endif;
				if ( $item['button'] ): echo '</a>'; endif;

				if ( $item['title'] ):
					echo '<h3>';
					 if ($url): echo '<a href="'.$url.'" target="'. $target.'">'; endif;
					 if (strlen($titlestring) > 65){
						 $titlestring = implode(' ', array_slice(explode(' ', $titlestring), 0, 10)).'...';
					 }
					 echo $titlestring.'</a></h3>';
				endif;
				echo '<div class="text">';
				if ( $item['content'] ): echo wp_kses_post($item['content']); endif;
				echo '</div>';
				
				if ( $showbutton && $url ): echo '<a href="'.$url.'" class="blue-btn" target="'. $target.'">';
					if ($text=='Read More'||$text==''): _e( 'Read More', 'braftonium' ); echo '<span class="hide">'. $titlestring.'</span>';
					else: echo $text;
					endif;
					echo '</a>';
				endif;

				echo '</div>';
			endforeach;
			
		elseif ( $recent ):
			if ($number==0){
				$number = wp_count_posts($recent)->publish;
			}
		echo '<div class="container count'.$number.'">';
			$recent_query = new WP_Query(
				array( 
					'post_type' => $recent,
					'showposts' => $number
				)
			);
			while ($recent_query->have_posts()) : $recent_query->the_post();
				$titlestring = get_the_title($post); ?>
				<div class="list-item"><a href="<?php the_permalink() ?>" name="<?php echo $titlestring; ?>">
					<?php if ( $imagestyle && in_array('round', $imagestyle) && has_post_thumbnail() ){
						?><div class="image"><?php
						 the_post_thumbnail('mediumsquared', ['class' => 'round']);
						 ?></div><?php
					} elseif( has_post_thumbnail()){
						?><div class="image"><?php
						the_post_thumbnail('mediumsquared');
						?></div><?php
					}
					?>
						<h3><?php
						if (strlen($titlestring) > 65){
							$titlestring = implode(' ', array_slice(explode(' ', $titlestring), 0, 10)).'...';
						}
						echo $titlestring;
						?></h3></a>
					<?php
						echo '<p class="text">';
						$content= get_the_content();
						$the_excerpt= substr($content,0,strpos($content,'.')+1);
						if (strlen($the_excerpt) > 125){
							echo implode(' ', array_slice(explode(' ', strip_tags($the_excerpt)), 0, 15)).'...';
						} else {
							echo strip_tags($the_excerpt);
						}
						echo '</p>';
					if ( $showbutton ){ ?>
						<a href="<?php echo get_permalink(); ?>" class="button"><?php _e( 'Read More', 'braftonium' ); echo '<span class="hide">'.$titlestring.'</span>'; ?></a>
					<?php } ?>
				</div>
			<?php endwhile;
			wp_reset_postdata();
			wp_reset_query();
		endif;
		?></div>

	<?php echo $outro; ?>
	</div>
</section><!-- section -->

<?php if ( $style['other'] && in_array('shadow', $style['other']) ) { echo '<div class="shadow"></div>'; } ?>