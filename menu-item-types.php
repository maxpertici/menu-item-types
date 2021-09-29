<?php
/*
Plugin Name:  Menu Item Types
Plugin URI:   https://maxpertici.fr#menu-item-types
Description:  —
Version:      1.0
Author:       Maxime Pertici
Author URI:   https://maxpertici.fr
Contributors:
License:      GPLv2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  menu-item-types
Domain Path:  /languages
*/

defined( 'ABSPATH' ) or	die();


/**
 * Load defines
 * @since 1.0
 */
require_once( 'config.php' );


/**
 * Run plugin
 * @since 1.0
 */

function mitypes_run(){

	// Get Translations
	$locale = get_locale();
	$locale = apply_filters( 'plugin_locale', $locale, 'menu-item-types' );
	load_textdomain( 'menu-item-types', WP_LANG_DIR . '/plugins/menu-item-types-' . $locale . '.mo' );
	load_plugin_textdomain( 'menu-item-types', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	// Has ACF ?
	require( MITYPES_ACF_PATH . 'acf.php' );

	if( ! mitypes_is_acf_loaded() ){
		add_action('admin_notices', 'mitypes_notice_acf_plugin_required');
	}

	if( mitypes_is_acf_loaded() ){

		if( is_admin() ){
			add_action( 'acf/init', 'mitypes_location_types'  );
			add_action( 'acf/init', 'mitypes_load_acf_fields' );
		}
	}
}

add_action( 'plugins_loaded', 'mitypes_run' );




/**
 * Second load, initialisation et fire mitypes_loaded action
 *
 * @since 1.0
 */
function mitypes_init() {

	if( mitypes_is_acf_loaded() ){

		// Admin ?
		if( is_admin() ){
			require_once( MITYPES_ADMIN_PATH . 'wp_admin.php' );
			require_once( MITYPES_METABOX    . 'mitypes-menu-item-types.php' ) ;
		}
		
		if( ! is_admin() ){
			require_once( MITYPES_INC_PATH   . 'render/menu-item-types-render.php' );
		}

		/**
		 * Fires when MIP is loaded
		 * @since 1.0
		*/
		do_action( 'mitypes_loaded' );
	}
}


add_action( 'after_setup_theme', 'mitypes_init' );