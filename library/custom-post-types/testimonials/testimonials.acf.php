<?php
	register_field_group(array (
		'id' => 'acf_testimonials',
		'title' => 'Testimonials',
		'fields' => array (
			array (
				'key' => 'field_5925fb3a1d91d',
				'label' => 'Name',
				'name' => 'name',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5925fb4e1d91e',
				'label' => 'Position',
				'name' => 'position',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5925fb581d91f',
				'label' => 'Company',
				'name' => 'company',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5925fb5f1d920',
				'label' => 'Location',
				'name' => 'location',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_website',
				'label' => 'Website',
				'name' => 'website',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'testimonial',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

// function get_the_content_with_formatting ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
// 	$content = get_the_content($more_link_text, $stripteaser, $more_file);
// 	$content = apply_filters('the_content', $content);
// 	$content = str_replace(']]>', ']]&gt;', $content);
// 	return $content;
// }

// Add News Shortcode
// function testimonials_shortcode() {
// 	$q = new WP_Query( array('post_type' =>'testimonials', 'order' => 'DESC', 'posts_per_page' => 10 ));
// 	$output = '<div class="testimonials-list">';
// 	if( $q->have_posts() ) {
// 		while( $q->have_posts() ) {
// 			$q->the_post();
// 			$name = get_field('name');
// 			$position = get_field('position');
// 			$company = get_field('company');
// 			$location = get_field('location');
// 			$website = get_field('website');

// 			$output .= '<div class="testimonial-single">'.get_the_content_with_formatting();

// 			$output .= '<p class="testimonial-meta">';
// 				if (!empty($name)){ $output .= $name; }
// 				if (!empty($position)){ $output .= ', '.$position; }
// 				if (!empty($company)){ $output .= ', '.$company; }
// 				if (!empty($location)){ $output .= ', '.$location; }
// 				if (!empty($website)){ $output .= '<br/><a href="http://'.$website.'" target="_blank"><span class="testimonial-website">'.$website.'</span></a>'; }
// 			$output .= '</p></div>';
// 	    }
// 	}
// 	$output .= '</div>';
// 	return $output;
// }
// add_shortcode( 'testimonials', 'testimonials_shortcode' );