				<?php if ( !is_page_template('full-width.php') && is_page() && is_active_sidebar( 'page-sidebar' ) ) : ?>
					<div id="sidebar1" class="sidebar m-all t-1of3 d-2of7 last-col cf" role="complementary">
						<?php dynamic_sidebar( 'page-sidebar' ); ?>
					</div>
				<?php elseif ( !is_page() && is_active_sidebar('blog-sidebar') ) : ?>
					<div id="sidebar1" class="sidebar m-all t-1of3 d-2of7 last-col cf" role="complementary">
						<?php dynamic_sidebar( 'blog-sidebar' ); ?>
					
						<?php if ( is_single() && get_field('related_posts', 'option')=='side' ) : ?>
							<section class="latest widget">
								<h3><?php _e( 'Related Posts', 'braftonium' ); ?></h3>
								<?php $categories = get_the_category();
								if ($categories) {
									foreach ($categories as $category) {
										$cat = $category->cat_ID;
										$args=array( 'cat' => $cat, 'post__not_in' => array($post->ID), 'posts_per_page'=>3 );

										$my_query = null;
										$my_query = new WP_Query($args);

										if( $my_query->have_posts() ) {
											while ($my_query->have_posts()) : $my_query->the_post();
											$url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
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
							</section>
						<?php endif; ?>
					</div>
				<?php endif; ?>
