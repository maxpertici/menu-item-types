<?php

defined( 'ABSPATH' ) or	die();

if( function_exists('acf_add_local_field_group') ){

    acf_add_local_field_group(array(

        
        'key'      => $mip_custom_menu_item_spec['nolink']['acf_group']['key'],
        'title'    => $mip_custom_menu_item_spec['nolink']['acf_group']['title'],
        'fields'   => $mip_custom_menu_item_spec['nolink']['acf_fields'],

        'location' => array(
            array(
                array(
                    'param' => 'nav_menu_item',
                    'operator' => '==',
                    'value' => 'all',
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