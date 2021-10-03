

/**
 * 
 */
function mitypes_set_menu_item_type_css( item_id, item_type, hide_url = false  ){

    jQuery("#menu-item-" + item_id ).addClass( "mitypes-item-type mitypes-item__" + item_type );
    if( hide_url ){
        jQuery("#menu-item-" + item_id ).find( ".field-url" ).hide();
        jQuery("#menu-item-" + item_id ).find( ".field-link-target" ).hide();
        jQuery("#menu-item-" + item_id ).find( ".field-xfn" ).hide();
        jQuery("#menu-item-" + item_id ).find( ".field-title-attribute" ).hide();
    }

}



/**
 * 
 * 
 */
function mitypes_item_type_chekbox_handler(){

        
    jQuery('#mitypes-item-type-custom-metabox input[type="checkbox"]').on('change', function() {
        jQuery(this).parent().parent().parent().find('input[type="checkbox"]').not(this).prop('checked', false)
     });


    jQuery('#mitypes-item-type-post_type_archive-metabox input[type="checkbox"]').on('change', function() {
        jQuery(this).parent().parent().parent().find('input[type="checkbox"]').not(this).prop('checked', false)
     });
}




jQuery(document).on('ready', function(){
    
    mitypes_item_type_chekbox_handler();
});