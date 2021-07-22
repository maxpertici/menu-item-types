<?php

defined( 'ABSPATH' ) or	die();

// Plugin names
define( 'MITYPES_PLUGIN_NAME' , 'Menu Item types' );
define( 'MITYPES_PLUGIN_SLUG' , sanitize_key( MITYPES_PLUGIN_NAME ) );

// Plugin folder
define( 'MITYPES_PLUGIN_FOLDER_INSTALL' , plugin_dir_path( __DIR__ ) );

// Path base
define( 'MITYPES_FILE' , __FILE__ );
define( 'MITYPES_PATH' , realpath( plugin_dir_path( MITYPES_FILE ) ) . '/' );

define( 'MITYPES_INC_PATH'   , realpath( MITYPES_PATH     . 'inc' )     . '/' );
define( 'MITYPES_ACF_PATH'   , realpath( MITYPES_INC_PATH . 'acf' )     . '/' );
define( 'MITYPES_ADMIN_PATH' , realpath( MITYPES_INC_PATH . 'admin' ) . '/' );
define( 'MITYPES_METABOX'    , realpath( MITYPES_INC_PATH . 'metabox' ) . '/' );

// ACF
define( 'MITYPES_ACF_PREFIX_GROUP'            , 'group_mit_' );
define( 'MITYPES_ACF_PREFIX_FIELD'            , 'field_mit_' );

// Plugin version
if( ! function_exists('get_plugin_data') ){
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
$mitypes_plugin_data = get_plugin_data( MITYPES_PATH . 'menu-item-types.php', false, false ) ;
define( 'MITYPES_VERSION', $mitypes_plugin_data['Version'] );
