<?php

/**
 * Load image size in "mitypes_image_size" field
 *
 * @since 1.0
 * 
 * @param array $field values of ACF selector
 * 
 * @return array $field to ACF selctor
 */
function mitypes_load_nav_menu_image_item_sizes( $field ) {
    
    $field['choices'] = array();
    $mitypes_image_sizes = get_intermediate_image_sizes() ;
    
    foreach ( $mitypes_image_sizes as $key => $size ) {
        $field['choices'][ $size ] = $size;
    }
    
    $field['choices'][ 'full' ] = 'full' ;
    ksort ( $field['choices'] ) ;

    return $field;
}


function mitypes_nav_menu_enqueue_scripts__for_image_type( $hook ){

    if ( 'nav-menus.php' != $hook ) {
        return;
    }

    wp_enqueue_media();
}

return [
    'slug'   => 'image',
    'label'  => __( 'Image', 'menu-item-types'),
    'icon'   => '',
    'render' => '',
    'callback' => function(){
        add_filter('acf/load_field/name=mitypes_image_size', 'mitypes_load_nav_menu_image_item_sizes');
        add_action( 'admin_enqueue_scripts', 'mitypes_nav_menu_enqueue_scripts__for_image_type' );
    },
    'field-group' => array(
        'key'      => MITYPES_ACF_PREFIX_GROUP.'image',
        'title'    => __( 'Image settings group', 'menu-item-types' ),
        'fields' => array(
            array(
                'key' => MITYPES_ACF_PREFIX_FIELD.'image_selector',
                'label' => __( 'Image', 'menu-item-types' ),
                'name' => 'mitypes_image_media',

                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,

                'wrapper' => array(
                    'width' => '50',
                    'class' => 'mitypes-image__media',
                    'id' => '',
                ),

                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',

                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),

            array(
                'key'   => MITYPES_ACF_PREFIX_FIELD.'image_size',
                'label' => __( 'Size', 'menu-item-types' ),
                'name'  => 'mitypes_image_size',

                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,

                'wrapper' => array(
                    'width' => '50',
                    'class' => 'mitypes-image__size',
                    'id'    => '',
                ),

                'choices' => array(),

                'default_value' => false,
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,

                'return_format' => 'array',
                'ajax' => 0,
                'placeholder' => '',
            ),
            
        ),


        'location' => array(
            array(
                array(
                    // 'param' => 'nav_menu_item',
                    'param' => 'mitypes',
                    'operator' => '==',
                    // 'value' => 'all',
                    'value' => 'image',
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