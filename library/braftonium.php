<?php
/* Braftonium Theme */

/*********************
Removing all stuff in WP_HEAD we don't need.
*********************/

function braftonium_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'braftonium_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'braftonium_remove_wp_ver_css_js', 9999 );

} /* end braftonium head cleanup */

// A better title
// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function braftonium_rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  // Don't affect in feeds.
  if ( is_feed() ) return $title;

  // Add the blog's name
  if ( 'right' == $seplocation ) {
	$title .= get_bloginfo( 'name' );
  } else {
	$title = get_bloginfo( 'name' ) . $title;
  }

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
	$title .= " {$sep} {$site_description}";
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
	$title .= " {$sep} " . sprintf( __( 'Page %s', 'braftonium' ), max( $paged, $page ) );
  }

  return $title;

} // end better title

// remove WP version from RSS
function braftonium_rss_version() { return ''; }

// remove WP version from scripts
function braftonium_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function braftonium_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function braftonium_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}


/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function braftonium_scripts_and_styles() {

  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

  if (!is_admin()) {

		// modernizr (without media query polyfill)
		wp_register_script( 'braftonium-modernizr', get_template_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );

		// register main stylesheet
		wp_register_style( 'braftonium-stylesheet', get_template_directory_uri() . '/library/css/style.css' );

		// ie-only style sheet
		wp_register_style( 'braftonium-ie-only', get_template_directory_uri() . '/library/css/ie.css', array(), '' );

 		//adding scripts file in the footer
		wp_register_script( 'braftonium-js', get_template_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );

		// enqueue styles and scripts
		wp_enqueue_script( 'braftonium-modernizr' );
		wp_enqueue_style( 'braftonium-stylesheet' );
		wp_enqueue_style( 'braftonium-ie-only' );

		$wp_styles->add_data( 'braftonium-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

		/*
		I recommend using a plugin to call jQuery
		using the google cdn. That way it stays cached
		and your site will load faster.
		*/
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'braftonium-js' );

		$shenanigans = get_field('shenanigans', 'option');
		if ($shenanigans[0]=='on') :
		wp_register_style( 'shenanigans', get_template_directory_uri() . '/library/css/wickedcss.min.css' );
		wp_enqueue_style( 'shenanigans' );
		endif;
	}
}

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function braftonium_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'custom-header');
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'mediumsquared', 300, 300, true );

	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background',
		array(
		'default-image' => '',	// background image default
		'default-color' => '',	// background color default (dont add the #)
		'wp-head-callback' => '_custom_background_cb',
		'admin-head-callback' => '',
		'admin-preview-callback' => ''
		)
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// registering title tag
	add_theme_support( "title-tag" );

	// registering menus
	register_nav_menus(
		array(
			'main-nav' => __( 'Navigation', 'braftonium' ),   // main nav in header
			'social' => __( 'Social Media', 'braftonium' ),   // social nav in media
		)
	);

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	) );

} /* end theme support */


if ( ! function_exists( "sanitize_html_classes" ) && function_exists( "sanitize_html_class" ) ) {
	/**
	   * sanitize_html_class works just fine for a single class
	   * Some times le wild <span class="blue hedgehog"> appears, which is when you need this function,
	   * to validate both blue and hedgehog,
	   * Because sanitize_html_class doesn't allow spaces.
	   *
	   * @uses   sanitize_html_class
	   * @param  (mixed: string/array) $class   "blue hedgehog goes shopping" or array("blue", "hedgehog", "goes", "shopping")
	   * @param  (mixed) $fallback Anything you want returned in case of a failure
	   * @return (mixed: string / $fallback )
	   */
	  function sanitize_html_classes( $class, $fallback = null ) {
		  // Explode it, if it's a string
		  if ( is_string( $class ) ) {
			  $class = explode(" ", $class);
		  } 
		  if ( is_array( $class ) && count( $class ) > 0 ) {
			  $class = array_map("sanitize_html_class", $class);
			  return implode(" ", $class);
		  }
		  else { 
			  return sanitize_html_class( $class, $fallback );
		  }
	  }
  }

/**
 * Widget areas to the widget area section 
 */
function acf_load_widget_area_field_choices( $field ) {
	
	// reset choices
	$field['choices'] = array();

	foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
		$field['choices'] = array_merge($field['choices'], array($sidebar['id'] => ucwords( $sidebar['name'] )));
	}
	// return the field
	return $field;
}
add_filter('acf/load_field/key=field_5b43bc9b0acf1', 'acf_load_widget_area_field_choices');


/*********************
RELATED POSTS FUNCTION
*********************/

