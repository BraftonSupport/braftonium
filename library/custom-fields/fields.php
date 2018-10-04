<?php
require_once ABSPATH . 'wp-content/plugins/advanced-custom-fields-pro/acf.php';
require_once get_template_directory().'/library/theme-options/braftonium-options.acf.php';

if(function_exists("register_field_group"))
{
	$dir = dirname(__FILE__);
	$files = glob("$dir/**/*.acf.php");
	
	foreach($files as $file){
		if( is_file($file) ){
			require_once $file;
		}
	}
}