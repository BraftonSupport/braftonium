<?php

return array(
    '5b43bc8cb4c26' => array(
        'key' => '5b43bc8cb4c26',
        'name' => 'widget_areas',
        'label' => __( 'Widget Areas', 'braftonium' ),
        'display' => 'block',
        'sub_fields' => array(
            array(
                'key' => 'field_5b61e4ff523a5',
                'label' => 'Title',
                'name' => 'title',
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
            array(
                'key' => 'field_5b43bc9b0acf1',
                'label' => 'Widget Area',
                'name' => 'widget_area',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'round' => 'Round',
                    'thumb' => 'Thumbnail',
                    'square' => 'Squared',
                    'full' => 'Full',
                ),
                'default_value' => array(
                ),
                'allow_null' => 0,
                'multiple' => 1,
                'ui' => 0,
                'ajax' => 0,
                'return_format' => 'value',
                'placeholder' => '',
            ),
            array(
                'key' => 'field_5b61e59f2b5a2',
                'label' => __( 'Style', 'braftonium' ),
                'name' => 'style',
                'type' => 'clone',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'clone' => array(
                    0 => 'group_5a4d3902e55eb',
                ),
                'display' => 'seamless',
                'layout' => 'block',
                'prefix_label' => 0,
                'prefix_name' => 0,
            ),
        ),
        'min' => '',
        'max' => '',
    )
);