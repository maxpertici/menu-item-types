<?php


/**
 * Register Menu Item Type
 * 
 * slug
 * icon
 * label
 * field-group
 * render
 *
 * @return void
 */
function mitypes_register_type( $args = array() ){

    $defaults = array(
        'slug'        => null,
        'icon'        => null,
        'label'       => null,
        'field-group' => null,
        'render'      => null,
    );

    // @TODO : check $type requirements
    
    if( isset( $args['fields'] ) ){
        $args['field-group'] = $args['fields'];
    }

    $type = wp_parse_args( $args, $defaults );

    add_filter( 'mitypes_item_types', function( $types ) use ( $type ) {
        $types[] = $type;
        return $types;
    } );
}