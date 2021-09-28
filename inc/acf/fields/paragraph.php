<?php

defined( 'ABSPATH' ) or	die();

if( function_exists('acf_add_local_field_group') ){
    


    acf_add_local_field_group(array(
        
        'key'      => MITYPES_ACF_PREFIX_GROUP.'paragraph',
        'title'    => __( 'Paragraph settings group', 'menu-item-types' ),
        
        'fields' => array(

            array(
                'key'   => MITYPES_ACF_PREFIX_FIELD . 'paragraph_text',
                'label' => __( 'Text' , 'menu-item-types'),
                'name'  => 'mitypes_paragraph_text',
                'type'  => 'textarea',

                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,

                'wrapper' => array(
                    'width' => '',
                    'class' => 'mitypes-paragraph__text',
                    'id' => '',
                ),

                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => 'br',
            ),

        ),

        'location' => array(
            array(
                array(
                    // 'param' => 'nav_menu_item',
                    'param' => 'mitypes',
                    'operator' => '==',
                    // 'value' => 'all',
                    'value' => 'paragraph',
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



    /* Filters */
    /*
    add_filter( 'acf/load_field_group', 'mitypes_nav_item_field_group_loader' );

    function mitypes_nav_item_field_group_loader( $field_group ){

        var_dump($field_group);
        
        return $field_group ;
    }
    */

    /*
    add_filter('acf/prepare_field/key='.WPAM_ACF_PREFIX_FIELD.'mitypes_field_mitypes_menu_nav_item_image_selector', 'mitypes_nav_item_image_prepare_field' );
    
    function mitypes_nav_item_image_prepare_field( $field ) {
        return $field;
    }
    */
    
}