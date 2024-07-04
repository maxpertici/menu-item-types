<?php

namespace MXP\MITypes\MenuItemTypes;

use MXP\MITypes\App;
use MXP\MITypes\Plugin;
use MXP\MITypes\Base\Singleton;

final class MenuItemTypesFactory extends Singleton {

	protected App|null $app = null ;
	protected bool $isLoaded = false;
	protected array $buildinTypes = [];
	protected array $pluginTypes = [];

	/**
	 * Load the factory && inject the app as a dependency
	 *
	 * @return void
	 */
	public function load (): void{
		if( $this->isLoaded ){
			return;
		}
		$this->app = App::instance();
		$this->isLoaded = true;
	}

	/**
	 * Register buildin types
	 *
	 * @return void
	 */
    public function registerBuildInTypes (): void{

		$directory = $this->app->getDirectoryPath() . 'mitypes/item-types/';
		$files = scandir( $directory );
		$files = array_diff( $files, [ '.', '..' ] );

		$types = [];
		foreach( $files as $file ){

			if( ! file_exists( $directory . $file ) ){
				continue;
			}
			$settings = include $directory . $file ;
			if( ! is_array( $settings ) ){
				continue;
			}
			$file = str_replace('.php', '', $file );
			$types[ $file ] = $settings ;
			ksort( $types );
			$this->buildinTypes = $types ;
		}
    }

	/**
	 * Register Plugin Types
	 *
	 * @return void
	 */
	public function registerPluginTypes(): void {

		$items = apply_filters( 'mitypes_item_types', [] );
		$items = apply_filters( 'mitypes/item_types', $items  );

		ksort( $items ); // TODO : Sort by label

		$types = [];
		foreach( $items as $i => $type ){
			$types[ $type['slug'] ] = $type ;
		}
		$this->pluginTypes = $types ;
	}


	/**
	 * Load All Types
	 *
	 * @return void
	 */
	public function loadTypes(): void {

		foreach( $this->getTypes() as $k => $collection ){

            foreach( $collection as $i => $type ){
                if( isset( $type['slug'] ) ){ if( 'post_type_archive' === $type['slug'] ){ continue; } }
				$this->loadTypeFields($type);
            }
        }
	}


	/**
	 * Load Fields for a Registered Types
	 * 
	 * @param [type] $type
	 * @return void
	 */
	protected function loadTypeFields( $type ): void {

		$has_field_group = ( isset( $type['field-group'] ) ) ;
		$has_callback    = ( isset( $type['callback'] ) ) ;

		if( $has_field_group ){

			$field_group = null ;

			if( is_string( $type['field-group'] ) && ! empty( $type['field-group'] ) && file_exists( $type['field-group'] ) ){
				$field_group = include( $type['field-group'] );
			}

			if( ! function_exists( 'acf_add_local_field_group' ) ){
				return ;
			}

			if( is_array( $field_group ) ){
				acf_add_local_field_group( $field_group );
			}

			if( is_array( $type['field-group'] ) ){
				acf_add_local_field_group( $type['field-group'] );
			}
		}

		if( $has_callback && is_callable( $type['callback'] ) ){
			call_user_func( $type['callback'] );
		}

	}


	/**
	 * Get Buildin Types
	 *
	 * @return array
	 */
	public function getBuildinTypes(): array{
		return $this->buildinTypes;
	}

	/**
	 * Get plugin types
	 *
	 * @return array
	 */
	public function getPluginTypes(): array{
		return $this->pluginTypes;
	}

	/**
	 * Get all types
	 *
	 * @return array
	 */
	public function getTypes(): array{
		
		return [
			'buildin' => $this->buildinTypes,
			'plugin'  => $this->pluginTypes,
		];
	}

}
