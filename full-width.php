<?php
if(!session_id()) session_start();
/*
 Template Name: Full Width
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
$background_image = get_field('background_image');
$title = get_field('title');
$tagline = get_field('tagline');
$style = get_field('style');
$bg = $style['background_color'];
$color = $style['color'];
$bg_image = $style['background_image'];
$video = $style['video_url'];
$class = $style['add_class'];
$other = $style['other'];
?>

<?php get_header(); ?>

	<div id="content" class="hentry">
		<?php $sectionrow=0;
		if ($background_image||$title||$tagline) : ?>
			<section class="banner visual"<?php if ($background_image): echo ' style="background-image:url('.$background_image.')"'; endif; ?>>
				<div class="black"><div class="wrap">
					<?php if ($title): echo '<h1 class="page-title" itemprop="headline">'.$title.'</h1>'; endif; ?>
					<?php if ($tagline): echo $tagline; endif; ?>
				</div></div>
			</section>
		<?php $sectionrow++;
		endif; // check if the flexible content field has rows of data
			if( have_rows('content') ):
				// loop through the rows of data
				while ( have_rows('content') ) : the_row();
					$_SESSION['sectionrow']=$sectionrow;
					if( get_row_layout() == 'visual' ):
						get_template_part( 'post-formats/content', 'visual' );
						$sectionrow++;
					elseif( get_row_layout() == 'list' ): 
						get_template_part( 'post-formats/content', 'list' );
						$sectionrow++;
					elseif( get_row_layout() == 'validation' ):
						get_template_part( 'post-formats/content', 'validation' );
						$sectionrow++;
					elseif( get_row_layout() == 'row' ): 
						get_template_part( 'post-formats/content', 'row' );
						$sectionrow++;
					elseif( get_row_layout() == 'cta' ): 
						get_template_part( 'post-formats/content', 'cta' );
						$sectionrow++;
					elseif( get_row_layout() == 'map' ):
						get_template_part( 'post-formats/content', 'map' );
						$sectionrow++;
					endif;
				endwhile;
			endif; ?>
			<div id="inner-content" class="wrap cf">

				<main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

							<header class="article-header">
								<?php if( !have_rows('content') ): ?>
									<h1 class="page-title"><?php the_title(); ?></h1>
								<?php else : ?>
									<h2 class="page-title"><?php the_title(); ?></h2>
								<?php endif; ?>

								<p class="byline vcard">
								<?php printf( __( 'Posted', 'braftonium' ).' %1$s %2$s',
									/* the time the post was published */
									'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
									/* the author of the post */
									'<span class="by">'.__( 'by', 'braftonium' ).'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
								); ?>
								</p>

							</header>

							<section class="entry-content cf" itemprop="articleBody">
								<?php
									the_content();
								?>
							</section>

						</article>

					<?php endwhile; else : ?>

						<article id="post-not-found" class="hentry cf">
							<header class="article-header">
								<h1><?php _e( 'Oops, Post Not Found!', 'braftonium' ); ?></h1>
							</header>
							<section class="entry-content">
								<p><?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'braftonium' ); ?></p>
							</section>
							<footer class="article-footer">
								<p><?php _e( 'This is the error message in the full-width.php template.', 'braftonium' ); ?></p>
							</footer>
						</article>

					<?php endif; ?>

				</main>

				<?php get_sidebar(); ?>

			</div>

		</div>

<?php get_footer(); ?>
