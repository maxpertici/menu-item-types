jQuery(document).ready(function($){
    
    

    /**
     * 
     * 
     * 
     * 
     * 
     * 
     */
    function mitypes_item_type_chekbox_handler(){


        
        $('#mitypes-item-type-custom-metabox input[type="checkbox"]').on('change', function() {
            $(this).parent().parent().parent().find('input[type="checkbox"]').not(this).prop('checked', false)
         });


        $('#mitypes-item-type-post_type_archive-metabox input[type="checkbox"]').on('change', function() {
            $(this).parent().parent().parent().find('input[type="checkbox"]').not(this).prop('checked', false)
         });
    }

    mitypes_item_type_chekbox_handler();

});