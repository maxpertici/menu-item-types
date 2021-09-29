<?php 

if( ! defined( 'ABSPATH' ) ) exit;

class MITYPES_ACF_Location_Menu_Item_Types extends ACF_Location {

    public function initialize() {
        $this->name = 'mitypes';
        $this->label = __( "Menu Item Types", 'menu-item-types' );
        $this->category = 'forms';
        // $this->object_type = 'post';
    }

    public function get_values( $rule ) {

        include_once( MITYPES_INC_PATH . 'item-types.php' ) ;

        $choices = array();

        
        foreach( $menu_item_types as $k => $collection ){

            foreach( $collection as $type ){
                if( 'post_type_archive' === $type['slug'] ){ continue; }
                $choices[ $type['slug'] ] = $type['label'];
            }

        }


        
        return $choices;
    }

    public function match( $rule, $screen, $field_group ) {
        
        if( ! isset( $screen['nav_menu_item'] ) || 'custom' != $screen['nav_menu_item'] ) { return false ; }
            
        $custom_item_type = get_post_meta( $screen['nav_menu_item_id'] , '_mitypes_custom_item_type' , true );

        if( 'mitypes' !== $rule['param'] ){ return false ; }
            
        if( ! isset( $custom_item_type ) ){ return false ; }

        $result = ( $custom_item_type == $rule['value'] );

        if( $rule['operator'] == '!=' ) {
            return !$result;
        }

        return $result ;
    }
}