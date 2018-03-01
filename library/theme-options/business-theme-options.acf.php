<?php
acf_add_local_field_group(array(
	'key' => 'group_5a4e8d955ca60',
	'title' => 'Business Theme Options',
	'fields' => array(
		array(
			'key' => 'field_5a4e8db865361',
			'label' => 'Navigation Bar Position',
			'name' => 'navigation_bar_position',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'next' => 'Next to the Nav 75%',
				'below' => 'Below the Logo 100%',
			),
			'default_value' => array(
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'return_format' => 'value',
			'placeholder' => '',
		),
		array(
			'key' => 'field_5a4e8e2f65362',
			'label' => 'Sticky Nav',
			'name' => 'sticky_nav',
			'type' => 'checkbox',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'on' => 'Sticky?',
			),
			'allow_custom' => 0,
			'save_custom' => 0,
			'default_value' => array(
			),
			'layout' => 'vertical',
			'toggle' => 0,
			'return_format' => 'value',
		),
		array(
			'key' => 'field_5a4e8e5a65363',
			'label' => 'Google Analytics',
			'name' => 'google_analytics',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'UA-xxxxxxxx-xx',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5a4e8e7665364',
			'label' => 'Social Share Buttons',
			'name' => 'social_share_buttons',
			'type' => 'checkbox',
			'instructions' => 'These are not links to your social media, these are for people to share a particular page or post on their own social media profiles.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'on' => 'Social Share Buttons?',
			),
			'allow_custom' => 0,
			'save_custom' => 0,
			'default_value' => array(
			),
			'layout' => 'vertical',
			'toggle' => 0,
			'return_format' => 'value',
		),
		array(
			'key' => 'field_5a4e8e9565365',
			'label' => 'Social Share Button Location',
			'name' => 'ss_button_location',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5a4e8e7665364',
						'operator' => '==',
						'value' => 'on',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'all' => 'On All',
				'excerpt' => 'On Excerpt',
				'post' => 'On Post',
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => '',
			'layout' => 'horizontal',
			'return_format' => 'value',
		),
		array(
			'key' => 'field_5a4e8f3565366',
			'label' => 'Social Media',
			'name' => 'social_media',
			'type' => 'checkbox',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5a4e8e7665364',
						'operator' => '==',
						'value' => 'on',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'facebook' => 'Facebook',
				'twitter' => 'Twitter',
				'google' => 'Google+',
				'linkedin' => 'LinkedIn',
				'pinterest' => 'Pinterest',
				'email' => 'Email',
			),
			'allow_custom' => 0,
			'save_custom' => 0,
			'default_value' => array(
			),
			'layout' => 'horizontal',
			'toggle' => 0,
			'return_format' => 'value',
		),
		array(
			'key' => 'field_5a4ea9e92e432',
			'label' => 'Related Posts',
			'name' => 'related_posts',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'no' => 'No Related Posts',
				'below' => 'Below Post',
				'side' => 'On the Sidebar',
			),
			'default_value' => array(
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'return_format' => 'value',
			'placeholder' => '',
		),
		array(
			'key' => 'field_5a4e8f8065367',
			'label' => 'Extra Widget Areas',
			'name' => 'extra_widget_areas',
			'type' => 'checkbox',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'header' => 'Header',
				'page' => 'Page Sidebar',
				'blog' => 'Blog Sidebar',
				'footer' => 'Footer Widget Area',
			),
			'allow_custom' => 1,
			'save_custom' => 1,
			'default_value' => array(
			),
			'layout' => 'horizontal',
			'toggle' => 0,
			'return_format' => 'value',
		),
		array(
			'key' => 'field_5a8f488bf8df7',
			'label' => 'Custom Post Types',
			'name' => 'custom_post_types',
			'type' => 'checkbox',
			'instructions' => 'Adding \'testimonial\', \'event\', and \'team-member\' will automatically add accompanying options.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'testimonial' => 'Testimonial',
				'event' => 'Event',
				'team_member' => 'Team Member',
			),
			'allow_custom' => 1,
			'save_custom' => 1,
			'default_value' => array(
			),
			'layout' => 'horizontal',
			'toggle' => 0,
			'return_format' => 'value',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-general-settings',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));


/* Adding More Options to the Wordpress Theme Customizer.
-----------------------------------------------------------------*/

/* Adding the logo to the settings page*/

function businesstheme_site_options( $wp_customize ) {
	$wp_customize->add_setting( 'businesstheme_logo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'businesstheme_logo', array(
	'label' => __( 'Logo' ),
	'section'  => 'title_tagline',
	'settings' => 'businesstheme_logo',
	) ) );

	$wp_customize->add_setting( 'businesstheme_footerlogo' );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'businesstheme_footerlogo', array(
	'label' => __( 'Logo in the Footer' ),
	'section'  => 'title_tagline',
	'settings' => 'businesstheme_footerlogo',
	) ) );
}

add_action('customize_register', 'businesstheme_site_options');

/* Logo size */

function businesstheme_get_image_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
        return $attachment[0]; 
}