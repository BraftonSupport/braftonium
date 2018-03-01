<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php
								/*
								 * Ah, post formats. Nature's greatest mystery (aside from the sloth).
								 *
								 * So this function will bring in the needed template file depending on what the post
								 * format is. The different post formats are located in the post-formats folder.
								 *
								 *
								 * REMEMBER TO ALWAYS HAVE A DEFAULT ONE NAMED "format.php" FOR POSTS THAT AREN'T
								 * A SPECIFIC POST FORMAT.
								 *
								 * If you want to remove post formats, just delete the post-formats folder and
								 * replace the function below with the contents of the "format.php" file.
								*/
								get_template_part( 'post-formats/format', get_post_format() );
							?>

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'business-theme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'business-theme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'business-theme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>
						<?php if ( is_single() && get_field('related_posts', 'option')=='below' ) : ?>
						<div class="latest">
							<h3>Related Posts</h3>
							<?php //$categories = get_the_category();
							// if ($categories) {
							// 	foreach ($categories as $category) {
							// 		$cat = $category->cat_ID;
							// 		$args=array( 'cat' => $cat, 'post__not_in' => array($post->ID), 'posts_per_page'=>3 );

							// 		$my_query = null;
							// 		$my_query = new WP_Query($args);

							// 		if( $my_query->have_posts() ) {
							// 			while ($my_query->have_posts()) : $my_query->the_post();
							// 			$url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
							// 			echo '<a href="' . get_the_permalink() . '" title="'.get_the_title().'">';
							// 				if ( $options['featured_style']=="rollover" ) {
							// 					echo '<div class="thumb" style="background-image: url('.$url[0].')"></div>';
							// 				} else if ( get_post_thumbnail_id( get_the_ID() ) ) {
							// 					echo '<img src="'.$url[0].'" alt="'.get_the_title().'">';
							// 				}
							// 				echo '<h5>'.get_the_title().'<br/><span class="tiny">'.get_the_date('M j, Y').'</span></h5>';
							// 			echo '</a>';
							// 			endwhile;
							// 		}
							// 	}
							// } ?>
						</div>
					<?php endif; ?>
					</main>

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
