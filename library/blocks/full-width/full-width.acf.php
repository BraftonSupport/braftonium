<?php
if(function_exists("acf_add_local_field_group")){

//@todo perform a glob for all component files *.block.php and import them into an array
// $blocks = []
// under layouts add the $blocks array

$dir = dirname(__FILE__);	
$files = glob("$dir/components/**/*.block.php");
$blocks = [];
foreach($files as $file){
	if( is_file($file) ){
		$blocks = array_merge(include $file, $blocks);
	}
}
//for child themes to add new custom layout blocks

// $custom_blocks = apply_filters('braftonium_add_layout_block', $custom_blocks);
// var_dump($custom_blocks);die();
// if(count($custom_blocks) > 0){
// 	$blocks = array_merge($blocks, $custom_blocks);
// }
// var_dump($blocks);
$blocks = apply_filters('braftonium_add_layout_block', $blocks);
// var_dump($blocks);
acf_add_local_field_group(array(
	'key' => 'group_5a4d29f317abe',
	'title' => 'full-width',
	'fields' => array(
		array(
			'key' => 'field_5a4d2a47df496',
			'label' => __( 'Content (L3go) Blocks', 'braftonium' ),
			'name' => 'content',
			'type' => 'flexible_content',
			'instructions' => 'When using these Blocks your page content using the default Wordpress editor will display last after all blocks.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layouts' => $blocks,
			'button_label' => __( 'Add Row', 'braftonium' ),
			'min' => '',
			'max' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_template',
				'operator' => '==',
				'value' => 'full-width.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'the_content',
	),
	'active' => 1,
	'description' => '',
));
}