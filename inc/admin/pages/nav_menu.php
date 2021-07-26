<?php

defined( 'ABSPATH' ) or	die();

/**
 * Enqueue script for admin WP:AM setings page
 *
 * @since 0.1.0
 */
add_action( 'admin_enqueue_scripts', 'mitypes_nav_menu_enqueue_scripts' );

function mitypes_nav_menu_enqueue_scripts( $hook ){

    if ( 'nav-menus.php' != $hook ) {
        return;
    }

    wp_enqueue_media();

    wp_register_style( 'mitypes_nav_menu_style', plugins_url( '../css/mitypes-nav-menu.css', __FILE__ ) );
    wp_enqueue_style( 'mitypes_nav_menu_style' );
    
    /*
    wp_register_script( 'mitypes_nav_menu_script', plugins_url( '../js/mitypes-nav-menu.js', __FILE__ ), false, true);
    
    
    
    // Get custim item config.
    // include( mitypes_LEGACY_MENU_METABOX . 'item-types/mitypes-item-types-config.php' ) ;
    
    include( MITYPES_INC_PATH . 'item-types.php' ) ;

    wp_enqueue_script( 'mitypes_nav_menu_script' );
    wp_localize_script('mitypes_nav_menu_script' , 'mitypes_nav_menu_js_vars', array(
        'theme_notice'           => esc_html__('Save menu to see options.', 'menu-item-types'),
        'custom_menu_item_spec'  => $mitypes_custom_menu_item_spec,
        'nav_item_fields_keys'   => $mitypes_nav_item_fields_keys
        )
    );
    */
    

}



function mitypes_nav_menu_mark_item_type( $item_id, $item, $depth, $args, $id )  {

    $custom_item_type = get_post_meta( $item_id , '_mitypes_custom_item_type' , true );

    if( '' != $custom_item_type ){
        echo '<script>jQuery("#menu-item-'.$item_id.'").addClass( "mitypes-item-type mitypes-item__'.$custom_item_type.'" );</script>';
        echo '<script>jQuery("#menu-item-'.$item_id.'").find( ".field-url" ).hide();</script>';
    }
}

add_action( 'wp_nav_menu_item_custom_fields', 'mitypes_nav_menu_mark_item_type', 10, 5 );