// Related Posts Function (call using braftonium_related_posts(); )
function braftonium_related_posts($number) {
	global $post;
	$categories = wp_get_post_categories( $post->ID );
	if($categories) {
		foreach( $categories as $category ) {
			$cat_arr .= $cat->slug . ',';
		}
		$args = array(
			'cat' => $cat_arr,
			'numberposts' => $number, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
	}

		$related_posts = get_posts( $args );
		$location = get_field('related_posts', 'option');
		echo '<section class="latest widget"><h3>'. __( 'Related Posts', 'braftonium' ).'</h3>';
		if ( $location=='below'): echo '<div class="container">'; endif;
			if($related_posts):
				foreach ( $related_posts as $post ) : setup_postdata( $post );
				$url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
				echo '<a href="' . get_the_permalink() . '" title="'.get_the_title().'">';
				if ($url) :
					echo '<div class="thumbnail" style="background-image: url('.$url[0].')"></div>';
				endif;
				
				echo '<h4>'.get_the_title().'<br/><span class="tiny">'.get_the_date('M j, Y').'</span></h4>';
				echo '</a>';
				
				endforeach;
			else:
				echo '<p class="no_related_post">' . __( 'No Related Posts Yet!', 'braftonium' ) . '</p>';
			endif;
		if ( $location=='below'): echo '</div>'; endif;
	echo '</section>';

	wp_reset_postdata();
} /* end related posts function */


/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function braftonium_page_navi() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
	return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
	'base'		 => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
	'format'	   => '',
	'current'	  => max( 1, get_query_var('paged') ),
	'total'		=> $wp_query->max_num_pages,
	'prev_text'	=> '&larr;',
	'next_text'	=> '&rarr;',
	'type'		 => 'list',
	'end_size'	 => 3,
	'mid_size'	 => 3
  ) );
  echo '</nav>';
} /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function braftonium_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function braftonium_excerpt_more($more) {
	global $post;
	// edit here if you like
}

/**
 * Let's redo the social media nav
 *
 * @return array $social_links_icons
 * @param   string  $output			menu HTML
 * @param   string  $item			menu
 * @param   int		$depth			menu depth
 * @param   object  $args			menu args
 * */
	// changing it up
	class Social_Nav_Menu extends Walker_Nav_Menu {
		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
			if ( 'social' === $args->theme_location ) {
				if (strpos($item->url, 'mailto:') !== false) {
					$social_media = 'envelope';
				} elseif (strpos($item->url, 'tel:') !== false) {
					$social_media = 'phone';
				} elseif (strpos($item->url, '/feed') !== false) {
					$social_media = 'rss';
				} else {
					$social_media = preg_replace('#^www\.|\.com$#', '$1', parse_url($item->url)['host']);
				}
				$svg = braftonium_get_svg_path('icon-'.$social_media);
				$output .= sprintf("\n<li %s><a href='%s' target='_blank' title='%s'>".$svg."</a>\n", ( array_search('current-menu-item', $item->classes) ) ? '' : '', $item->url, $item->title );
			};
		}
	}
/**
 * Now the Main Nav adding the svg
 * 
 * @param   string  $item_output	HTML
 * @param   string  $item			menu
 * @param   int		$depth			menu depth
 * @param   object  $args			menu args
 * 
 * @return  string                  modified menu */	
function braftonium_be_arrows_in_menus( $item_output, $item, $depth, $args ) {
	if( in_array( 'menu-item-has-children', $item->classes ) ) {
		$arrow = '<button>'.braftonium_get_svg_path('icon-expand').'</button>';
		$item_output = str_replace( '</a>', '</a>' . $arrow, $item_output );
	}
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'braftonium_be_arrows_in_menus', 10, 4 );


/**
 * Add the shopping cart svg to any menu item with the cart class
 *
 * @param   string  $item_output	HTML
 * @param   string  $item			menu
 * @param   int		$depth			menu depth
 * @param   object  $args			menu args
 * 
 * @return  string                  modified menu */	

function braftonium_be_cart_icon( $item_output, $item, $depth, $args ) {
	if( in_array( 'cart', $item->classes ) ) {
		$icon = '<span>'.braftonium_get_svg_path('icon-cart').'</span>';
		$item_output = str_replace( '</a>', $icon . '</a>', $item_output );
	}
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'braftonium_be_cart_icon', 10, 4 );

