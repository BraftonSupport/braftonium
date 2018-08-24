<?php
/**
 * The template used for displaying slider section of page.
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

$list_type = get_sub_field('list_type');
	if ($list_type=='custom'): $custom = get_sub_field('custom_list'); endif;
	if ($list_type=='recent'): $recent = sanitize_text_field(get_sub_field('recent')); $number = intval(get_sub_field('number_of_posts')); endif;
	$showbutton	 = get_sub_field('showbutton');
$style = get_sub_field('style');
$imagestyle	 = get_sub_field('image_size_and_shape');
$classes = array('validation');
if ($style['add_class']){
	$classes[] = sanitize_html_class($style['add_class']);
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
}

braftonium_slick_script();
?>

<section id="post-<?php the_ID(); echo '-'.$sectionrow; ?>" class="<?php echo implode(' ',$classes); ?>" style="<?php
if ( $style['background_image'] ) { echo 'background-image: url(' . esc_url($style['background_image']) . ');'; }
if ( $style['background_color'] ) { echo 'background-color: ' . sanitize_hex_color($style['background_color']) . ';'; }
if ( $style['color'] ) { echo 'color: ' . sanitize_hex_color($style['color']) . ';'; } ?>" >
	<div class="wrap">

		<?php if ($titletext): echo $titletext; endif;
		echo '<div class="slick">';
		if ( $custom ) :
			foreach( $custom as $item ):
				if ($item['button']){
					$url = esc_url($item['button']['url']);
					$text = sanitize_text_field($item['button']['text']);
				}
				if( is_array($imagestyle)):
					if( in_array('thumb', $imagestyle) ): $size = 'thumbnail'; endif;
					if( in_array('square', $imagestyle) ): $size = 'mediumsquared'; endif;
					if( in_array('full', $imagestyle) ): $size = 'full'; endif;
				endif;
			?>
				<div class="list-item"><?php
				if ( !$showbutton ):'<a href="'.$url.'"">'; endif;
				if ( $item['image'] ):
					echo '<div class="image">';
						if ( is_array($imagestyle) && in_array('round', $imagestyle) ):
							echo wp_get_attachment_image( $item['image'], $size, "", ["class" => "round"] );
						else:
							echo wp_get_attachment_image( $item['image'], $size );
						endif;
					echo '</div>';
				endif;
				if ( !$showbutton ):'</a>'; endif;

				if ( $item['title'] ):
					echo '<div class="text">';
					echo '<h3>';
					 if ($url): echo '<a href="'.$url.'">'; endif;
					 $titlestring = sanitize_text_field($item['title']);
					 if (strlen($titlestring) > 65){
						 $titlestring = implode(' ', array_slice(explode(' ', $titlestring), 0, 10)).'...';
					 }
					 echo $titlestring.'</a></h3>';
					 echo '</div>';
				endif;

				if ( $item['content'] ): echo wp_kses_post($item['content']); endif;

				if ( $showbutton ): echo '<a href="'.$url.'" class="button">'.$text.'</a>';endif;

				echo '</div>';
			endforeach;
			
		elseif ( $recent ):
			$recent_query = new WP_Query(
				array( 
					'post_type' => $recent,
					'showposts' => $number
				)
			);
			while ($recent_query->have_posts()) : $recent_query->the_post(); ?>
				<div class="list-item">
					<?php
					$name = get_field('name', $post);
					$position = get_field('position', $post);
					$company = get_field('company', $post);
					$location = get_field('location', $post);
					$website = get_field('website', $post);
					if ( $imagestyle && in_array('round', $imagestyle) && has_post_thumbnail() ){
						?><div class="image"><?php
						 the_post_thumbnail('mediumsquared', ['class' => 'round']);
						 ?></div><?php
					} elseif( has_post_thumbnail()){
						?><div class="image"><?php
						the_post_thumbnail('mediumsquared');
						?></div><?php
					}
					?>
						<div class="text"><h3><a href="<?php the_permalink() ?>"><?php
						$titlestring = get_the_title($post);
						if (strlen($titlestring) > 65){
							$titlestring = implode(' ', array_slice(explode(' ', $titlestring), 0, 10)).'...';
						}
						echo $titlestring;
						?></a></h3>
					<?php
						echo '<p>';
						$content= get_the_content();
						$the_excerpt= substr($content,0,strpos($content,'.')+1);
						if (strlen($the_excerpt) > 125){
							echo implode(' ', array_slice(explode(' ', strip_tags($the_excerpt)), 0, 15)).'...';
						} else {
							echo strip_tags($the_excerpt);
						}
						echo '</p>';
						if ( $name || $position || $company || $location || $website) { echo '<p class="testimonial-meta">'; }
						if ($name) { echo '<span class="testimonial-name">'.$name.'</span>'; }
						if ($position) { echo '<span class="testimonial-position">'.$position.'</span>'; }
						if ($company) { echo '<span class="testimonial-company">'.$company.'</span>'; }
						if ($location) { echo '<span class="testimonial-location">'.$location.'</span>'; }
						if ($website) { echo '<br/><a href="http://'.$website.'" target="_blank"><span class="testimonial-website">'.$website.'</span></a>'; }
						if ( $name || $position || $company || $location || $website) { echo '</p>'; }
					if ( $showbutton ){ ?>
						<a href="<?php echo get_permalink(); ?>" class="button"><?php _e('Read More', 'braftonium') ?></a>
					<?php } ?>
					</div>
				</div>
			<?php endwhile;
			wp_reset_postdata();
			wp_reset_query();
		endif;
		echo '</div>';
		?>

	</div>
</section><!-- section -->

<?php if ( $style['other'] && in_array('shadow', $style['other']) ) { echo '<div class="shadow"></div>'; } ?>