<?php

namespace MXP\MITypes\Base;

use MXP\MITypes\Base\Singleton;

class Plugin extends Singleton {

	public $version = '' ;
	protected $pluginUrl = null ;
	protected $directoryPath = null ;

	public function createFromFile(  $mainPluginFilePath = null  ){
		
		if( is_null( $mainPluginFilePath ) ){ return ; }

		$this->setDirectoryPath( $mainPluginFilePath ) ;
		$this->setPluginUrl();
		$this->setVersion();
	}

	private function setVersion(){
		if( ! function_exists('get_plugin_data') ){
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		$plugin_data = get_plugin_data( $this->directoryPath . 'menu-item-types.php' ) ;
		$this->version = $plugin_data['Version'] ;
	}

	private function setPluginUrl() {
		if( is_null($this->directoryPath) ){ return ; }
		$this->pluginUrl = trailingslashit( plugin_dir_url( $this->directoryPath ) . 'menu-item-types' ) ;
	}

	private function setDirectoryPath( $mainPluginFilePath ){
		$this->directoryPath = trailingslashit( dirname( $mainPluginFilePath ) );
	}

	public function getVersion(){
		return $this->version;
	}

	public function getDirectoryPath(){
		return $this->directoryPath;
	}
}