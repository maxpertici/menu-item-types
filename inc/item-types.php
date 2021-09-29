<?php

defined( 'ABSPATH' ) or	die();

$menu_item_types = array();

$menu_item_types_buildin[ 'nolink'    ] = array( 'slug' => 'nolink'    , 'label' => __( 'No link'        , 'menu-item-types') );
$menu_item_types_buildin[ 'heading'   ] = array( 'slug' => 'heading'   , 'label' => __( 'Heading'        , 'menu-item-types') );
$menu_item_types_buildin[ 'paragraph' ] = array( 'slug' => 'paragraph' , 'label' => __( 'Paragraph'      , 'menu-item-types') );
$menu_item_types_buildin[ 'image'     ] = array( 'slug' => 'image'     , 'label' => __( 'Image'          , 'menu-item-types') );
$menu_item_types_buildin[ 'wpblock'   ] = array( 'slug' => 'wpblock'   , 'label' => __( 'Reusable Block' , 'menu-item-types') );

// $menu_item_types[ 'post_type_archive' ] = array( 'slug' => 'post_type_archive',  'label' => __( 'Post Type Archive', 'menu-item-types') );
$menu_item_types_buildin['post_type_archive'] = array( 'slug' => 'post_type_archive',  'label' => __( 'Post Type Archive', 'menu-item-types') );

ksort( $menu_item_types_buildin );

$mitypes_prefix = '#mitypes' . '_' ;


// setup fields for buildin items
foreach( $menu_item_types_buildin as $type ){
    if( 'post_type_archive' === $type['slug'] ){ continue; }
    $menu_item_types_buildin[ $type['slug'] ]['fields'] = MITYPES_ACF_PATH . 'fields/'.$type['slug'].'.php' ;
}

$menu_item_types['buildin'] = $menu_item_types_buildin ;

// filter for plugin items

$menu_item_types_plugin_items = array();
$menu_item_types_plugin_items = apply_filters( 'mitypes_item_types', $menu_item_types_plugin_items );

ksort( $menu_item_types_plugin_items );

$menu_item_types['plugin'] = array();
foreach( $menu_item_types_plugin_items as $i => $type ){
    $menu_item_types['plugin'][ $type['slug'] ] = $type ;
}
