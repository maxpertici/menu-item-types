<?php

defined( 'ABSPATH' ) or	die();

$menu_item_types = array();

$menu_item_types[ 'nolink' ]            = array( 'slug' => 'nolink',             'label' => __( 'No link' ,          'menu-item-types') );
$menu_item_types[ 'heading' ]           = array( 'slug' => 'heading',            'label' => __( 'Heading' ,          'menu-item-types') );
$menu_item_types[ 'paragraph' ]         = array( 'slug' => 'paragraph',          'label' => __( 'Paragraph' ,        'menu-item-types') );
$menu_item_types[ 'image' ]             = array( 'slug' => 'image',              'label' => __( 'Image' ,            'menu-item-types') );
$menu_item_types[ 'wpblock' ]           = array( 'slug' => 'wpblock',            'label' => __( 'Reusable Block',    'menu-item-types') );

$menu_item_types[ 'post_type_archive' ] = array( 'slug' => 'post_type_archive',  'label' => __( 'Post Type Archive', 'menu-item-types') );

$mitypes_prefix = '#mitypes' . '_' ;

// setup fields
foreach( $menu_item_types as $type ){
    if( 'post_type_archive' === $type['slug'] ){ continue; }
    $menu_item_types[ $type['slug'] ]['fields'] = MITYPES_ACF_PATH . 'fields/'.$type['slug'].'.php' ;
}

// filtre
$menu_item_types = apply_filters( 'mitypes_item_types', $menu_item_types );