<?php get_header();
$blog_page_id = get_option( "page_for_posts" );
$background_image = get_field('background_image',$blog_page_id);
$title = get_field('title',$blog_page_id);
$tagline = get_field('tagline',$blog_page_id); ?>
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
					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (!$title): ?><header class="article-header hentry">
							<h1 class="page-title" itemprop="headline"><?php echo get_the_title( $blog_page_id ); ?></h1>
						</header><?php endif;// end article header ?>

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
								<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
									echo '<div class="thumbnail">';
									the_post_thumbnail('medium');
									echo '</div>';
								} ?>
								<div class="content"><header class="article-header">
									<h2 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
									<p class="byline entry-meta vcard">
										<?php printf( __( 'Posted', 'braftonium' ).' %1$s %2$s',
											/* the time the post was published */
											'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
											/* the author of the post */
											'<span class="by">'.__( 'by', 'braftonium').'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
										); ?>
									</p>
								</header>

								<section class="entry-content cf">
									<?php the_excerpt(); ?>
								</section></div>

							</article>
						<?php endwhile; ?>

							<?php page_navi(); ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
								<header class="article-header">
									<h1><?php _e( 'Oops, Post Not Found!', 'braftonium' ); ?></h1>
								</header>
								<section class="entry-content">
									<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'braftonium' ); ?></p>
								</section>
								<footer class="article-footer">
									<p><?php _e( 'This is the error message in the index.php template.', 'braftonium' ); ?></p>
								</footer>
							</article>

						<?php endif; ?>
					</main>

					<?php get_sidebar(); ?>
				</div>
			</div>

<?php get_footer(); ?>
