<?php

defined( 'ABSPATH' ) or	die();

if( function_exists('acf_add_local_field_group') ){
    

    acf_add_local_field_group(array(

        'key'      => MITYPES_ACF_PREFIX_GROUP.'heading',
        'title'    => __( 'Heading settings group', 'menu-item-types' ),
        
        'fields' => array(
            
            array(
                'key'   => MITYPES_ACF_PREFIX_FIELD . 'heading_selector',
                'label' => __( 'Heading level' , 'menu-item-types'),
                'name'  => 'mitypes_nav_item_heading_selector',
                'type'  => 'select',

                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,

                'wrapper' => array(
                    'width' => '',
                    'class' => 'mitypes-heading__selector',
                    'id' => '',
                ),

                'choices' => array(
                    'h2' => __( 'Heading 2', 'menu-item-types' ),
                    'h3' => __( 'Heading 3', 'menu-item-types' ),
                    'h4' => __( 'Heading 4', 'menu-item-types' ),
                    'h5' => __( 'Heading 5', 'menu-item-types' ),
                    'h6' => __( 'Heading 6', 'menu-item-types' ),
                ),

                'default_value' => false,
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
        ),

        'location' => array(
            array(
                array(
                    'param' => 'mitypes',
                    'operator' => '==',
                    'value' => 'heading',
                ),
            ),
        ),
        'menu_order' => 90,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
    
}