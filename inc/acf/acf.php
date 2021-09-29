<?php

defined( 'ABSPATH' ) or	die();

/**
 * Wrapper for loading ACF build-in plugin if not ACF (free and pro) already active
 *
 * @since 1.0
 */
function mitypes_is_acf_loaded(){

    /**
     * Load ACF & configure it
     */
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    
    if (
        ( ! is_plugin_active( 'advanced-custom-fields/acf.php'     ) ) &&
        ( ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) )

    ){

        return false ;

    }

    return true ;

}



/**
 * 
 * ACF notice
 * 
 * @since 1.0
 */
function mitypes_notice_acf_plugin_required(){
    //print the message
    $acf_search_url = 'plugin-install.php?s=advanced-custom-fields&tab=search&type=term';
    $acf_link = get_admin_url() . $acf_search_url ;

    echo '<div id="message" class="error notice is-dismissible">
    <p>'. __( 'Please install and activate', 'menu-item-types') . ' ' . '<a href="'.$acf_link.'">Advanced Custom Fields</a>'. ' ' . __('for using Menu Item Types plugin.' , 'menu-item-types').'</p>
    <button type="button" class="notice-dismiss"><span class="screen-reader-text">'.__('Ignore this message.','menu-item-types').'</span></button>
    </div>';
    
    //make sure to remove notice after its displayed so its only displayed when needed.
    remove_action('admin_notices', 'mitypes_notice_acf_plugin_required');

    // shutdown
    deactivate_plugins( 'menu-item-types/menu-item-types.php' );
}

/**
 * Load ACF fields
 * @since 1.0
 */
function mitypes_load_acf_fields(){
    
    // load fields
    if( is_admin() ){
        
        include_once( MITYPES_INC_PATH . 'item-types.php' ) ;

        // TODO : filtre nouveau item !

        foreach( $menu_item_types as $k => $collection ){

            foreach( $collection as $i => $type ){

                if( isset( $type['slug'] ) ){ if( 'post_type_archive' === $type['slug'] ){ continue; } }

                if( isset( $type['field-group'] ) && '' != (string) $type['field-group'] ){
                    include_once( $type['field-group'] );
                }
            }
        }

    }

}


/**
 * 
 * 
 */

function mitypes_location_types() {

    // Check function exists, then include and register the custom location type class.
    if( function_exists('acf_register_location_type') ) {

        require( MITYPES_ACF_PATH . 'location/acf-mitypes-locations.php' );
        acf_register_location_type( 'MITYPES_ACF_Location_Menu_Item_Types' );
    }
}