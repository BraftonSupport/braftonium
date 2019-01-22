<?php
/*
 Template Name: 404 2
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all cf" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<article id="post-not-found" class="hentry cf">

							<header class="article-header">
								
								<img src='http://design.brafton.com/braftonium/wp-content/uploads/2019/01/full_logo.png' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' class="site-title">
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
					
				</div>

			</div>

<?php get_footer(); ?>
