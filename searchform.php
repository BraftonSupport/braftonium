<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>">
    <label for="s" class="screen-reader-text"><?php _e('Search for:','business-theme'); ?></label>
    <input type="search" id="s" name="s" placeholder="search" />
    <button type="submit" id="searchsubmit" class="blue-btn"><?php echo get_svg_path('icon-search'); ?></button>
</form>