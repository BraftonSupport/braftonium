<?php 

class BraftoniumGutenbergBlocks{
    static $dir = __DIR__;
    function __construct(){
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

        // Check function exists.
        // if( function_exists('acf_register_block_type') ) {
    
            // register a testimonial block.
            acf_register_block_type(array(
                'name'              => 'cta',
                'title'             => __('CTA'),
                'description'       => __('Call to Action Block'),
                'render_template'   => static::$dir.'/full-width/components/cta/block-cta.html.php',
                'category'          => 'braftonium',
                'icon'              => 'admin-comments',
                'keywords'          => array( 'testimonial', 'quote' ),
            ));
        // }
    }
}
$Braftonium_Gutenberg_Blocks = new BraftoniumGutenbergBlocks();