<?php
// Theme options page
if(function_exists("acf_add_local_field_group")){
acf_add_local_field_group(array(
	'key' => 'group_5a4e8d955ca60',
	'title' => __( 'Braftonium Theme Options', 'braftonium' ),
	'fields' => array(
		array(
			'key' => 'field_5a4e8db865361',
			'label' => __( 'Navigation Bar Position', 'braftonium' ),
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
				'next' => __( 'Next to the Logo 75%', 'braftonium' ),
				'below' => __( 'Below the Logo 100%', 'braftonium' ),
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
			'label' => __( 'Sticky Nav', 'braftonium' ),
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
				'on' => __( 'Sticky?', 'braftonium' ),
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
			'key' => 'field_5b185eb33c54b',
			'label' => __( 'Blog Layout', 'braftonium' ),
			'name' => 'blog_layout',
			'type' => 'select',
			'instructions' => 'All Blog sidebar option contain a full height Sidebar unless otherwise specified.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'hero' => 'First Article Larger Image',
				'simple' => 'Full Width with second row sidebar',
				'rich' => 'Background Cards with Content Overlay',
			),
			'default_value' => array(
				'hero'
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'return_format' => 'value',
			'placeholder' => '',
		),
		
		
		array(
			'key' => 'field_5a4e8f3565366',
			'label' => __( 'Social Media', 'braftonium' ),
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
				'email' => __( 'Email', 'braftonium' ),
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
			'key' => 'field_5b61e4ff523a7',
			'label' => __( 'Allow Comments', 'braftonium' ),
			'name' => 'comments',
			'type' => 'checkbox',
			'instructions' => __( 'I must warn you, it\'s going to be spam.', 'braftonium' ),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'comments' => __( 'Comments', 'braftonium' ),
			),
			'allow_custom' => 0,
			'save_custom' => 0,
			'default_value' => array(
			),
			'layout' => 'vertical',
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

/* Adding More Options to the WordPress Theme Customizer.
-----------------------------------------------------------------*/

/* Adding the logo to the settings page*/
function braftonium_logo_options( $wp_customize ) {
	$wp_customize->add_setting( 'braftonium_logo');

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'braftonium_logo', array(
	'label' => __( 'Logo', 'braftonium' ),
	'section'  => 'title_tagline',
	'settings' => 'braftonium_logo',
	) ) );

	$wp_customize->add_setting( 'braftonium_footerlogo');
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'braftonium_footerlogo', array(
	'label' => __( 'Logo in the Footer', 'braftonium' ),
	'section'  => 'title_tagline',
	'settings' => 'braftonium_footerlogo',
	) ) );
}

add_action('customize_register', 'braftonium_logo_options');


/* Adding the color options to the settings page*/
function braftonium_color_options( $wp_customize ) {
	$wp_customize->add_setting( 'braftonium_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_color', array(
	'label' => __( 'Text Color', 'braftonium' ),
	'section'  => 'colors',
	'settings' => 'braftonium_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_link_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
	)  );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_link_color', array(
	'label' => __( 'Link Color', 'braftonium' ),
	'section'  => 'colors',
	'settings' => 'braftonium_link_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_linkhover_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
	)  );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_linkhover_color', array(
	'label' => __( 'Link Hover Color', 'braftonium' ),
	'section'  => 'colors',
	'settings' => 'braftonium_linkhover_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_headerbg_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
	)  );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_headerbg_color', array(
	'label' => __( 'Header Background Color', 'braftonium' ),
	'section'  => 'colors',
	'settings' => 'braftonium_headerbg_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_header_color2', array(
		'sanitize_callback' => 'sanitize_hex_color',
	)  );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_header_color2', array(
	'label' => __( 'Header Text Color', 'braftonium' ),
	'section'  => 'colors',
	'settings' => 'braftonium_header_color2',
	) ) );

	$wp_customize->add_setting( 'braftonium_headerlink_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
	)  );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_headerlink_color', array(
	'label' => __( 'Header Link Color', 'braftonium' ),
	'section'  => 'colors',
	'settings' => 'braftonium_headerlink_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_headerlinkhover_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
	)  );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_headerlinkhover_color', array(
	'label' => __( 'Header Link Hover Color', 'braftonium' ),
	'section'  => 'colors',
	'settings' => 'braftonium_headerlinkhover_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_footerbg_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
	)  );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_footerbg_color', array(
	'label' => __( 'Footer Background Color', 'braftonium' ),
	'section'  => 'colors',
	'settings' => 'braftonium_footerbg_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_footer_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
	)  );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_footer_color', array(
	'label' => __( 'Footer Text Color', 'braftonium' ),
	'section'  => 'colors',
	'settings' => 'braftonium_footer_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_footerlink_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
	)  );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_footerlink_color', array(
	'label' => __( 'Footer Link Color', 'braftonium' ),
	'section'  => 'colors',
	'settings' => 'braftonium_footerlink_color',
	) ) );

	$wp_customize->add_setting( 'braftonium_footerlinkhover_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
	)  );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'braftonium_footerlinkhover_color', array(
	'label' => __( 'Footer Link Hover Color', 'braftonium' ),
	'section'  => 'colors',
	'settings' => 'braftonium_footerlinkhover_color',
	) ) );
}
add_action('customize_register', 'braftonium_color_options');

function braftonium_customize_preview_js() {
	wp_enqueue_script( 'braftonium-customize-preview', get_template_directory_uri() . '/library/js/customize-preview.js', array( 'customize-preview' ), '20150825', true );
}
add_action( 'customize_preview_init', 'braftonium_customize_preview_js' );
include 'block-page-options.php';