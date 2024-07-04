<?php

use MXP\MITypes\App;
use MXP\MITypes\MenuItemTypes\MenuItemTypesFactory;

defined( 'ABSPATH' ) or	die();

$app = App::instance();
require_once( $app->getDirectoryPath() . 'admin/metabox/item-types/mitypes-item-type-post_type_archive.php' );
require_once( $app->getDirectoryPath() . 'admin/metabox/item-types/mitypes-item-type-custom.php' );


/**
 * 
 * 
 * handler for add menuitem in nva-menu admin screen
 * check with custom and flag and param added url of item
 */

add_filter( 'wp_setup_nav_menu_item' , 'mitypes_setup_nav_menu_item' );

function mitypes_setup_nav_menu_item( $menu_item ){
	
    if( $menu_item->type == 'custom' ){

        $factory = MenuItemTypesFactory::instance();
        $menu_item_types = $factory->getTypes();

        $app = App::instance();

        //Check flag FIRST, only deal with URL if flag hasn't been set
		$custom_item_type = '';
        $custom_item_data = '';
        
        $mitypes_data = $menu_item->url ;
        $url = '';
        
        $is_mitypes_item = false ;

        // Find MIP item type with prefix
        $mitypes_item_types_prefix = array();

        foreach( $menu_item_types as $k => $collection ){

            foreach( $collection as $type ){
                
                if( isset( $type['slug'] ) ){
                    array_push( $mitypes_item_types_prefix, $app->prefix . $type['slug'] );
                }

            }
        }

        foreach( $mitypes_item_types_prefix as $mitypes_type_prefix ){

            if( strpos( $mitypes_data , $mitypes_type_prefix ) === 0 ){

                $app = App::instance();

                $mitypes_item_type = substr( $mitypes_type_prefix, strlen( $app->prefix ) ) ;

                $mitypes_data = substr( $mitypes_data , strlen( $mitypes_type_prefix ) );
                $parts = parse_url( $mitypes_data );
                parse_str( $parts['path'], $results );
                $mitypes_item_key = $results ;
                
                $mitypes_item_keys = array(
                    'item_type' => $mitypes_item_type,
                    'item_data' => $mitypes_item_key
                );
                $is_mitypes_item = true ;
            }

        }
        
        if( $is_mitypes_item ){

            
            // When item is added to menu, set flag
            if( isset( $menu_item->post_status ) && $menu_item->post_status == 'draft' ){
        
                update_post_meta( $menu_item->ID , '_mitypes_custom_item_type' , $mitypes_item_keys['item_type'] );
                update_post_meta( $menu_item->ID , '_mitypes_custom_item_data' , $mitypes_item_keys['item_data'] );

                $custom_item_type = get_post_meta( $menu_item->ID , '_mitypes_custom_item_type' , true );
                $custom_item_data = get_post_meta( $menu_item->ID , '_mitypes_custom_item_data' , true );
            
            }

            //Not new, check meta
            else{

                $custom_item_type = get_post_meta( $menu_item->ID , '_mitypes_custom_item_type' , true );
                $custom_item_data = get_post_meta( $menu_item->ID , '_mitypes_custom_item_data' , true );
                
            }

        }

        if( $is_mitypes_item ){
            
            // Label
            
            if( array_key_exists( $custom_item_type, $menu_item_types['buildin'] ) ){

                if( isset( $menu_item_types['buildin'][ $custom_item_type ][ 'label' ] ) ){
                    $label =  esc_html( $menu_item_types['buildin'][ $custom_item_type ][ 'label' ] );
                }
            }

            if( array_key_exists( $custom_item_type, $menu_item_types['plugin'] ) ){
                if( isset( $menu_item_types['plugin'][ $custom_item_type ][ 'label' ] ) ){
                    $label =  esc_html( $menu_item_types['plugin'][ $custom_item_type ][ 'label' ] );
                }
            }

            // if( isset( $menu_item_types[ $custom_item_type ][ 'label' ] ) ){
            //     $label =  esc_html( $menu_item_types[ $custom_item_type ][ 'label' ] );
            // }

            if( $custom_item_type === 'post_type_archive' ){
                $menu_item->object  = $custom_item_data['menu-item-object'];
                $menu_item->type    = 'post_type_archive';

                $label =  esc_html( $menu_item_types['buildin'][ $custom_item_type ][ 'label' ] );
            }

            if( isset( $label ) ){
                $menu_item->type_label = esc_html( $label );
            }
            
            $menu_item->url = esc_url( $custom_item_data['menu-item-url'] );
        }


	}

	return $menu_item;
}