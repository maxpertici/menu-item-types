jQuery(document).ready(function($){
    
    

    /**
     * 
     * 
     * 
     * 
     * 
     * 
     */
    function mip_item_type_chekbox_handler(){


        
        $('#mip-item-type-custom-metabox input[type="checkbox"]').on('change', function() {
            $(this).parent().parent().parent().find('input[type="checkbox"]').not(this).prop('checked', false)
         });


        $('#mip-item-type-post_type_archive-metabox input[type="checkbox"]').on('change', function() {
            $(this).parent().parent().parent().find('input[type="checkbox"]').not(this).prop('checked', false)
         });
    }

    mip_item_type_chekbox_handler();

    /**
     * 
     * 
     * 
     * 
     * 
     * 
     */
    function mip_item_type_brand_maker(){
        
        var sup_brand = '<sup style="position:absolute;margin-left:4px;font-weight:bold;font-size:0.8em;">MIP</sup>';

        // $('#mip-item-type-post_type_archive-metabox .accordion-section-title').append(sup_brand);
        $('#mip-item-type-custom-metabox .accordion-section-title').append( sup_brand) ;

    }

   mip_item_type_brand_maker();
   


    /**
     * 
     * 
     * 
     * 
     * 
     */
    (function($) {
        var origAppend = $.fn.append;

        $.fn.append = function () {
            return origAppend.apply(this, arguments).trigger("append");
        };
    })(jQuery);
    
    function mip_menu_edit_item_add_mip_item_type_class( menu_item ){
        
        // WPAM item type
        var $_mip_item_type = menu_item.find('input.menu-item-data-type').attr( 'data-mip-item') ;
        if( $_mip_item_type ){ menu_item.addClass('mip-item-type mip-item__' + $_mip_item_type ); }

    }

    function mip_get_menu_item_as_array( ){

        var $_item_list = [] ;
        $( "#menu-to-edit" ).find('.menu-item').each(function(e){
            $_item_list.push( $(this).attr('id') );
        });

        return $_item_list ;
    }

    function mip_compare_list_item( on_load, current_state, on_append ){

        var item_to_parse = [] ;
        
        if( current_state.length === 0 ){
            current_state = on_load ;
        }
        
        // on compare les list
        // concept :
        // varifier pour chaque valeur du on_append qu'elle existe de l'autre cote
        // celles qui n'hexiste pas, on les traite.
        
        on_append.forEach(function(item){

            if( current_state.indexOf(item) < 0 ){
                item_to_parse.push(item);
            }
        });

        return item_to_parse ;
    }

    function mip_menu_edit_add_item_type_class(){

        var $_menu_edit = $( "#menu-to-edit" ) ;

        // collect
        var list_item_of_menu__on_load = mip_get_menu_item_as_array();
        
        // addclass on load (on all item)
        $( "#menu-to-edit" ).find('.menu-item').each(function(e){
            var item_data_type =  $(this).find('input.menu-item-data-type').val() ;
            $(this).addClass('wp-item-type wp-item-type__' + item_data_type );
            // mip_menu_edit_item_add_mip_item_type_class( $(this) );
        });

        var list_item_of_menu__current_state = [] ;

        $( "#menu-to-edit" ).on( "append", function(e) {

            var list_item_of_menu__on_append = mip_get_menu_item_as_array();
        
            var new_item_menu = mip_compare_list_item(
                                    list_item_of_menu__on_load,
                                    list_item_of_menu__current_state,
                                    list_item_of_menu__on_append
                                );

            if(new_item_menu.length > 0  ){

                new_item_menu.forEach(function(id){

                    var item_data_type =  $('#'+id).find('input.menu-item-data-type').val() ;
                    $('#'+id).addClass('wp-item-type wp-item-type__' + item_data_type );
                    mip_menu_edit_item_add_mip_item_type_class( $('#'+id) );
                });
            }

            list_item_of_menu__current_state = list_item_of_menu__on_append ;

        });

    }

    mip_menu_edit_add_item_type_class();
        



   /**
     * 
     * 
     * 
     * 
     * 
     */
    function mip_get_nav_menu_item_fields_key(){
        return mip_nav_menu_js_vars.nav_item_fields_keys ;
    }



    /**
     * 
     * 
     * 
     * 
     */
    var mip_Nav_Menu_Item_Fields_Prepare = function( field ){

        var nav_menu_item = field.$el.parent().parent().parent() ;
                
        var nav_menu_item_type_marker = nav_menu_item.find('.menu-item-handle .item-controls .item-type');
        var nav_menu_item_type_marker_text = nav_menu_item_type_marker.text() ;
        
        // clean pass 1
        var re = /MIP \— /gi;
        var chn = nav_menu_item_type_marker_text;
        var nav_menu_item_type = chn.replace(re, '');

        // Test opur branding, etc
        var str = nav_menu_item_type_marker_text;
        var re = /MIP/i;
        var is_custom_nav_menu_item = str.match(re);
    
        the_custom_nav_item_type = false ;

        if( is_custom_nav_menu_item != null){
            
            // OK : it's a custiom item :)
            // Really ?

            // Already knew ?
            var attr_data_mip_item = nav_menu_item.find('input.menu-item-data-type').attr( 'data-mip-item' );
            
            // if not -> do the trick
            var nav_item_type_specs = Object.keys( mip_nav_menu_js_vars.custom_menu_item_spec );

            if( attr_data_mip_item === undefined ){

                // Loop and find item type
                for( var i = 0 ; i < nav_item_type_specs.length ; i++){
                    var item_type = nav_item_type_specs[i] ;
                    
                    // elmeent and item has same translation :/
                    // stop on the first result for deine item type -> break;
                    // test are on label...

                    if( nav_menu_item_type ===  mip_nav_menu_js_vars.custom_menu_item_spec[item_type].label ){
                        the_custom_nav_item_type = item_type ;
                        break;
                    }
                    
                }

                // Brand item
                if( the_custom_nav_item_type ){
                    var sup_brand_style = ' style="position:absolute;right:calc(100% - 10px);font-weight:bold;font-size:0.8em;" ';
                    var sup_brand       = '<sup' + sup_brand_style + '>MIP</sup>' ;

                    nav_menu_item_type_marker.html( nav_menu_item_type + sup_brand );
                }
                
            
            }else{
               the_custom_nav_item_type = attr_data_mip_item;

            }

            // Write data attr for css icon in admin page

            // nav_menu_item.find('input.menu-item-data-type').attr( 'data-mip-item', item_type);
            // nav_menu_item.find('input.menu-item-data-type').attr( 'data-mip-item', the_custom_nav_item_type);
            
            if( attr_data_mip_item === undefined ){
                nav_menu_item.find('input.menu-item-data-type').attr( 'data-mip-item', the_custom_nav_item_type);    
            }

            mip_menu_edit_item_add_mip_item_type_class( nav_menu_item );
            

            // Ajust item field and settings
            if( the_custom_nav_item_type ){
                mip_nav_menu_item_field_prepare_css( the_custom_nav_item_type, nav_menu_item ) ;
            }

        }

        
        // if Generic -> keep only generic field
        // if custom -> keep only generic field + specific field for this item type
       
        var item_keys = mip_get_nav_menu_item_fields_key();
        mip_nav_menu_item_field_remove_field( field, the_custom_nav_item_type, item_keys );
       

    };

    // field preparation
    function mip_nav_menu_item_field_prepare_css( item_type = false, nav_menu_item ){
        
        if( item_type ){

            // TODO : improve translation support
            // TODO : make this list dynamic
            if(
                item_type === 'heading'   ||
                item_type === 'paragraph' ||
                item_type === 'image'     ||
                item_type === 'wpblock'   ||
                item_type === 'nolink'    ||
                item_type === 'shortcode' ||
                item_type === 'dynamic'

                ){
                nav_menu_item.find( '.field-url' ).hide();
            }
            

        }
    }

    // field cleaning
    function mip_nav_menu_item_field_remove_field( field, nav_item_type, item_keys ){

        // Remove all field for specific custom item, keep all generic field

        // Generic are not remove before action not run
        // hooks itarget only specific field
        // see above

        // Item (generic)
        if( nav_item_type === false ){ nav_item_type = 'item' ; }

        var keep_the_field = false ;

        // Filter filed
        if( nav_item_type === 'item' ){

            // only for generic item
            // keep ?
            for (var i = 0; i < item_keys.length ; i++) {

                if(  nav_item_type === item_keys[ i ].type ){
                    
                    if( field.data.key === item_keys[ i ].key ){
                        keep_the_field = true;

                    }
                    
                   // keep_the_field = true;
                }
            }
            
            // if no -> remove
            if( ! keep_the_field ){
                field.remove();
            }

        }else{

            // item & current item type

            // keep ?
            for (var i = 0; i < item_keys.length ; i++) {

                if(  (nav_item_type === item_keys[ i ].type) || ('item' === item_keys[ i ].type) ){

                    if( field.data.key === item_keys[ i ].key ){
                        keep_the_field = true;
                    }
                    
                   // keep_the_field = true;
                }
            }
            
            // if no -> remove
            if( ! keep_the_field ){
                field.remove();
            }

        }

    }

    /**
     * 
     * 
     * 
     */
    // Construc right list of field key to be filtered
    var item_keys = mip_get_nav_menu_item_fields_key();
    
    for (var i = 0; i < item_keys.length ; i++) {
        
        var field_key =  item_keys[ i ].key;
        
        acf.addAction('load_field/key=' + field_key, mip_Nav_Menu_Item_Fields_Prepare);
        acf.addAction('new_field/key='  + field_key, mip_Nav_Menu_Item_Fields_Prepare);

    }

    /**
     * 
     * 
     * 
     */

});