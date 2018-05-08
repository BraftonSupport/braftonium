<?php get_header(); ?>

			<div id="content">
				<?php if (has_post_thumbnail()) : ?>
					<section class="banner visual"<?php echo ' style="background-image:url('.get_the_post_thumbnail_url().')"'; ?>>
						<div class="black"><div class="wrap">
							<h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
							<p class="byline entry-meta vcard">
								<?php printf( __( 'Posted', 'braftonium' ).' %1$s %2$s',
									/* the time the post was published */
									'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
									/* the author of the post */
									'<span class="by">'.__( 'by', 'braftonium' ).'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
								); ?>
								<?php printf( __( 'in', 'braftonium' ).': %1$s', get_the_category_list(', ') ); ?>
								<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'braftonium' ) . '</span> ', ', ', '</p>' ); ?>
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
						<?php if ( is_single() && get_field('related_posts', 'option')=='below' ) : ?>
						<div class="latest">
							<h3>Related Posts</h3>
							<?php $categories = get_the_category();
							if ($categories) {
								foreach ($categories as $category) {
									$cat = $category->cat_ID;
									$args=array( 'cat' => $cat, 'post__not_in' => array($post->ID), 'posts_per_page'=>3 );

									$my_query = null;
									$my_query = new WP_Query($args);

									if( $my_query->have_posts() ) {
										while ($my_query->have_posts()) : $my_query->the_post();
										$url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
										echo '<a href="' . get_the_permalink() . '" title="'.get_the_title().'">';
											if ( $options['featured_style']=="rollover" ) {
												echo '<div class="thumb" style="background-image: url('.$url[0].')"></div>';
											} else if ( get_post_thumbnail_id( get_the_ID() ) ) {
												echo '<img src="'.$url[0].'" alt="'.get_the_title().'">';
											}
											echo '<h5>'.get_the_title().'<br/><span class="tiny">'.get_the_date('M j, Y').'</span></h5>';
										echo '</a>';
										endwhile;
									}
								}
							 } ?>
						</div>
					<?php endif; ?>
					</main>

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
