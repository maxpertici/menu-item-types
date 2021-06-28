<?php

defined( 'ABSPATH' ) or	die();

require_once( MIP_METABOX . 'item-types/mip-item-type-post_type_archive.php' );
require_once( MIP_METABOX . 'item-types/mip-item-type-custom.php' );


/**
 * 
 * 
 * handler for add menuitem in nva-menu admin screen
 * check with custom and flag and param added url of item
 */

add_filter( 'wp_setup_nav_menu_item' , 'mip_setup_nav_menu_item' );

function mip_setup_nav_menu_item( $menu_item ){
	
    if( $menu_item->type == 'custom' ){

        // include( mip_LEGACY_MENU_METABOX . 'item-types/wpam-item-types-config.php' ) ;
        include( MIP_INC_PATH . 'item-types.php' ) ;

        //Check flag FIRST, only deal with URL if flag hasn't been set
		$custom_item_type = '';
        $custom_item_data = '';
        
        $mip_data = $menu_item->url ;
        $url = '';
        
        $is_mip_item = false ;

        // Find MIP item type with prefix
        $mip_item_types_prefix = array();

        foreach( $mip_custom_menu_item_spec as $item_type_spec ){
            
            array_push( $mip_item_types_prefix, $item_type_spec['prefix'] );

        }

        foreach( $mip_item_types_prefix as $mip_type_prefix ){
            
            if( strpos( $mip_data , $mip_type_prefix ) === 0 ){

                $mip_item_type = substr( $mip_type_prefix, strlen( $mip_prefix ) ) ;

                $mip_data = substr( $mip_data , strlen( $mip_type_prefix ) );
                $parts = parse_url( $mip_data );
                parse_str( $parts['path'], $results );
                $mip_item_key = $results ;
                
                $mip_item_keys = array(
                    'item_type' => $mip_item_type,
                    'item_data' => $mip_item_key
                );
                $is_mip_item = true ;
            }

        }
        
        if( $is_mip_item ){

            
            // When item is added to menu, set flag
            if( isset( $menu_item->post_status ) && $menu_item->post_status == 'draft' ){
        
                update_post_meta( $menu_item->ID , '_mip_custom_item_type' , $mip_item_keys['item_type'] );
                update_post_meta( $menu_item->ID , '_mip_custom_item_data' , $mip_item_keys['item_data'] );

                $custom_item_type = get_post_meta( $menu_item->ID , '_mip_custom_item_type' , true );
                $custom_item_data = get_post_meta( $menu_item->ID , '_mip_custom_item_data' , true );
            
            }

            //Not new, check meta
            else{

                $custom_item_type = get_post_meta( $menu_item->ID , '_mip_custom_item_type' , true );
                $custom_item_data = get_post_meta( $menu_item->ID , '_mip_custom_item_data' , true );
                
            }

        }

        if( $is_mip_item ){
            
            // Label
            $label =  esc_html( __( 'MIP' , 'menu-item-types') . ' — ' . $mip_custom_menu_item_spec[ $custom_item_type ][ 'label' ] );

            if( $custom_item_type === 'post_type_archive' ){
                $menu_item->object  = $custom_item_data['menu-item-object'];
                $menu_item->type    = 'post_type_archive';

                $label =  esc_html( $mip_custom_menu_item_spec[ $custom_item_type ][ 'label' ] );
            }

            $menu_item->type_label = esc_html( $label );
            $menu_item->url = esc_url( $custom_item_data['menu-item-url'] );
        }


	}

	return $menu_item;
}