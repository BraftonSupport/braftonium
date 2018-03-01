<?php
require_once ABSPATH . 'wp-content/plugins/advanced-custom-fields/acf.php';
require_once ABSPATH . 'wp-content/themes/business-theme-v2/library/theme-options/business-theme-options.acf.php';

if(function_exists("register_field_group"))
{
	$dir = dirname(__FILE__);
	$files = glob("$dir/**/*.acf.php");
    $custom_post_types = get_field('custom_post_types', 'option');
    
	foreach($files as $file){
		if( is_file($file) ){
			require_once $file;
		}
	}
		
	if ( in_array('testimonial', $custom_post_types) ) {
		require_once ABSPATH . 'wp-content/themes/business-theme-v2/library/custom-post-types/testimonials/testimonials.acf.php';
	}
	if(in_array('event', $custom_post_types) ) {
		require_once ABSPATH . 'wp-content/themes/business-theme-v2/library/custom-post-types/events/events.acf.php';
	}
	if( in_array('team_member', $custom_post_types) ) {
		require_once ABSPATH . 'wp-content/themes/business-theme-v2/library/custom-post-types/team/team.acf.php';
	}
}