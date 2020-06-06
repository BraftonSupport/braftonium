<?php
if(function_exists("acf_add_local_field_group")){

	$style_classes = array(
		'shadow' => __( 'Add Shadow', 'braftonium' ),
		'full' => __( 'Full Screen', 'braftonium' ),
		'compact' => __( 'Blockquote (add side margins)', 'braftonium' ),
		'center' => __( 'Center', 'braftonium' ),
	);
	$style_classes = apply_filters('braftonium_style_classes', $style_classes);
	//Style fields for use on classic editor.
acf_add_local_field_group(array(
	'key' => 'group_5a4d3902e55eb',
	'title' => 'Style',
	'fields' => array(
		array(
			'key' => 'field_5a4d3dc7e18d5',
			'label' => __( 'Style', 'braftonium' ),
			'name' => 'style',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'row',
			'sub_fields' => array(
				array(
					'key' => 'field_5a4d3996952f0',
					'label' => __( 'Background Color', 'braftonium' ),
					'name' => 'background_color',
					'type' => 'color_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '18',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
				),
				array(
					'key' => 'field_5a4d39b1952f1',
					'label' => __( 'Color', 'braftonium' ),
					'name' => 'color',
					'type' => 'color_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '17',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
				),
				array(
					'key' => 'field_5a4d3087df49d',
					'label' => __( 'Background', 'braftonium' ),
					'name' => 'background',
					'type' => 'radio',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '15',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'Static' => __( 'Static', 'braftonium' ),
						'Video' => __( 'Video', 'braftonium' ),
					),
					'allow_null' => 0,
					'other_choice' => 0,
					'save_other_choice' => 0,
					'default_value' => '',
					'layout' => 'vertical',
					'return_format' => 'value',
				),
				array(
					'key' => 'field_5a4d2f89df498',
					'label' => __( 'Background Image', 'braftonium' ),
					'name' => 'background_image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_5a4d3087df49d',
								'operator' => '==',
								'value' => 'Static',
							),
						),
					),
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'url',
					'preview_size' => 'thumbnail',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
				array(
					'key' => 'field_5a4d2fcddf499',
					'label' => __( 'Video Url', 'braftonium' ),
					'name' => 'video_url',
					'type' => 'url',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_5a4d3087df49d',
								'operator' => '==',
								'value' => 'Video',
							),
						),
					),
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
				array(
					'key' => 'field_5a4d42b4ce417',
					'label' => __( 'Other', 'braftonium' ),
					'name' => 'other',
					'instructions'	=> "Preset Additional Styles",
					'choices' => $style_classes,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'type' => 'select',
					'required' => 0,
					'conditional_logic' => 0,
					'default_value' => array(
					),
					'allow_null' => 0,
					'multiple' => 1,
					'ui' => 1,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
					
					// 'type' => 'checkbox',
					// 'instructions' => '',
					// 'required' => 0,
					// 'conditional_logic' => 0,
					
					
					// 'allow_custom' => 0,
					// 'save_custom' => 0,
					// 'default_value' => array(
					// ),
					// 'layout' => 'horizontal',
					// 'toggle' => 0,
					// 'return_format' => 'value',
				),
				array(
					'key' => 'field_5a4d4292ce416',
					'label' => __( 'Add Class', 'braftonium' ),
					'name' => 'add_class',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
			),
		),
	),
	'location' => array(
		// array(
		// ),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));
//Styles fields for use with gutenberg
acf_add_local_field_group(array(
	'key' => 'group_5a4d3902e55eb_bf',
	'title' => 'Style',
	'fields' => array(
		
			array(
				'key' => 'field_5a4d3996952f0_bf',
				'label' => __( 'Background Color', 'braftonium' ),
				'name' => 'background_color',
				'type' => 'color_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
			),
			array(
				'key' => 'field_5a4d39b1952f1_bf',
				'label' => __( 'Color', 'braftonium' ),
				'name' => 'color',
				'type' => 'color_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
			),
			array(
				'key' => 'field_5a4d3087df49d_bf',
				'label' => __( 'Background', 'braftonium' ),
				'name' => 'background',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'Static' => __( 'Static', 'braftonium' ),
					'Video' => __( 'Video', 'braftonium' ),
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'vertical',
				'return_format' => 'value',
			),
			array(
				'key' => 'field_5a4d2f89df498_bf',
				'label' => __( 'Background Image', 'braftonium' ),
				'name' => 'background_image',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5a4d3087df49d_bf',
							'operator' => '==',
							'value' => 'Static',
						),
					),
				),
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_5a4d2fcddf499_bf',
				'label' => __( 'Video Url', 'braftonium' ),
				'name' => 'video_url',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5a4d3087df49d_bf',
							'operator' => '==',
							'value' => 'Video',
						),
					),
				),
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_5a4d42b4ce417_bf',
				'label' => __( 'Other', 'braftonium' ),
				'name' => 'other',
				'instructions'	=> "Preset Additional Styles",
				'choices' => array_merge($style_classes, array('full-width'	=> 'Full Width')),
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'type' => 'select',
				'required' => 0,
				'conditional_logic' => 0,
				'default_value' => array(
				),
				'allow_null' => 0,
				'multiple' => 1,
				'ui' => 1,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
				
				// 'type' => 'checkbox',
				// 'instructions' => '',
				// 'required' => 0,
				// 'conditional_logic' => 0,
				
				
				// 'allow_custom' => 0,
				// 'save_custom' => 0,
				// 'default_value' => array(
				// ),
				// 'layout' => 'horizontal',
				// 'toggle' => 0,
				// 'return_format' => 'value',
			),
			// array(
			// 	'key' => 'field_5a4d4292ce416',
			// 	'label' => __( 'Add Class', 'braftonium' ),
			// 	'name' => 'add_class',
			// 	'type' => 'text',
			// 	'instructions' => '',
			// 	'required' => 0,
			// 	'conditional_logic' => 0,
			// 	'wrapper' => array(
			// 		'width' => '50',
			// 		'class' => '',
			// 		'id' => '',
			// 	),
			// 	'default_value' => '',
			// 	'placeholder' => '',
			// 	'prepend' => '',
			// 	'append' => '',
			// 	'maxlength' => '',
			// ),
	),
	'location' => array(
		// array(
		// ),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));
}