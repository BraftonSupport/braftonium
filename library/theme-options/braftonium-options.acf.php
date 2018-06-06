<?php
if(function_exists("acf_add_local_field_group")){
acf_add_local_field_group(array(
	'key' => 'group_5a4e8d955ca60',
	'title' => 'Braftonium Theme Options',
	'fields' => array(
		array(
			'key' => 'field_5b1858bc2f26f',
			'label' => 'Braftonium Theme Options',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5a4e8db865361',
			'label' => __( "Navigation Bar Position", "braftonium" ),
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
				'next' => __( "Next to the Nav 75%", "braftonium" ),
				'below' => __( "Below the Logo 100%", "braftonium" ),
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
			'label' => __( "Sticky Nav", "braftonium" ),
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
				'on' => __( "Sticky?", "braftonium" ),
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
			'label' => __( "Google Analytics", "braftonium" ),
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
			'key' => 'field_5a4e8f8065367',
			'label' => __( "Extra Widget Areas", "braftonium" ),
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
				'header' => __( "Header", "braftonium" ),
				'page' => __( "Page Sidebar", "braftonium" ),
				'blog' => __( "Blog Sidebar", "braftonium" ),
				'footer' => __( "Footer Widget Area", "braftonium" ),
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
			'label' => __( "Custom Post Types", "braftonium" ),
			'name' => 'custom_post_types',
			'type' => 'checkbox',
			'instructions' => __( 'Adding \'testimonial\', \'event\', and \'team-member\' will automatically add accompanying options.', 'braftonium' ),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'testimonial' => __( 'Testimonial', 'braftonium' ),
				'event' => __( 'Event', 'braftonium' ),
				'team_member' => __( 'Team Member', 'braftonium' ),
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
			'key' => 'field_5b1859702f270',
			'label' => 'Blog Options',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5b185eb33c54b',
			'label' => 'Blog Layout',
			'name' => 'blog_layout',
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
				'hero' => 'Hero First',
				'rich' => 'Image Rich',
				'full' => 'Full Card',
				'simple' => 'Simple Card',
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
			'key' => 'field_5a4ea9e92e432',
			'label' => __( "Related Posts", "braftonium" ),
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
				'no' => __( "No Related Posts", "braftonium" ),
				'below' => __( "Below Post", "braftonium" ),
				'side' => __( "On the Sidebar", "braftonium" ),
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
			'key' => 'field_5a4e8e7665364',
			'label' => __( "Social Share Buttons", "braftonium" ),
			'name' => 'social_share_buttons',
			'type' => 'checkbox',
			'instructions' => __( "These are not links to your social media, these are for people to share a particular page or post on their own social media profiles.", "braftonium" ),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'on' => __( 'Social Share Buttons?', 'braftonium' ),
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
			'label' => __( "Social Share Button Location", "braftonium" ),
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
				'all' => __( "On All", "braftonium" ),
				'excerpt' => __( "On Excerpt", "braftonium" ),
				'post' => __( "On Post", "braftonium" ),
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
			'label' => __( "Social Media", "braftonium" ),
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
				'email' => __( "Email", "braftonium" ),
			),
			'allow_custom' => 0,
			'save_custom' => 0,
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
}

/* Adding More Options to the Wordpress Theme Customizer.
-----------------------------------------------------------------*/

/* Adding the logo to the settings page*/
function braftonium_logo_options( $wp_customize ) {
	$wp_customize->add_setting( 'braftonium_logo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'braftonium_logo', array(
	'label' => __( 'Logo' ),
	'section'  => 'title_tagline',
	'settings' => 'braftonium_logo',
	) ) );

	$wp_customize->add_setting( 'braftonium_footerlogo' );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'braftonium_footerlogo', array(
	'label' => __( 'Logo in the Footer' ),
	'section'  => 'title_tagline',
	'settings' => 'braftonium_footerlogo',
	) ) );
}

add_action('customize_register', 'braftonium_logo_options');


/* Adding the color options to the settings page*/
function braftonium_color_options( $wp_customize ) {
	$wp_customize->add_setting( 'braftonium_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_color', array(
	'label' => __( 'Text Color' ),
	'section'  => 'colors',
	'settings' => 'braftonium_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_link_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_link_color', array(
	'label' => __( 'Link Color' ),
	'section'  => 'colors',
	'settings' => 'braftonium_link_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_linkhover_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_linkhover_color', array(
	'label' => __( 'Link Hover Color' ),
	'section'  => 'colors',
	'settings' => 'braftonium_linkhover_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_headerbg_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_headerbg_color', array(
	'label' => __( 'Header Background Color' ),
	'section'  => 'colors',
	'settings' => 'braftonium_headerbg_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_header_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_header_color', array(
	'label' => __( 'Header Text Color' ),
	'section'  => 'colors',
	'settings' => 'braftonium_header_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_headerlink_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_headerlink_color', array(
	'label' => __( 'Header Link Color' ),
	'section'  => 'colors',
	'settings' => 'braftonium_headerlink_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_headerlinkhover_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_headerlinkhover_color', array(
	'label' => __( 'Header Link Hover Color' ),
	'section'  => 'colors',
	'settings' => 'braftonium_headerlinkhover_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_footerbg_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_footerbg_color', array(
	'label' => __( 'Footer Background Color' ),
	'section'  => 'colors',
	'settings' => 'braftonium_footerbg_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_footer_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_footer_color', array(
	'label' => __( 'Footer Text Color' ),
	'section'  => 'colors',
	'settings' => 'braftonium_footer_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_footerlink_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_footerlink_color', array(
	'label' => __( 'Footer Link Color' ),
	'section'  => 'colors',
	'settings' => 'braftonium_footerlink_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_footerlinkhover_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_footerlinkhover_color', array(
	'label' => __( 'Footer Link Hover Color' ),
	'section'  => 'colors',
	'settings' => 'braftonium_footerlinkhover_color',
	) ) );
}
add_action('customize_register', 'braftonium_color_options');

function braftonium_customize_preview_js() {
	wp_enqueue_script( 'braftonium-customize-preview', get_template_directory_uri() . '/library/js/customize-preview.js', array( 'customize-preview' ), '20150825', true );
}
add_action( 'customize_preview_init', 'braftonium_customize_preview_js' );
