<?php
function braftonium_language_setup(){

	load_theme_textdomain( 'braftonium', get_template_directory() . '/library/translation' );
  
	$locale = get_locale();
	$locale_file = get_template_directory() . "/library/translation/$locale.php";
  
	if ( is_readable( $locale_file ) ) {
		require_once( $locale_file );
	}
  }
  add_action('after_setup_theme', 'braftonium_language_setup');

/*********************
LAUNCH BRAFTONIUM
Let's get everything up and running.
*********************/
function braftonium_start() {
	require_once( 'library/braftonium.php' );
	include_once get_template_directory().'/library/custom-fields/fields.php';

  //Allow editor style.
  add_editor_style( get_template_directory_uri() . '/library/css/editor-style.css' );

  add_action( 'admin_enqueue_scripts', 'load_admin_style' );
  function load_admin_style() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/library/css/admin.css', false, '1.0.0' );
  }

  wp_enqueue_script( 'functions', get_template_directory_uri() . '/library/js/functions.js', array(), '1.0.0', true );

  if ( get_field('sticky_nav', 'option')[0]=='on' ){
	wp_enqueue_script( 'sticky', get_template_directory_uri() . '/library/js/sticky.js', array(), '1.0.0', true );
  }

  // launching operation cleanup
  add_action( 'init', 'braftonium_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'braftonium_rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'braftonium_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'braftonium_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'braftonium_remove_recent_comments_style', 1 );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'braftonium_scripts_and_styles', 20 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  braftonium_support();

  // cleaning up random code around images
  add_filter( 'the_content', 'braftonium_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'braftonium_excerpt_more' );

} /* end braftonium */

// let's get this party started
add_action( 'after_setup_theme', 'braftonium_start' );



/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
*/

function braftonium_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  $wp_customize->get_section('colors')->title = __( 'Theme Colors', 'braftonium' );
//   $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'braftonium_customizer' );


/*
This is where we can declare some external fonts. If you're using Google Fonts, you can replace
these fonts, change it in your scss files and be up and running in seconds.
*/
function braftonium_fonts() {
  wp_enqueue_style('googleFonts', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
}
add_action('wp_enqueue_scripts', 'braftonium_fonts');

/* I CALL UPON THE POWERS OF AN SVG SPRITESHEET except linking an svg file doesn't work in IE so I gots to do this */
require_once(ABSPATH . 'wp-admin/includes/file.php');
function braftonium_get_svg_path($svgid) {
	WP_Filesystem();
	global $wp_filesystem;
	$file_data = get_template_directory_uri().'/library/theme-options/svg-icons.svg';
	$content = $wp_filesystem->get_contents($file_data);
	$first_step = explode( '<symbol id="'.$svgid , $content );
	$second_step = explode("</path>" , $first_step[1] );
	return '<svg class="'.$svgid.$second_step[0].'</svg>';
}


/**
 * What it says on the tin.
 */
if (!function_exists( 'braftonium_social_sharing_buttons' ) && function_exists('get_field') ) :
	$ssbutton = get_field('social_share_buttons', 'option');
	if (isset($ssbutton) && in_array("on", $ssbutton) ) {
		function braftonium_social_sharing_buttons() {
			$social_media = get_field('social_media', 'option');
			$ss_location = get_field('ss_button_location', 'option');

			// Get current page URL 
			$ssbURL = get_permalink();

			// Get current page title
			$ssbTitle = str_replace( ' ', '%20', get_the_title());
				
			// Get Post Thumbnail for pinterest
			$ssbThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

			// Construct sharing URL without using any script
			$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$ssbURL;
			$twitterURL = 'https://twitter.com/intent/tweet?text='.$ssbTitle.'&amp;url='.$ssbURL;
			$googleURL = 'https://plus.google.com/share?url='.$ssbURL;
			$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$ssbURL.'&amp;media='.$ssbThumbnail[0].'&amp;description='.$ssbTitle;
			$linkedURL = 'https://linkedin.com/shareArticle?mini=true&url='.$ssbURL.'&title='.$ssbTitle;

			// Add sharing button at the end of page/page content
			$variable = '<span class="ssb-social"><span class="ssb-text">'.__( 'Social Share', 'braftonium' ).': </span>';

			if(is_array($social_media)):
				if ( in_array("facebook", $social_media)) { $variable .= '<a class="ssb-facebook" href="'.$facebookURL.'" target="_blank">'.braftonium_get_svg_path('icon-facebook').'</a>'; }
				if ( in_array('twitter', $social_media) ) { $variable .= '<a class="ssb-twitter" href="'. $twitterURL .'" target="_blank">'.braftonium_get_svg_path('icon-twitter').'</a>'; }
				if ( in_array('google', $social_media) ) { $variable .= '<a class="ssb-googleplus" href="'.$googleURL.'" target="_blank">'.braftonium_get_svg_path('icon-google').'</a>'; }
				if ( in_array('linkedin', $social_media) ) { $variable .= '<a class="ssb-linked" href="'.$linkedURL.'" target="_blank">'.braftonium_get_svg_path('icon-linkedin').'</a>'; }
				if ( in_array('pinterest', $social_media) ) { $variable .= '<a class="ssb-pinterest" href="'.$pinterestURL.'" target="_blank">'.braftonium_get_svg_path('icon-pinterest').'</a>'; }
				if ( in_array('email', $social_media) ) { $variable .= '<a class="ssb-email" href="mailto:?subject=I wanted you to see this site&amp;body='.$ssbURL.'">'.braftonium_get_svg_path('icon-envelope').'</a>'; }
			endif;
			$variable .= '</span>';

			if ( is_single() && $ss_location=="post" || !is_single() && $ss_location=="excerpt" || $ss_location=="all" ){
				echo $variable;
			}
		}
	}
endif;

// Comment Layout
function braftonium_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
	 <article  class="cf">
	   <header class="comment-author vcard">
		 <?php
		 /*
		   this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular WordPress gravatar call:
		   echo get_avatar($comment,$size='32',$default='<path_to_url>' );
		 */
		 ?>
		 <?php // custom gravatar call ?>
		 <?php
		   // create variable
		   $bgauthemail = get_comment_author_email();
		 ?>
		 <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
		 <?php // end custom gravatar call ?>
		 <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'braftonium' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'braftonium' ),'  ','') ) ?>
		 <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'braftonium' )); ?> </a></time>
 
	   </header>
	   <?php if ($comment->comment_approved == '0') : ?>
		 <div class="alert alert-info">
		   <p><?php _e( 'Your comment is awaiting moderation.', 'braftonium' ) ?></p>
		 </div>
	   <?php endif; ?>
	   <section class="comment_content cf">
		 <?php comment_text() ?>
	   </section>
	   <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	 </article>
   <?php // </li> is added by WordPress automatically ?>
 <?php
 }



