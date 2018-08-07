<?php get_header();
$brafton_comments = get_field('comments', 'option');
?>

			<div id="content">
				<?php if (has_post_thumbnail()) : ?>
					<section class="banner visual"<?php echo ' style="background-image:url('.get_the_post_thumbnail_url(get_the_ID(),'full').')"'; ?>>
						<div class="black"><div class="wrap">
							<h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
							<p class="byline entry-meta vcard">
								<?php printf( __( 'Posted', 'braftonium' ).' %1$s %2$s',
									/* the time the post was published */
									'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
									/* the author of the post */
									'<span class="by">'.__( 'by', 'braftonium' ).'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
								);
								?>
								<?php printf( __( 'filed under', 'braftonium' ).': %1$s', get_the_category_list(', ') ); ?>
								<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'braftonium' ) . '</span> ', ', ', '</p>' );
								social_sharing_buttons(); ?>
							</p>
						</div></div>
					</section>
				<?php endif; ?>
				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php
								/*
								 * REMEMBER TO ALWAYS HAVE A DEFAULT ONE NAMED "format.php", make different formats if needed
								*/
								get_template_part( 'post-formats/format', get_post_format() );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( !empty($brafton_comments) && comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							?>

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'braftonium' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'braftonium' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'braftonium' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>
					</main>

					<?php get_sidebar(); ?>
					<?php if ( is_single() && get_field('related_posts', 'option')=='below' ) :
						braftonium_related_posts(3);
					endif; ?>
				</div>

			</div>

<?php get_footer(); ?>
