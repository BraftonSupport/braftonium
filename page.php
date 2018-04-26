<?php get_header();
$background_image = get_field('background_image');
$title = get_field('title');
$tagline = get_field('tagline');
?>

			<div id="content">
				<?php if ($background_image||$title||$tagline) : ?>
					<section class="banner visual"<?php if ($background_image): echo ' style="background-image:url('.$background_image.')"'; endif; ?>>
						<div class="black"><div class="wrap">
							<?php if ($title): echo '<h1 class="page-title" itemprop="headline">'.$title.'</h1>'; endif; ?>
							<?php if ($tagline): echo $tagline; endif; ?>
						</div></div>
					</section>
				<?php endif; ?>
				
				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all <?php if ( is_active_sidebar( 'page-sidebar' ) ) : echo 't-2of3 d-5of7 '; endif; ?>cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<?php if (!$title): ?><header class="article-header">
									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
								</header><?php endif;// end article header ?>

								<section class="entry-content cf" itemprop="articleBody">
									<?php
										// the content (pretty self explanatory huh)
										the_content();
									?>
								</section> <?php // end article section ?>

							</article>

							<?php endwhile; endif; ?>

						</main>

						<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
