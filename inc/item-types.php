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

$mip_prefix = '#mip' . '_';
$mip_custom_menu_item_spec = array(

    /**
     *  Heading
     */
    
    'heading' => array(
        'label' => __( 'Heading' , 'menu-item-types'),

        'slug'  => 'heading',
        'prefix' => $mip_prefix . 'heading',

        'acf_group' => array(
            'key'   => MIP_ACF_PREFIX_GROUP.'mip_group_nav_item_heading',
            'title' => __( 'Heading settings group', 'menu-item-types' ),
        ),

        'acf_fields' => array(
            
            array(
                'key'   => MIP_ACF_PREFIX_FIELD . 'mip_field_mip_nav_item_heading_selector',
                'label' => __( 'Heading level' , 'menu-item-types'),
                'name'  => 'mip_nav_item_heading_selector',
                'type'  => 'select',

                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,

                'wrapper' => array(
                    'width' => '',
                    'class' => 'mip-heading-settings-field__selector',
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

        'prefix' => $mip_prefix . 'paragraph',

        'acf_group' => array(
            'key'   => MIP_ACF_PREFIX_GROUP.'mip_group_nav_item_paragraph',
            'title' => __( 'Paragraph settings group', 'menu-item-types' ),
        ),

        'acf_fields' => array(

            array(
                'key'   => MIP_ACF_PREFIX_FIELD . 'mip_field_mip_nav_item_paragraph_text',
                'label' => __( 'Text' , 'menu-item-types'),
                'name'  => 'mip_nav_item_paragraph_text',
                'type'  => 'textarea',

                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,

                'wrapper' => array(
                    'width' => '',
                    'class' => 'mip-paragraph-settings-field__text',
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
        'prefix'     => $mip_prefix . 'image',

        'acf_group'  => array(
            'key' => MIP_ACF_PREFIX_GROUP.'mip_group_nav_item_image',
            'title' => __( 'Image settings group', 'menu-item-types' ),
        ),
        
        'acf_fields' => array(
            
            array(
                'key' => MIP_ACF_PREFIX_FIELD.'mip_field_mip_nav_item_image_selector',
                'label' => __( 'Image', 'menu-item-types' ),
                'name' => 'mip_nav_item_image_media',

                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,

                'wrapper' => array(
                    'width' => '50',
                    'class' => 'mip-image-settings-field__media',
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
                'key'   => MIP_ACF_PREFIX_FIELD.'mip_field_mip_nav_item_image_size',
                'label' => __( 'Size', 'menu-item-types' ),
                'name'  => 'mip_nav_item_image_size',

                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,

                'wrapper' => array(
                    'width' => '50',
                    'class' => 'mip-image-settings-field__size',
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
     *  Content
     */
    
    'content' => array(
        
        'label'  => __( 'Content' , 'menu-item-types'),
        
        'slug' => 'content',
        'prefix' => $mip_prefix . 'content',
        
        'acf_group'  => array(
            'key' => MIP_ACF_PREFIX_GROUP.'mip_group_nav_item_content',
            'title' => __( 'Content settings group', 'menu-item-types' ),
        ),

        'acf_fields' => array(
            
            array(

                'key' => MIP_ACF_PREFIX_FIELD.'mip_field_mip_nav_item_content_selector',
                'label' => __( 'Contents', 'menu-item-types' ),
                'name' => 'mip_nav_item_content_selector',

                'type' => 'post_object',
                
                'instructions' => 
                    sprintf(
                        __( 'Choose your <a href="edit.php?post_type=mip-content">%s</a> or <a href="post-new.php?post_type=mip-content">%s</a> if empty.', 'menu-item-types' ) ,
                        __( 'content', 'menu-item-types' ),
                        __( 'create one', 'menu-item-types' )
                    ),

                'required' => 0,
                'conditional_logic' => 0,

                'wrapper' => array(
                    'width' => '',
                    'class' => 'mip-content-settings-field__selector',
                    'id' => '',
                ),
                'post_type' => array(
                    0 => 'mip-content',
                ),
                'taxonomy' => '',
                'allow_null' => 0,
                'multiple' => 0,
                'return_format' => 'object',
                'ui' => 1,
            ),
        ),




    ),



    /**
     *  WP Block
     */
    
    'wpblock' => array(
        'label'      => __( 'Block' , 'menu-item-types'),
        
        'slug' => 'wpblock',
        'prefix'     => $mip_prefix . 'wpblock',

        'acf_group'  => array(
            'key' => MIP_ACF_PREFIX_GROUP.'mip_group_nav_item_wpblock',
            'title' => __( 'Block settings group', 'menu-item-types' ),
        ),
        
        'acf_fields' => array(
            
            array(
                'key' => MIP_ACF_PREFIX_FIELD.'mip_field_mip_nav_item_wpblock_selector',
                'label' => __( 'Reusable Blocks', 'menu-item-types' ),
                'name' => 'mip_nav_item_wpblock_selector',
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
                    'class' => 'mip-wpblock-settings-field__selector',
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

        'prefix' => $mip_prefix . 'nolink',

        'acf_group'  => '',
        'acf_fields' => array(),

    ),

    /**
     *  Post type archive
     */
    
    'post_type_archive' => array(
        'label'  => __( 'Post Type Archive' , 'menu-item-types'),
        'slug' => 'post_type_archive',

        'prefix' => $mip_prefix . 'post_type_archive',

        'acf_group'  => '',
        'acf_fields' => array(),

    ),




    /**
     *  Menu
     */
    
    'menu' => array(
        'label'  => __( 'Menu' , 'menu-item-types'),
        'slug' => 'menu',

        'prefix' => $mip_prefix . 'menu',

        'acf_group'  => '',
        'acf_fields' => array(),

    ),


    
    /**
     *  Shortcode
     */
    
    'shortcode' => array(
        'label'  => __( 'Shortcode' , 'menu-item-types'),
        'slug' => 'shortcode',

        'prefix' => $mip_prefix . 'shortcode',

        'acf_group'  => '',
        'acf_fields' => array(),

    ),



    /**
     *  Search
     */
    
    'search' => array(
        'label'  => __( 'Search' , 'menu-item-types'),
        'slug' => 'search',

        'prefix' => $mip_prefix . 'search',

        'acf_group'  => '',
        'acf_fields' => array(),

    ),



    /**
     *  Dynamic
     */
    
    'dynamic' => array(
        'label'  => __( 'Dynamic' , 'menu-item-types'),
        'slug' => 'dynamic',

        'prefix' => $mip_prefix . 'dynamic',

        'acf_group'  => '',
        'acf_fields' => array(),

    ),

    

    /**
     *  Generic item type (all item)
     */
    'item' => array(
        'label'  => __( 'Item' , 'menu-item-types'),
        'slug' => 'item',

        'prefix' => $mip_prefix . 'item',

        'acf_group'  => array(
            'key' => MIP_ACF_PREFIX_GROUP.'mip_group_nav_item_generic',
            'title' => __( 'Item settings group', 'menu-item-types' ),
        ),

        'acf_fields' => array(
            
            array(
                'key' => MIP_ACF_PREFIX_FIELD . 'mip_field_mip_nav_item_generic_submenu_type',
                'label' => __( 'Submenu type' , 'menu-item-types'),
                'name' => 'mip_nav_item_generic_submenu_type',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => 'mip-submenu-type-settings-field__type',
                    'id' => '',
                ),
                'choices' => array(
                    'default' => __( 'Default' , 'menu-item-types'),
                    'column' => __( 'Columns' , 'menu-item-types'),
                ),
                'default_value' => array(
                    0 => 'default',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => MIP_ACF_PREFIX_FIELD . 'mip_field_mip_nav_item_generic_submenu_colmuns_number',
                'label' => __( 'Number of columns' , 'menu-item-types') ,
                'name' => 'mip_nav_item_generic_submenu_colmuns_number',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => MIP_ACF_PREFIX_FIELD . 'mip_field_mip_nav_item_generic_submenu_type',
                            'operator' => '==',
                            'value' => 'column',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => 'mip-submenu-type-settings-field__colmuns-number',
                    'id' => '',
                ),
                'choices' => array(
                    'auto' => 'Auto',
                    2 =>  __( 'Two'   , 'menu-item-types') ,
                    3 =>  __( 'Three' , 'menu-item-types') ,
                    4 =>  __( 'Four'  , 'menu-item-types') ,
                    5 =>  __( 'Five'  , 'menu-item-types') ,
                    6 =>  __( 'Six'   , 'menu-item-types') ,
                    7 =>  __( 'Seven' , 'menu-item-types') ,
                    8 =>  __( 'Eight' , 'menu-item-types') ,
                    9 =>  __( 'Nine'  , 'menu-item-types') ,
                    10 => __( 'Ten'   , 'menu-item-types') ,
                ),
                'default_value' => array(
                    0 => 'auto',
                ),
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
     * 
     * 
     */
);


/**
 * 
 * 
 * 
 * 
 * 
 */

$mip_nav_item_fields_keys = array();
 
foreach( $mip_custom_menu_item_spec as $item_type => $spec ){
  
    $acf_fields = $spec['acf_fields'] ;
    if(  is_array( $acf_fields ) && count( $acf_fields ) > 0 ){

        foreach(  $acf_fields as $acf_field ){

            array_push(
                $mip_nav_item_fields_keys,
                array(
                    'type' => $item_type ,
                    'key' => $acf_field['key']
                )
            );

        }

    }
}

