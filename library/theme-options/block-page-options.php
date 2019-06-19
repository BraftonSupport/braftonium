<?php 
acf_add_local_field_group(array(
	'key' => 'group_5d0a972492dd8',
	'title' => 'Block Page Options',
	'fields' => array(
		array(
			'key' => 'field_5d0a973473bee',
			'label' => 'Display Default Page Content',
			'name' => 'default_content',
			'type' => 'true_false',
			'instructions' => 'The full width template is designed for use with the Content L3go blocks. If you wish to display the default Gutenberg Editor content you need to turn this option on.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'full-width.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));