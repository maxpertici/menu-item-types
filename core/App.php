<?php

namespace MXP\MITypes;

use MXP\MITypes\Base\Plugin;
use MXP\MITypes\MenuItemTypes\MenuItemTypesFactory;

final class App extends Plugin {

	public $prefix = '#mitypes' . '_' ;

	private $itemsColection = [];

	/**
	 * Load the plugin
	 *
	 * @return void
	 */
	public function load() {
		$this->setHooks();
	}

	/**
	 * Set Hooks
	 *
	 * @return void
	 */
	private function setHooks() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
		add_action( 'after_setup_theme', [ $this, 'setup' ] );
	}

	/**
	 * Init the plugin
	 *
	 * @return void
	 */
	public function init(){

		$this->loadTranslations();

		if( ! $this->isAcfLoaded() ){
			add_action('admin_notices',  [ $this, 'adminNoticeAcfPluginRequired' ] );
		}

		if( $this->isAcfLoaded() ){

			if( is_admin()  ){
				add_action( 'acf/init', [ $this, 'addAcfLocations' ]  );
			}

			add_action( 'acf/init', [ $this, 'loadTypesFactory' ] );
		}

		do_action('mitypes_init');
	}


	/**
	 * Get Translations
	 *
	 * @return void
	 */
	protected function loadTranslations(){
		$locale = get_locale();
		$locale = apply_filters( 'plugin_locale', $locale, 'menu-item-types' );
		load_textdomain( 'menu-item-types', WP_LANG_DIR . '/plugins/menu-item-types-' . $locale . '.mo' );
		load_plugin_textdomain( 'menu-item-types', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}


	/**
	 * Check if ACF is loaded
	 *
	 * @return boolean
	 */
	function isAcfLoaded(){
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if( ! class_exists( 'ACF' ) ){ return false ; }
		return true ;
	}


	/**
	 * Admin Notice for ACF Plugin Requirement
	 *
	 * @return void
	 */
	function adminNoticeAcfPluginRequired(){

		// Print
		$acf_search_url = 'plugin-install.php?s=advanced-custom-fields&tab=search&type=term';
		$acf_link = get_admin_url() . $acf_search_url ;
	
		echo '<div id="message" class="error notice is-dismissible">
		<p>'. esc_html__( 'Please install and activate', 'menu-item-types') . ' ' . '<a href="' . esc_url( $acf_link ).'">Advanced Custom Fields</a>'. ' ' . esc_html__('for using Menu Item Types plugin.' , 'menu-item-types').'</p>
		</div>';
		
		// Make sure to remove notice after its displayed so its only displayed when needed && shutdown the plugin
		remove_action('admin_notices',  [ $this, 'adminNoticeAcfPluginRequired' ] );
		deactivate_plugins( 'menu-item-types/menu-item-types.php' );
	}

	/**
	 * ACF Locations
	 *
	 * @return void
	 */
	function addAcfLocations() {
		if( ! function_exists('acf_register_location_type') ) { return; }
		acf_register_location_type( 'MITYPES_ACF_Location_Menu_Item_Types' );
	}
	
	/**
	 * Handle ACF Fields
	 *
	 * @return void
	 */
	function loadTypesFactory(){
		$factory = MenuItemTypesFactory::instance();
		$factory->load();
		$factory->registerBuildInTypes();
		$factory->registerPluginTypes();
		$factory->loadTypes();
	}

	/**
	 * Setup the plugin with ACF checks
	 *
	 * @return void
	 */
	function setup(){

		if( ! $this->isAcfLoaded() ){
			return;
		}

		if( is_admin() ){
			$admin = Admin::instance();
			$admin->init();
		}
		
		if( ! is_admin() ){
			$front = Front::instance();
			$front->init();
		}

		do_action( 'mitypes_setup' );
		do_action( 'mitypes_loaded' );
	}

}
