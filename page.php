<?php get_header();
$title = wp_kses_post(get_field('title'));
$brafton_comments = get_field('comments', 'option');
?>

	<div id="content">
		<div id="inner-content" class="cf">

			<main id="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
				
				<div class="wrap">
					<div class="m-all <?php if ( is_active_sidebar( 'page-sidebar' ) ) : echo 't-2of3 d-5of7 '; endif; ?>cf" >
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> itemscope itemtype="http://schema.org/BlogPosting">

							<?php if (!$title): ?><header class="article-header">
								<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
							</header><?php endif;// end article header ?>

							<section class="entry-content cf" itemprop="articleBody">
								<?php
									// the content (pretty self explanatory huh)
									the_content();

									// If comments are open or we have at least one comment, load up the comment template.
									if ( !empty($brafton_comments) && comments_open() || get_comments_number() ) :
										comments_template();
									endif;
								?>
							</section> <?php // end article section 
							 	$defaults = array(
									'before'           => '<p>' . __( 'Pages:', 'braftonium' ),
									'after'            => '</p>',
									'link_before'      => '',
									'link_after'       => '',
									'next_or_number'   => 'number',
									'separator'        => ' ',
									'nextpagelink'     => __( 'Next page', 'braftonium'),
									'previouspagelink' => __( 'Previous page', 'braftonium' ),
									'pagelink'         => '%',
									'echo'             => 1
								);
								 
									wp_link_pages( $defaults );
							?>

						</article>

					<?php endwhile; endif; ?>


				
				</div>
				<?php get_sidebar(); ?>
			</div>
			</main>
		</div>
	</div>
<?php get_footer(); ?>
