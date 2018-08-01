<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Braftonium
 * @since Braftonium Theme 1.0
 */
?>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<!doctype html>
	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title( '|', true, 'right' ); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
            <meta name="theme-color" content="#121212">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // WordPress head functions ?>
		<?php wp_head(); ?>
		<?php // end of WordPress head
			$braftonium_text = get_theme_mod( 'braftonium_color' );
			$braftonium_link = get_theme_mod( 'braftonium_link_color' );
			$braftonium_hover = get_theme_mod( 'braftonium_linkhover_color' );
			$braftonium_headerbg = get_theme_mod( 'braftonium_headerbg_color' );
			$braftonium_headercolor = get_theme_mod( 'braftonium_header_color' );
			$braftonium_headerlink = get_theme_mod( 'braftonium_headerlink_color' );
			$braftonium_headerlinkhover = get_theme_mod( 'braftonium_headerlinkhover_color' );
			$braftonium_footerbg_color = get_theme_mod( 'braftonium_footerbg_color' );
			$braftonium_footer_color = get_theme_mod( 'braftonium_footer_color' );
			$braftonium_footerlink_color = get_theme_mod( 'braftonium_footerlink_color' );
			$braftonium_footerlinkhover_color = get_theme_mod( 'braftonium_footerlinkhover_color' );
		echo '<style>';
			if ($braftonium_text) { echo 'body { color:'.$braftonium_text.';}'; }
			if ($braftonium_link) { echo 'a:not(.blue-btn):not(.orange-btn):not(.read-more), a:not(.blue-btn):not(.orange-btn):not(.read-more):visited, .blog .read-more, .slick-prev:before, .slick-next:before { color:'.$braftonium_link.';} button, .blue-btn, .pagination a:hover, .hero .read-more { background-color:'.$braftonium_link.';} .blog .hero article.hentry { border-bottom-color: '.$braftonium_link.'99; }'; }
			if ($braftonium_hover) { echo 'a:not(.blue-btn):not(.orange-btn):not(.read-more):hover, .pagination a:hover, .blog .read-more:hover { color:'.$braftonium_hover.';} .button:hover, .blue-btn:hover, .blue-btn:focus, .blue-btn:active, .hero .read-more:hover { background-color:'.$braftonium_hover.';} '; }
			if ($braftonium_headerbg) { echo '.header, #menu-nav.nav li ul.sub-menu, .blog .simple .byline, .blog .rich article.hentry { background-color:'.$braftonium_headerbg.';} .blog .rich article.hentry .content { background-color:'.$braftonium_headerbg.'cc;}'; }
			if ($braftonium_headercolor) { echo '.header, .blog .simple .byline, .blog .rich article.hentry .content { color:'.$braftonium_headercolor.';} '; }
			if ($braftonium_headerlink) { echo '.header a, #menu-nav.nav li a, .blog .simple .byline a, .blog .rich article.hentry a { color:'.$braftonium_headerlink.';} .header button, .header .blue-btn { background-color:'.$headerlink.';} '; }
			if ($braftonium_headerlinkhover) { echo '.header a:hover, #menu-nav.nav li a:hover, .blog .simple .byline a:hover, .blog .rich article.hentry a:hover { color:'.$braftonium_headerlinkhover.';} .header .header button:hover, .header .blue-btn:hover { background-color:'.$headerlinkhover.';}'; }
			if ($braftonium_footerbg_color) { echo '.footer, .blog .simple .entry-title, .blog .full article.hentry { background-color:'.$braftonium_footerbg_color.';} '; }
			if ($braftonium_footer_color) { echo '.footer, .blog .simple .entry-title, .blog .full article.hentry a { color:'.$braftonium_footer_color.';} '; }
			if ($braftonium_footerlink_color) { echo '.footer a, .blog .simple .entry-title a { color:'.$braftonium_footerlink_color.';} .footer button, .footer .blue-btn { background-color:'.$braftonium_footerlink_color.';} '; }
			if ($braftonium_footerlinkhover_color) { echo '.footer a:hover, .blog .simple .entry-title a:hover, .blog .full article.hentry a:hover { color:'.$braftonium_footerlinkhover_color.';} .footer button:hover, .footer .blue-btn:hover { background-color:'.$braftonium_footerlinkhover_color.';} '; }
			if ($braftonium_hover) { echo '@media only screen and (min-width: 768px){ #menu-nav.nav li a { background-color:'.$braftonium_headerbg.';} } '; }
		echo '</style>';

		$nav = get_field('navigation_bar_position', 'option');

		$description = get_bloginfo( 'description', 'display' );
		echo '<script type="application/ld+json">
			{
				"@context": "http://schema.org/",
				"@type": "Organization",
				"name": "'.get_bloginfo( "name" ).'",
				"legalName": "'.get_bloginfo( "name" ).'",
				"url": "'.network_site_url( '/' ).'",
				"description": "'.$description.'"
			}
		</script>';
		if(is_single()) {
			$content = wp_strip_all_tags(apply_filters('the_content', $post->post_content)); 
			$excerpt = wp_strip_all_tags(apply_filters('the_excerpt', $post->post_excerpt)); 
			$image_url = esc_url( get_theme_mod( 'braftonium_logo' ) );
			$author = $post->post_author; 
			echo '<script type="application/ld+json">
				{ "@context": "http://schema.org",
				"@type": "BlogPosting",
				"headline": "'.esc_html( get_the_title() ).'",
				"image": "'.get_the_post_thumbnail_url().'",
				"wordcount": "'.str_word_count($content,0).'",
				"publisher": {
				"@type": "Organization",
				"name": "'.get_bloginfo( "name" ).'",
				"logo": "'.$image_url.'"
				},
				"url": "'.get_permalink().'",
				"datePublished": "'.get_the_date('Y-m-d').'",
				"description": "'.$excerpt.'",
				"author": {
				"@type": "Person",
				"name": "'.get_the_author_meta( "user_nicename" , $author ).'"
				}
				}
			</script>';
		}
		?>

	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

		<div id="container">

			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

				<div id="inner-header" class="wrap cf container">

					<div id="logo" class="h1" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow">
					<?php $logo1 = get_theme_mod( 'braftonium_logo' );
						if ($logo1) { ?>
						<img src='<?php echo $logo1; ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' class="site-title">
					<?php } else {
						bloginfo('name');
					} ?></a></div>

					<div class="nextwidget">
						<button id="menu-toggle" class="menu-toggle blue-btn"><?php _e( 'Menu', 'braftonium' );
						echo get_svg_path('icon-bars'); ?></button>	
						<?php if ( is_active_sidebar( 'header-sidebar' ) ) {
							dynamic_sidebar( 'header-sidebar' );
						} ?>
					</div>

					<nav class="<?php if ($nav): echo $nav; else: echo 'below'; endif; ?>" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<?php wp_nav_menu(array(
							'container' => false,                           // remove nav container
							'container_class' => 'menu cf',                 // class of container (should you choose to use it)
							'menu' => __( 'The Main Menu', 'braftonium' ),  // nav name
							'menu_class' => 'nav top-nav cf',               // adding custom nav class
							'theme_location' => 'main-nav',                 // where it's located in the theme
							'before' => '',                                 // before the menu
							'after' => '',                                  // after the menu
							'link_before' => '',                            // before each link
							'link_after' => '',                             // after each link
							'depth' => 0,                                   // limit the depth of the nav
							'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>
					</nav>

				</div>
			</header>
