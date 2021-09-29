<?php

defined( 'ABSPATH' ) or	die();

if( function_exists('acf_add_local_field_group') ){
    
    // Field data
    // include( WPAM_CORE_PATH . 'item-types.php' ) ;

    acf_add_local_field_group(array(
        
        'key'      => MITYPES_ACF_PREFIX_GROUP.'wpblock',
        'title'    => __( 'Block settings group', 'menu-item-types' ),

        'fields' => array(
            
            array(
                'key' => MITYPES_ACF_PREFIX_FIELD.'wpblock_selector',
                'label' => __( 'Reusable Block', 'menu-item-types' ),
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


        'location' => array(
            array(
                array(
                    // 'param' => 'nav_menu_item',
                    'param' => 'mitypes',
                    'operator' => '==',
                    // 'value' => 'all',
                    'value' => 'wpblock',
                ),
            ),
        ),
        'menu_order' => 80,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
   



    /**
     * Load Reusables lbocks in nav item selector of mitypes wpblock
     * @since 1.0
     */
    function mitypes_load_wpblock_choices( $field ) {
        
        // Load reusable blocks
        $field['choices'] = array();
        $acf_fields = array();

        $args = array(
			'post_type'      => 'wp_block',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
        );
        
        $query_reusable = new WP_Query( $args );
        
		if( $query_reusable->have_posts() ){
            
            while ( $query_reusable->have_posts() ) {
                $query_reusable->the_post();
                $acf_fields[ get_the_id() ] = get_the_title() ;
            }
        }
        
        asort($acf_fields);
        $field['choices'] = $acf_fields ;
        
        return $field;
    }

    add_filter('acf/load_field/name=mitypes_wpblock_selector', 'mitypes_load_wpblock_choices');



}