/*
Making the Braftonium Theme Option Page
*/
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> __( 'Theme General Settings', 'braftonium' ),
		'menu_title'	=> __( 'Theme Settings', 'braftonium' ),
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'parent_slug'	=> 'themes.php',
		'redirect'		=> false
	));
} else {
	function braftonium_blanksettingspage() {
		add_submenu_page( 'themes.php', __( 'Theme General Settings', 'braftonium' ), __( 'Theme Settings', 'braftonium' ),
		'edit_posts', 'theme-general-settings', 'turnonacf_callback');
	} 
	add_action( 'admin_menu', 'braftonium_blanksettingspage' );
	function turnonacf_callback() { 
		?>
		<div class="wrap">
			<h1><?php _e( 'Theme General Settings', 'braftonium' ); ?></h1>
			<p><?php _e( 'Turn on the Braftonium plugin. You also ACF Pro plugin.', 'braftonium' ); ?></p>
		</div>
		<?php
	}
}

/**
 * Adding Footer Widget Areas
 */
function braftonium_widgets_init() {
	register_sidebar( array(
		'name'		  => __( 'Footer Left Widget', 'braftonium' ),
		'id'			=> 'footer-left',
		'description'   => __( 'This is located in the footer. Use only 1 widget.', 'braftonium' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="h3 widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'		  => __( 'Footer Middle Widget', 'braftonium' ),
		'id'			=> 'footer-middle',
		'description'   => __( 'This is located in the footer. Use only 1 widget.', 'braftonium' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="h3 widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'		  => __( 'Footer Right Widget', 'braftonium' ),
		'id'			=> 'footer-right',
		'description'   => __( 'This is located in the footer. Use only 1 widget.', 'braftonium' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="h3 widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'braftonium_widgets_init' );


/** Adds a title attribute to iframe oembeds
 *
 * @since   1.0.0
 *
 * @param   int  $post_ID        Post ID */

function my_set_image_meta_upon_image_upload( $post_ID ) {

	// Check if uploaded file is an image, else do nothing
	if ( wp_attachment_is_image( $post_ID ) ) {

		$my_image_title = get_post( $post_ID )->post_title;

		// Sanitize the title:  remove hyphens, underscores & extra spaces:
		$my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $my_image_title );

		// Sanitize the title:  capitalize first letter of every word (other letters lower case):
		$my_image_title = ucwords( strtolower( $my_image_title ) );

		$my_image_meta = array(
			'ID'		=> $post_ID,			// Specify the image (ID) to be updated
			'post_title'	=> $my_image_title,		// Set image Title to sanitized title
		);

		// Set the image Alt-Text
		update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );

		// Set the image meta (e.g. Title, Excerpt, Content)
		wp_update_post( $my_image_meta );

	} 
}
add_action( 'add_attachment', 'my_set_image_meta_upon_image_upload' );


/**
 * Adds a title attribute to iframe oembeds
 *
 * @since   1.0.0
 *
 * @param   string  $html           HTML
 * @param   string  $url            URL to embed
 * @param   array   $attributes     HTML Attributes
 * @param   int     $post_id        Post ID
 * @return  string                  HTML
 */
function add_title_to_iframe_oembed( $html, $url, $attributes, $post_id ) {
    // Bail if this isn't an iframe
    if ( strpos( $html, '<iframe' ) === false ) {
        return $html;
    }
    // Bail if the attributes already contain a title
    if ( array_key_exists( 'title', $attributes ) ) {
        return $html;
    }
    // Define the title for the iframe, depending on the source content
    // List is based on supported Video and Audio providers at https://codex.wordpress.org/Embeds
    $url = parse_url( $url );
    $title = '';
    switch ( str_replace( 'www.', '', $url['host'] ) ) {
        /**
         * Video
         */
        case 'animoto.com':
        case 'blip.com':
        case 'collegehumor.com':
        case 'dailymotion.com':
        case 'funnyordie.com':
        case 'hulu.com':
        case 'ted.com':
        case 'videopress.com':
        case 'vimeo.com':
        case 'vine.com':
        case 'wordpress.tv':
        case 'youtube.com':
            $title = __( 'Video Player', 'n7studios' );
            break;
        /**
         * Audio
         */
        case 'mixcloud.com':
        case 'reverbnation.com':
        case 'soundcloud.com':
        case 'spotify.com':
            $title = __( 'Audio Player', 'n7studios' );
            break;
        /**
         * Handle any other URLs here, via further code
         */
        default:
            $title = apply_filters( 'add_title_to_iframe_oembed', $title, $url );
            break;
    }
    // Add title to iframe, depending on the oembed provider
    $html = str_replace( '></iframe>', ' title="' . $title . '"></iframe>', $html );
    // Return
    return $html;
}
add_filter( 'embed_oembed_html', 'add_title_to_iframe_oembed', 10, 4 );
?>
