<?php
/**
 * The template used for displaying list section of page.
 *
 * @package WordPress
 * @subpackage Business_Theme
 * @since businesstheme 2.0
 */

if(!session_id()) session_start();
$sectionrow = $_SESSION['sectionrow'];
$titletext = ($sectionrow==0)?'<h1>'.get_sub_field('title').'</h1>':'<h2>'.get_sub_field('title').'</h2>';

$show_text = get_sub_field('show_text');
	if ($show_text && in_array('intro', $show_text)): $intro = get_sub_field('intro_text'); endif;
	if ($show_text && in_array('outro', $show_text)): $outro = get_sub_field('outro_text'); endif;
$list_type = get_sub_field('list_type');
	if ($list_type=='Custom'): $custom = get_sub_field('custom_list'); endif;
	if ($list_type=='Recent'): $recent = get_sub_field('recent'); $number = get_sub_field('number_of_posts'); endif;

$showbutton	 = get_sub_field('showbutton');

$style = get_sub_field('style');
$classes = array('list');
if ($style['class']){
	$classes[] = $section_class;
}
if (!$style['background_image'] && !$style['background_color'] ) {
	$classes[] = "gradient";
}
if ( $style['other'] && in_array('full', $style['other']) ) {
	$classes[] = "full";
} ?>

<section class="<?php echo implode(' ',$classes); ?>" style="<?php
if ( $style['background_image'] ) { echo 'background-image: url(' . $style['background_image'] . ');'; }
if ( $style['background_color'] ) { echo 'background-color: ' . $style['background_color'] . ';'; }
if ( $style['color'] ) { echo 'color: ' . $style['color'] . ';'; } ?>" >
	<?php if ( $style['video_url'] ) {
		if (strpos($video, 'youtube.com') == true || strpos($video, '.webm') == false && strpos($video, '.mp4') == false) {
			$videoid = preg_replace('/https:\/\/www.youtube.com\/watch\?v=/', '', $video);
		?>

			<div id="video"></div>
		
			<script async src="https://www.youtube.com/iframe_api"></script>
			<script>
			 function onYouTubeIframeAPIReady() {
			  var player;
			  player = new YT.Player('video', {
				videoId: '<?php echo $videoid; ?>', // YouTube Video ID
				width: 1000,			   // Player width (in px)
				height: 750,			  // Player height (in px)
				playerVars: {
				  autoplay: 1,		// Auto-play the video on load
				  controls: 1,		// Show pause/play 	s in player
				  showinfo: 0,		// Hide the video title
				  modestbranding: 1,  // Hide the Youtube Logo
				  loop: 1,			// Run the video in a loop
				  fs: 1,			  // Hide the full screen 	
				  rel: 0,
				  playsinline: 1,
				  cc_load_policy: 1, // Hide closed captions
				  iv_load_policy: 3,  // Hide the Video Annotations
				  autohide: 0		 // Hide video controls when playing
				},
				events: {
				  onReady: function(e) {
					e.target.mute();
				  }
				}
			  });
			 }
			</script>
		<?php } else {
			$vidstring = chop($video, '.webm');
			$vidstring = chop($vidstring, '.mp4'); ?>
			<button id="vidpause"><i class="fa fa-pause" aria-hidden="true"></i></button>
			<video playsinline autoplay muted loop id="video">
				<source src="<?php echo $vidstring; ?>.webm" type="video/webm">
				<source src="<?php echo $vidstring; ?>.mp4" type="video/mp4">
			</video>
		<?php }
	} ?><div class="wrap">

		<?php echo $titletext;
		echo $intro;
		?>
	
		<div class="container"><?php
		if ( $custom ) :
			foreach( $custom as $item ):
				$url = $item['button']['url'];
				$text = $item['button']['text'];
					if( in_array('thumb', $item['image_size_and_shape']) ): $size = 'thumbnail'; endif;
					if( in_array('square', $item['image_size_and_shape']) ): $size = 'mediumsquared'; endif;
					if( in_array('uncropped', $item['image_size_and_shape']) ): $size = 'full'; endif;
			?>
				<div class="list-item"><?php
				if ( !$showbutton ):'<a href="'.$url.'"">'; endif;
				echo '<div class="list-featured-image">';
				if ( $item['image'] ):
					
					if ( in_array('round', $item['image_size_and_shape']) ):
						echo wp_get_attachment_image( $item['image'], $size, "", ["class" => "round"] );
					else:
						echo wp_get_attachment_image( $item['image'], $size );
					endif;
				endif;
				echo '</div>';
				if ( !$showbutton ):'</a>'; endif;

				if ( $item['title'] ):
					echo '<h3>';
					 if ($url): echo '<a href="'.$url.'">'; endif;
					 $titlestring = $item['title'];
					 if (strlen($titlestring) > 65){
						 $titlestring = implode(' ', array_slice(explode(' ', $titlestring), 0, 10)).'...';
					 }
					 echo $titlestring.'</a></h3>';
				endif;

				if ( $item['content'] ): echo $item['content']; endif;

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
					<?php if ( $item['image_size_and_shape'] && in_array('round', $item['image_size_and_shape']) && has_post_thumbnail() ){
						?><div class="list-post-featured-image"><?php
						 the_post_thumbnail('mediumsquared', ['class' => 'round']);
						 ?></div><?php
					} elseif( has_post_thumbnail()){
						?><div class="list-post-featured-image"><?php
						the_post_thumbnail('mediumsquared');
						?></div><?php
					}
					?>
						<h3><a href="<?php the_permalink() ?>"><?php
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
					if ( $showbutton ){ ?>
						<a href="<?php echo get_permalink(); ?>" class="button">Read More</a>
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
<?php if ( $style['video_url'] ) { ?>
	<script>
	var vid = document.getElementById("bgvid"),
	pause	 = document.getElementById("vidpause");
	function vidFade() {
		vid.classList.add("stopfade");
	}
	vid.addEventListener('ended', function() {
		// only functional if "loop" is removed 
		 vid.pause();
		// to capture IE10
		vidFade();
	});
	pause	.addEventListener("click", function() {
		vid.classList.toggle("stopfade");
		if (vid.paused) {
	vid.play();
			pause	.innerHTML = '<i class="fa fa-pause" aria-hidden="true"></i>';
		} else {
			vid.pause();
			pause	.innerHTML = '<i class="fa fa-play" aria-hidden="true"></i>';
		}
	})
	</script>
<?php } ?>