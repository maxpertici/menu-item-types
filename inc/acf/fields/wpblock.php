<?php

defined( 'ABSPATH' ) or	die();

if( function_exists('acf_add_local_field_group') ){
    
    // Field data
    // include( WPAM_CORE_PATH . 'item-types.php' ) ;

    acf_add_local_field_group(array(
        
        'key'      => $mitypes_custom_menu_item_spec['wpblock']['acf_group']['key'],
        'title'    => $mitypes_custom_menu_item_spec['wpblock']['acf_group']['title'],
        'fields'   => $mitypes_custom_menu_item_spec['wpblock']['acf_fields'],

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
   


    /**/
    

    /**
     * Load ...
     *
     * @since 0.10.5
     * 
     * @param 
     * 
     * @return 
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

    add_filter('acf/load_field/name=mitypes_nav_item_wpblock_selector', 'mitypes_load_wpblock_choices');



}