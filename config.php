<?php

defined( 'ABSPATH' ) or	die();

// Plugin names
define( 'MIP_PLUGIN_NAME' , 'Menu Item type' );
define( 'MIP_PLUGIN_SLUG' , sanitize_key( MIP_PLUGIN_NAME ) );

// Plugin folder
define( 'MIP_PLUGIN_FOLDER_INSTALL' , plugin_dir_path( __DIR__ ) );

// Path base
define( 'MIP_FILE' , __FILE__ );
define( 'MIP_PATH' , realpath( plugin_dir_path( MIP_FILE ) ) . '/' );

define( 'MIP_INC_PATH' , realpath( MIP_PATH     . 'inc' )     . '/' );
define( 'MIP_ACF_PATH' , realpath( MIP_INC_PATH . 'acf' )     . '/' );
define( 'MIP_METABOX'  , realpath( MIP_INC_PATH . 'metabox' ) . '/' );

// ACF
define( 'MIP_ACF_PREFIX_GROUP'            , 'group_acf_key_' );
define( 'MIP_ACF_PREFIX_FIELD'            , 'field_acf_key_' );

// Plugin version
if( ! function_exists('get_plugin_data') ){
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
$mip_plugin_data = get_plugin_data( MIP_PATH . 'menu-item-types.php', false, false ) ;
define( 'MIP_VERSION', $mip_plugin_data['Version'] );
