<?php
if(!session_id()) session_start();
/*
 Template Name: Resources
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
$banner_style = get_field('banner_style', 'option');
$background_image = esc_url(get_field('background_image'));
$title = wp_kses_post(get_field('title'));
$tagline = wp_kses_post(get_field('tagline'));
?>
<?php get_header(); ?>

<div id="content" class="hentry">
    <div id="inner-content" class="cf">
        <?php if ($background_image||$title||$tagline) : ?>
            <section class="banner visual<?php if ($banner_style == 'sinistral'): echo ' sinistral'; endif; ?>"<?php if ($background_image): echo ' style="background-image:url('.$background_image.')"'; endif; ?>>
                <?php if ($banner_style == 'sinistral'): ?>
                    <div class="wrap"><div class="black">
                <?php else : ?>
                    <div class="black"><div class="wrap">
                <?php endif; ?>
                    <?php if ($title): echo '<h1 class="page-title" itemprop="headline">'.$title.'</h1>'; endif; ?>
                    <?php if ($tagline): echo $tagline; endif; ?>
                </div></div>
            </section>
        <?php endif;?>
        <main id="main" class="m-all t-all d-all cf" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

            <div class="wrap">
                
                <?php if (!$background_image && !$layout == 'simple'): ?><header class="article-header hentry">
					<h1 class="page-title" itemprop="headline"><?php echo get_the_title( $blog_page_id ); ?></h1>
                </header><?php endif;// end article header ?>
                
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php if( get_the_title() && !$title) : ?>
                        <header class="article-header">
                            <h1 class="page-title"><?php the_title(); ?></h1>
                        </header>
                    <?php endif; ?>

                    <?php if( get_the_content() ): ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> itemscope itemtype="http://schema.org/BlogPosting">
                            <section class="entry-content cf" itemprop="articleBody">
                                <?php the_content(); ?>
                            </section>
                        </article>
                    <?php endif; ?>
                    
            <?php
                $custom_terms = get_terms('resource-type');

                foreach($custom_terms as $custom_term) {
                    wp_reset_query();
                    $args = array('post_type' => 'resources',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'resource-type',
                                'field' => 'slug',
                                'terms' => $custom_term->slug,
                            ),
                        ),
                    );

                    $loop = new WP_Query($args);
                    if($loop->have_posts()) {
                        echo '<h2>'.$custom_term->name.'</h2><div class="container">';

                        while($loop->have_posts()) : $loop->the_post();
                        echo '<div class="list-item">';
                        if (has_post_thumbnail()):
                            echo '<div class="image">'.get_the_post_thumbnail().'</div>';
                        endif;

                        echo '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';

                        $content= get_the_content();
                        if ($content): 
						    $the_excerpt= substr($content,0,strpos($content,'.')+1);
                            if ( strlen($the_excerpt) == 1) {
								echo implode(' ', array_slice(explode(' ', get_the_content()), 0, 15)).'...';
							} else if ( strlen($the_excerpt) > 125 ){
								echo implode(' ', array_slice(explode(' ', $the_excerpt), 0, 15)).'...';
							} else {
								echo $the_excerpt;
							}
                        endif;

                        echo '<br/><a href="'.get_permalink().'" class="blue-btn">Read More</a></div>';
                        endwhile;

                        echo '</div>';
                    }
                }
            ?>
                <?php endwhile; else : ?>

                    <article id="post-not-found" class="hentry cf">
                        <header class="article-header">
                            <h1><?php _e( 'Oops, Post Not Found!', 'braftonium' ); ?></h1>
                        </header>
                        <section class="entry-content">
                            <p><?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'braftonium' ); ?></p>
                        </section>
                        <footer class="article-footer">
                            <p><?php //_e( 'This is the error message in the full-width.php template.', 'braftonium' ); ?></p>
                        </footer>
                    </article>

                <?php endif; ?>
            </div>
        </main><!-- //main -->

    </div><!-- //inner-content -->

</div><!-- //content -->

<?php get_footer(); ?>
