<?php

defined( 'ABSPATH' ) or	die();

$menu_item_types = array();

$menu_item_types[ 'heading' ]           = array( 'slug' => 'heading',            'label' => __( 'Heading' ,          'menu-item-types') );
$menu_item_types[ 'image' ]             = array( 'slug' => 'image',              'label' => __( 'Image' ,            'menu-item-types') );
$menu_item_types[ 'nolink' ]            = array( 'slug' => 'nolink',             'label' => __( 'No link' ,          'menu-item-types') );
$menu_item_types[ 'paragraph' ]         = array( 'slug' => 'paragraph',          'label' => __( 'Paragraph' ,        'menu-item-types') );
$menu_item_types[ 'wpblock' ]           = array( 'slug' => 'wpblock',            'label' => __( 'Reusable Blocks',   'menu-item-types') );

$menu_item_types[ 'post_type_archive' ] = array( 'slug' => 'post_type_archive',  'label' => __( 'Post Type Archive', 'menu-item-types') );

$mitypes_prefix = '#mitypes' . '_';

// TODO : filtre nouveau item !