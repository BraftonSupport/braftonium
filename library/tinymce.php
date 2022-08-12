<?php
// TinyMCE show formats button on the 2nd row

// Callback function to insert 'styleselect' into the $buttons array
function br_my_mce_buttons_2( $buttons, $editor_id ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'br_my_mce_buttons_2', 10, 2 );


// Callback function to filter the MCE settings
function br_my_mce_before_init_insert_formats( $init_array, $editor_id = '' ) {  
	// Define the style_formats array
	$style_formats = array(  
        // Each array child is a format with it's own settings
        array( 
            'title' => 'Buttons',
            'items' => array( 
                array( 
                    'title' => 'CTA Button',
                    'selector'  => 'a',
                    'classes'   => 'blue-btn'
                )

            )
        )
    );  
    $style_formats = apply_filters('braftonium_style_formats', $style_formats);
    // Insert the array, JSON ENCODED, into 'style_formats'
    if(count($style_formats) > 0){

        $init_array['style_formats'] = wp_json_encode( $style_formats ); 
    }
	 
	
	return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'br_my_mce_before_init_insert_formats', 10, 2 );  

?>