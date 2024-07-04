<?php
/**
 * Register Menu Item Type
 * 
 * slug
 * icon
 * label
 * field-group
 * render
 * callback
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

    // check $type requirements
    $type = wp_parse_args( $args, $defaults );
    if( ! $type['slug'] || ! $type['label'] || ! $type['render'] ){
        return;
    }

    // Add to mitypes_item_types
    add_filter( 'mitypes_item_types', function( $types ) use ( $type ) {
        $types[] = $type;
        return $types;
    } );
}