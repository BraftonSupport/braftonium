<?php get_header();
$brafton_comments = get_field('comments', 'option');
?>

			<div id="content">
			<main id="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
				
				<div id="inner-content" class="wrap cf">

					<div class="m-all <?php if(is_active_sidebar('blog-sidebar')): echo 't-2of3 d-5of7'; endif; ?> cf">

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
											<p><?php //_e( 'This is the error message in the single.php template.', 'braftonium' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>
						</div>

					<?php get_sidebar(); ?>
					<?php if ( is_single() && get_field('related_posts', 'option')=='below' ) :
						braftonium_related_posts(3);
					endif; ?>
				</div>
				</main>
			</div>

<?php get_footer(); ?>