// Add new constant that returns true if WooCommerce is active
define( 'WPEX_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );

// Checking if WooCommerce is active
if ( WPEX_WOOCOMMERCE_ACTIVE ) {
	add_action( 'after_setup_theme', function() {
		add_theme_support( 'woocommerce' );
	} );

	add_action('woocommerce_before_main_content', 'theme_prefix_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'theme_prefix_wrapper_end', 10);
	
	function theme_prefix_wrapper_start() {
		echo '<div id="content"><div id="inner-content" class="wrap cf"><main id="main" class="m-all t-2of3 d-5of7 cf"><article class="hentry">';
	}
	
	function theme_prefix_wrapper_end() {
		echo '</article></main></div></div>';
	}
}


/* Excerpt shortening*/
if (function_exists('get_field')):
$layout = get_field('blog_layout', 'option');
if ( isset($layout) && $layout=='rich' ) {
	function custom_excerpt_length( $length ) {
		return 10;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
}
endif;

// Adds js needed for the video background.
function braftonium_video_script() {
	wp_enqueue_script( 'video', get_template_directory_uri() . '/library/js/video.js', array(), '1.0.0', true );
}

//All to do with slick slider
function braftonium_slick_script() {
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/library/js/slick/slick.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'slickfunction', get_template_directory_uri() . '/library/js/slickfunction.js', array(), '1.0.0', true );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/library/js/slick/slick.css', false, '1.0.0' );
	wp_enqueue_style( 'slick-themes', get_template_directory_uri() . '/library/js/slick/slick-theme.css', false, '1.0.0' );
}

//customized css colors in the header
function braftonium_customize_css() {
	$css = '<style type="text/css">';
		//build css from the theme customizer variables
		if (get_theme_mod( 'braftonium_color' )) { 
			$braftonium_text = sanitize_hex_color(get_theme_mod( 'braftonium_color' ));
			$css .= PHP_EOL . sprintf( 'body { color:%s; }', $braftonium_text );
		}
		if (get_theme_mod( 'braftonium_link_color' )) {
			$braftonium_link = sanitize_hex_color(get_theme_mod( 'braftonium_link_color' ));
			$css .= PHP_EOL . sprintf( 'a, a:visited, .blog .read-more, .slick-prev:before, .slick-next:before { color:%s; }', $braftonium_link );
			$css .= PHP_EOL . sprintf( 'button, .blue-btn, .pagination a:hover, .hero .read-more { background-color:%s; }', $braftonium_link );
			$css .= PHP_EOL . sprintf( '.blog .hero article.hentry { border-bottom-color:%s99; }', $braftonium_link );
		}
		if (get_theme_mod( 'braftonium_linkhover_color' )) {
			$braftonium_hover = sanitize_hex_color(get_theme_mod( 'braftonium_linkhover_color' ));
			$css .= PHP_EOL . sprintf( 'a:hover, a:focus, a:visited:hover, a:visited:focus, .pagination a:hover, .blog .read-more:hover { color:%s; }', $braftonium_hover );
			$css .= PHP_EOL . sprintf( '.button:hover, .blue-btn:hover, .blue-btn:focus, .blue-btn:active, .hero .read-more:hover { background-color:%s; }', $braftonium_hover );
		}
		if (get_theme_mod( 'braftonium_headerbg_color' )) {
			$braftonium_headerbg = sanitize_hex_color(get_theme_mod( 'braftonium_headerbg_color' ));
			$css .= PHP_EOL . sprintf( '.header, nav .nav li ul.sub-menu, .blog .simple .byline, .blog .rich article.hentry { background-color:%s; }', $braftonium_headerbg );
			$css .= PHP_EOL . sprintf( '.blog .rich article.hentry .content { background-color:%scc; }', $braftonium_headerbg );
			$css .= PHP_EOL . sprintf( '@media only screen and (max-width: 768px){ nav .nav li a { background-color:%s; }}', $braftonium_headerbg );
		}
		if (get_theme_mod( 'braftonium_header_color2' )) {
			$braftonium_headercolor = sanitize_hex_color(get_theme_mod( 'braftonium_header_color2' ));
			$css .= PHP_EOL . sprintf( '.header, .blog .simple .byline, .blog .rich article.hentry .content { color:%s; }', $braftonium_headercolor );
		}
		if (get_theme_mod( 'braftonium_headerlink_color' )) {
			$braftonium_headerlink = sanitize_hex_color(get_theme_mod( 'braftonium_headerlink_color' ));
			$css .= PHP_EOL . sprintf( '.header a, nav .nav li a, .blog .simple .byline a, .blog .rich article.hentry a, .nav button { color:%s; }', $braftonium_headerlink );
			$css .= PHP_EOL . sprintf( '.header .blue-btn { background-color:%s; }', $braftonium_headerlink );
		}
		if (get_theme_mod( 'braftonium_headerlinkhover_color' )) {
			$braftonium_headerlinkhover = sanitize_hex_color(get_theme_mod( 'braftonium_headerlinkhover_color' ));
			$css .= PHP_EOL . sprintf( '.header a:hover, nav .nav li a:hover, .blog .simple .byline a:hover, .blog .rich article.hentry a:hover, .nav button:hover { color:%s; }', $braftonium_headerlinkhover );
			$css .= PHP_EOL . sprintf( '.header .header button:hover, .header .blue-btn:hover { background-color:%s; }', $braftonium_headerlinkhover );
		}
		if (get_theme_mod( 'braftonium_footerbg_color' )) {
			$braftonium_footerbg_color = sanitize_hex_color(get_theme_mod( 'braftonium_footerbg_color' ));
			$css .= PHP_EOL . sprintf( '.footer, .blog .simple .entry-title, .blog .full article.hentry { background-color:%s; }', $braftonium_footerbg_color );
		}
		if (get_theme_mod( 'braftonium_footer_color' )) {
			$braftonium_footer_color = sanitize_hex_color(get_theme_mod( 'braftonium_footer_color' ));
			$css .= PHP_EOL . sprintf( '.footer, .blog .simple .entry-title, .blog .full article.hentry a { color:%s; }', $braftonium_footer_color );
		}
		if (get_theme_mod( 'braftonium_footerlink_color' )) {
			$braftonium_footerlink_color = sanitize_hex_color(get_theme_mod( 'braftonium_footerlink_color' ));
			$css .= PHP_EOL . sprintf( '.footer a, .blog .simple .entry-title a { color:%s; }', $braftonium_footerlink_color );
			$css .= PHP_EOL . sprintf( '.footer button, .footer .blue-btn { background-color:%s; }', $braftonium_footerlink_color );
		}
		if (get_theme_mod( 'braftonium_footerlinkhover_color' )) {
			$braftonium_footerlinkhover_color = sanitize_hex_color(get_theme_mod( 'braftonium_footerlinkhover_color' ));
			$css .= PHP_EOL . sprintf( '.footer a:hover, .blog .simple .entry-title a:hover, .blog .full article.hentry a:hover%s; }', $braftonium_footerlinkhover_color );
			$css .= PHP_EOL . sprintf( '.footer button:hover, .footer .blue-btn:hover { background-color:%s; }', $braftonium_footerlinkhover_color );
		}
		$css .= '</style>';
		echo $css;
	}
	add_action( 'wp_head', 'braftonium_customize_css', 20);

/* DON'T DELETE THIS CLOSING TAG */ ?>