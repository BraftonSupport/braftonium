<?php get_header();
$layout = sanitize_text_field(get_field('blog_layout', 'option'));
$layoutarray = array('full','rich','simple');
$blog_page_id = get_option( "page_for_posts" );

?>
			<div id="content">
				<div id="inner-content" class="wrap cf">
					<main id="main" class="m-all <?php if(is_active_sidebar('blog-sidebar')): echo 't-2of3 d-5of7'; endif; ?> cf<?php echo ' '.$layout; ?>" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (!$title): ?><header class="article-header hentry">
							<h1 class="page-title" itemprop="headline"><?php echo get_the_title( $blog_page_id ); ?></h1>
						</header><?php endif;// end article header ?>

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?>>
								<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
									echo '<div class="thumbnail">';
									if (in_array($layout, $layoutarray)):
										echo '<a href="'. get_the_permalink().'"  title="'. the_title_attribute( 'echo=0' ) .'">';
										the_post_thumbnail('medium');
										echo '</a>';
									else:
										the_post_thumbnail('medium');
									endif;
									echo '</div>';
								} ?>
								<div class="content"><header class="article-header">
									<h2 class="h3 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
									<p class="byline entry-meta vcard">
										<?php printf( __( 'Posted', 'braftonium' ).' %1$s %2$s',
											/* the time the post was published */
											'<a href="'. get_the_permalink().'"><time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time></a>',
											/* the author of the post */
											'<span class="by">'.__( 'by', 'braftonium').'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
										); 
										if (function_exists('braftonium_social_sharing_buttons')):
											braftonium_social_sharing_buttons();
										endif; ?>
									</p>
								</header>

								<section class="entry-content cf">
									<?php the_excerpt(); ?>
								</section></div>

							</article>
						<?php endwhile; ?>

							<?php braftonium_page_navi(); ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
								<header class="article-header">
									<h1><?php _e( 'Oops, Post Not Found!', 'braftonium' ); ?></h1>
								</header>
								<section class="entry-content">
									<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'braftonium' ); ?></p>
								</section>
								<footer class="article-footer">
									<p><?php // _e( 'This is the error message in the index.php template.', 'braftonium' ); ?></p>
								</footer>
							</article>

						<?php endif; ?>
					</main>

					<?php get_sidebar(); ?>
				</div>
			</div>

<?php get_footer(); ?>
