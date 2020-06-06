<?php 

class BraftoniumGutenbergBlocks{
    static $dir = __DIR__;
    function __construct(){
        // var_dump("construction");
        add_action('acf/init', array($this, 'Braftonium_register_blocks'));
        add_filter( 'block_categories', array($this, 'Create_Braftonium_Category'), 10, 2);
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
        $files = glob("$dir/full-width/components/**/*.guten-block.php");
        foreach($files as $file){
            $settings = include $file;
            $settings['register']['render_callback'] = array($this, 'render_block_html');
            
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
        if( file_exists( get_theme_file_path("library/blocks/full-width/components/{$slug}/block-{$slug}.html.php") ) ) {
            include get_theme_file_path("library/blocks/full-width/components/{$slug}/block-{$slug}.html.php") ;
        }
    }
}
// var_dump("In file");
$Braftonium_Gutenberg_Blocks = new BraftoniumGutenbergBlocks();