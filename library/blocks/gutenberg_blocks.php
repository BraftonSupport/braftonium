<?php 
/**
 * Register Gutenberg Blocks in combination with Advanced Custom Fields
 */
class BraftoniumGutenbergBlocks{
    static $dir = __DIR__;
    function __construct(){
        // var_dump("construction");
        add_action('acf/init', array($this, 'Braftonium_register_blocks'));
        add_filter( 'block_categories', array($this, 'Create_Braftonium_Category'), 10, 2);
        add_action( 'enqueue_block_editor_assets', array($this,'block_editor_styles' ));
        add_filter('acf/load_field/key=field_5a4d5799d4ddb_list', array($this,'acf_load_post_types'));
        add_filter('acf/load_field/key=field_5a4d572d47280_list', array($this, 'acf_load_list_styles'));
    }
    function Create_Braftonium_Category($categories, $post){
        
            return array_merge(
                $categories,
                array(
                    array(
                        'slug' => 'braftonium',
                        'title' => __( 'Braftonium Blocks', 'braftonium' ),
                    ),
                )
            );
        
        
    }
    function Braftonium_register_blocks() {
        // var_dump("register block");
        $dir = dirname(__FILE__);	
        $files = glob("$dir/guten/**/*.guten-block.php");
        foreach($files as $file){
            $settings = include $file;
            $settings['register']['render_callback'] = array($this, 'render_block_html');
            // $settings['register']['enqueue_style'] = get_template_directory_uri() . '/library/css/editor-style.css';
            // $settings['register']['render_template'] = apply_filters('braftonium_modify_block_template', $settings['register']);
            acf_register_block_type($settings['register']);
            acf_add_local_field_group($settings['fields']);
        }
    }
    function render_block_html($block){
        // '/full-width/components/cta/block-cta.html.php',

        // convert name ("acf/testimonial") into path friendly slug ("testimonial")
        $slug = str_replace('acf/', '', $block['name']);
        // include a template part from within the "template-parts/block" folder
        if( file_exists( get_theme_file_path("library/blocks/guten/{$slug}/block-{$slug}.html.php") ) ) {
            include get_theme_file_path("library/blocks/guten/{$slug}/block-{$slug}.html.php") ;
        }
    }
    function block_editor_styles(){
        wp_enqueue_style('brafton-gutenblock',get_template_directory_uri() . '/library/css/editor-style.css');
    }
    function acf_load_post_types($field){
        $field['choices'] = array();
        $post_types = get_post_types([], 'objects');
        $valid_post_types = array();
        foreach($post_types as $type){
            if($type->public && $type->name != 'page'){
                $valid_post_types[$type->name]  = $type->label;
            }
        }
        $field['choices'] = apply_filters('braftonium_customize_post_types', $valid_post_types);
        return $field;
    }
    function acf_load_list_styles($field){
        // echo '<pre>';
        // var_dump($field);
        // echo '</pre>';
        foreach($field['sub_fields'] as $key => $option){
            if($option['name'] == "other"){
                $choices = array_merge(
                    $field['sub_fields'][$key]['choices'], 
                    array("column-2"    => "Force 2 Columns", "column-3"    => "Force 3 Columns"));
                    $choices = apply_filters('braftonium_custom_list_classes', $choices);
                $field['sub_fields'][$key]['choices'] = $choices;
            }
        }
        // $field['choices'] = array_merge($field['choices'], array('do-it-now'=> "Wow Thisng worked"));
        return $field;
    }
    
}
// var_dump("In file");
$Braftonium_Gutenberg_Blocks = new BraftoniumGutenbergBlocks();