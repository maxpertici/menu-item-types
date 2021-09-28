<?php
defined( 'ABSPATH' ) or	die();

add_filter( 'walker_nav_menu_start_el', 'mitypes_menu_item_custom_output', 10, 4 );

// https://developer.wordpress.org/reference/hooks/walker_nav_menu_start_el/

function mitypes_menu_item_custom_output( $item_output, $item, $depth, $args ) {

    $custom_item_type = get_post_meta( $item->ID , '_mitypes_custom_item_type' , true );
    // $custom_item_data = get_post_meta( $item->ID , '_mitypes_custom_item_data' , true );

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
                
                // TODO : filter !

                if( ( 'heading'   === $custom_item_type ) && ( ( 'href'=== $attr ) ) ){ continue; }
                if( ( 'image'     === $custom_item_type ) && ( ( 'href'=== $attr ) ) ){ continue; }
                if( ( 'nolink'    === $custom_item_type ) && ( ( 'href'=== $attr ) ) ){ continue; }
                if( ( 'paragraph' === $custom_item_type ) && ( ( 'href'=== $attr ) ) ){ continue; }
                if( ( 'wpblock'   === $custom_item_type ) && ( ( 'href'=== $attr ) ) ){ continue; }

                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters( 'mitypes_the_title', $item->title, $item->ID );
        $title = apply_filters( 'mitypes_nav_menu_item_title', $title, $item, $args, $depth );
        
        ob_start();
        include( plugin_dir_path( __FILE__ ) . 'templates/' . esc_html( $custom_item_type ) . '.php' ) ;
        $custom_menu_item_html = ob_get_clean();
        
        $item_output = $custom_menu_item_html ;
    }
    
    
    return $item_output ;
}