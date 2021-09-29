<?php
defined( 'ABSPATH' ) or	die();

add_filter( 'walker_nav_menu_start_el', 'mitypes_menu_item_custom_output', 10, 4 );

// https://developer.wordpress.org/reference/hooks/walker_nav_menu_start_el/

function mitypes_menu_item_custom_output( $item_output, $item, $depth, $args ) {

    $custom_item_type = get_post_meta( $item->ID , '_mitypes_custom_item_type' , true );
    // $custom_item_data = get_post_meta( $item->ID , '_mitypes_custom_item_data' , true );

    // is supported ? no ? classic output.
    include( MITYPES_INC_PATH . 'item-types.php' ) ;
    $mit_buildin = array_keys( $menu_item_types['buildin'] );
    $mit_plugin  = array_keys( $menu_item_types['plugin'] );
    $miytpes_supported = array_merge( $mit_buildin, $mit_plugin );
    
    if( ! in_array( $custom_item_type , $miytpes_supported ) ){
        return $item_output ;
    }

    if( 'post_type_archive' != $custom_item_type && '' != $custom_item_type ){


        $atts           = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        if ( '_blank' === $item->target && empty( $item->xfn ) ) {
            $atts['rel'] = 'noopener';
        } else {
            $atts['rel'] = $item->xfn;
        }

        $atts['href']         = ! empty( $item->url ) ? $item->url : '';
        $atts['aria-current'] = $item->current ? 'page' : '';

        $atts = apply_filters( 'mitypes_nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';

        foreach ( $atts as $attr => $value ) {

            if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                
                $skip = apply_filters( 'mitypes_nav_menu_link_attributes_builder_skip', false, $custom_item_type, $attr, $value );
                if( $skip ){ continue ; }
                
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters( 'mitypes_the_title', $item->title, $item->ID );
        $title = apply_filters( 'mitypes_nav_menu_item_title', $title, $item, $args, $depth );
        
        include( MITYPES_INC_PATH . 'item-types.php' ) ;
        
        ob_start();
        
        if( array_key_exists( $custom_item_type, $menu_item_types['buildin'] )) {
            
            if( is_file( plugin_dir_path( __FILE__ ) . 'templates/' . esc_html( $custom_item_type ) . '.php' ) ){
                include( plugin_dir_path( __FILE__ ) . 'templates/' . esc_html( $custom_item_type ) . '.php' ) ;
            }
        }

        if( array_key_exists( $custom_item_type, $menu_item_types['plugin'] )) {
            
            if( is_file( $menu_item_types['plugin'][$custom_item_type]['render'] ) ){
                include( $menu_item_types['plugin'][$custom_item_type]['render'] ) ;
            }
        }

        $custom_menu_item_html = ob_get_clean();
        
        $item_output = $custom_menu_item_html ;
    }
    
    
    return $item_output ;
}