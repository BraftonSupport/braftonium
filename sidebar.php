				<?php if ( !is_page_template('full-width.php') && is_page() && is_active_sidebar( 'page-sidebar' ) ) : ?>
					<div id="sidebar1" class="sidebar m-all t-1of3 d-2of7 last-col cf" role="complementary">
						<?php dynamic_sidebar( 'page-sidebar' ); ?>
					</div>
					<?php elseif ( !is_page() && is_active_sidebar('blog-sidebar') ) : ?>
					<div id="sidebar1" class="sidebar m-all t-1of3 d-2of7 last-col cf" role="complementary">
						<?php dynamic_sidebar( 'blog-sidebar' ); ?>
					
						<?php if ( is_single() && get_field('related_posts', 'option')=='side' ) :
							braftonium_related_posts(3);
						endif; ?>
					</div>
				<?php elseif ( is_page_template('simple-card.php') || is_page_template('full-card.php') || is_page_template('image-rich.php') && is_active_sidebar('blog-sidebar') ) : ?>
					<div id="sidebar1" class="sidebar m-all t-1of3 d-2of7 last-col cf" role="complementary">
						<?php dynamic_sidebar( 'blog-sidebar' ); ?>
					
						<?php if ( is_single() && get_field('related_posts', 'option')=='side' ) :
							braftonium_related_posts(3);
						endif; ?>
					</div>
				<?php endif; ?>
