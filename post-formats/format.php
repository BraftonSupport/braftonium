              <?php
                /*
                 * This is the default post format.
                 *
                 * So basically this is a regular post. if you don't want to use post formats,
                 * you can just copy ths stuff in here and replace the post format thing in
                 * single.php.
                 *
                 * The other formats are SUPER basic so you can style them as you like.
                 *
                 * Again, If you want to remove post formats, just delete the post-formats
                 * folder and replace the function below with the contents of the "format.php" file.
                */
              ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

                <?php if (!has_post_thumbnail()) : ?>
                  <header class="article-header entry-header">
                    <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
                    <p class="byline entry-meta vcard">
                      <?php printf( __( 'Posted', 'braftonium' ).' %1$s %2$s',
                        /* the time the post was published */
                        '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                        /* the author of the post */
                        '<span class="by">'.__( 'by', 'braftonium' ).'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
                      ); ?>
                      <?php printf( __( 'filed under', 'braftonium' ).': %1$s', get_the_category_list(', ') ); ?>
                      <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'braftonium' ) . '</span> ', ', ', '</p>' );
                        social_sharing_buttons(); ?>
                    </p>
                  </header>
                <?php endif; // end article header ?>

                <section class="entry-content cf" itemprop="articleBody">
                  <?php
                    the_content();
                  ?>
                </section> <?php // end article section ?>

              </article> <?php // end article ?>
