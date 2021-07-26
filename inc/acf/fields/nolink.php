<?php

defined( 'ABSPATH' ) or	die();

if( function_exists('acf_add_local_field_group') ){

    acf_add_local_field_group(array(

        'key'      => MITYPES_ACF_PREFIX_GROUP.'nolink',
        'title'    => __( 'Nolink settings group', 'menu-item-types' ),
        
        'fields'   => array(),

        'location' => array(
            array(
                array(
                    // 'param' => 'nav_menu_item',
                    'param' => 'mitypes',
                    'operator' => '==',
                    // 'value' => 'all',
                    'value' => 'nolink',
                ),
            ),
        ),
    
        'menu_order' => 70,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',


    ));
    
}