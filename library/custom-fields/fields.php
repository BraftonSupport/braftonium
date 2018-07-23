<?php
require_once ABSPATH . 'wp-content/plugins/advanced-custom-fields-pro/acf.php';
require_once get_template_directory().'/library/theme-options/braftonium-options.acf.php';

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
<<<<<<< HEAD
	if ( !is_null($custom_post_types) && is_array($custom_post_types) ):
		if ( in_array('testimonial', $custom_post_types) ) {
			require_once get_template_directory().'/library/custom-post-types/testimonials/testimonials.acf.php';
		}
		if(in_array('event', $custom_post_types) ) {
			require_once get_template_directory(). '/library/custom-post-types/events/events.acf.php';
		}
		if( in_array('team_member', $custom_post_types) ) {
			require_once get_template_directory(). '/library/custom-post-types/team/team.acf.php';
		}
	endif;
=======
		
	if ( is_array($custom_post_types) && in_array('testimonial', $custom_post_types) ) {
		require_once get_template_directory().'/library/custom-post-types/testimonials/testimonials.acf.php';
	}
	if ( is_array($custom_post_types) &&  in_array('event', $custom_post_types) ) {
		require_once get_template_directory(). '/library/custom-post-types/events/events.acf.php';
	}
	if ( is_array($custom_post_types) &&  in_array('team_member', $custom_post_types) ) {
		require_once get_template_directory(). '/library/custom-post-types/team/team.acf.php';
	}
>>>>>>> 3c7e5ea86f3f2b15b857ce53f811df74b1445125
}