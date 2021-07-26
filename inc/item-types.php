<?php

defined( 'ABSPATH' ) or	die();


/**
 * 
 * 
 * 
 * 
 * 
 * 
 */


// Custom nav item specifications

$mitypes_prefix = '#mitypes' . '_';
$mitypes_custom_menu_item_spec = array(

    /**
     *  Heading
     */
    
    'heading' => array(
        'label' => __( 'Heading' , 'menu-item-types'),

        'slug'  => 'heading',
        'prefix' => $mitypes_prefix . 'heading',

        'acf_group' => array(
            'key'   => MITYPES_ACF_PREFIX_GROUP.'heading',
            'title' => __( 'Heading settings group', 'menu-item-types' ),
        ),

        'acf_fields' => array(
            
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



    ),




    /**
     *  Paragraph
     */
    
    'paragraph' => array(
        'label'  => __( 'Paragraph' , 'menu-item-types'),
        'slug' => 'paragraph',

        'prefix' => $mitypes_prefix . 'paragraph',

        'acf_group' => array(
            'key'   => MITYPES_ACF_PREFIX_GROUP.'paragraph',
            'title' => __( 'Paragraph settings group', 'menu-item-types' ),
        ),

        'acf_fields' => array(

            array(
                'key'   => MITYPES_ACF_PREFIX_FIELD . 'paragraph_text',
                'label' => __( 'Text' , 'menu-item-types'),
                'name'  => 'mitypes_nav_item_paragraph_text',
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

    ),


    /**
     *  Image type
     */
    'image' => array(
        'label'      => __( 'Image' , 'menu-item-types'),
        
        'slug' => 'image',
        'prefix'     => $mitypes_prefix . 'image',

        'acf_group'  => array(
            'key' => MITYPES_ACF_PREFIX_GROUP.'image',
            'title' => __( 'Image settings group', 'menu-item-types' ),
        ),
        
        'acf_fields' => array(
            
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
                'name'  => 'mitypes_nav_item_image_size',

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



    ),






    /**
     *  WP Block
     */
    
    'wpblock' => array(
        'label'      => __( 'Block' , 'menu-item-types'),
        
        'slug' => 'wpblock',
        'prefix'     => $mitypes_prefix . 'wpblock',

        'acf_group'  => array(
            'key' => MITYPES_ACF_PREFIX_GROUP.'wpblock',
            'title' => __( 'Block settings group', 'menu-item-types' ),
        ),
        
        'acf_fields' => array(
            
            array(
                'key' => MITYPES_ACF_PREFIX_FIELD.'wpblock_selector',
                'label' => __( 'Reusable Blocks', 'menu-item-types' ),
                'name' => 'mitypes_wpblock_selector',
                'type' => 'select',
                
                'instructions' => 
                    sprintf(
                        __( 'Choose your <a href="edit.php?post_type=wp_block">%s</a> or <a href="post-new.php?post_type=wp_block">%s</a> if empty.', 'menu-item-types' ) ,
                        __( 'reusable block', 'menu-item-types' ),
                        __( 'create one', 'menu-item-types' )
                    ),

                'required' => 0,
                'conditional_logic' => 0,

                'wrapper' => array(
                    'width' => '',
                    'class' => 'mitypes-wpblock__selector',
                    'id' => '',
                ),

                'choices' => array(),
                'default_value' => array(),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'array',
                'ajax' => 0,
                'placeholder' => '',
            ),
        ),



    ),


    /**
     *  No link
     */
    
    'nolink' => array(
        'label'  => __( 'No link' , 'menu-item-types'),
        'slug' => 'nolink',

        'prefix' => $mitypes_prefix . 'nolink',

        'acf_group'  => array(
            'key' => MITYPES_ACF_PREFIX_GROUP.'nolink',
            'title' => __( 'Nolink settings group', 'menu-item-types' ),
        ),

        'acf_fields' => array(),

    ),

    /**
     *  Post type archive
     */
    
    'post_type_archive' => array(
        'label'  => __( 'Post Type Archive' , 'menu-item-types'),
        'slug' => 'post_type_archive',

        'prefix' => $mitypes_prefix . 'post_type_archive',

        'acf_group'  => '',
        'acf_fields' => array(),

    ),




    // — — — — — — —
);




/**
 * 
 * 
 * 
 * 
 * 
 */

/*

$mitypes_nav_item_fields_keys = array();
 
foreach( $mitypes_custom_menu_item_spec as $item_type => $spec ){
  
    $acf_fields = $spec['acf_fields'] ;
    if(  is_array( $acf_fields ) && count( $acf_fields ) > 0 ){

        foreach(  $acf_fields as $acf_field ){

            // echo '<pre>' ; var_dump( $acf_field ); echo '</pre>'; die;

            array_push(
                $mitypes_nav_item_fields_keys,
                array(
                    'type' => $item_type ,
                    'key'  => $acf_field['key']
                )
            );

        }

    }
}


*/