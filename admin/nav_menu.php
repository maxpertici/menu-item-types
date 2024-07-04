<?php

use MXP\MITypes\MenuItemTypes\MenuItemTypesFactory;

defined( 'ABSPATH' ) or	die();

/**
 * Enqueue script for admin WP:AM setings page
 *
 * @since 1.0
 */
add_action( 'admin_enqueue_scripts', 'mitypes_nav_menu_enqueue_scripts' );

function mitypes_nav_menu_enqueue_scripts( $hook ){

    if ( 'nav-menus.php' != $hook ) {
        return;
    }

    wp_register_style( 'mitypes_nav_menu_style', plugins_url( './css/mitypes-nav-menu.css', __FILE__ ) );
    $nav_menu_items_has_icons = apply_filters('mitypes_nav_menu_items_has_icons', true);
    if( true === $nav_menu_items_has_icons ){
        wp_enqueue_style( 'mitypes_nav_menu_style' );
    }

    wp_register_script( 'mitypes_nav_menu_script', plugins_url( './js/mitypes-nav-menu.js', __FILE__ ), false, true);
    wp_enqueue_script( 'mitypes_nav_menu_script' );

}



function mitypes_nav_menu_mark_item_type( $item_id, $item, $depth, $args, $id )  {

    $factory = MenuItemTypesFactory::instance();
    $menu_item_types = $factory->getTypes();

    $item_type =  $item->type ;
    $hide_url_of_nav_item = false ;
    
    // check if has meta & suported
    $custom_item_type = get_post_meta( $item_id , '_mitypes_custom_item_type' , true );
    if( '' != $custom_item_type ){
    
        // find item type

        $mit_buildin = array_keys( $menu_item_types['buildin'] );
        $mit_plugin  = array_keys( $menu_item_types['plugin'] );
        $miytpes_supported = array_merge( $mit_buildin, $mit_plugin );
        
        if( in_array( $custom_item_type , $miytpes_supported ) && ( 'post_type_archive' != $custom_item_type  ) ){
            $item_type = $custom_item_type ;
            $hide_url_of_nav_item = true ;
        }

    }

    // $wp_buildin  = array( 'post_type', 'taxonomy' );
    
    echo '<script> mitypes_set_menu_item_type_css( '.$item_id.', "' . $item_type . '", ' . $hide_url_of_nav_item . ' ); </script>';

}

add_action( 'wp_nav_menu_item_custom_fields', 'mitypes_nav_menu_mark_item_type', 10, 5 );



/**
 * 
 * @since : 1.1
 */

add_action( 'admin_head', 'mitypes_mit_items_icons_css' );

function mitypes_mit_items_icons_css( $hook ){

    $factory = MenuItemTypesFactory::instance();
    $menu_item_types = $factory->getTypes();

    $nav_menu_items_has_icons = apply_filters('mitypes_nav_menu_items_has_icons', true);

    if( true === $nav_menu_items_has_icons && isset( $menu_item_types['plugin'] ) && count( $menu_item_types['plugin'] ) > 0 ){

        echo '<style>';
        foreach( $menu_item_types['plugin'] as $item ) :
            $icon = isset( $item['icon'] ) && '' != $item['icon'] ? $item['icon'] : false;
            $icon = str_contains( $icon, '<svg') ? str_replace('"', '\'', 'data:image/svg+xml;utf8,'. preg_replace("/\s+/", " ", $icon)) : esc_url($icon);
            if( $icon ){
                echo '#menu-to-edit .mitypes-item__'.$item['slug'].' .item-title:before {';
                echo 'background: url("'.$icon.'") center center / 20px 20px no-repeat transparent;';
                echo '}';
            }

        endforeach;
        echo '</style>';
    }

}