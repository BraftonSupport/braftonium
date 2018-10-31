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
<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
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
		$nav = get_field('navigation_bar_position', 'option');
		$logo1 = esc_url(get_theme_mod( 'braftonium_logo' ));
		$logo2 = esc_url(get_site_icon_url());

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
			$image_url = get_theme_mod( 'braftonium_logo' );
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

			<header class="header" itemscope itemtype="http://schema.org/WPHeader">
				<?php if (is_page_template('full-width.php')){ ?>
					<a class="skip-link" href="#content">Skip to content</a>
				<?php } else { ?>
					<a class="skip-link" href="#inner-content">Skip to content</a>
				<?php }?>
				<div id="inner-header" class="<?php if (!$logo1 && !$nav=='next') : echo 'auto '; endif; ?> cf container">
					<div class="wrap">
						<div id="logo" class="h1" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow" name='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
						<?php if ($logo1&&$logo2): ?>
							<img src='<?php echo $logo1; ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' class="site-title">
							<img src='<?php echo $logo2; ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' class="scrolled-title">
						<?php elseif ($logo1): ?>
							<img src='<?php echo $logo1; ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' class="site-title" style="display: inline">
						<?php else:
							$blogname = get_bloginfo('name');
							if (strlen($blogname) < 30):
								echo $blogname;
							else :
								echo substr($blogname, 0, 30).'...' ;
							endif;
						endif; ?></a></div>

						<div class="nextwidget">
							<button id="menu-toggle" class="menu-toggle blue-btn"><?php _e( 'Menu', 'braftonium' );
							echo braftonium_get_svg_path('icon-bars').braftonium_get_svg_path('icon-close'); ?></button>	
							<?php if ( is_active_sidebar( 'header-sidebar' ) ) {
								dynamic_sidebar( 'header-sidebar' );
							} ?>
						</div>

						<nav class="<?php if ($nav): echo sanitize_text_field ($nav); else: echo 'below'; endif; ?>" itemscope itemtype="http://schema.org/SiteNavigationElement">
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
				</div>
				
				<?php if (is_single() && has_post_thumbnail()) : ?>
					<section class="banner visual"<?php echo ' style="background-image:url('.get_the_post_thumbnail_url(get_the_ID(),'full').')"'; ?>>
						<div class="black"><div class="wrap">
							<h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
							<p class="byline entry-meta vcard">
								<?php printf( __( 'Posted', 'braftonium' ).' %1$s',
									/* the time the post was published */
									'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>'
									/* the author of the post */
									// '<span class="by">'.__( 'by', 'braftonium' ).'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
								);
								?>
								<?php //printf( __( 'filed under', 'braftonium' ).': %1$s', get_the_category_list(', ') ); ?>
								<?php //the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'braftonium' ) . '</span> ', ', ', '</p>' );
								if (function_exists('braftonium_social_sharing_buttons')): braftonium_social_sharing_buttons(); endif;  ?>
							</p>
						</div></div>
					</section>
				<?php endif;
				if(is_home()):
					$blog_page_id = get_option( "page_for_posts" );
					$background_image = esc_url(get_field('background_image',$blog_page_id));
					$title = wp_kses_post(get_field('title',$blog_page_id));
					$tagline = wp_kses_post(get_field('tagline',$blog_page_id));
				elseif(is_archive()):
					$term = get_queried_object()->cat_ID;
					$background_image = esc_url(get_field('background_image', 'category_'.$term));
					if(get_field('title','category_'. $term)): $title = wp_kses_post(get_field('title','category_'. $term)); else: $title = get_the_archive_title(); endif;
					$tagline = wp_kses_post(get_field('tagline','category_'. $term));
				elseif(!is_page_template( 'full-width.php' ) ):
					$background_image = esc_url(get_field('background_image'));
					$title = wp_kses_post(get_field('title'));
					$tagline = wp_kses_post(get_field('tagline'));
				endif;
				if ($background_image||$title||$tagline) : ?>
					<section class="banner visual"<?php if ($background_image): echo ' style="background-image:url('.$background_image.')"'; endif; ?>>
						<div class="black"><div class="wrap">
							<?php if ($title): echo '<h1 class="page-title" itemprop="headline">'.$title.'</h1>'; endif; ?>
							<?php if ($tagline): echo $tagline; endif; ?>
						</div></div>
					</section>
				<?php endif; ?>
			</header>
