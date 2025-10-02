<?php

use MXP\MITypes\App;

$App = App::instance();

return [
    'slug'   => 'nolink',
    'label'  => __( 'No link', 'menu-item-types'),
    'icon'   => '',
    'render' => '',
    'field-group' => array(

        'key'      => $App->acf_group_prefix.'nolink',
        'title'    => __( 'Nolink settings group', 'menu-item-types' ),
        
        'fields'   => array(),

        'location' => array(
            array(
                array(
                    'param' => 'mitypes',
                    'operator' => '==',
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


    )
];