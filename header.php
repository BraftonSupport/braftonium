<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Business_Theme
 * @since Business Theme 1.0
 */
$nav = get_field('navigation_bar_position', 'option');
$ga = get_field('google_analytics', 'option');?>
<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<?php
if ( $ga ) : ?>
	<!-- Google Analytics -->
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', '<?php echo $ga; ?>', 'auto');
		  ga('send', 'pageview');
		</script>
	<!-- End Google Analytics -->
<?php endif;

$description = get_bloginfo( 'description', 'display' );
echo '<script type="application/ld+json">
	{
		"@context": "http://schema.org/",
		"@type": "Organization",
		"name": "'.get_bloginfo( "name" ).'",
		"legalName": "'.get_bloginfo( "name" ).'",
		"url": "'.network_site_url( '/' ).'",
		"email": "",
		"telephone": "",
		"description": "'.$description.'"
	}
</script>';
if(is_single()) {
	$content = wp_strip_all_tags(apply_filters('the_content', $post->post_content)); 
	$excerpt = wp_strip_all_tags(apply_filters('the_excerpt', $post->post_excerpt)); 
	$image_url = esc_url( get_theme_mod( 'businesstheme_logo' ) );
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
	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>

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

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

		<div id="container">

			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

				<div id="inner-header" class="wrap cf">

					<p id="logo" class="h1" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow">
					<?php $logo1 = get_theme_mod( 'businesstheme_logo' );
						if ($logo1) { ?>
						<img src='<?php echo $logo1; ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' class="site-title">
					<?php } else {
						bloginfo('name');
					} ?></a></p>

					<div class="nextwidget">
						<button id="menu-toggle" class="menu-toggle blue-btn"><?php _e( 'Menu', 'businesstheme' );
						echo get_svg_path('icon-bars'); ?></button>	
						<?php if ( is_active_sidebar( 'header-sidebar' ) ) {
							dynamic_sidebar( 'header-sidebar' );
						} ?>
					</div>

					<nav class="<?php echo $nav; ?>" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<?php wp_nav_menu(array(
							'container' => false,                           // remove nav container
							'container_class' => 'menu cf',                 // class of container (should you choose to use it)
							'menu' => __( 'The Main Menu', 'business-theme' ),  // nav name
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
