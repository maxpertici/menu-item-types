<?php

use MXP\MITypes\MenuItemTypes\MenuItemTypesFactory;

defined( 'ABSPATH' ) or	die();

add_filter( 'walker_nav_menu_start_el', 'mitypes_menu_item_custom_output', 10, 4 );

// https://developer.wordpress.org/reference/hooks/walker_nav_menu_start_el/

function mitypes_menu_item_custom_output( $item_output, $item, $depth, $args ) {

    $custom_item_type = get_post_meta( $item->ID , '_mitypes_custom_item_type' , true );
    // $custom_item_data = get_post_meta( $item->ID , '_mitypes_custom_item_data' , true );

    // is supported ? no ? classic output.
    $factory = MenuItemTypesFactory::instance();
    $menu_item_types = $factory->getTypes();

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
            $atts['rel'] = 'noopener noreferrer';
        } else {
            $atts['rel'] = $item->xfn;
        }

        $atts['href']         = ! empty( $item->url ) ? $item->url : '';
        $atts['aria-current'] = $item->current ? 'page' : '';

        $atts = apply_filters( 'mitypes_nav_menu_link_attributes', $atts, $item, $args, $depth, $custom_item_type );

        $attributes = '';

        foreach ( $atts as $attr => $value ) {

            if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters( 'mitypes_the_title', $item->title, $item->ID );
        $title = apply_filters( 'mitypes_nav_menu_item_title', $title, $item, $args, $depth );

        $factory = MenuItemTypesFactory::instance();
        $menu_item_types = $factory->getTypes();

        if (
            isset($menu_item_types['plugin'][$custom_item_type]['render_callback'])
            && is_callable($menu_item_types['plugin'][$custom_item_type]['render_callback'])
        ) {
            $custom_menu_item_html = call_user_func($menu_item_types['plugin'][$custom_item_type]['render_callback'], $item, $custom_item_type, $args, $depth);
        } else {
            ob_start();

            // path
            $path = plugin_dir_path(__FILE__) . 'templates/' . esc_html($custom_item_type) . '.php';
            $path = apply_filters('mitypes_render_path', $path, $custom_item_type);

            if (array_key_exists($custom_item_type, $menu_item_types['buildin'])) {
                if (is_file($path)) {
                    include($path);
                }
            }


            // additionnals paths
            if (isset($menu_item_types['plugin'][$custom_item_type]['render'])) :
                $path = $menu_item_types['plugin'][$custom_item_type]['render'];
                $path = apply_filters('mitypes_render_path', $path, $custom_item_type);

                if (array_key_exists($custom_item_type, $menu_item_types['plugin'])) {
                    if (is_file($path)) {
                        include($path);
                    }
                }
            endif;

            $custom_menu_item_html = ob_get_clean();
        }

        $item_output = $custom_menu_item_html ;
    }


    return $item_output ;
}


/**
 * Apply specific classses to nav menu item <li>
 */
function mitypes_nav_menu_item_class( $classes, $item, $args ) {

    $custom_item_type = get_post_meta( $item->ID , '_mitypes_custom_item_type' , true );
    if( '' != $custom_item_type ){
        $classes[] = 'mitypes-' . $custom_item_type ;
    }
    return $classes;
}

add_filter( 'nav_menu_css_class' , 'mitypes_nav_menu_item_class', 10, 4 );



/**
 * Handle attributes : skip href
 */

function mitypes_nav_menu_link_attributes_skiper( $atts, $item, $args, $depth, $custom_item_type ){

	if( 'heading'   === $custom_item_type ){ unset( $atts['href'], $atts['target'], $atts['rel'], $atts['title'] ) ; }
	if( 'image'     === $custom_item_type ){ unset( $atts['href'], $atts['target'], $atts['rel'], $atts['title'] ) ; }
	if( 'nolink'    === $custom_item_type ){ unset( $atts['href'], $atts['target'], $atts['rel'], $atts['title'] ) ; }
	if( 'paragraph' === $custom_item_type ){ unset( $atts['href'], $atts['target'], $atts['rel'], $atts['title'] ) ; }

	return $atts ;
}

add_filter( 'mitypes_nav_menu_link_attributes', 'mitypes_nav_menu_link_attributes_skiper', 11, 5 );