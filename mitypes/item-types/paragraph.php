<?php

return [
    'slug'   => 'parapraph',
    'label'  => __( 'Paragraph', 'menu-item-types'),
    'icon'   => '',
    'render' => '',
    'field-group' => array(
        
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
                    'param' => 'mitypes',
                    'operator' => '==',
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
    )
];