<?php
defined( 'ABSPATH' ) or	die();

add_filter( 'walker_nav_menu_start_el', 'mitypes_menu_item_custom_output', 10, 4 );

// https://developer.wordpress.org/reference/hooks/walker_nav_menu_start_el/

function mitypes_menu_item_custom_output( $item_output, $item, $depth, $args ) {

    $custom_item_type = get_post_meta( $item->ID , '_mitypes_custom_item_type' , true );
    // $custom_item_data = get_post_meta( $item->ID , '_mitypes_custom_item_data' , true );

    if( 'post_type_archive' != $custom_item_type ){

        ob_start();
        include( plugin_dir_path( __FILE__ ) . 'templates/'.$custom_item_type.'.php' ) ;
        $custom_menu_item_html = ob_get_clean();
        
        $item_output = $custom_menu_item_html ;
    }
    
    
    return $item_output ;
}