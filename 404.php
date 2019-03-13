<?php get_header();
$logo = esc_url(get_field('404logo', 'option'));
$links = get_field('suggested_links', 'option'); ?>

	<div id="content">
		<div id="inner-content" class="wrap cf">
			<main id="main" class="m-all cf" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
				<article id="post-not-found" class="hentry cf">
					<header class="article-header">
					<img src='<?php if ($logo) :
							echo $logo;
						else:
							echo esc_url(get_theme_mod( 'braftonium_logo' ));
						endif;
						?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' class="site-title">
						<h1>404</h1>
					</header>

					<section class="entry-content">
						<p><?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'braftonium' ); ?></p>
					</section>
					<section class="search">
						<p><?php get_search_form(); ?></p>
					</section>
				</article>
			</main>
			<div class="cf" role="complementary">
				<h2><?php _e( 'Or were you looking for:', 'braftonium' ); ?></h2>
				<div class="container">
				<?php if($links): foreach( $links as $link): // variable must be called $post (IMPORTANT) ?>
					<?php setup_postdata($link); ?>
					<div class="list-item"><a href="<?php the_permalink($link->ID); ?>" class="blue-btn"><?php  echo get_the_title($link->ID); ?></a></div>
				<?php endforeach;
				else: ?>
	
					<div class="list-item"><h3><?php _e( 'Our Latest Post', 'braftonium' ); ?></h3>
					<?php
						$args = array( 'numberposts' => '1' );
						$recent_posts = wp_get_recent_posts( $args );
						foreach( $recent_posts as $recent ){
							echo '<a href="' . get_permalink($recent["ID"]) . '" class="blue-btn">'. $recent["post_title"].'</a>';
						}
						wp_reset_query();
					?></div>
					<div class="list-item"><?php $page = get_page_by_title_search('contact');
						if ($page):
							echo '<a href="' . get_permalink($page[0]->ID) . '" class="blue-btn">'. $page[0]->post_title.'</a>';
						endif; ?>
					</div>
					<div class="list-item">
						<h3><?php _e( 'Our Homepage', 'braftonium' ); ?></h3>
						<?php $frontpage_id = get_option( 'page_on_front' ); 
						echo '<a href="' . get_permalink($frontpage_id) . '" class="blue-btn">'.get_the_title($frontpage_id).'</a>'; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
