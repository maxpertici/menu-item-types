<?php
/*
Plugin Name:  Menu Item Types
Plugin URI:   https://maxpertici.fr#menu-item-types
Description:  —
Version:      0.1.0
Author:       Maxime Pertici
Author URI:   https://maxpertici.fr
Contributors:
License:      GPLv2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  meni-item-types
Domain Path:  /languages
*/

defined( 'ABSPATH' ) or	die();


/**
 * Load defines
 * @since 0.1.0
 */
require_once( 'config.php' );


/**
 * Run plugin
 * @since 0.1.0
 */

function mip_run(){

	// Get Translations
	$locale = get_locale();
	$locale = apply_filters( 'plugin_locale', $locale, 'menu-item-types' );
	load_textdomain( 'menu-item-types', WP_LANG_DIR . '/plugins/menu-item-types-' . $locale . '.mo' );
	load_plugin_textdomain( 'menu-item-types', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	// Has ACF ?
	require( MIP_ACF_PATH . 'acf.php' );

	if( ! wpam_is_acf_loaded() ){
		add_action('admin_notices', 'mip_notice_acf_plugin_required');
	}

	if( wpam_is_acf_loaded() ){

		if( is_admin() ){
			add_action( 'acf/init', 'mip_load_acf_fields', 10 );
		}
	}
}

add_action( 'plugins_loaded', 'mip_run' );




/**
 * Second load, initialisation et fire wpam_loaded action
 *
 * @since 0.1.0
 */
function mip_init() {

	if( wpam_is_acf_loaded() ){

		// Admin ?
		if( is_admin() ){
			require_once( MIP_ADMIN_PATH . '/wp_admin.php' );
			require_once( MIP_METABOX . 'mip-menu-item-types.php' ) ;
		}

		/**
		 * Fires when MIP is loaded
		 * @since 0.1.0
		*/
		do_action( 'mip_loaded' );
	}
}


add_action( 'after_setup_theme', 'mip_init' );